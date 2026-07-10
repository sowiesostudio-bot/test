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

## Project: nieuwe website marijnhageman.nl — LIVE sinds 2026-07-03

Nieuw ontwerp "Beweging" (aangeleverd als HTML) nagebouwd in Elementor.
**Status: LIVE.** Front page = post 3179. Oude pagina's (2654 home-oud,
2657 expertise-oud, 2659 contact-oud) staan op concept — niet verwijderd.
301-redirects in `.htaccess` (blok `MH-redirects`): /nieuw* → definitieve
slugs, /expertise/ → /over-mij/. Favicon = media 3183 (site_icon),
rond logo-embleem = media 3184 (in footer), volledig logo = media 3185.
Yoast-titels/-descriptions per pagina gezet, noindex verwijderd.
404-template (post 2803) is omgebouwd naar de nieuwe huisstijl ("Pagina
niet gevonden"); Zeko header/footer-templates (36, 2780) zijn uitgeschakeld
(_elementor_conditions verwijderd, ook uit de Pro conditions-cache) — alle
pagina's dragen hun eigen nav/footer. Favicon/rond logo opnieuw gecentreerd:
media 3190 (site_icon) en 3191 (footer-embleem); 3183/3184 verwijderd.
Footerquote overal: "Jij doet het werk. Ik creëer de bedding." Alle
Zeko-mailadressen uit de opties geschoond (0 treffers). Hipsy-widget vergt
nog actie van gebruiker: marijnhageman.nl toevoegen aan de domeinlijst in
het Hipsy-dashboard. [afgerond: domein toegevoegd, org-slug
gefixt naar marijn-hageman, widget gestyled via CSS-variabelen]

- **Meerpagina-opzet na feedback gebruiker (geen one-pager):**
  - Home: `https://marijnhageman.nl/nieuw/` (post 3179) — hero, voor wie
    (donker blok), voices (7 stemmen), hoe ik werk, CTA naar aanbod.
    Teksten hero/voorwie/voices komen uit de tweede aangeleverde HTML
    (df3ace61-marijnbelichaamd.html). Hero-subregel later vormneutraal
    gemaakt (niet meer "één-op-één"): "Voor sterke vrouwen die veel dragen,
    maar zichzelf zijn kwijtgeraakt. Ik begeleid je terug naar je lichaam,
    je wijsheid en je vrouwelijke kracht." — a.d.h.v. Business/Vorm-doc
    (propositie: sterke vrouwen die dragen/doen/analyseren maar contact met
    lichaam kwijt zijn; aanbod verbreedt naar trajecten/cirkels).
  - Over mij: `https://marijnhageman.nl/nieuw-over-mij/` (post 3182) —
    verhaal (nieuwe lange tekst van gebruiker): foto + eerste 3 alinea's,
    daarna leeskolommen (CSS columns), groot 2016-citaat, leeskolommen.
  - Aanbod: `https://marijnhageman.nl/nieuw-aanbod/` (post 3180) —
    intro (licht, "Sessies, trajecten, cirkels & rituelen") → 1:1-blok
    (donker, 2 uur/€450 per 3 sessies + "Zo werkt het") → VRIJspraak
    (licht, id `vrijspraak`, groepstraject 6 vrouwen, kaart met "VRIJ" als
    vlam-accent) → Vrouwencirkels (licht, id `cirkels`) → Rituelen Rite of
    the Womb (donker, id `rituelen`, kan in cirkel of 1:1) → events (licht,
    Hipsy).
  - Kennismaken (voorheen Contact): post 3181, live op `/kennismaken/` —
    CF7-formulier + social-icoontjes. `/contact/` → 301 `/kennismaken/`.
  - Menu overal: Home / Over mij / Aanbod + Kennismaken-CTA (geen apart
    Contact-item meer, was dubbelop).
  - Reviews-sectie op home ("Ervaringen — Wat deelnemers zeggen. Uit mijn
    yogalessen."): 3 kaarten (Wendy Borninkhof, Marieke Peters, Wilma
    Eilander — met emoji's, bewust behouden), tussen werkwijze en CTA;
    3 kolommen ≥1100px, daaronder 2/1. Sessiekaart: "Vorm — Live" (online weggehaald).
  - Alle pagina's: publiek maar noindex, `elementor_canvas`, nav/footer ín
    de pagina (voor preview), menu Home/Aanbod/Contact + Kennismaken-CTA.
  - Socials: Instagram `instagram.com/marijn_hageman/`, LinkedIn
    `linkedin.com/in/marijn-hageman/` (in footer overal + contactpagina).
  - Blokkenritme na feedback: voices-sectie op home is donker (grond-bg);
    aanbodpagina = licht intro-blok → donker 1:1-blok (ruim, kaart 3rem
    padding) → licht events-blok met live Hipsy-widget
    (organisation `marijn-hageman` — let op: de eerder aangeleverde
    embedcode bevatte een verkeerde organisatienaam,
    widget-key `wcc_msawdjkeoc`, sdk `cdn.hipsy.nl/sdk/v1/hipsy-events.js`).
  - Bij livegang: previewslugs `/nieuw*` → `/`, `/aanbod/`, `/contact/`;
    interne links in `_elementor_data` mee-vervangen.
- Kleuren (per 2026-07-03 gelijk aan het toonanker van de gebruiker):
  goud/oker #E0A93C, grond #6B3A2A, zwart #1C1008, vlam/terracotta
  #C66A3F, adem (warm wit) #F7F3E8 (ook in _elementor_page_settings
  background_color). Oorspronkelijk ontwerp-palet: #DEA344/#B84820/#FAF5EE.
- Huisstijl-CSS: `wp-content/themes/hello-elementor/mh-huisstijl.css`,
  enqueued via functions.php (marker `mh-huisstijl`); Google Fonts
  (Cormorant Garamond + Inter) idem (marker `mh-google-fonts`).
- Widget-CSS-klassen in Elementor-JSON: widgets gebruiken `_css_classes`,
  secties/kolommen `css_classes` — beide gezet door de generator.
- Foto's: media 3197 (hero, terracotta pak — crop uit prof. shoot,
  960x1215), 3176 (portret, over-mij), 3177 (balans, kennismaken),
  3198 (sessieportret bordeaux — solo-crop uit duofoto, 1:1-blok).
  Oude 3175/3194 verwijderd. Originele shootfoto's (5x 2000px, deels
  duo met andere vrouw — die moet er altijd afgesneden worden) in
  scratchpad als shoot1-5.bin.
