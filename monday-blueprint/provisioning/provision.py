#!/usr/bin/env python3
"""
Monday.com Enterprise Blueprint — provisioner.

Maakt de volledige structuur (workspaces, boards, groepen, kolommen, connect-
board relaties en mirrors) aan via de Monday GraphQL API, op basis van
blueprint.yaml. Idempotent: bestaande items worden hergebruikt, niet gedupliceerd.

GEBRUIK
    export MONDAY_TOKEN="<jouw_api_token>"      # of: --token-file ~/.monday_token
    python3 provision.py --dry-run             # toon plan, geen API-calls
    python3 provision.py                        # voer uit

VEREIST
    pip install pyyaml requests
    Netwerktoegang tot https://api.monday.com (host op de egress-allowlist).

VEILIGHEID
    Token NOOIT committen. Lees via env-var of een bestand buiten de repo.
"""
import argparse
import json
import os
import sys
import time
import pathlib

try:
    import yaml
except ImportError:
    sys.exit("PyYAML ontbreekt: pip install pyyaml")

API_URL = "https://api.monday.com/v2"
API_VERSION = "2024-10"
HERE = pathlib.Path(__file__).parent
STATE_FILE = HERE / ".state.json"

# Map blueprint kolomtype -> Monday ColumnType enum
TYPE_MAP = {
    "name": None,            # 'name' is de standaard itemkolom, niet aanmaken
    "text": "text",
    "long_text": "long_text",
    "numbers": "numbers",
    "status": "status",
    "dropdown": "dropdown",
    "people": "people",
    "date": "date",
    "email": "email",
    "phone": "phone",
    "link": "link",
    "file": "file",
    "tags": "tags",
    "timeline": "timeline",
    "checkbox": "checkbox",
    "formula": "formula",
    "item_id": "item_id",
    "board_relation": "board_relation",
    "mirror": "mirror",
}


class Monday:
    def __init__(self, token, dry_run=False, verbose=True):
        self.token = token
        self.dry_run = dry_run
        self.verbose = verbose
        self._session = None

    def _post(self, query, variables=None):
        if self.dry_run:
            return {"data": {}}
        import requests
        if self._session is None:
            self._session = requests.Session()
        for attempt in range(5):
            r = self._session.post(
                API_URL,
                json={"query": query, "variables": variables or {}},
                headers={
                    "Authorization": self.token,
                    "Content-Type": "application/json",
                    "API-Version": API_VERSION,
                },
                timeout=60,
            )
            data = r.json()
            if "errors" in data:
                msg = json.dumps(data["errors"])
                # complexiteit/rate limit -> backoff
                if "complexity" in msg.lower() or r.status_code == 429:
                    time.sleep(2 ** attempt)
                    continue
                raise RuntimeError(f"GraphQL error: {msg}\nQuery: {query[:200]}")
            time.sleep(0.3)  # vriendelijk voor de rate limit
            return data
        raise RuntimeError("Te vaak rate-limited; later opnieuw proberen.")

    # ---- queries ----
    def list_workspaces(self):
        q = "query { workspaces (limit:200) { id name } }"
        d = self._post(q)
        return {w["name"]: w["id"] for w in (d.get("data", {}).get("workspaces") or [])}

    def list_boards(self, workspace_id):
        q = "query ($ws:[ID!]) { boards (workspace_ids:$ws, limit:300) { id name } }"
        d = self._post(q, {"ws": [str(workspace_id)]})
        return {b["name"]: b["id"] for b in (d.get("data", {}).get("boards") or [])}

    def board_groups(self, board_id):
        q = "query ($id:[ID!]) { boards (ids:$id) { groups { id title } } }"
        d = self._post(q, {"id": [str(board_id)]})
        bs = d.get("data", {}).get("boards") or [{}]
        return {g["title"]: g["id"] for g in (bs[0].get("groups") or [])}

    def board_columns(self, board_id):
        q = "query ($id:[ID!]) { boards (ids:$id) { columns { id title type } } }"
        d = self._post(q, {"id": [str(board_id)]})
        bs = d.get("data", {}).get("boards") or [{}]
        return {c["title"]: {"id": c["id"], "type": c["type"]} for c in (bs[0].get("columns") or [])}

    # ---- mutations ----
    def create_workspace(self, name, kind, description):
        q = ('mutation ($n:String!,$k:WorkspaceKind!,$d:String) '
             '{ create_workspace (name:$n, kind:$k, description:$d) { id } }')
        d = self._post(q, {"n": name, "k": kind, "d": description})
        return d.get("data", {}).get("create_workspace", {}).get("id", "DRYRUN")

    def create_board(self, name, kind, workspace_id, description):
        q = ('mutation ($n:String!,$k:BoardKind!,$w:ID!,$d:String) '
             '{ create_board (board_name:$n, board_kind:$k, workspace_id:$w, description:$d) { id } }')
        d = self._post(q, {"n": name, "k": kind, "w": str(workspace_id), "d": description})
        return d.get("data", {}).get("create_board", {}).get("id", "DRYRUN")

    def create_group(self, board_id, title):
        q = ('mutation ($b:ID!,$t:String!) '
             '{ create_group (board_id:$b, group_name:$t) { id } }')
        d = self._post(q, {"b": str(board_id), "t": title})
        return d.get("data", {}).get("create_group", {}).get("id", "DRYRUN")

    def create_column(self, board_id, title, ctype, defaults=None, description=None):
        q = ('mutation ($b:ID!,$t:String!,$c:ColumnType!,$d:JSON,$desc:String) '
             '{ create_column (board_id:$b, title:$t, column_type:$c, defaults:$d, description:$desc) '
             '{ id title type } }')
        vars = {"b": str(board_id), "t": title, "c": ctype,
                "d": json.dumps(defaults) if defaults else None, "desc": description}
        d = self._post(q, vars)
        return d.get("data", {}).get("create_column", {}).get("id", "DRYRUN")


