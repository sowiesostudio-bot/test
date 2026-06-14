/**
 * ADVIESMOTOR — Beste Partij BV
 * Eén implementatie, identiek bruikbaar in n8n (Function/Code node) en als tool
 * voor de WhatsApp AI-agent. Leest de regels uit kb.json (de single source of
 * truth), zodat advies & prijs overal hetzelfde uitkomen.
 *
 * Gebruik in n8n (Code node, run once per item):
 *   const kb = require('./kb.json');            // of via HTTP/Read Binary
 *   const out = advise(kb, $json);              // $json = verzamelde kwalificatie
 *   return [{ json: out }];
 *
 * Input (qualification): { verbruik, fase, laadpaal, warmtepomp, airco, ... }
 * Output: { battery_kwh, modules, inverter_kw, inverter_phase, review_flag,
 *           review_reasons[], price: { subtotal, vat, total, lines[] } }
 */

function advise(kb, q) {
  const a = kb.advice;

  // --- 1. Basisadvies op jaarlijks verbruik ---------------------------------
  const verbruik = Number(q.verbruik) || 0;
  let base = a.base_table.find(r => r.max_consumption === null || verbruik <= r.max_consumption);
  let modules = base.modules;
  let battery_kwh = base.advice_kwh;

  // --- 2. Correcties --------------------------------------------------------
  const review_reasons = [];
  let extraSteps = 0;
  for (const rule of a.corrections.rules) {
    const hit = evalRule(rule.key, q, verbruik);
    if (!hit) continue;
    if (rule.flag) review_reasons.push(`${rule.key}: ${rule.flag}`);
    if (rule.steps > 0) {
      if (a.corrections.mode === "additive") extraSteps += rule.steps;
      else review_reasons.push(`${rule.key}: +${rule.steps} stap (beoordelen)`);
    }
  }
  if (a.corrections.mode === "additive") {
    modules += extraSteps;
    battery_kwh = modules * a.base_table.find(r => r.modules === 1).advice_kwh;
  }
  // never_oversize: in "review"-modus verhogen we NIET automatisch (conform voorbeeld).
  const review_flag = review_reasons.length > 0;

  // --- 3. Omvormer-sizing ---------------------------------------------------
  const sizing = a.inverter_sizing.find(s => s.advice_kwh === battery_kwh)
              || a.inverter_sizing[a.inverter_sizing.length - 1];
  // Bij laadpaal/warmtepomp: kies bovenkant van het bereik (hogere piekvraag).
  const upper = q.laadpaal || q.warmtepomp;
  const inverter_kw = pickKw(sizing.recommended_kw_range, upper);

  // --- 4. Prijs -------------------------------------------------------------
  const phase = q.fase === "3-fase" ? "3-fase" : "1-fase";
  const price = priceFor(kb, modules, inverter_kw, phase, q);

  return {
    battery_kwh,
    modules,
    inverter_kw,
    inverter_kw_range: sizing.recommended_kw_range,
    inverter_phase: phase,
    review_flag,
    review_reasons,
    price,
  };
}

function evalRule(key, q, verbruik) {
  switch (key) {
    case "laadpaal":   return q.laadpaal === true;
    case "warmtepomp": return q.warmtepomp === true;
    case "airco":      return q.airco === true && verbruik > 5000;
    default:           return false;
  }
}

function pickKw(range, upper) {
  // "6-8" -> upper ? 8 : 6 ; "5" -> 5
  const parts = String(range).split("-").map(s => parseFloat(s));
  return parts.length === 1 ? parts[0] : (upper ? parts[1] : parts[0]);
}

function priceFor(kb, modules, inverter_kw, phase, q) {
  const p = kb.pricing;
  const lines = [];

  const batt = modules * p.battery_module_eur;
  lines.push({ item: `Batterij ${modules}x module`, amount: batt });

  const key = `${inverter_kw}kW`;
  const inv = (p.inverter_eur[phase] || {})[key];
  if (inv != null) lines.push({ item: `Omvormer ${key} (${phase})`, amount: inv });
  else lines.push({ item: `Omvormer ${key} (${phase}) — PRIJS ONBEKEND`, amount: 0 });

  lines.push({ item: "Installatie", amount: p.extras_eur.installatie });
  lines.push({ item: "Sales", amount: p.extras_eur.sales });
  // Optionele extra's alleen bij expliciete vraag/conditie:
  if (q.off_grid)          lines.push({ item: "Off-grid", amount: p.extras_eur.off_grid });
  if (q.meterkast_upgrade) lines.push({ item: "Meterkast upgrade", amount: p.extras_eur.meterkast_upgrade });
  if (q.ct_clamps)         lines.push({ item: "CT clamps", amount: p.extras_eur.ct_clamps });

  const subtotal = lines.reduce((s, l) => s + l.amount, 0);
  const vat = Math.round(subtotal * kb.meta.vat_rate * 100) / 100;
  const total = subtotal + vat;
  return { lines, subtotal, vat, total };
}

if (typeof module !== "undefined") module.exports = { advise };