- Contactformulier: CF7 id 3178 "Kennismaking (nieuwe site)" →
  info@marijnhageman.nl.
- Generator + CSS staan in de scratchpad van sessie
  session_01JvSzt8J6jj8PXEUeYYN7Vg (bouw_pagina.py, custom.css).
- **Nog te doen na akkoord:** header/footer als theme-builder-templates
  (in-page nav/footer er dan uit), pagina omzetten naar homepage
  (front page), oude pagina's (2654 Home, 2657 Expertise, 2659 Contact)
  op concept, 301-redirects, Yoast-titel/meta, noindex eraf, caches,
  live natesten.

- **Review-verbeterronde (2026-07-03):** mobiel menu toont nu de
  Kennismaken-CTA (Home-link verbergt op mobiel, logo = home); hero heeft
  concrete propositie + toonanker-accentregel; privacypagina (post 3195,
  `/privacy/`, noindex) + notitie bij formulier + footerlink; og:image
  (media 3196, ook Yoast-default); CF7-honeypot (veld `mh-website` +
  `wpcf7_spam`-filter in functions.php, marker mh-honeypot);
  scroll-reveals + actieve menustaat via `mh-extra.js` (enqueued, marker
  mh-extra); h1 op /over-mij/ en /kennismaken/; 404 heeft twee knoppen;
  Hipsy lege-staat-notitie. Let op: homepage-cache kan hardnekkig zijn —
  na wijzigingen met `?fresh=<random>` controleren.
- **Review-ronde 2 (2026-07-03):** asymmetrische kolommen (voorwie 5/6,
  verhaal 4.4/6.6, aanbod 5.4/6.6, verhaal-foto -4vh); koppen op licht
  gebruiken `--goud-diep` #C9922F (donkere blokken houden #E0A93C);
  focus-visible-stijl; hover-lift op reviewkaarten; e-mail
  info@marijnhageman.nl in footer; sessiekaart heeft locatieregel
  "Zwolle e.o." (gebruiker heeft geen vaste locatie) + notitie.
- **"Zo werkt het"** (punt 10): 3 stappen (01 Kennismaken / 02 Drie
  sessies / 03 Verder bewegen) onderin het donkere 1:1-blok op /aanbod/,
  klasse `stappen-grid`. Fotopunten uit de review zijn opgelost met de
  professionele shoot (2026-07-06).
