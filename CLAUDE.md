# Project: WordPress-sites beheren via Novamira

Deze repo verbindt Claude Code met WordPress via de Novamira MCP-server
(zie `.mcp.json` en `novamira-mcp-setup/README.md`).

## Sites

- **marijnhageman.nl** — Novamira geïnstalleerd en werkend.
  Gebruiker: `abdi` (administrator). De `.mcp.json` wijst hierheen.
- **buurmanstudio.nl** — géén Novamira; application-password-login komt
  daar niet door de server (Authorization-header wordt gestript).

## Afgeronde taken

- [x] Footertekst op marijnhageman.nl gewijzigd (2026-07-03):
  `Designed By: Zeko Code` → `Designed By: Buurman Studio`,
  link naar `https://buurmanstudio.nl`. Bron: Elementor-template
  "Buurman Studio - Footer" (post 2780, `elementor_library`), in
  postmeta `_elementor_data`. Live geverifieerd op meerdere pagina's.

## Lopend project: nieuwe website marijnhageman.nl (2026-07-03)

Nieuw one-page ontwerp "Beweging" (aangeleverd als HTML) nagebouwd in
Elementor. **Status: voorbeeld klaar, wacht op akkoord van de gebruiker.**

- **Meerpagina-opzet na feedback gebruiker (geen one-pager):**
  - Home: `https://marijnhageman.nl/nieuw/` (post 3179) — hero, voor wie,
    voices, wie ik ben, hoe ik werk, CTA naar aanbod.
  - Aanbod: `https://marijnhageman.nl/nieuw-aanbod/` (post 3180) — titel
    linksboven (feedback), sessiekaart.
  - Contact: `https://marijnhageman.nl/nieuw-contact/` (post 3181) — CF7-
    formulier + social-icoontjes.
  - Alle pagina's: publiek maar noindex, `elementor_canvas`, nav/footer ín
    de pagina (voor preview), menu Home/Aanbod/Contact + Kennismaken-CTA.
  - Socials: Instagram `instagram.com/marijn_hageman/`, LinkedIn
    `linkedin.com/in/marijn-hageman/` (in footer overal + contactpagina).
  - Blokkenritme na feedback: voices-sectie op home is donker (grond-bg);
    aanbodpagina = licht intro-blok → donker 1:1-blok (ruim, kaart 3rem
    padding) → licht events-blok met live Hipsy-widget
    (organisation `marijn-lichaamswijsheid-bewustzijn`,
    widget-key `wcc_msawdjkeoc`, sdk `cdn.hipsy.nl/sdk/v1/hipsy-events.js`).
  - Bij livegang: previewslugs `/nieuw*` → `/`, `/aanbod/`, `/contact/`;
    interne links in `_elementor_data` mee-vervangen.
- Huisstijl-CSS: `wp-content/themes/hello-elementor/mh-huisstijl.css`,
  enqueued via functions.php (marker `mh-huisstijl`); Google Fonts
  (Cormorant Garamond + Inter) idem (marker `mh-google-fonts`).
- Widget-CSS-klassen in Elementor-JSON: widgets gebruiken `_css_classes`,
  secties/kolommen `css_classes` — beide gezet door de generator.
- Foto's: media 3175 (hero), 3176 (portret), 3177 (balans).
- Contactformulier: CF7 id 3178 "Kennismaking (nieuwe site)" →
  info@marijnhageman.nl.
- Generator + CSS staan in de scratchpad van sessie
  session_01JvSzt8J6jj8PXEUeYYN7Vg (bouw_pagina.py, custom.css).
- **Nog te doen na akkoord:** header/footer als theme-builder-templates
  (in-page nav/footer er dan uit), pagina omzetten naar homepage
  (front page), oude pagina's (2654 Home, 2657 Expertise, 2659 Contact)
  op concept, 301-redirects, Yoast-titel/meta, noindex eraf, caches,
  live natesten.

## Werkwijze / geleerde lessen

- De Novamira-tools laden via `.mcp.json`; lukt dat niet, dan werkt de
  REST-route ook direct met Basic auth (application password):
  `POST /wp-json/novamira/v1/abilities/novamira/execute-php/run`
  met body `{"input":{"code":"...PHP zonder <?php..."}}`.
- marijnhageman.nl draait achter Varnish/Breeze (Cloudways-achtig).
  In `functions.php` van het actieve thema (hello-elementor) staan
  snippets die de Authorization-header herstellen en `PHP_AUTH_USER/PW`
  vullen — niet verwijderen, de API-login kan ervan afhangen.
- Na content-wijzigingen: Elementor-cache legen
  (`\Elementor\Plugin::$instance->files_manager->clear_cache()`) en
  `do_action('breeze_clear_all_cache')`, daarna live controleren.
- Het zijn live sites: maak gerichte, kleine wijzigingen en verifieer
  het resultaat op de site zelf.
