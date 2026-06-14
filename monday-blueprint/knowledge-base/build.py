#!/usr/bin/env python3
"""Genereer kb.json uit kb.yaml (de canonieke bron).

Gebruik:  python3 build.py
Vereist:  pip install pyyaml

Draai dit na ELKE wijziging in kb.yaml, zodat systemen die JSON consumeren
(n8n, AI-agent) niet afwijken van de bron.
"""
import json
import pathlib
import sys

try:
    import yaml
except ImportError:
    sys.exit("PyYAML ontbreekt. Installeer met: pip install pyyaml")

HERE = pathlib.Path(__file__).parent
src = HERE / "kb.yaml"
dst = HERE / "kb.json"

data = yaml.safe_load(src.read_text(encoding="utf-8"))
dst.write_text(json.dumps(data, ensure_ascii=False, indent=2) + "\n", encoding="utf-8")
print(f"OK: {dst.name} gegenereerd uit {src.name} (versie {data['meta']['version']})")
