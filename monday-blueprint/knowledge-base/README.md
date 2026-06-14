# Centrale Kennisbron — Beste Partij BV (Deye thuisbatterijen)

Eén bron van waarheid waar **n8n, Monday.com, PandaDoc en de WhatsApp AI-agent**
allemaal dezelfde feiten, regels en prijzen uit halen. Zo gebruikt geen enkel
systeem zijn eigen losse regels.

## Bestanden

| Bestand | Rol |
|---------|-----|
| **`kb.yaml`** | **Canonieke bron** — bewerk hier (mensvriendelijk, met commentaar). |
| `kb.json` | Gegenereerd uit `kb.yaml`. Door machines te consumeren (n8n, AI-agent). |
| `build.py` | Genereert `kb.json` uit `kb.yaml`. Draaien na elke wijziging. |
| `advice-engine.js` | Adviesmotor (batterij + omvormer + prijs). n8n Code-node & AI-tool. |
| `advies-logica.md` | Beslisregels, voorbeelden en de te bevestigen ontwerpkeuze. |
| `whatsapp-system-prompt.md` | Paste-ready system prompt voor de WhatsApp-agent. |
| `products/*.md` | Leesbare datasheet-samenvattingen (Deye 1-fase & 3-fase). |

## Build

```bash
pip install pyyaml
python3 build.py        # kb.yaml -> kb.json
```

> Gouden regel: wijzig **nooit** prijzen/regels in een afzonderlijk systeem.
> Wijzig in `kb.yaml`, run `build.py`, en alle systemen volgen.

## Structuur van kb.yaml

```
meta            versie, valuta, BTW-tarief
company         bedrijfsgegevens (naam, adres, KVK, BTW)
products        battery (SE-F5 Pro-C) + inverters (Deye 1-fase & 3-fase, met specs)
qualification   verplichte velden die de AI altijd ophaalt
advice          basis-tabel + correcties + omvormer-sizing  (deterministisch)
pricing         batterijmodule, omvormers per fase, extra's
whatsapp_prompt taal/regels + openingsbericht
mappings        monday (CRM-kolommen) + pandadoc (offertevariabelen)
```

## Hoe elk systeem consumeert

```
                         ┌──────────────────────┐
                         │      kb.yaml         │  (canoniek, bewerk hier)
                         └──────────┬───────────┘
                            build.py│
                         ┌──────────▼───────────┐
                         │      kb.json         │  (gegenereerd)
                         └──┬────────┬───────┬──┘
          ┌─────────────────┘        │       └──────────────────┐
          ▼                          ▼                          ▼
 ┌─────────────────┐      ┌────────────────────┐     ┌────────────────────┐
 │ WhatsApp AI     │      │        n8n         │     │     PandaDoc        │
 │ - prompt+feiten │      │ - advice-engine    │     │ - variables uit     │
 │ - advice-engine │      │ - schrijft Monday  │     │   mappings.pandadoc │
 └────────┬────────┘      │ - vult PandaDoc    │     └────────────────────┘
          │ verzamelt     └─────────┬──────────┘
          │ kwalificatie            │ mappings.monday
          └────────────────────────►│
                                     ▼
                            ┌────────────────────┐
                            │   Monday.com CRM   │
                            │   board: Leads     │
                            └────────────────────┘
```

### WhatsApp AI-agent
- System prompt uit `whatsapp-system-prompt.md`.
- Feiten (bedrijf/product/prijs) uitsluitend uit `kb.json` — niets hardcoden.
- Advies via `advice-engine.js` (zelfde resultaat als n8n).

### n8n
- Laadt `kb.json`, draait `advise(kb, antwoorden)`.
- Schrijft lead + advies naar Monday via `mappings.monday`.
- Vult PandaDoc via `mappings.pandadoc` + `price` uit de adviesmotor.

### Monday.com
- Board `Leads` met de kolommen uit `mappings.monday` (zie ook ../README.md).

### PandaDoc
- Offertesjabloon met de variabelen uit `mappings.pandadoc`.

## Te bevestigen ontwerpkeuze

De adviescorrecties (laadpaal/warmtepomp = "+1 stap") botsen met je voorbeeld
(6000 kWh + warmtepomp + airco → 10 kWh, niet 15). Default staat daarom op
`advice.corrections.mode: review` ("nooit oversizen" wint). Zet op `additive`
als je wél automatisch wilt ophogen. Details in `advies-logica.md`.
