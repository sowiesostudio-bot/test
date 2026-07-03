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
