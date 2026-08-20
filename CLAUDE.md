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
    yogalessen."): 4 kaarten (Wendy Borninkhof, Marieke Peters, Wilma
    Eilander — met emoji's, bewust behouden — en Miranda Schrijver,
    toegevoegd 2026-07-11), tussen werkwijze en CTA; 2x2-raster ≥1100px
    (was 3 kolommen), daaronder 2/1. Sessiekaart: "Vorm — Live" (online weggehaald).
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
- **Logo herkleurd naar huisstijlpalet (2026-07-10, keuze gebruiker):**
  zonnestralen = verloop vlam #C66A3F → goud #C9922F (o.b.v. originele
  toon per pad), vrouw + naam = grond #6B3A2A, streepje/sterretje onder
  de naam = terra #C66A3F (geselecteerd op positie: paden met min-y >
  1040 in 1254-space), achtergrond = adem #F7F3E8. Master:
  `uploads/2026/07/logo-marijn-hageman-palet.svg` (origineelkleurige
  SVG staat er ook nog: `logo-marijn-hageman.svg`). Favicon 3190 +
  rond embleem 3191 opnieuw in place overschreven uit 2508px-render,
  metadata geregenereerd, live geverifieerd (md5). Scratchpad:
  `logo-palet-definitief.svg` + herkleurscript in de sessie.
- **Stralen-revisie (2026-07-10, feedback):** het vlam→goud-verloop per
  straal verving door **kronkelstralen = vlam-accenten, rechte spitsen +
  ring = goud**. Segmentatie die werkte (na mislukte pogingen met vaste/
  adaptieve zaadradius + watershed en erosie — de stralen vergroeien bij
  de ring): **skeletonize op 5016px-render, skelet in takken splitsen op
  junctiepunten, tak = vuur als gemiddelde EDT-dikte > 11** (verdeling is
  bimodaal: spitsen 2-10, kronkels 12-26), daarna watershed met
  takken als markers. Definitieve PNG opnieuw gevectoriseerd via Adobe
  `image_vectorize` → `logo-marijn-hageman-palet.svg` (145 KB) op de
  site vervangen; favicon 3190 + embleem 3191 idem (md5 live gecheckt).
  Hand van de danseres heeft in het ORIGINEEL ook al duim + 3 vingers
  (gestileerd) — geen vectorisatiefout; gebruiker gemeld.
- **Logo v3 (2026-07-10, feedback):** (a) achtergrond van adem #F7F3E8
  naar **warm wit #F2E9DE** (gebruiker vond adem te wit-geel); (b)
  **vuur-accenten weer weg: álle stralen goud** #C9922F; (c) **extra
  vinger** op de opgestoken hand (nu duim + 4): middelste vingerzone
  op de 5016px-render gewist en 3 vingers programmatisch getekend
  (taps toelopende polygonen langs centerlijn), vectorisatie strijkt
  de randen glad; (d) **pols-kringel rechterhand weggewerkt** (was de
  duim die door vectorisatie een klont werd) + los zwevend vlekje weg
  + omsloten crème-vlekjes in de hand gevuld (scipy label, alleen
  componenten die de vensterrand niet raken). Werk-render:
  `render-edit.png` in scratchpad; workflow = bewerken op render5016 →
  herinkleuren → 2508 PNG → Adobe vectorize → SVG. Favicon/embleem/
  SVG op de site vervangen (md5 live geverifieerd). Streepje onder de
  naam blijft terra.
- **Logo v4 — handen getransplanteerd (2026-07-10):** gebruiker vond de
  getekende handen niet goed en leverde een referentiefoto (danseres,
  stock). Beide handsilhouetten uit de foto gesneden (4x LANCZOS-upscale
  eerst, dán drempel lum<150, grootste component, fill_holes — direct
  drempelen op lage resolutie versmolt de vingers) en op de polsen van
  de logo-figuur geënt: masker ingekort tot hand + polsstomp, oude hand
  gewist, geplakt op ankerpunt (armhoeken kwamen vrijwel overeen, geen
  rotatie nodig), polsnaden met kleine donkere/lichte polygonen
  bijgewerkt (meerdere zoom-iteraties: pijlpunt, schoorsteentje en
  hoorntje-artefacten weggewerkt). Werkbestand `render-hands.png`,
  maskers `mask4-boven/rechts.png`, ref `danseres-ref.png` (scratchpad).
  Daarna zelfde pipeline: herinkleuren → 2508 → Adobe vectorize → SVG →
  favicon/embleem/SVG op site (md5 geverifieerd). Masters:
  `logo-v4-2508.png` + `logo-v4.svg`.
