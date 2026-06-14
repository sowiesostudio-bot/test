# Advieslogica — beslisregels & voorbeelden

Bron van waarheid: `kb.yaml -> advice`. Referentie-implementatie: `advice-engine.js`
(identiek bruikbaar in n8n en als tool voor de WhatsApp-AI).

## 1. Basisadvies (op jaarlijks verbruik)

| Jaarverbruik (kWh) | Modules | Capaciteit |
|--------------------|---------|------------|
| < 5.000            | 1       | 5 kWh      |
| 5.000 – 7.500      | 2       | 10 kWh     |
| 7.500 – 10.000     | 3       | 15 kWh     |
| > 10.000           | 4       | 20 kWh     |

> 1 module = 5,12 kWh = 1 "stap".

## 2. Correcties

| Conditie                         | Effect (mode "review", **default**) | Effect (mode "additive") |
|----------------------------------|-------------------------------------|--------------------------|
| Laadpaal = ja                    | review_flag + voorstel +1 stap      | +1 stap                  |
| Warmtepomp = ja                  | review_flag + voorstel +1 stap      | +1 stap                  |
| Airco = ja **én** verbruik > 5000| review_flag ("beoordelen")          | review_flag ("beoordelen")|

### ⚠️ Belangrijke ontwerpkeuze (te bevestigen)

Je regels zeggen *"+1 stap"*, maar je voorbeeld houdt het bewust op de basis:

> 6000 kWh, 12 panelen, warmtepomp, airco, geen laadpaal → **10 kWh, 6–8 kW** (níét 15 kWh).

Dit kan niet allebei deterministisch waar zijn. Daarom:

- **Default = `mode: review`** → correcties verhogen **niet** automatisch; ze
  zetten een `review_flag` zodat een adviseur beslist. Leidend blijft *"nooit
  oversizen, bij twijfel kleiner"*. Dit reproduceert jouw voorbeeld exact.
- **Alternatief = `mode: additive`** → past "+1 stap" letterlijk toe.

Wil je dat laadpaal/warmtepomp tóch automatisch ophogen? Zet dan in
`kb.yaml`: `advice.corrections.mode: additive`.

## 3. Omvormer-sizing

| Capaciteit | Omvormer (kW) |
|------------|---------------|
| 5 kWh      | 5             |
| 10 kWh     | 6–8           |
| 15 kWh     | 8–10          |
| 20 kWh     | 10–12         |

Bij laadpaal of warmtepomp → kies de bovenkant van het bereik (hogere piekvraag).

## 4. Uitgewerkte voorbeelden

**Voorbeeld A (jouw casus) — 1-fase**
- Input: verbruik 6000, warmtepomp ja, airco ja, laadpaal nee
- Basis: 10 kWh (2 modules)
- Correcties: review_flag (warmtepomp +1 voorstel, airco beoordelen) → **blijft 10 kWh**
- Omvormer: bereik 6–8, warmtepomp → **8 kW**
- Resultaat: **10 kWh batterij + 8 kW omvormer**, met review-vlag voor de adviseur.

**Voorbeeld B — 3-fase, groot verbruik**
- Input: verbruik 11000, laadpaal ja, fase 3-fase
- Basis: 20 kWh (4 modules), omvormer 10–12 → laadpaal → **12 kW**
- Prijs (excl. opties): 4×€660 + €1465 (3-fase 12kW) + €1500 + €750 = €6.355 excl. BTW.

## 5. Prijsopbouw

`subtotaal = (modules × €660) + omvormer(fase, kW) + installatie €1500 + sales €750
            [+ off-grid €950] [+ meterkast upgrade €950] [+ CT clamps €150]`

`totaal = subtotaal + BTW (kb.meta.vat_rate, standaard 21%)`

Off-grid / meterkast upgrade / CT clamps alleen toevoegen bij expliciete
behoefte (niet standaard meerekenen).
