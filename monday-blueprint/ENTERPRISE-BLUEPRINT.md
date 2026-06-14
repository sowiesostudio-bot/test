# Monday.com Enterprise Blueprint — Beste Partij BV

Enterprise-grade, 5+ jaar schaalbare omgeving. Dit document beschrijft de
**architectuur, governance en automatisering**. De exacte boards/kolommen/relaties
staan machine-leesbaar in [`provisioning/blueprint.yaml`](./provisioning/blueprint.yaml)
en worden aangemaakt door [`provisioning/provision.py`](./provisioning/provision.py).

> Concrete kennis (producten, prijzen, advieslogica) als single source of truth:
> zie [`knowledge-base/`](./knowledge-base/README.md).

Kernproces: **Lead → Opportunity → Offerte (Offorte) → Gewonnen → Klant →
Implementatie → Support → Klantontwikkeling → Upsell/Cross-sell → nieuwe Opportunity.**

---

## Opdracht 1 — Workspaces

| # | Workspace | Doel | Boards | Rollen (rechten) | Datastromen |
|---|-----------|------|--------|------------------|-------------|
| 01 | **CRM & Sales** | Lead-to-win commercie | Leads, Opportunities, Accounts, Contactpersonen | Sales (edit), SalesMgr (admin), Directie (view) | Website/mail → Leads → Opportunities → Accounts |
| 02 | **Customer Success** | Klantbehoud & groei | Klantontwikkeling (+ Accounts gedeeld) | CSM (edit), Directie (view) | Accounts → Klantontwikkeling → Opportunities |
| 03 | **Support** | Tickets, incidenten, changes | Support Tickets, Incidenten, Change Requests | Support (edit), SupportMgr (admin) | Mail/webform → Tickets → KB/Producten |
| 04 | **Operations** | Delivery/implementatie | Implementaties, Projecten, Taken | PM/Ops (edit), Directie (view) | Gewonnen opp → Implementatie → Projecten → Taken |
| 05 | **Product Management** | Productdatabase & lifecycle | Producten | Product (edit), iedereen (view) | Producten ↔ Opp/Support/KB |
| 06 | **Knowledge Management** | Centrale kennisbank | KB-Categorieën, Knowledge Base | KB-redactie (edit), iedereen (view) | Support/Product → KB |
| 07 | **Management & Reporting** | Stuurinformatie | Targets & KPI's + dashboards | Directie (admin), mgrs (view) | Cross-workspace mirrors → dashboards |

**Rechtenmodel (RBAC):** rechten op **workspace-niveau** (team-membership), niet per
persoon. Boards met gevoelige data (Accounts, Targets) als *private/shareable*; KB
en Producten breed leesbaar. Gasten (installateurs/partners) alleen op specifieke
gedeelde boards. Accounts wordt als master **gedeeld** met CS en Support.

---

## Opdracht 2 — CRM datamodel
Volledig in `blueprint.yaml` → boards `leads`, `opportunities`, `accounts`, `contacten`.

- **Leads**: Lead ID, Organisatie, Contactpersoon, Functie, E-mail, Telefoon,
  Leadbron, Interessegebied, Leadscore, Status, Eigenaar, Volgende Actie,
  Laatste Contact. Status: Nieuw·Contact·In gesprek·Gekwalificeerd·Opportunity·
  Niet geschikt·Verloren. Relatie → Opportunities.
- **Opportunities**: + Klant(→Accounts), Product(→Producten), Verwachte omzet,
  Sluitdatum, Fase (Discovery·Analyse·Demo·Offerte·Onderhandeling·Gewonnen·
  Verloren), Kans %, Gewogen omzet (formule), Sales Owner + **Offorte-velden**.
- **Accounts**: Account ID, Branche, Accountmanager, Status, Contractwaarde,
  Contracttype + relaties naar Contactpersonen/Implementaties/Tickets.
- **Contactpersonen**: gekoppeld aan Accounts.

---

## Opdracht 3 — Offorte integratie

Offertes worden **uitsluitend in Offorte** gemaakt; Monday spiegelt de status.
Velden op **Opportunities**: Offorte Nummer, Offerte Status, Offerte Waarde,
Offerte Link, Offerte Datum, Geldigheid, Offerte Eigenaar.

**Workflow + n8n:**
```
Opportunity -> Fase "Offerte"
   └─(n8n) Monday webhook -> Offorte API: maak concept-offerte (klant/producten/prijs uit KB)
        └─ schrijf Offorte Nummer + Link terug naar Opportunity
Offorte status-events (verzonden/bekeken/geaccepteerd/afgewezen)
   └─(n8n) Offorte webhook -> Monday: update "Offerte Status"
        └─ bij "Geaccepteerd": zet Fase = Gewonnen
Fase "Gewonnen"
   └─(n8n) maak/koppel Account (Klant) + maak Implementatie
```
Idempotentie op **Offorte Nummer**; statusmapping Offorte↔Monday in n8n.