- **Logo v5 — handen als splines (2026-07-11):** gebruiker vond ook de
  fotomaskers niet netjes (te grof op deze schaal, vingers papperig).
  Definitieve aanpak: **handen getekend als gladde gesloten splines**
  (scipy splprep, per=1, s=3.5*n, ~30 controlepunten per hand) op de
  5016-render. De hangende rechterhand (handrug → 4 vingerprongen met
  dalen → duim) werkte meteen; de opgestoken hand faalde 3x als eigen
  ontwerp (blob/klauw) en is uiteindelijk **dezelfde vorm, gespiegeld
  (linkerhand!), -63° geroteerd, schaal 0.92** op de pols van de
  opgeheven arm gezet (armtip programmatisch gemeten: bovenste donkere
  pixel na wissen, (2556,1453)) + polswig-polygoon voor de geknikte
  aansluiting. Puntenlijst HAND2 + transformeer() staan in de sessie.
  Zelfde pipeline → masters `logo-v5-2508.png` + `logo-v5.svg`;
  favicon/embleem/SVG op site vervangen (md5 geverifieerd).
- **Logo v6 — DEFINITIEF: originele handen terug (2026-07-11):**
  gebruiker vond ook de spline-handen lelijk ("laat maar even, zet de
  oorspronkelijke afbeelding terug"). Alle handbewerkingen teruggedraaid:
  v6 = schone render5016 van het originele logo, alleen herinkleurd
  (warm wit #F2E9DE, alle stralen goud #C9922F, figuur/naam grond
  #6B3A2A, streepje terra #C66A3F). Handen dus exact zoals in het
  aangeleverde origineel (incl. gestileerde duim + 3 vingers).
  Masters `logo-v6-2508.png` + `logo-v6.svg`; favicon 3190/embleem
  3191/SVG op site vervangen (md5 geverifieerd). LES: geen
  ontwerp-chirurgie (handen e.d.) meer proberen op dit logo — dat is
  illustratorwerk; alleen kleuren/scherpte aanpassen werkt goed.
- **Logo DEFINITIEF v7 — nieuw aangeleverd ontwerp (2026-07-11):**
  gebruiker leverde een NIEUW logo (danseres met wapperende broek ín de
  zon, stralen met oranje verloop, ander ontwerp dan het oude). Kleuren
  gemeten en NIET aangepast (instructie): achtergrond #F6E6D5, figuur/
  naam ±#5F3A22, stralen verloop ±#D67F36 (ring #CB8A2E, ster #D86A2B).
  Let op: wijkt af van het sitepalet (goud #C9922F 12% donkerder,
  figuur donkerder dan grond) — gebruiker gemeld, bewust zo gelaten.
  Adobe-vectorisatie kleurgetrouw (Δ1-4 tinten). Masters:
  `logo-def-2508.png` + `logo-def.svg` (scratchpad), SVG ook op de site
  (zelfde bestandsnaam logo-marijn-hageman-palet.svg). Favicon 3190 +
  rond embleem 3191 in place vervangen (embleem-cut y<0.645H, ster valt
  eraf). **Header-embleem toegevoegd:** rond zonnetje (zelfde
  mh-logo-rond2.png) naast de naam in de nav op alle 7 pagina's —
  nav() in bouw_pagina.py heeft nu `<img class="nav-embleem">` in
  .nav-mark; CSS: .nav-mark flex + .nav-embleem 38px (mobiel 30px).
  Alle pagina's + CSS gedeployed, md5 + nav-embleem live geverifieerd.
  **Cache-doorbraak (2026-07-11):** gebruiker bleef oud logo zien
  ondanks juiste bestanden op de server (afbeeldingen krijgen
  max-age=1 jaar; hernieuwde inhoud onder zelfde naam is onbetrouwbaar).
  Definitieve oplossing: **nieuwe bestandsnamen** mh-favicon3.png +
  mh-logo-rond3.png (attachments 3190/3191: _wp_attached_file
  aangepast + metadata geregenereerd zodat site_icon-maten
  mh-favicon3-150x150/-300x300 werden); nav/footer in generator naar
  rond3; alle pagina's opnieuw gedeployed; Varnish gepurged (PURGE
  per pad vanaf de server zelf werkt, regex-purge niet). LES: bij
  vervanging van afbeeldingen op deze site ALTIJD een nieuwe
  bestandsnaam gebruiken.
- **1:1-blok herbouwd na ChatGPT-bewerking (2026-08-18):** gebruiker had
  via ChatGPT nieuwe teksten in het 1:1-blok op /aanbod/ gezet: één lange
  text-editor met inline-styled koppen en detailbox in #6b3a2a op de
  donkere grond-achtergrond (onleesbaar); sessiekaart + stappen-grid
  waren daarbij verdwenen. Herbouwd in huisstijl MET BEHOUD van alle
  nieuwe teksten (lichaamswerk/de-armouring, nieuw tarief €550 per 3
  sessies incl. btw, medische disclaimer): verhaal (klasse
  `aanbod-verhaal`, 62ch) → tweeluik "Veiligheid als bedding" | "Wat
  lichaamswerk je kan brengen" (`aanbod-tweeluik`, subkoppen
  `aanbod-subkop` in goud-cursief) → tariefblok (`aanbod-tarief`:
  tarieftekst | sessie-kaart met Duur 2 uur / Start min. 3 sessies /
  €550 / Zwolle e.o. / Live + disclaimer als sessie-note + CTA-knop
  mh-btn-adem naar /kennismaken/). CSS-blok toegevoegd aan
  mh-huisstijl.css. Intro-sectie ("Beweging begint hier.") was al in
  huisstijl, alleen tekst gewijzigd; zo gelaten. Stappen-grid "Zo werkt
  het" bewust NIET teruggezet (nieuwe tarieftekst dekt dat verhaal).
  LET OP: generator bouw_pagina.py bestaat niet meer (scratchpad
  geleegd); live _elementor_data is nu de bron, wijzigingen dus
  chirurgisch in de JSON doen.
