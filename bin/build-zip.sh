#!/bin/bash
# Empaqueta el theme en un .zip limpio, listo para subir a producción,
# excluyendo archivos que solo sirven en desarrollo local.
set -e

THEME_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEME_NAME="$(basename "$THEME_DIR")"
OUT_DIR="$(cd "$THEME_DIR/../../.." && pwd)"
ZIP_PATH="$OUT_DIR/${THEME_NAME}-$(date +%Y%m%d-%H%M).zip"

cd "$THEME_DIR/.."

zip -r -q "$ZIP_PATH" "$THEME_NAME" \
  -x "*.DS_Store" \
  -x "*/.DS_Store" \
  -x "*/node_modules/*" \
  -x "*/.git/*" \
  -x "*/.gitignore" \
  -x "*/bin/*" \
  -x "*/*.log" \
  -x "*/PENDIENTE-*"

echo "Zip generado en: $ZIP_PATH"
unzip -l "$ZIP_PATH" | tail -n 20