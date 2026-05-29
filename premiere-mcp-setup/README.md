# Premiere Pro aansturen met AI (adb-mcp bridge) — Windows

Deze map zet de **bridge** op waarmee **Claude Desktop** jouw **Adobe Premiere Pro**
kan aansturen (clips importeren, sequences, timeline-bewerkingen, transities,
effecten, renderen).

> Belangrijk: dit draait **lokaal op je eigen PC**, naast Premiere. Het werkt met
> de **Claude Desktop-app**, niet met Claude Code op het web. Je moet dit éénmalig
> op **elke PC** opzetten waar je het wilt gebruiken.

## Hoe het werkt

```
Claude Desktop  ->  MCP-server (Python)  ->  Proxy (Node.js, ws://localhost:3001)  ->  UXP-plugin  ->  Premiere Pro
```

De bridge zelf komt uit het open-source project
[mikechambers/adb-mcp](https://github.com/mikechambers/adb-mcp) (MIT-licentie,
niet door Adobe ondersteund). Het setup-script haalt die automatisch op.

## Vereisten

- Windows 10/11
- **Premiere Pro Beta 25.3 build 46+** (Premiere-ondersteuning vereist de Beta)
- Internetverbinding (om de bridge en tools op te halen)

## Stap voor stap

### 1. Setup-script draaien (automatisch deel)

Open PowerShell in deze map en draai:

```powershell
./setup-premiere-windows.ps1
```

Krijg je een melding over uitvoeringsbeleid, draai dan eerst in dezelfde sessie:

```powershell
Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass
```

Het script:
1. installeert/controleert **Git, Node.js, Python en uv** (via winget);
2. haalt de **adb-mcp bridge** op naar `%USERPROFILE%\adb-mcp`;
3. registreert de **Premiere MCP-server** in Claude Desktop;
4. maakt **`%USERPROFILE%\adb-mcp\start-proxy.bat`** om de proxy te starten.

> Als een tool net geïnstalleerd is maar nog niet in PATH staat: sluit het venster,
> open een **nieuwe** PowerShell en draai het script opnieuw.

### 2. Apps installeren (handmatig — Adobe staat automatiseren niet toe)

- **Claude Desktop** → https://claude.ai/download
- **Premiere Pro (Beta 25.3 build 46+)** → via Creative Cloud
- **UXP Developer Tool** → via Creative Cloud (zoek op "UXP")

Herstart **Claude Desktop** daarna één keer.

### 3. Proxy starten

Dubbelklik op `%USERPROFILE%\adb-mcp\start-proxy.bat`.
Je ziet: `... proxy server running on ws://localhost:3001`.
**Laat dit venster open** zolang je werkt.

### 4. Plugin laden in Premiere

1. Open **UXP Developer Tool** → **File > Add Plugin**
2. Kies `%USERPROFILE%\adb-mcp\uxp\pr\manifest.json` → **Load**
3. In Premiere: **Window > UXP Plugins > Premiere MCP Agent**
4. Klik op **Connect** in dat paneel

> Na elke herstart van Premiere moet je de plugin opnieuw via **Load** laden in
> de UXP Developer Tool.

### 5. Sessie starten in Claude Desktop

1. Start: Claude Desktop + proxy-venster + Premiere (plugin op Connect).
2. In Claude Desktop: klik **"+"** → **Add from Adobe Premiere** → **`config://get_instructions`**.
3. Stuur dat eerste bericht. Daarna in gewoon Nederlands/Engels, bv.:
   - "Voeg crossfades toe tussen alle clips op de timeline"
   - "Maak een nieuwe sequence en plaats deze 3 clips achter elkaar"
   - "Welke Premiere-functies heb je beschikbaar?"

## Goed om te weten

- De **Premiere**-agent kan minder dan de Photoshop-agent (beperking van de
  Premiere plugin-API). Verwacht solide basisbewerkingen, niet élke functie.
- De plugin gaat uit van werken met **één sequence** tegelijk.
- Maak tijdens het werk niet zelf wijzigingen in Premiere zonder het de AI te
  vertellen — anders raakt de AI "het overzicht" kwijt.
- Voor bestandstoegang (clips inladen vanaf schijf) kun je aanvullend de
  [Filesystem MCP server](https://www.claudemcp.com/servers/filesystem) of
  [media-utils-mcp](https://github.com/mikechambers/media-utils-mcp) toevoegen.

## Problemen oplossen

| Probleem | Oplossing |
|---|---|
| Plugin blijft op "Connect" staan | Proxy-venster draait niet, of plugin niet geladen. Check beide; bekijk fouten via "Debug" in UXP Developer Tool. |
| MCP werkt niet in Claude | Zet een **absoluut pad** naar `uv` in de Claude-config. Zie issue #5 in de adb-mcp repo. |
| Tool net geïnstalleerd, script faalt op PATH | Nieuwe PowerShell openen en script opnieuw draaien. |

Bron: [mikechambers/adb-mcp](https://github.com/mikechambers/adb-mcp)