- **1:1-blok ronde 3, blokjes-layout (2026-08-18, DEFINITIEF):** gebruiker
  vond de enkele kolom een "lange lap tekst"; wilde blokjes naast elkaar,
  maar de prijzenkaart alleen ónderaan (niet naast tekst). Nu: verhaal in
  2 CSS-leeskolommen (`aanbod-leeskolommen`, ≥900px, max 140ch) →
  2x2-raster (`aanbod-blokken`) met 4 omkaderde blokjes (`aanbod-blok`,
  dun kader + gouden accentlijn links, zoals sessie-kaart): Veiligheid
  als bedding | Wat lichaamswerk je kan brengen | Mijn achtergrond |
  Tarief → sessie-kaart los gecentreerd onderaan (`aanbod-kaart-wrap`,
  max 620px) met details (2 uur / min. 3 sessies / €550 / vervolg €170),
  intake-note, "Belangrijk om te weten"-disclaimer als tweede note, CTA.
  Subkop "Belangrijk om te weten" is dus opgegaan in de kaart-note
  (gemeld aan gebruiker). Mobiel: raster 1 kolom.
- **1:1-blok ronde 2, definitieve tekst gebruiker (2026-08-18):**
  gebruiker leverde de definitieve tekst + vond het tweeluik niet mooi
  uitgelijnd. Nu één rustige kolom (66ch) met gouden subkoppen:
  verhaal → Veiligheid als bedding → Wat lichaamswerk je kan brengen →
  **Mijn achtergrond (nieuw**: politie, veld lezen, doorleefde weg
  hoofd→lichaam**)** → Belangrijk om te weten → Tarief (tekst |
  sessie-kaart, grid align start). Kaart: Duur 2 uur / Minimale afname
  3 sessies / €550 per 3 sessies (incl. btw) / **Vervolgsessies €170
  per sessie (incl. btw)**; intake-notitie (formulier vooraf, "In de
  eerste sessie bespreken we de intake, daarna volgt de sessie zelf.
  De eerste sessie duurt daarom 2,5 uur.") als sessie-note; CTA "Plan een kennismaken". "Zwolle e.o."
  en "Vorm Live" op verzoek (impliciet, definitieve lijst) verwijderd.
  Tekst woord-voor-woord geverifieerd (46 fragmenten). `.aanbod-tweeluik`
  uit CSS verwijderd; subkoppen krijgen margin-top 3.2rem.

- **Homepage-titel ingekort (2026-08-19):** Yoast-titel van post 3179
  was "Marijn Hageman — Beweging"; gebruiker vond "Beweging" stom in
  tabblad/Google. Nu alleen "Marijn Hageman" (_yoast_wpseo_title).
  Overige pagina's houden "Paginanaam — Marijn Hageman". Google toont
  de nieuwe titel pas na hercrawl (dagen tot weken).

- **CTA-kop op home (2026-08-19):** "Klaar om te bewegen?" →
  "Klaar om in beweging te komen?" (echoot de hero-eyebrow); dubbele
  tussenregel "Bekijk het aanbod." (em) verwijderd, knop dekt dat al.
- **Reviews-kop op home (2026-08-19):** "Wat deelnemers zeggen. / Uit
  mijn yogalessen." → alleen "Wat ik terugkrijg." (gebruiker vond
  deelnemers/yogalessen lelijk gestapeld); eyebrow "Ervaringen" en de
  twee intro-zinnen blijven.

