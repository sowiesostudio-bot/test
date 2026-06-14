#!/usr/bin/env bash
# =============================================================================
# Monday Provisioner — macOS/Linux starter
# Gebruik:  bash run.sh
# =============================================================================
set -euo pipefail
cd "$(dirname "$0")"

echo "== Monday Provisioner =="

# 1) Python check
PY="$(command -v python3 || command -v python || true)"
if [ -z "$PY" ]; then
  echo "Python niet gevonden. Installeer Python 3." >&2
  exit 1
fi
echo "Python: $PY"

# 2) Dependencies
echo "Dependencies installeren (pyyaml, requests)..."
"$PY" -m pip install --quiet --user pyyaml requests

# 3) Token veilig opvragen (niet in shell-history, niet opgeslagen)
read -r -s -p "Plak je Monday API-token: " MONDAY_TOKEN
export MONDAY_TOKEN
echo

# 4) Dry-run
echo
echo "--- DRY-RUN (plan, nog geen wijzigingen) ---"
"$PY" provision.py --dry-run

# 5) Bevestigen + live
echo
read -r -p "Alles live aanmaken in Monday? (ja/nee) " OK
if [ "$OK" = "ja" ]; then
  echo
  echo "--- LIVE BOUWEN ---"
  "$PY" provision.py
else
  echo "Geannuleerd. Er is niets gewijzigd."
fi

# 6) Token uit de omgeving wissen
unset MONDAY_TOKEN
echo
echo "Klaar. Vergeet niet je API-token in te trekken in Monday (Developers > My Access Tokens)."
