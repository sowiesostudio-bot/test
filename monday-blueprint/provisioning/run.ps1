# =============================================================================
# Monday Provisioner — Windows starter (PowerShell)
# Gebruik:  rechtsklik > "Run with PowerShell"  OF  in een terminal:
#   powershell -ExecutionPolicy Bypass -File .\run.ps1
# =============================================================================
$ErrorActionPreference = "Stop"
Set-Location -Path $PSScriptRoot

Write-Host "== Monday Provisioner ==" -ForegroundColor Cyan

# 1) Python check
$py = Get-Command python -ErrorAction SilentlyContinue
if (-not $py) { $py = Get-Command python3 -ErrorAction SilentlyContinue }
if (-not $py) { Write-Host "Python niet gevonden. Installeer Python 3 via https://python.org" -ForegroundColor Red; exit 1 }
$python = $py.Source
Write-Host "Python: $python"

# 2) Dependencies
Write-Host "Dependencies installeren (pyyaml, requests)..."
& $python -m pip install --quiet --user pyyaml requests

# 3) Token veilig opvragen (wordt niet opgeslagen of getoond)
$secure = Read-Host "Plak je Monday API-token" -AsSecureString
$bstr = [Runtime.InteropServices.Marshal]::SecureStringToBSTR($secure)
$env:MONDAY_TOKEN = [Runtime.InteropServices.Marshal]::PtrToStringAuto($bstr)
[Runtime.InteropServices.Marshal]::ZeroFreeBSTR($bstr)

# 4) Dry-run tonen
Write-Host "`n--- DRY-RUN (plan, nog geen wijzigingen) ---" -ForegroundColor Yellow
& $python provision.py --dry-run

# 5) Bevestigen en live draaien
$ok = Read-Host "`nAlles live aanmaken in Monday? (ja/nee)"
if ($ok -eq "ja") {
    Write-Host "`n--- LIVE BOUWEN ---" -ForegroundColor Green
    & $python provision.py
} else {
    Write-Host "Geannuleerd. Er is niets gewijzigd." -ForegroundColor Yellow
}

# 6) Token uit de sessie wissen
$env:MONDAY_TOKEN = $null
Write-Host "`nKlaar. Vergeet niet je API-token in te trekken in Monday (Developers > My Access Tokens)."