- **Over mij-tekst vervangen (2026-08-19):** volledige nieuwe tekst van
  gebruiker op /over-mij/ (post 3182), verdeeld over de bestaande opbouw:
  intro naast foto (tussenruimte / gezin+pleegkinderen / politie op 18e),
  leeskolommen 1 (17 jaar, spaceholden, masker / IVK+kinderen / stem van
  anderen / super stoer), 2016-quote (ongewijzigd), leeskolommen 2
  (naar binnen / gifts / direct-scherp-analytisch / "The feminine force
  of Mother Nature"). 36 fragmenten woord-voor-woord live geverifieerd.
  Kernwoorden-regel en foto ongewijzigd.

- **Werkwijze-sectie op home gesplitst (2026-08-19, definitief):** op
  aanleveren gebruiker nu TWEE secties: (1) "Waarvoor je bij mij
  terechtkunt." (id `werkvormen`, eyebrow "Werkvormen" door mij gekozen)
  met intro-alinea + 4 ww-items: Lichaamswerk / Schaduwwerk & systemisch
  werk / Dans & expressie / Ritueel (Rite of the Womb, Ayni, Despacho);
  (2) "Hoe ik werk" (id `hoe-ik-werk`, kop "Afstemmen op het veld."
  behouden) met 2 ww-items: Het veld lezen / Veiligheid & eigen regie
  (nieuwe tekst: "basis van alles wat ik doe"). 16 fragmenten +
  volgorde live geverifieerd.

- **Werkvormen-intro ingekort + sessiefoto (2026-08-20):** intro van
  "Waarvoor je bij mij terechtkunt." op home ingekort (geen "eigen
  ingang en bedoeling"/"Wat centraal staat"-zin; "vervolggroep" →
  "groepstrajecten"). Op /aanbod/ in het 1:1-blok: aangeleverde
  sessiefoto (AI-bewerkt, 1536x1024) naast het verhaal
  (`aanbod-foto-rij` 1.4fr/1fr; leeskolommen daar vervallen). Foto
  bewust klein op de site: `uploads/2026/08/mh-sessie-lichaamswerk.jpg`
  900px JPEG q82 (geen groter origineel op de server), géén attachment,
  niet klikbaar, pointer-events none + draggable=false (rechtsklik-
  opslaan/slepen geblokkeerd; screenshots blijven mogelijk, gebruiker
  weet dat lage resolutie de echte bescherming is). Max 420px breed
  (mobiel 340px, gecentreerd).

- **Knoppen /aanbod/ (2026-08-20):** sessiekaart-CTA "Plan een
  kennismaking" → "Neem contact op"; onder Rite of the Womb-tekst
  nieuwe knop "Meer informatie" (mh-btn-adem → /kennismaken/).

- **Kennismaken-pagina (2026-08-20):** regel "Plan een kennismaking.
  Geen verplichtingen." onder de kop verwijderd.

- **Events-kop /aanbod/ (2026-08-20):** "Samen in beweging." weg; grote
  kop is nu "Events & workshops.", eyebrow → "Agenda" (geen dubbeling).

- **1:1-blokje "Tarief" → "Investering" (2026-08-20):** subkop in het
  2x2-raster hernoemd; de detailregel "Investering" in de sessiekaart
  stond er al zo.

- **Rite of the Womb-tekst vernieuwd (2026-08-20):** kop nu alleen
  "Rite of the Womb." (subregel "In een cirkel of één-op-één." weg);
  nieuwe tekst gebruiker: 3 alinea's (ritueel / 1:1 of kleine kring
  vriendinnen-familie / praktisch: 2 uur, €170 incl. btw voor 1:1 of
  twee vrouwen, grotere groep op maat). 7 fragmenten live geverifieerd.