---

## Opdracht 4 — Implementaties
Boards `implementaties`, `projecten`, `taken` (zie blueprint.yaml).

- **Templates**: maak board-templates "Standaard Onboarding" met vaste groepen
  (Kick-off·Configuratie·Installatie·Test·Go-Live·Nazorg) en taak-subitems.
- **Standaard onboarding**: bij "Gewonnen" instantieert n8n een Implementatie uit
  de template + standaard takenlijst.
- **Go-Live**: aparte fase + `Go-Live datum`; automation notificeert Support bij
  Go-Live zodat het account "live" wordt voor tickets.
- **Evaluatie**: na Nazorg automatisch een evaluatietaak + CS-handoff naar
  Klantontwikkeling.

---

## Opdracht 5 — Support + SLA
Boards `tickets`, `incidenten`, `changes`.

- **Status**: Nieuw·In Analyse·In Behandeling·Wacht op Klant·Opgelost·Gesloten.
- **Prioriteit**: Kritiek·Hoog·Normaal·Laag.
- **SLA-bewaking**: bij Nieuw zet automation `SLA Deadline` o.b.v. prioriteit
  (bv. Kritiek 4u, Hoog 1d, Normaal 3d, Laag 5d). Formule/automation markeert
  overschrijding; "Wacht op Klant" pauzeert de klok. Eerste-reactie- en oplostijd
  worden vastgelegd voor het Support-dashboard.
- **Incidenten**: Sev1-3, koppelt meerdere tickets + producten, postmortem-fase.
- **Change Requests**: aanvraag → beoordeling → goedkeuring → uitvoering.

---

## Opdracht 6 — Productdatabase
Board `producten`: Productcode, Productnaam, Versie, Categorie, Product Owner,
Lijstprijs, Lifecycle Status (Concept·Actief·Onderhoud·Uitgefaseerd). Relaties naar
Opportunities, Accounts (via opp), Support, Knowledge Base. Echte Deye-producten
staan in `knowledge-base/kb.yaml` en `knowledge-base/products/`.

---

## Opdracht 7 & 8 — Knowledge Base + artikelmodel
Boards `kb_categorieen` (groepen = hoofdcategorieën: Productdocumentatie,
Supportdocumentatie, Sales Enablement, Interne Processen, FAQ) en `kb_artikelen`.

**Artikelmodel**: Artikel ID, Titel, Samenvatting, Categorie(→), Subcategorie,
Product(→), Tags, Auteur, Reviewer, Publicatiestatus, Versie, Laatste Reviewdatum,
Doelgroep. Status: Concept·Review·Gepubliceerd·Verouderd·Gearchiveerd.
Subcategorieën uit de opdracht zijn opgenomen in de dropdown.

---

## Opdracht 9 — Boardrelaties (volledige architectuur)

```
Leads ─▶ Opportunities ─▶ Accounts ─▶ Implementaties ─▶ Projecten ─▶ Taken
            │   │              │             ▲
            │   └─▶ Producten  ├─▶ Support Tickets ─▶ Knowledge Base
            │        ▲   ▲     ├─▶ Contactpersonen        ▲
   (Offorte velden)  │   │     └─(gedeeld CS) Klantontwikkeling ─▶ Opportunities
                     │   └────────── Support Tickets ─▶ Producten
   Producten ─▶ Knowledge Base ─▶ KB-Categorieën
   Incidenten ─▶ {Producten, Support Tickets} ;  Change Requests ─▶ Producten
```
Alle 24 connect-relaties staan in `blueprint.yaml`. **Mirrors** (sectie `mirrors:`):
o.a. Accountmanager/Status op Opportunities, SLA-niveau op Tickets, Contractwaarde
op Implementaties, Productcategorie op KB-artikelen.

---

## Opdracht 10 — Dashboards
> Dashboards zijn niet via API te bouwen → handmatig (1 widget-keuze per item).

- **Directie**: Omzet (gewonnen/maand), Pipeline (€ per fase), Forecast (gewogen),
  Support-KPI's (SLA%, open tickets), Klant-gezondheid.
- **Sales**: Leads per bron, conversieratio's, Opportunities per fase/owner,
  Offerte-status (Offorte), win/loss.
- **Support**: SLA-naleving, open tickets per prioriteit, gem. oplostijd,
  ticketvolume-trend, KB-deflectie.
- **Operations**: implementaties per fase, capaciteit/workload, go-live planning
  (Gantt), budget vs. besteed, risico's.
- **Knowledge Base**: # artikelen per categorie, verouderde content
  (reviewdatum verstreken), meest-gekoppelde artikelen in tickets.

---

