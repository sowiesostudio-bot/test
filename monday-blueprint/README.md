# Monday.com Blueprint — Schaalbare omgeving voor Lead-, Sales-, Support- & Kennisbeheer

> Doel: een complete, groeibestendige Monday.com-structuur die klaar is voor automatisering (o.a. via n8n).
> Volgorde van bouwen: **eerst structuur → dan knowledge base → dan automatiseringen.**

Dit blueprint is leveringsklaar: per onderdeel vind je workspaces, boards, kolommen,
statussen, relaties, dashboards en een gefaseerd implementatieplan.

> **Let op:** dit hoofddocument beschrijft de **generieke, schaalbare architectuur**.
> De **concrete invulling voor Beste Partij BV** (Deye thuisbatterijen) — met
> bedrijfs-, product-, kwalificatie-, advies- en prijskennis als één centrale
> kennisbron voor n8n, Monday, PandaDoc en de WhatsApp AI-agent — staat in
> [`knowledge-base/`](./knowledge-base/README.md) (canoniek: `kb.yaml`).

---

## Inhoudsopgave

1. [Naamgevings- & ontwerpconventies](#1-naamgevings--ontwerpconventies)
2. [Workspace-structuur](#2-workspace-structuur)
3. [Boards (overzicht)](#3-boards-overzicht)
4. [Datamodel per board](#4-datamodel-per-board)
5. [Knowledge Base-structuur](#5-knowledge-base-structuur)
6. [Relaties tussen boards](#6-relaties-tussen-boards)
7. [Dashboards](#7-dashboards)
8. [Toekomstige automatiseringen (n8n)](#8-toekomstige-automatiseringen-n8n)
9. [Implementatievolgorde (stappenplan)](#9-implementatievolgorde-stappenplan)
10. [Bijlage: kolomtype-referentie](#10-bijlage-kolomtype-referentie)

---

## 1. Naamgevings- & ontwerpconventies

Vaste afspraken voorkomen rommel zodra je gaat schalen.

- **Workspaces**: functioneel benoemd (bv. `Sales`, `Support`), niet per persoon.
- **Boards**: enkelvoud/meervoud consistent → meervoud voor records (`Leads`, `Klanten`),
  enkelvoud voor referentiebronnen (`Producten & Diensten`).
- **Statuskolommen**: altijd 1 "happy path" + duidelijke eind- en verliesstatussen.
- **ID's**: gebruik de auto-`Item ID` van Monday + een leesbare `Code`-kolom waar nodig
  (bv. `LEAD-0001`, `TCK-0001`) voor koppeling met n8n/externe systemen.
- **Koppelingen**: bouw via **Connect Boards** (relaties) + **Mirror**-kolommen
  (om gespiegelde info te tonen), nooit door data te dupliceren.
- **Eigenaar**: elk record heeft een `People`-kolom `Eigenaar`.
- **Automatiseringsvelden**: velden die uitsluitend door automation/n8n worden gevuld,
  prefix `auto_` (bv. `auto_Bron`, `auto_Score`, `auto_Sync ID`).

---

## 2. Workspace-structuur

Vijf functionele workspaces + één gedeelde. Logische scheiding op **proces/afdeling**,
zodat rechten, dashboards en groei per domein beheersbaar blijven.

| # | Workspace | Doel | Belangrijkste boards | Toegang (typisch) |
|---|-----------|------|----------------------|-------------------|
| 1 | **🟦 Sales & CRM** | Commercieel proces van lead t/m gewonnen deal | Leads, Sales Opportunities, Klanten (gedeeld) | Sales, Management |
| 2 | **🟩 Customer Success & Support** | Naservice, tickets, klantbeheer | Technische Support, Klanten (gedeeld), SLA's | Support, CS, Management |
| 3 | **🟧 Delivery & Projecten** | Implementaties/onboarding na verkoop | Projecten/Implementaties, Resources | Operations, PM, Tech |
| 4 | **🟨 Product & Knowledge Base** | Single source of truth: producten + kennis | Producten & Diensten, Knowledge Base, KB-categorieën | Iedereen (lezen), Product (schrijven) |
| 5 | **🟥 Operations & Management** | Stuurinformatie, dashboards, processen | Cross-board dashboards, Procesdocumentatie | Management, Ops |
| 6 | **⬜ Shared / Admin (optioneel)** | Templates, automation-logs, n8n-sync | Automation Log, Integratie-register, Templates | Admins |

**Waarom deze scheiding?**
- **Per proceseigenaar** → rechten en verantwoordelijkheid liggen op één plek.
- **Klanten-board wordt gedeeld** tussen Sales en Support (centraal klantbeeld, geen duplicatie).
- **Product & KB apart** → kennis is bedrijfsbreed leesbaar, maar beheer is afgeschermd.
- **Operations/Management** consumeert via dashboards (leest data, bezit weinig eigen boards).

---

## 3. Boards (overzicht)

| Board | Workspace | Type | Kernobject |
|-------|-----------|------|-----------|
| Leads | Sales & CRM | Records | Onbewerkte/ongekwalificeerde lead |
| Sales Opportunities | Sales & CRM | Records | Gekwalificeerde deal in pipeline |
| Klanten (Accounts) | Sales & CRM (gedeeld) | Master | Bedrijf/contactaccount |
| Technische Support | Support | Records | Support ticket |
| Projecten/Implementaties | Delivery | Records | Implementatie-/onboardingproject |
| Producten & Diensten | Product & KB | Master | Product/dienst (catalogus) |
| Knowledge Base | Product & KB | Content | Kennisartikel/FAQ |
| KB-Categorieën | Product & KB | Referentie | Categorie/subcategorie |

---

## 4. Datamodel per board

> Legenda kolomtypes: zie [bijlage](#10-bijlage-kolomtype-referentie).
> `🔗` = Connect Boards (relatie), `🪞` = Mirror, `auto_` = door automation gevuld.

### 4.1 Board: **Leads**

Doel: instroom verzamelen en kwalificeren vóór ze opportunity worden.

| Kolom | Type | Waarden / opmerking |
|-------|------|---------------------|
| Lead (naam) | Item naam | Volledige naam / bedrijf |
| Status | Status | `Nieuw` · `In behandeling` · `Gekwalificeerd` · `Niet gekwalificeerd` · `Geconverteerd` |
| Lead Score | Numbers | `auto_` (door n8n/automation) |
| Prioriteit | Status | `Laag` · `Midden` · `Hoog` |
| Eigenaar | People | Verantwoordelijke SDR/sales |
| Bedrijf | Text | |
| E-mail | Email | |
| Telefoon | Phone | |
| Bron | Dropdown | `Website` · `E-mail` · `Beurs` · `Referral` · `Campagne` · `Cold` |
| auto_Bron-detail | Text | UTM/formuliernaam vanuit n8n |
| Interesse in product | 🔗 Producten & Diensten | |
| Datum binnengekomen | Date | `auto_` (creation date) |
| Laatste contact | Date | |
| Volgende actie | Date | Trigger voor opvolg-automation |
| Notities | Long Text | |
| → Opportunity | 🔗 Sales Opportunities | Gevuld bij conversie |
| auto_Sync ID | Text | Externe ID (n8n/website) |

**Belangrijke automatiseringen (native):**
- Status → `Gekwalificeerd` ⇒ maak item in **Sales Opportunities** + koppel.
- `Volgende actie` datum bereikt ⇒ notify eigenaar.

---

### 4.2 Board: **Sales Opportunities** (Pipeline)

| Kolom | Type | Waarden / opmerking |
|-------|------|---------------------|
| Opportunity (naam) | Item naam | bv. "Bedrijf X — Implementatie" |
| Fase | Status | `Kwalificatie` · `Behoefte` · `Offerte` · `Onderhandeling` · `Gewonnen` · `Verloren` |
| Verlies-reden | Dropdown | `Prijs` · `Concurrent` · `Geen budget` · `Timing` · `Geen respons` |
| Prioriteit | Status | `Laag` · `Midden` · `Hoog` |
| Eigenaar | People | Account executive |
| Dealwaarde (€) | Numbers | |
| Gewogen waarde | Formula | `Dealwaarde × kanspercentage` |
| Kans % | Numbers | per fase richtlijn |
| Verwachte sluitdatum | Date | |
| Klant/Account | 🔗 Klanten | |
| ← Lead | 🔗 Leads | Herkomst |
| Producten | 🔗 Producten & Diensten | Scope van de deal |
| 🪞 Productprijs | Mirror | uit Producten & Diensten |
| Offertenummer | Text | `auto_` vanuit offerte-flow |
| Offerte-status | Status | `Concept` · `Verzonden` · `Geaccepteerd` · `Afgewezen` |
| → Project | 🔗 Projecten/Implementaties | Gevuld bij `Gewonnen` |
| auto_Sync ID | Text | |

**Automatiseringen (native):**
- Fase → `Gewonnen` ⇒ maak/koppel **Klant** + maak **Project/Implementatie**.
- Fase → `Verloren` ⇒ verplicht `Verlies-reden`, notify manager.

---

### 4.3 Board: **Klanten (Accounts)** — *master, gedeeld*

Centraal klantbeeld voor Sales én Support.

| Kolom | Type | Waarden / opmerking |
|-------|------|---------------------|
| Klant (naam) | Item naam | Bedrijfsnaam |
| Klant-status | Status | `Prospect` · `Actief` · `Onboarding` · `Risico` · `Opgezegd` |
| Klant-type/segment | Dropdown | `SMB` · `Mid-market` · `Enterprise` |
| Account-eigenaar | People | |
| CS-contact | People | Support/Customer Success |
| Hoofdcontact | Text + Email + Phone | |
| Adres | Location | |
| Klant sinds | Date | |
| MRR/Contractwaarde | Numbers | |
| Gekochte producten | 🔗 Producten & Diensten | |
| ← Opportunities | 🔗 Sales Opportunities | |
| → Support tickets | 🔗 Technische Support | |
| 🪞 Open tickets | Mirror (count) | Aantal openstaande tickets |
| → Projecten | 🔗 Projecten/Implementaties | |
| SLA-niveau | Dropdown | `Standaard` · `Premium` · `Enterprise` |
| Gezondheidsscore | Formula/Numbers | o.b.v. tickets, gebruik, NPS |
| auto_Sync ID | Text | CRM/boekhouding-ID |

---

### 4.4 Board: **Technische Support** (Tickets)

| Kolom | Type | Waarden / opmerking |
|-------|------|---------------------|
| Ticket (naam) | Item naam | Korte omschrijving |
| Ticketcode | Text | `auto_` `TCK-####` |
| Status | Status | `Nieuw` · `In behandeling` · `Wacht op klant` · `Escalatie` · `Opgelost` · `Gesloten` |
| Prioriteit | Status | `Laag` · `Normaal` · `Hoog` · `Urgent/Sev1` |
| Type | Dropdown | `Vraag` · `Bug` · `Storing` · `Feature request` · `Hoe-werkt` |
| Eigenaar | People | Toegewezen engineer |
| Klant | 🔗 Klanten | |
| Betrokken product | 🔗 Producten & Diensten | |
| Gerelateerd KB-artikel | 🔗 Knowledge Base | Oplossing/zelfhulp |
| Kanaal | Dropdown | `E-mail` · `Webform` · `Telefoon` · `Chat` |
| Aangemaakt op | Date | `auto_` |
| Eerste reactie op | Date | `auto_` (SLA-meting) |
| Opgelost op | Date | |
| SLA-deadline | Date | `auto_` o.b.v. prioriteit |
| SLA-status | Formula | `Binnen` / `Overschreden` |
| Oplossing/Resolutie | Long Text | Bron voor nieuwe KB-artikelen |
| auto_Sync ID | Text | Helpdesk/e-mail-ID |

**Automatiseringen (native):**
- `Nieuw` + Prioriteit ⇒ set `SLA-deadline`.
- Status `Wacht op klant` X dagen ⇒ auto-reminder.
- Status `Opgelost` ⇒ stuur CSAT-verzoek (via n8n).

---

### 4.5 Board: **Projecten / Implementaties**

| Kolom | Type | Waarden / opmerking |
|-------|------|---------------------|
| Project (naam) | Item naam | |
| Fase | Status | `Kick-off` · `Configuratie` · `Migratie` · `Test` · `Live` · `Nazorg` · `Afgerond` |
| Gezondheid | Status | `On track` · `Risico` · `Vertraagd` |
| Projectleider | People | |
| Team | People (multi) | |
| Klant | 🔗 Klanten | |
| ← Opportunity | 🔗 Sales Opportunities | |
| Producten in scope | 🔗 Producten & Diensten | |
| Startdatum | Date | |
| Geplande go-live | Timeline | |
| % Voltooid | Formula/Progress | o.b.v. subitems |
| Budget (uren/€) | Numbers | |
| Besteed | Numbers | |
| Onboarding-checklist | Subitems | Stappen met eigen status |
| Risico's/Blockers | Long Text | |
| auto_Sync ID | Text | |

> Subitems gebruiken voor de onboarding-checklist (taken per fase met eigenaar + datum).

---

### 4.6 Board: **Producten & Diensten** — *catalogus/master*

Verbindt commercie, support en kennis.

| Kolom | Type | Waarden / opmerking |
|-------|------|---------------------|
| Product/Dienst (naam) | Item naam | |
| Productcode/SKU | Text | |
| Categorie | Dropdown | `Software` · `Hardware` · `Dienst` · `Abonnement` |
| Status | Status | `Actief` · `In ontwikkeling` · `Uitgefaseerd` |
| Eigenaar (product) | People | Product owner |
| Korte omschrijving | Long Text | |
| Lijstprijs (€) | Numbers | |
| Prijsmodel | Dropdown | `Eenmalig` · `Per maand` · `Per jaar` · `Per gebruiker` |
| Versie | Text | |
| → KB-artikelen | 🔗 Knowledge Base | Alle docs/handleidingen |
| 🪞 Aantal KB-artikelen | Mirror (count) | |
| ← Gekocht door | 🔗 Klanten | |
| Technische specs (link) | Link/Files | |

---

### 4.7 Board: **Knowledge Base** (artikelen + FAQ)

Eén item = één artikel/FAQ. Filteren/groeperen op categorie i.p.v. losse boards.

| Kolom | Type | Waarden / opmerking |
|-------|------|---------------------|
| Artikel (titel) | Item naam | |
| Type | Dropdown | `Artikel` · `FAQ` · `Handleiding` · `Spec` · `Procedure` · `Verkoopdoc` |
| Categorie | 🔗 KB-Categorieën | Hoofdcategorie |
| Subcategorie | Dropdown/🔗 | Afgeleid van categorie |
| Doelgroep | Dropdown | `Klant (extern)` · `Sales` · `Support` · `Intern` |
| Status | Status | `Concept` · `In review` · `Gepubliceerd` · `Verouderd` |
| Eigenaar/Auteur | People | |
| Gekoppeld product | 🔗 Producten & Diensten | |
| Gebruikt in tickets | 🔗 Technische Support | (terugkoppeling) |
| Inhoud | Long Text / Doc | Korte inhoud of link naar Monday Doc |
| Bijlagen | Files | PDF/handleiding |
| Zichtbaarheid | Dropdown | `Publiek` · `Intern` |
| Laatst herzien | Date | |
| Review-datum | Date | Trigger voor herzieningsautomation |
| Trefwoorden/Tags | Tags | Voor zoeken/n8n-RAG |
| auto_Sync ID | Text | |

---

### 4.8 Board: **KB-Categorieën** (referentie)

Hiërarchie van de kennisbank, los beheerd zodat artikelen er netjes naar verwijzen.

| Kolom | Type | Opmerking |
|-------|------|-----------|
| Categorie (naam) | Item naam | bv. "Productdocumentatie" |
| Subcategorieën | Subitems | bv. "Installatie", "Configuratie" |
| Eigenaar | People | |
| → Artikelen | 🔗 Knowledge Base | |
| 🪞 # Artikelen | Mirror (count) | Volume per categorie |

---

## 5. Knowledge Base-structuur

Voorgestelde categorie → subcategorie → artikeltype-indeling, afgeleid van je documenttypen.
Realiseerbaar als één **Knowledge Base**-board (gegroepeerd per categorie) + referentieboard
**KB-Categorieën**.

```
KNOWLEDGE BASE
│
├── 1. Productdocumentatie            (doelgroep: Klant/Support)
│   ├── 1.1 Productoverzichten        → Artikel
│   ├── 1.2 Installatie & Setup       → Handleiding
│   ├── 1.3 Configuratie & Beheer     → Handleiding
│   ├── 1.4 Technische specificaties  → Spec
│   └── 1.5 Release notes / Versies   → Artikel
│
├── 2. Handleidingen & How-to         (doelgroep: Klant)
│   ├── 2.1 Quick-start guides        → Handleiding
│   ├── 2.2 Stap-voor-stap procedures → Handleiding
│   └── 2.3 Best practices            → Artikel
│
├── 3. FAQ                            (doelgroep: Klant/Support)
│   ├── 3.1 Algemeen
│   ├── 3.2 Per product               (gekoppeld aan Producten & Diensten)
│   ├── 3.3 Facturatie & Licenties
│   └── 3.4 Troubleshooting           → FAQ
│
├── 4. Supportdocumentatie            (doelgroep: Support/Intern)
│   ├── 4.1 Troubleshooting-runbooks  → Procedure
│   ├── 4.2 Bekende issues / Workarounds → Artikel
│   ├── 4.3 Escalatieprocedures       → Procedure
│   └── 4.4 SLA's & service-afspraken → Artikel
│
├── 5. Verkoopdocumentatie            (doelgroep: Sales/Intern)
│   ├── 5.1 Pitch decks & one-pagers  → Verkoopdoc
│   ├── 5.2 Prijslijsten & offertesjablonen → Verkoopdoc
│   ├── 5.3 Battle cards / concurrentie → Verkoopdoc
│   └── 5.4 Case studies / referenties → Artikel
│
└── 6. Interne procesdocumentatie     (doelgroep: Intern)
    ├── 6.1 Werkinstructies / SOP's   → Procedure
    ├── 6.2 Onboarding (medewerkers)  → Procedure
    └── 6.3 Beleid & compliance       → Artikel
```

**Ontwerpkeuzes:**
- **Eén board, niet zes.** Schaalt beter: filtering, dashboards en de n8n-RAG-koppeling
  (zoeken over alle kennis) werken op één databron. Categorieën sturen de weergave.
- **`Zichtbaarheid` + `Doelgroep`** scheiden extern (klant) van intern (sales/support).
- **Koppeling aan product** maakt contextuele zelfhulp en deflectie in tickets mogelijk.
- **`Review-datum`** houdt kennis actueel (automation: verlopen review ⇒ status `Verouderd`).

---

## 6. Relaties tussen boards

Alle koppelingen via **Connect Boards** (+ Mirror waar je gespiegelde info wilt tonen).

```
        ┌─────────┐   converteert   ┌────────────────────┐   wint    ┌──────────┐
        │  Leads  │ ───────────────▶│ Sales Opportunities│ ─────────▶│  Klanten │
        └─────────┘                 └────────────────────┘           └────┬─────┘
             │                                │                            │
             │ interesse                      │ scope                      │ heeft
             ▼                                ▼                            ▼
        ┌──────────────────────┐    ┌──────────────────────┐   ┌────────────────────┐
        │ Producten & Diensten │◀───┤  (gedeeld in deals)  │   │ Technische Support  │
        └──────────┬───────────┘    └──────────────────────┘   │     (Tickets)       │
                   │ documenteert                               └─────────┬──────────┘
                   ▼                                                       │ opgelost via
        ┌──────────────────────┐   gebruikt in tickets   ◀────────────────┘
        │   Knowledge Base     │
        └──────────────────────┘
                   ▲
        ┌──────────────────────┐
        │   KB-Categorieën     │ classificeert artikelen
        └──────────────────────┘

   Klanten ──────▶ Projecten/Implementaties ◀────── Sales Opportunities
   (na 'Gewonnen' ontstaat een implementatieproject, gekoppeld aan klant + opportunity)
```

| Van | Naar | Type | Reden |
|-----|------|------|-------|
| Leads | Sales Opportunities | 1→1 | Conversie van lead naar deal |
| Sales Opportunities | Klanten | n→1 | Deal hoort bij account |
| Sales Opportunities | Projecten | 1→1 | Gewonnen deal start implementatie |
| Klanten | Technische Support | 1→n | Tickets per klant |
| Klanten | Projecten | 1→n | Implementaties per klant |
| Klanten | Producten & Diensten | n→n | Welke producten klant afneemt |
| Sales Opportunities | Producten & Diensten | n→n | Scope/prijs van de deal |
| Producten & Diensten | Knowledge Base | 1→n | Documentatie per product |
| Technische Support | Knowledge Base | n→n | Oplossing/zelfhulp koppelen |
| Knowledge Base | KB-Categorieën | n→1 | Classificatie |

---

## 7. Dashboards

Per doelgroep een dashboard dat **leest** uit meerdere boards (cross-board widgets).

### 7.1 Management-dashboard
- **KPI-cards**: totale pipeline (€), gewogen pipeline, MRR, # actieve klanten, # open tickets.
- **Funnel**: Leads → Gekwalificeerd → Opportunity → Gewonnen (conversieratio's).
- **Omzet per maand/kwartaal** (gewonnen deals).
- **Klant-gezondheid**: verdeling `Actief/Risico/Opgezegd`.
- **Battery**: status implementatieprojecten.

### 7.2 Sales-dashboard
- **Pipeline per fase** (kanban/funnel + €-waarde).
- **Forecast**: verwachte sluitdatum × kans %.
- **Deals per eigenaar** (leaderboard).
- **Win/loss-ratio** + verliesredenen (pie).
- **Stagnatie**: deals zonder activiteit > X dagen.

### 7.3 Leadopvolging-dashboard
- **Nieuwe leads per bron** (week/maand).
- **Leads zonder opvolging** (volgende actie verlopen) — actielijst.
- **Reactietijd** lead → eerste contact.
- **Conversie per bron** (welk kanaal levert deals).
- **Lead score-verdeling**.

### 7.4 Support-dashboard
- **Open tickets per status & prioriteit**.
- **SLA-naleving**: % binnen / overschreden.
- **Eerste reactietijd & oplostijd** (gemiddeld).
- **Tickets per product** (signaleert kwaliteits-/doc-gaten).
- **Ticketvolume-trend** + **KB-deflectie** (# tickets met gekoppeld KB-artikel).

### 7.5 Operations-dashboard
- **Projectstatus** per fase + gezondheid.
- **Capaciteit/Workload** (People-workload widget).
- **Go-live planning** (Gantt/Timeline).
- **Budget vs. besteed** per project.
- **Onboarding-doorlooptijd** (Gewonnen → Live).

> Tip: bouw een extra **Knowledge-dashboard** in workspace 4: # artikelen per categorie,
> verouderde artikelen (review-datum verstreken), meest-gekoppelde artikelen in tickets.

---

## 8. Toekomstige automatiseringen (n8n)

Houd de structuur "n8n-ready": gebruik `auto_Sync ID`, `Code`-velden en webhooks.
Monday native automations voor interne logica; **n8n voor externe koppelingen**.

| # | Flow | Trigger (extern) | Actie in Monday | Velden die meekomen |
|---|------|------------------|-----------------|----------------------|
| 1 | **Website leadformulier** | Form submit (webhook) | Maak item in **Leads** | naam, bedrijf, e-mail, bron, UTM → `auto_Bron-detail`, `auto_Sync ID` |
| 2 | **E-mail (inbound)** | Nieuwe e-mail (IMAP/Gmail) | Maak Lead óf Support-ticket (op basis van adres/onderwerp) | afzender, onderwerp, body, kanaal |
| 3 | **Offertes** | Opportunity → `Offerte` | Genereer offerte (PDF/CRM), zet `Offertenummer` + status terug | dealwaarde, producten, klant |
| 4 | **Klant onboarding** | Opportunity → `Gewonnen` | Maak Klant + Project, vul onboarding-checklist, stuur welkomstmail | klant, producten, projectleider |
| 5 | **Support tickets** | Helpdesk/webform/chat | Maak/Update ticket, set SLA-deadline, koppel klant | klant, prioriteit, product, kanaal |
| 6 | **Rapportages** | Schedule (cron) | Lees boards → genereer rapport (Sheets/PDF/Slack) | KPI's per board |
| 7 | **KB-zelfhulp (RAG)** | Nieuw ticket | Zoek in Knowledge Base (tags/inhoud), stel artikel(en) voor | trefwoorden, product |
| 8 | **CSAT** | Ticket → `Opgelost` | Verstuur enquête, schrijf score terug | klant, ticketcode |

**Integratiepatroon:**
- Inkomend: extern systeem → **n8n** → Monday API (create/update item).
- Uitgaand: Monday **webhook** (status-/kolomwijziging) → n8n → extern systeem.
- Idempotentie: altijd matchen op `auto_Sync ID` om dubbele items te voorkomen.
- Logging: schrijf elke run naar **Automation Log** (workspace 6) voor traceability.

---

## 9. Implementatievolgorde (stappenplan)

### Fase 0 — Voorbereiding (½–1 dag)
1. Conventies vastleggen (sectie 1), accounts/rollen/rechten bepalen.
2. Workspaces aanmaken (sectie 2).

### Fase 1 — Structuur (boards & datamodel) (2–4 dagen)
3. Bouw **master/referentieboards eerst**: `Producten & Diensten`, `KB-Categorieën`, `Klanten`.
4. Bouw procesboards: `Leads`, `Sales Opportunities`, `Technische Support`, `Projecten`.
5. Voeg per board kolommen, statussen, prioriteiten, eigenaar & datums toe (sectie 4).
6. Leg **relaties** (Connect Boards) + Mirror-kolommen aan (sectie 6).
7. Voeg `auto_`-velden en `Code`-velden toe (n8n-ready).
8. Maak board-templates/views (Kanban, Tabel, Timeline) per board.

### Fase 2 — Knowledge Base inrichten (2–3 dagen)
9. Vul **KB-Categorieën** met de hiërarchie uit sectie 5.
10. Migreer bestaande documenten naar **Knowledge Base** (type, categorie, doelgroep, zichtbaarheid).
11. Koppel artikelen aan **Producten & Diensten**.
12. Zet `Review-datum` + status (`Gepubliceerd`/`Concept`).
13. Voeg tags/trefwoorden toe (basis voor latere RAG-zoekflow).

### Fase 3 — Native automations (1–2 dagen)
14. Interne Monday-automations: lead→opportunity, opportunity→klant+project,
    SLA-deadlines, herinneringen, review-verloop.
15. Notificaties & eigenaarstoewijzing.

### Fase 4 — Dashboards (1–2 dagen)
16. Bouw de 5 dashboards (sectie 7) + optioneel Knowledge-dashboard.
17. Stel rechten/zichtbaarheid per dashboard in.

### Fase 5 — Externe automatiseringen (n8n) (gefaseerd)
18. Begin met **leadformulier** (#1) en **support tickets** (#5) — hoogste volume/waarde.
19. Daarna **onboarding** (#4) en **offertes** (#3).
20. Tot slot **rapportages** (#6), **KB-RAG** (#7) en **CSAT** (#8).
21. Voeg **Automation Log** + idempotentie (`auto_Sync ID`) toe.

### Fase 6 — Borging
22. Test end-to-end per proces, train gebruikers, documenteer in **Interne procesdocumentatie** (KB §6).
23. Review na 2–4 weken: statussen, dashboards en automations bijstellen.

---

## 10. Bijlage: kolomtype-referentie

| Monday kolomtype | Gebruikt voor |
|------------------|---------------|
| Status | Workflow-statussen, prioriteiten (gekleurde labels) |
| Dropdown | Vaste keuzelijsten (bron, type, segment) |
| People | Eigenaar/teamtoewijzing |
| Date / Timeline | Losse datums / periodes (go-live) |
| Numbers | Bedragen, scores, percentages |
| Formula | Berekende velden (gewogen waarde, SLA-status) |
| Connect Boards (🔗) | Relaties tussen boards |
| Mirror (🪞) | Gespiegelde info uit gekoppeld board |
| Text / Long Text | Vrije tekst, notities, resoluties |
| Email / Phone / Link / Location | Contact- en adresgegevens |
| Files | Bijlagen (PDF, handleidingen) |
| Tags | Trefwoorden voor zoeken/filteren |
| Subitems | Checklist-/taakstructuur binnen een item |
| Item ID (auto) | Unieke technische sleutel |

---

*Klaar om te bouwen: begin bij Fase 0–1. De master-/referentieboards eerst, dan de
procesboards, dan kennis, dan automatisering — zo blijft elke koppeling stabiel terwijl je schaalt.*