- **"Veiligheid & eigen regie" op home (2026-08-20, definitief):** tekst
  is nu de "Veiligheid als bedding"-alinea (politie/veiligheidskundige/
  "werkelijk kan zakken"); regie/consent-details staan in het 1:1-blok
  op /aanbod/.

- **Lichaamswerk-blok /aanbod/ herschreven (2026-08-20, tekst
  gebruiker):** kop alleen "Lichaamswerk." (em "Eén-op-één sessies."
  weg); verhaal naast foto = 3 nieuwe alinea's ("sjamanistisch", "zonder
  iets te forceren of open te willen breken"); 2x2-blokjes nu:
  De-armouring binnen het lichaamswerk / Afstemming, consent en eigen
  regie / Wat lichaamswerk je kan brengen / Investering (3 alinea's,
  integratie-verhaal). "Veiligheid als bedding" en "Mijn achtergrond"
  vervallen. Praktisch-kaart + foto ongewijzigd. 27 fragmenten live
  geverifieerd.

- **Header-logo: transparante zon (2026-08-20):** nav-embleem is nu
  `uploads/2026/08/mh-logo-zon1.png` (400px RGBA, zon volledig met
  uitlopende stralen, transparante achtergrond, 2%% marge) op alle 7
  pagina's; 54px desktop / 42px mobiel, border-radius verwijderd.
  Footer-embleem + favicon blijven mh-logo-rond3/mh-favicon3. LET OP:
  in opgeslagen _elementor_data zijn quotes ge-escaped (\") — bij
  server-side str_replace het patroon met backslashes gebruiken.

- **Footer-embleem = zon + nieuwe hero (2026-08-20):** footer toont nu
  ook mh-logo-zon1.png (48px, geen ronde clip); alleen favicon is nog
  rond3. Hero home volledig vernieuwd (tekst gebruiker): eyebrow
  "Lichaamswerk · Bewustzijnswerk · Vrouwenwerk", h1 + naam + nieuwe
  rolregel "Lichaamswerker en facilitator van vrouwenwerk" (span
  .hero-rol), nieuwe subtekst ("Voor vrouwen die veel dragen en gewend
  zijn door te gaan...", accent "Ik hoor tussen de regels..."), knop
  "Ontdek hoe ik werk" → #werkvormen. Yoast-metadesc home mee
  bijgewerkt. Let op: /aanbod/ Yoast-schema thumbnailUrl verwijst nog
  naar mh-logo-rond3.png (onzichtbaar, onschuldig).

- **Praktisch-kaart /aanbod/ (2026-08-20):** regel "Eén-op-één sessie"
  (sessie-naam) verwijderd; kop "Praktisch" nu in aanbod-subkop-stijl
  (groot goud cursief, h3) i.p.v. klein sessie-label.

- **VRIJspraak-foto (2026-08-20):** kliffoto gebruiker naast de
  VRIJspraak-kaart (`vrij-kaart-wrap` nu grid 1.25fr/1fr,
  `vrij-foto-wrap`): `uploads/2026/08/mh-vrijspraak.jpg` 900x1200 q82,
  géén attachment/origineel op server; zachte randen (radius 18 +
  schaduw), niet klikbaar, pointer-events none + draggable=false.
  Max 360px (mobiel 300px onder de kaart).

- **Alle beweging van de site (2026-08-20):** op verzoek gebruiker geen
  bewegende/schuivende teksten meer: scroll-reveals uit mh-extra.js
  verwijderd (alleen actieve-menustaat blijft), .mh-reveal-CSS weg,
  knop-hover-lift (translateY) en reviewkaart-hover-lift weg.
  Kleurovergangen bij hover (zonder beweging) bewust behouden.

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
