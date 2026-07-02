# WordPress aansturen met AI (Novamira MCP)

Deze repo bevat een **`.mcp.json`** (in de root) waarmee Claude Code verbinding
maakt met [Novamira](https://novamira.ai/) — een MCP-server die als
WordPress-plugin op je eigen site draait en AI-agents volledige toegang geeft
tot WordPress (PHP uitvoeren, database queries, bestanden lezen/schrijven).

> Let op: Novamira is bedoeld voor **development/staging**-omgevingen, niet
> voor een live productiesite.

## Hoe het werkt

```
Claude Code  ->  mcp-wordpress-remote (npx-proxy)  ->  https://jouw-site.nl/wp-json/mcp/novamira  ->  WordPress
```

De inloggegevens staan **niet** in de repo: `.mcp.json` leest ze uit
omgevingsvariabelen. Die stel je zelf in (zie stap 3).

## Stap voor stap

### 1. Novamira-plugin installeren op je WordPress-site

1. Download de plugin via [novamira.ai](https://novamira.ai/) of de
   [GitHub-releases](https://github.com/use-novamira/novamira/releases).
2. Installeer en activeer de plugin in WordPress (dev/staging-site!).

### 2. Application Password aanmaken

1. Ga in WordPress admin naar **Novamira → Configuration**.
2. Klik onder *Application Passwords* op **Create New Application Password**.
3. **Kopieer het wachtwoord direct** — het wordt maar één keer getoond
   (inclusief de spaties).

Op dezelfde pagina zie je ook het MCP-endpoint van je site, in de vorm:
`https://jouw-site.nl/wp-json/mcp/novamira`

### 3. Omgevingsvariabelen instellen

De `.mcp.json` verwacht deze drie variabelen:

| Variabele                | Waarde                                            |
| ------------------------ | ------------------------------------------------- |
| `NOVAMIRA_URL`           | `https://jouw-site.nl/wp-json/mcp/novamira`       |
| `NOVAMIRA_USER`          | je WordPress-gebruikersnaam (bijv. `admin`)       |
| `NOVAMIRA_APP_PASSWORD`  | het application password uit stap 2               |

- **Claude Code op het web:** zet ze in de *environment variables* van je
  omgeving op [claude.ai/code](https://claude.ai/code) (instellingen van de
  environment). Zorg ook dat het **netwerkbeleid** van de omgeving verbinding
  met jouw WordPress-domein en `registry.npmjs.org` toestaat.
- **Claude Code lokaal:** zet ze in je shell-profiel, of registreer de server
  direct zonder `.mcp.json`:

  ```bash
  claude mcp add novamira \
    --env WP_API_URL='https://jouw-site.nl/wp-json/mcp/novamira' \
    --env WP_API_USERNAME='admin' \
    --env WP_API_PASSWORD='xxxx xxxx xxxx xxxx xxxx xxxx' \
    -- npx -y @automattic/mcp-wordpress-remote@latest
  ```

### 4. Testen

Start een nieuwe Claude Code-sessie in deze repo en vraag bijvoorbeeld:
*"welke plugins staan er op mijn WordPress-site?"* — als de verbinding werkt,
verschijnen de Novamira-tools (`mcp__novamira__*`) automatisch.

## Alternatief: directe HTTP-verbinding (zonder Node.js/npx)

Werkt de npx-proxy niet, dan kan Claude Code ook rechtstreeks met het
REST-endpoint praten via Basic-auth. Vervang de inhoud van `.mcp.json` door:

```json
{
  "mcpServers": {
    "novamira": {
      "type": "http",
      "url": "https://jouw-site.nl/wp-json/mcp/novamira",
      "headers": {
        "Authorization": "Basic BASE64_VAN_gebruikersnaam:application-password"
      }
    }
  }
}
```

De Base64-waarde maak je zo (let op: app-password mét spaties):

```bash
echo -n 'admin:xxxx xxxx xxxx xxxx xxxx xxxx' | base64
```

> Zet deze variant **niet** met echte credentials in een publieke repo — het
> wachtwoord staat dan letterlijk in het bestand. Gebruik in dat geval de
> npx-variant met omgevingsvariabelen.

## Problemen oplossen

- **Tools verschijnen niet:** controleer of alle drie de omgevingsvariabelen
  gezet zijn en herstart de sessie.
- **401/403 van WordPress:** application password verlopen of verkeerd
  gekopieerd (spaties horen erbij). Maak een nieuw aan via
  **Novamira → Configuration**.
- **Endpoint onbekend:** kijk op de Novamira-configuratiepagina in WordPress
  admin; daar staat de exacte URL van jouw site.