## Opdracht 11 — n8n automatiseringen

| Flow | Trigger | Actie |
|------|---------|-------|
| Website → Lead | Form webhook | Maak Lead (bron/UTM, idempotent op e-mail) |
| Lead → Sales | Status=Gekwalificeerd | Maak + koppel Opportunity, notify owner |
| Opportunity → Offorte | Fase=Offerte | Offorte concept-offerte, schrijf nr+link terug |
| Offorte → Monday | Offorte webhook | Update Offerte Status; Geaccepteerd → Gewonnen |
| Gewonnen → Klant | Fase=Gewonnen | Maak/koppel Account, start Implementatie |
| Klant → Implementatie | Account onboarding | Instantieer template + takenlijst |
| Support Mailbox → Ticket | Inbound mail (IMAP) | Maak Ticket, set SLA, koppel klant/product |
| Ticket → Knowledge Suggestie | Nieuw ticket | RAG-zoek in KB, stel artikel(en) voor |
| Rapportages | Cron | Genereer KPI-rapport (Sheets/PDF/Slack) |
| AI documentclassificatie | Nieuw KB-bestand | Classificeer categorie/subcategorie/tags |
| AI artikelgeneratie | Opgeloste tickets | Concept-KB-artikel uit resolutie |
| AI FAQ-generatie | Periodiek | Genereer/actualiseer FAQ uit veelgestelde tickets |

Patroon: inkomend extern → n8n → Monday API; uitgaand Monday webhook → n8n →
extern. AI-stappen gebruiken `knowledge-base/kb.json` als feitenbron. Idempotentie
op stabiele sleutels (e-mail, Offorte-nummer, ticketcode).

---

## Opdracht 12 — Governance

- **Naamconventies**: workspaces `NN — Naam`; boards meervoud voor records,
  enkelvoud voor referentie; kolommen Title Case; statussen 1 happy-path + duidelijke
  eind-/verliesstatussen.
- **Board-conventies**: elk record `Eigenaar` (People), `Item ID`, datums voor
  creatie/laatste-update; koppelen via Connect Boards + Mirror, nooit dupliceren.
- **Rollen/rechten**: RBAC per workspace; gevoelige boards private/shareable;
  gasten beperkt; admin alleen bij beheerders.
- **Archivering**: kwartaal-review; afgeronde records naar "Archief"-groep of
  archiveren; verouderde KB-artikelen → status Verouderd/Gearchiveerd.
- **Datakwaliteit**: verplichte velden via automations afdwingen; idempotente
  imports; dubbelen voorkomen op e-mail/Offorte-nummer.
- **Security**: API-tokens als secrets (n8n credentials), niet in code; least-
  privilege tokens; 2FA; periodieke token-rotatie; auditlog (Automation Log board).

---

## Opdracht 13 — Implementatieplan (fasen)

| Fase | Inhoud | Resultaat |
|------|--------|-----------|
| 1 Fundament | Workspaces + rollen/rechten + conventies | Lege, geordende omgeving |
| 2 Productdatabase | Board `producten` + Deye-data | Referentie voor alle koppelingen |
| 3 Knowledge Base | `kb_categorieen` + `kb_artikelen`, migratie docs | Centrale kennis |
| 4 CRM | Leads, Opportunities, Accounts, Contacten + relaties | Sales operationeel |
| 5 Support | Tickets, Incidenten, Changes + SLA | Support operationeel |
| 6 Implementaties | Implementaties, Projecten, Taken + templates | Delivery operationeel |
| 7 Automatiseringen | n8n flows (Offorte, mail, leads, AI) | End-to-end automatisch |
| 8 Dashboards | Directie/Sales/Support/Ops/KB | Stuurinformatie live |

Fasen 1–6 bouwt `provision.py` (referentie-/masterboards eerst, dan procesboards,
dan relaties/mirrors). Fasen 7–8 daarna handmatig/n8n.

---

## Schaalbaarheidsadvies (5+ jaar)
- **Referentieboards als anker** (Producten, Accounts, KB): koppel ernaar, dupliceer
  nooit — voorkomt fundamentele herstructurering bij groei.
- **Workspaces per functie, niet per persoon/afdelingsnaam** → reorganisaties raken
  de datastructuur niet.
- **Stabiele sleutels** (`Item ID`, Offorte-nummer, e-mail) voor alle integraties.
- **Eén kennisbron** (`kb.yaml`) voor regels/prijzen → systemen lopen niet uiteen.
- **High-volume boards** (Tickets, Leads): jaarlijks archiveren naar archiefboards;
  Monday-itemlimieten per board respecteren.
- **Governance vroeg vastleggen** (naamgeving, rechten, datakwaliteit) → schaalt mee.
- **Automatiseringen idempotent** → veilig herhaalbaar bij volumegroei.
