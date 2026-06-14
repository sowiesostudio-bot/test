# Monday Provisioner

Bouwt de volledige enterprise-structuur in Monday.com via de GraphQL API,
op basis van [`blueprint.yaml`](./blueprint.yaml). Idempotent — meermaals draaien
is veilig (bestaande items worden hergebruikt).

## Vereisten
```bash
pip install pyyaml requests
```
Netwerktoegang tot `https://api.monday.com` (host op de egress-allowlist).

## Draaien
```bash
# 1) Bekijk eerst het plan, zonder iets te wijzigen:
python3 provision.py --dry-run

# 2) Voer uit (token via env-var, blijft bij jou):
export MONDAY_TOKEN="<jouw_api_token>"
python3 provision.py

# alternatief: token uit een bestand buiten de repo
python3 provision.py --token-file ~/.monday_token
```

## Wat het doet (fasen)
- **A** Workspaces (7)
- **B** Boards + groepen + simpele kolommen
- **C** Connect-board relaties (board_relation)
- **D** Mirror-kolommen (best-effort; controleer bronkolom in UI)

## Aandachtspunten / Monday API-beperkingen
- **Dashboards** kunnen niet via de API worden aangemaakt → bouw handmatig
  volgens `../ENTERPRISE-BLUEPRINT.md` (Opdracht 10). Snel: voeg op het
  Management-board een Dashboard toe en kies de cross-board widgets.
- **Mirrors**: de API koppelt de connect-kolom; selecteer in de UI zo nodig de
  exacte bronkolom (zie `mirrors:` in blueprint.yaml, veld `column`).
- **Status/dropdown labels** worden bij aanmaak gezet; kleuren wijst Monday
  automatisch toe (achteraf aanpasbaar).
- **Plan**: het aanmaken van workspaces vereist een betaald Monday-plan met
  workspace-beheer. Lukt `create_workspace` niet, maak ze dan handmatig aan en
  draai het script opnieuw (het herkent ze op naam).

## Veiligheid
- Token **nooit** committen. `.state.json` en tokenbestanden staan in `.gitignore`.
- Trek de gebruikte token in na de build en genereer een nieuwe.

## Wijzigen / uitbreiden
Pas `blueprint.yaml` aan en draai opnieuw. Nieuwe boards/kolommen/relaties
worden toegevoegd; bestaande blijven ongemoeid.
