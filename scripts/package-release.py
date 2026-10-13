#!/usr/bin/env python3
"""Build a deterministic theme ZIP outside the checkout; no credentials or tooling."""
import argparse
from pathlib import Path
import re
import zipfile
parser = argparse.ArgumentParser()
parser.add_argument('--output', type=Path, required=True)
parser.add_argument('--version', required=True)
args = parser.parse_args()
root = Path(__file__).resolve().parents[1]
out = args.output.resolve()
if out == root or root in out.parents:
    raise SystemExit('Release output must be outside the checkout')
match = re.search(r'Version:\s*([^\s]+)', (root/'style.css').read_text())
if not match or match.group(1) != args.version:
    raise SystemExit('Tag and style.css version differ')
exclude = {'.git', '.github', 'node_modules', 'scripts', 'tests', '__pycache__'}
out.parent.mkdir(parents=True, exist_ok=True)
with zipfile.ZipFile(out, 'w', zipfile.ZIP_DEFLATED) as archive:
    for file in sorted(root.rglob('*')):
        rel = file.relative_to(root)
        if not file.is_file() or any(part in exclude or part.startswith('.') for part in rel.parts): continue
        if rel.name in {'README.md', 'SYSTEM.md'} or file.suffix in {'.zip', '.sql', '.log'}: continue
        info = zipfile.ZipInfo('bootstrap-component-blox/' + rel.as_posix(), (2026, 1, 1, 0, 0, 0))
        info.compress_type = zipfile.ZIP_DEFLATED
        info.external_attr = 0o644 << 16
        archive.writestr(info, file.read_bytes())
with zipfile.ZipFile(out) as archive:
    assert archive.testzip() is None
    assert 'bootstrap-component-blox/style.css' in archive.namelist()
print(out)
