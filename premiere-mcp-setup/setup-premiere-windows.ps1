<#
    setup-premiere-windows.ps1
    ----------------------------------------------------------------------
    Zet de adb-mcp "bridge" op zodat Claude Desktop Adobe Premiere Pro kan
    aansturen op deze Windows-PC.

    Wat dit script automatisch doet:
      1. Controleert / installeert Git, Node.js, Python en uv (via winget)
      2. Haalt de adb-mcp bridge binnen naar %USERPROFILE%\adb-mcp
      3. Registreert de Premiere MCP-server in Claude Desktop
      4. Maakt een snelkoppeling "start-proxy.bat" om de proxy te starten

    Wat JIJ daarna nog handmatig doet (Adobe staat automatiseren niet toe):
      - Claude Desktop, Premiere Pro (Beta) en UXP Developer Tool installeren
      - De UXP-plugin laden en in Premiere op "Connect" klikken

    Gebruik:  rechtsklik > "Met PowerShell uitvoeren"
              of in PowerShell:  ./setup-premiere-windows.ps1
#>

$ErrorActionPreference = "Stop"
$InstallDir = Join-Path $env:USERPROFILE "adb-mcp"
$RepoUrl    = "https://github.com/mikechambers/adb-mcp.git"

function Write-Step($n, $msg) { Write-Host "`n[$n] $msg" -ForegroundColor Cyan }
function Write-Ok($msg)       { Write-Host "    OK  $msg" -ForegroundColor Green }
function Write-Warn($msg)     { Write-Host "    !!  $msg" -ForegroundColor Yellow }

function Test-Cmd($name) {
    return [bool](Get-Command $name -ErrorAction SilentlyContinue)
}

function Ensure-WingetPackage($cmd, $wingetId, $friendly) {
    if (Test-Cmd $cmd) {
        Write-Ok "$friendly is al aanwezig."
        return
    }
    if (-not (Test-Cmd "winget")) {
        Write-Warn "$friendly ontbreekt en winget is niet beschikbaar."
        Write-Warn "Installeer $friendly handmatig en draai dit script opnieuw."
        throw "Vereiste ontbreekt: $friendly"
    }
    Write-Host "    Installeren van $friendly via winget..."
    winget install --id $wingetId -e --accept-source-agreements --accept-package-agreements
    if (-not (Test-Cmd $cmd)) {
        Write-Warn "$friendly is geinstalleerd maar nog niet in PATH."
        Write-Warn "Sluit dit venster, open een NIEUWE PowerShell en draai het script opnieuw."
        throw "PATH-herstart nodig na installatie van $friendly"
    }
    Write-Ok "$friendly geinstalleerd."
}

Write-Host "==========================================================" -ForegroundColor White
Write-Host "  adb-mcp  -  Premiere Pro bridge setup (Windows)" -ForegroundColor White
Write-Host "==========================================================" -ForegroundColor White

# 1. Vereisten ---------------------------------------------------------------
Write-Step 1 "Vereisten controleren / installeren"
Ensure-WingetPackage -cmd "git"    -wingetId "Git.Git"            -friendly "Git"
Ensure-WingetPackage -cmd "node"   -wingetId "OpenJS.NodeJS.LTS"  -friendly "Node.js (LTS)"
Ensure-WingetPackage -cmd "python" -wingetId "Python.Python.3.12" -friendly "Python 3"
Ensure-WingetPackage -cmd "uv"     -wingetId "astral-sh.uv"       -friendly "uv (Python runner)"

# 2. Bridge ophalen ----------------------------------------------------------
Write-Step 2 "adb-mcp bridge ophalen"
if (Test-Path $InstallDir) {
    Write-Ok "Map bestaat al: $InstallDir  -> bijwerken (git pull)"
    git -C $InstallDir pull --ff-only
} else {
    git clone --depth 1 $RepoUrl $InstallDir
    Write-Ok "Gekloond naar $InstallDir"
}

# 3. MCP-server voor Premiere registreren in Claude Desktop ------------------
Write-Step 3 "Premiere MCP-server registreren in Claude Desktop"
$mcpDir = Join-Path $InstallDir "mcp"
Push-Location $mcpDir
try {
    uv run mcp install `
        --with fonttools `
        --with python-socketio `
        --with mcp `
        --with requests `
        --with websocket-client `
        --with pillow `
        pr-mcp.py
    Write-Ok "MCP-server geregistreerd. Herstart Claude Desktop straks."
}
finally {
    Pop-Location
}

# 4. Proxy-startbestand maken ------------------------------------------------
Write-Step 4 "Snelkoppeling voor de proxy-server maken"
$proxyDir = Join-Path $InstallDir "adb-proxy-socket"
$startBat = Join-Path $InstallDir "start-proxy.bat"
@"
@echo off
title adb-mcp proxy (laat dit venster open tijdens je sessie)
cd /d "$proxyDir"
echo Proxy starten op ws://localhost:3001 ...
node proxy.js
pause
"@ | Set-Content -Path $startBat -Encoding ASCII
Write-Ok "Aangemaakt: $startBat"

# Klaar ----------------------------------------------------------------------
Write-Host "`n==========================================================" -ForegroundColor White
Write-Host "  Geautomatiseerde stappen klaar." -ForegroundColor Green
Write-Host "==========================================================" -ForegroundColor White
Write-Host @"

NOG HANDMATIG TE DOEN (eenmalig per PC):

  A. Installeer deze apps (kunnen niet veilig geautomatiseerd worden):
       - Claude Desktop      : https://claude.ai/download
       - Premiere Pro (Beta 25.3 build 46+) via Creative Cloud
       - UXP Developer Tool  via Creative Cloud  (zoek op "UXP")

  B. Herstart Claude Desktop (zodat de MCP-server geladen wordt).

  C. Start de proxy:  dubbelklik  $startBat
     (laat dat venster open zolang je werkt)

  D. Laad de Premiere-plugin:
       1. Open UXP Developer Tool > File > Add Plugin
       2. Kies:  $InstallDir\uxp\pr\manifest.json
       3. Klik Load
       4. In Premiere:  Window > UXP Plugins > Premiere MCP Agent
       5. Klik in dat paneel op "Connect"
          (LET OP: na elke herstart van Premiere opnieuw via UXP "Load")

  E. In Claude Desktop:  "+"  >  Add from Adobe Premiere  >  config://get_instructions
     Stuur dat als eerste bericht. Daarna kun je gewoon vragen zoals:
       "Voeg crossfades toe tussen alle clips op de timeline"

"@ -ForegroundColor White