def status_defaults(labels):
    return {"labels": {str(i): name for i, name in enumerate(labels)}}


def dropdown_defaults(labels):
    return {"settings": {"labels": [{"id": i, "name": name} for i, name in enumerate(labels)]}}


def relation_defaults(board_id, multiple):
    return {"boardIds": [int(board_id)] if str(board_id).isdigit() else [board_id],
            "allowMultipleItems": bool(multiple)}


def log(msg):
    print(msg, flush=True)


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("--dry-run", action="store_true", help="Toon plan zonder API-calls")
    ap.add_argument("--blueprint", default=str(HERE / "blueprint.yaml"))
    ap.add_argument("--token-file", default=None, help="Pad naar bestand met API-token")
    args = ap.parse_args()

    token = os.environ.get("MONDAY_TOKEN")
    if not token and args.token_file:
        token = pathlib.Path(args.token_file).expanduser().read_text().strip()
    if not token and not args.dry_run:
        sys.exit("Geen token. Zet MONDAY_TOKEN of gebruik --token-file (of --dry-run).")

    bp = yaml.safe_load(pathlib.Path(args.blueprint).read_text(encoding="utf-8"))
    s = bp["settings"]
    api = Monday(token or "DRYRUN", dry_run=args.dry_run)

    state = {"workspaces": {}, "boards": {}, "columns": {}}  # columns: {board_key: {col_id: monday_col_id}}
    mode = "DRY-RUN (geen wijzigingen)" if args.dry_run else "LIVE"
    log(f"== Monday provisioner — {mode} ==\n")

    # ---- Fase A: workspaces ----
    log("[A] Workspaces")
    existing_ws = {} if args.dry_run else api.list_workspaces()
    for ws in bp["workspaces"]:
        if ws["name"] in existing_ws:
            wid = existing_ws[ws["name"]]
            log(f"  = bestaat: {ws['name']} ({wid})")
        else:
            wid = api.create_workspace(ws["name"], s["workspace_kind"], ws.get("description", ""))
            log(f"  + nieuw:   {ws['name']} ({wid})")
        state["workspaces"][ws["key"]] = wid

    # ---- Fase B: boards + groepen + simpele kolommen ----
    log("\n[B] Boards, groepen en kolommen")
    board_defs = bp["boards"]
    for ws in bp["workspaces"]:
        wid = state["workspaces"][ws["key"]]
        existing_boards = {} if args.dry_run else api.list_boards(wid)
        for bkey in ws["boards"]:
            bdef = board_defs[bkey]
            if bdef["name"] in existing_boards:
                bid = existing_boards[bdef["name"]]
                log(f"  = board bestaat: {bdef['name']} ({bid})")
            else:
                bid = api.create_board(bdef["name"], s["board_kind"], wid, bdef.get("description", ""))
                log(f"  + board nieuw:   {bdef['name']} ({bid})")
            state["boards"][bkey] = bid
            state["columns"].setdefault(bkey, {})

            # groepen
            existing_groups = {} if args.dry_run else api.board_groups(bid)
            for g in bdef.get("groups", s["default_groups"]):
                if g in existing_groups:
                    continue
                api.create_group(bid, g)
                log(f"      group + {g}")

            # simpele kolommen (board_relation/mirror in latere fase)
            existing_cols = {} if args.dry_run else api.board_columns(bid)
            for col in bdef["columns"]:
                ctype = col["type"]
                if ctype in ("board_relation", "mirror", "name"):
                    if ctype != "name" and col["title"] in existing_cols:
                        state["columns"][bkey][col["id"]] = existing_cols[col["title"]]["id"]
                    continue
                if col["title"] in existing_cols:
                    state["columns"][bkey][col["id"]] = existing_cols[col["title"]]["id"]
                    continue
                defaults = None
                if ctype == "status":
                    defaults = status_defaults(col["labels"])
                elif ctype == "dropdown":
                    defaults = dropdown_defaults(col["labels"])
                cid = api.create_column(bid, col["title"], TYPE_MAP[ctype], defaults)
                state["columns"][bkey][col["id"]] = cid
                log(f"      col + {col['title']} [{ctype}]")

    # ---- Fase C: board_relation kolommen (connect boards) ----
    log("\n[C] Connect-board relaties")
    for bkey, bdef in board_defs.items():
        if bkey not in state["boards"]:
            continue
        bid = state["boards"][bkey]
        existing_cols = {} if args.dry_run else api.board_columns(bid)
        for col in bdef["columns"]:
            if col["type"] != "board_relation":
                continue
            if col["title"] in existing_cols:
                state["columns"][bkey][col["id"]] = existing_cols[col["title"]]["id"]
                log(f"  = relatie bestaat: {bdef['name']}.{col['title']}")
                continue
            target = state["boards"].get(col["link_to"])
            defaults = relation_defaults(target, col.get("multiple", False)) if target else None
            cid = api.create_column(bid, col["title"], "board_relation", defaults)
            state["columns"][bkey][col["id"]] = cid
            log(f"  + relatie: {bdef['name']}.{col['title']} -> {board_defs[col['link_to']]['name']}")

    # ---- Fase D: mirror kolommen ----
    log("\n[D] Mirror-kolommen (best-effort)")
    for m in bp.get("mirrors", []):
        bkey = m["board"]
        if bkey not in state["boards"]:
            continue
        bid = state["boards"][bkey]
        existing_cols = {} if args.dry_run else api.board_columns(bid)
        if m["title"] in existing_cols:
            log(f"  = mirror bestaat: {m['title']}")
            continue
        relation_col_id = state["columns"].get(bkey, {}).get(m["via"])
        if not relation_col_id and not args.dry_run:
            log(f"  ! mirror overgeslagen (geen relatiekolom '{m['via']}'): {m['title']}")
            continue
        # Mirror via connect-kolom; doelkolom wordt op naam gematcht in de UI indien nodig.
        defaults = {"relation_column": {str(relation_col_id): True}} if relation_col_id else None
        try:
            api.create_column(bid, m["title"], "mirror", defaults)
            log(f"  + mirror: {bkey}.{m['title']} (via {m['via']} -> {m['column']})")
            log(f"            > controleer in UI of de juiste bronkolom '{m['column']}' is geselecteerd")
        except Exception as e:
            log(f"  ! mirror handmatig afmaken ({m['title']}): {e}")

    # ---- state wegschrijven ----
    if not args.dry_run:
        STATE_FILE.write_text(json.dumps(state, indent=2), encoding="utf-8")
        log(f"\nState opgeslagen: {STATE_FILE.name}")
    log("\nKlaar.")


if __name__ == "__main__":
    main()
