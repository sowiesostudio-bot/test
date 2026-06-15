# Samen Omhoog — WordPress thema

Maatwerk-thema voor **Stichting Samen Omhoog** (School of Life, Zwolle), gebaseerd op het goedgekeurde redesign (v5). Een warme, toegankelijke one-page site met hero, hulp-finder, missie, programma's, oprichtersverhaal, doelgroepen, verhalen, werkwijze, certificeringen, documenten en een werkend contactformulier.

## Installeren in WordPress

1. Maak een ZIP van de map `samen-omhoog` (zie hieronder), of gebruik het meegeleverde `samen-omhoog.zip`.
2. Ga in WordPress naar **Weergave → Thema's → Nieuw thema toevoegen → Thema uploaden**.
3. Kies `samen-omhoog.zip` en klik op **Nu installeren** → **Activeren**.
4. De homepage toont automatisch de landingspagina (via `front-page.php`).

### Zelf een ZIP maken
Vanuit deze repository:
```bash
cd samen-omhoog && zip -r ../samen-omhoog.zip . -x ".*"
```
Let op: WordPress verwacht dat de themabestanden in een **eigen submap** zitten binnen de ZIP (map `samen-omhoog/` met daarin `style.css` etc.). Maak de ZIP daarom vanaf de bovenliggende map:
```bash
zip -r samen-omhoog.zip samen-omhoog -x "*.DS_Store"
```

## Na installatie instellen

- **Logo**: twee opties —
  1. Weergave → Aanpassen → Site-identiteit → Logo (aanbevolen, via WordPress), of
  2. plaats het bestand `assets/img/logo.png` in het thema; dit verschijnt automatisch in de
     navigatie (en op een witte chip in de footer) als er geen WordPress-logo is ingesteld.
- **Contactgegevens**: Weergave → Aanpassen → **Samen Omhoog — Contactgegevens**. Hier stel je in:
  WhatsApp-nummer, telefoon, e-mail, adres, openingstijden en de ontvanger van het contactformulier.
- **Menu**: Weergave → Menu's → wijs een menu toe aan "Hoofdmenu" en/of "Footer menu".
  Zonder menu toont het thema automatisch een nette standaardnavigatie.
- **Front page**: het thema gebruikt `front-page.php` automatisch. Wil je expliciet een statische voorpagina, zet dan Instellingen → Lezen → "Je homepagina toont" op een statische pagina.

## Contactformulier
Het formulier verstuurt via `admin-post.php` met nonce-beveiliging en een honeypot tegen spam.
Mails gaan naar het adres ingesteld bij *Ontvanger contactformulier* (standaard het WordPress-beheerdersadres).
Voor betrouwbare aflevering wordt een SMTP-plugin aangeraden (bijv. WP Mail SMTP).

## Bestanden
- `style.css` — thema-header + volledige styling
- `functions.php` — assets, menu's, custom logo, Customizer-instellingen, formulierafhandeling
- `header.php` / `footer.php` — site-shell met topbar, navigatie, footer en WhatsApp-knop
- `front-page.php` — de complete landingspagina
- `index.php` — fallback voor blog/pagina's
- `assets/js/main.js` — sticky nav + reveal-animaties

## Preview bijwerken
De map `preview/` bevat een standalone HTML-versie (zonder WordPress) ter beoordeling.
Die wordt automatisch uit de échte themabestanden gegenereerd, dus preview en thema
blijven identiek. Opnieuw genereren na wijzigingen:
```bash
php tools/build-preview.php
```

## Aandachtspunten
- De afbeeldingen in het oorspronkelijke ontwerp (logo, ISO/SBB/Rotary, PDF's) waren externe links.
  Upload deze via de Mediabibliotheek en koppel ze (logo via Site-identiteit, documenten via de doc-links).
- Het redesign was een one-page concept; bestaande subpagina's (Over ons, Aanbod) kun je later koppelen via het menu.