- **VRIJspraak praktisch + em-dashes weg (2026-07-06):** VRIJspraak-kaart
  toont nu praktische details (6 maanden, livedagen & masterclasses, max.
  6 vrouwen, start 2027, investering "volgt") + zachte interesse-CTA "Laat
  je interesse weten" (in ontwikkeling). "VRIJ" in beide woorden in
  goud-diep. Cirkels-zin: "wat je (nog) niet ziet". **Alle em-dashes (—)
  uit de zichtbare teksten verwijderd** (voelden AI-achtig) — vervangen
  door komma/punt/dubbele punt in de generator; alle 6 pagina's opnieuw
  gedeployed. Hyphens in woorden (één-op-één) blijven.
- **Aanbod-layout 2026-07-06:** sessieportret (3198) staat nu bovenin de
  intro (2-koloms: tekst | foto, `aanbod-intro-foto`), niet meer naast het
  1:1-blok; 1:1-blok is nu enkele kolom (sessie-kaart max-width 620px).
  Cirkels-zin: "Wat je (nog) niet ziet of voelt". VRIJspraak-kaart padding
  gelijkgetrokken met de 1:1-sessiekaart (padding 3rem op `.vrij-kaart`
  zelf + `.vrij-kaart .elementor-widget-wrap { padding: 0 }`; de `>
  .elementor-widget-wrap`-variant pakte niet). LET OP: headless Chromium
  komt in deze omgeving niet langs de proxy naar de live site — visuele
  controle alleen via curl/grep mogelijk.
- **2026-07-06 (3 wijzigingen):** (a) **Goud overal gelijkgetrokken** naar
  het diepe #C9922F — `--goud` was #E0A93C (fel/oranjer op donkere blokken),
  nu = `--goud-diep`; ook `--lijn-goud` rgba(201,146,47,.30) en Hipsy
  `--hipsy-secondary`. Toonanker-oker #E0A93C dus verlaten t.b.v.
  consistentie + minder oranje. (b) **WhatsApp** (06-10927446 →
  `wa.me/31610927446?text=Hoi Marijn, `) als monochroom SVG (SVG_WA,
  currentColor, géén groen) toegevoegd aan socials() + footer() — subtiel,
  op alle pagina's in de footer + op kennismaken. (c) **Algemene
  voorwaarden**: verstopte pagina `/algemene-voorwaarden/` (post 3199,
  noindex, niet in menu), bereikbaar via subtiele footerlink naast Privacy.
  Gegevens: Zwolle, KvK 99478161, btw NL869008018B01. **Geüpgraded naar
  13 artikelen** n.a.v. ISA RAMA-voorbeeld (aanbod-definities, getrapte/
  volledige annulering, termijnbetaling, herroeping mét evenredige
  vergoeding, IP/opnames, e-mail+WhatsApp-communicatie, wijzigingsclausule).
  **Annulering trajecten/groepstrajecten/cirkels = 100%** (plek gereserveerd,
  niet opvulbaar; op verzoek gebruiker); losse sessies 48u; events 2wk/1wk.
  Herroeping: mag wettelijk NIET bij 'start' vervallen, alleen bij volledige
  uitvoering + evenredige vergoeding bij tussentijdse herroeping (uitgelegd).
  Gebruiker moet de inhoud nog juridisch laten toetsen.
- **Logo gevectoriseerd (2026-07-10):** origineel was 1254px webp (80 KB,
  zachte randen bij inzoomen). Via Adobe `image_vectorize` (MCP) omgezet
  naar SVG met strakke paden; master staat op de site:
  `wp-content/uploads/2026/07/logo-marijn-hageman.svg` (172 KB, géén
  attachment) + lokaal in scratchpad als `logo-vector.svg`. Favicon
  (media 3190, mh-favicon2.png 512px) en rond footer-embleem (media 3191,
  mh-logo-rond2.png 400px) opnieuw gegenereerd uit een 2508px-render van
  de SVG (cairosvg) en **in place overschreven** (zelfde bestandsnamen,
  dus alle verwijzingen + site_icon bleven werken);
  `wp_generate_attachment_metadata` draaide de maatvarianten opnieuw
  (-150x150/-300x300 gecheckt). Live geverifieerd via md5-vergelijking.
  Embleem-centrering: pixel-bbox boven 58,5% hoogte (tekst eronder
  uitgesloten), 5% marge favicon / 11% marge rond embleem.

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
