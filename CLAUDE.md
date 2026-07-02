# Project: buurmanstudio.nl via Novamira

Deze repo verbindt Claude Code met de WordPress-site **buurmanstudio.nl**
via de Novamira MCP-server (zie `.mcp.json` en `novamira-mcp-setup/README.md`).

## Openstaande taak

- [ ] **Footertekst wijzigen** op buurmanstudio.nl:
  vervang `Designed By: Zeko Code` door `Designed By: Buurman Studio`.
  De credit staat in de footer (rood/roze balk onderaan de site) — zoek de
  bron via de Novamira-tools: waarschijnlijk een customizer/thema-instelling
  (`wp_options`/theme mods), anders `footer.php` van het actieve thema of een
  widget. Controleer na de wijziging de live site.

## Werkwijze

- De Novamira-tools (`mcp__novamira__*`) laden automatisch als het
  netwerkbeleid van de environment `buurmanstudio.nl` toestaat.
- Zijn de tools er niet, controleer dan eerst met `curl` of
  `https://buurmanstudio.nl/wp-json/` bereikbaar is; zo niet, dan blokkeert
  het netwerkbeleid nog en moet de gebruiker dat aanpassen op claude.ai/code.
- buurmanstudio.nl is een live site: maak gerichte, kleine wijzigingen en
  verifieer het resultaat op de site zelf.
