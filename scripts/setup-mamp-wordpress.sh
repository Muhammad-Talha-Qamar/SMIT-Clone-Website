#!/usr/bin/env bash
# SMIT WordPress + MAMP setup helper
# Run: bash scripts/setup-mamp-wordpress.sh
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
THEME_SRC="$ROOT/wp-theme/smit"
SETUP_DIR="${SETUP_DIR:-/tmp/smit-setup}"
MAMP_HTDOCS="/Applications/MAMP/htdocs"
WP_DIR="$MAMP_HTDOCS/smit"
MYSQL="/Applications/MAMP/Library/bin/mysql"
MYSQLADMIN="/Applications/MAMP/Library/bin/mysqladmin"
PHP="/Applications/MAMP/bin/php/php8.3.14/bin/php"
# Fallback PHP path discovery
if [[ ! -x "$PHP" ]]; then
  PHP="$(ls -d /Applications/MAMP/bin/php/php*/bin/php 2>/dev/null | sort -V | tail -1 || true)"
fi

echo "==> SMIT MAMP + WordPress setup"

if [[ ! -d /Applications/MAMP ]]; then
  PKG="$SETUP_DIR/mamp.pkg"
  if [[ ! -f "$PKG" ]]; then
    echo "Downloading MAMP 7.4 (Apple Silicon)..."
    mkdir -p "$SETUP_DIR"
    curl -L --fail -A "Mozilla/5.0" -o "$PKG" \
      "https://downloads.mamp.info/MAMP-PRO/macOS/MAMP-PRO/MAMP-MAMP-PRO-7.4-Apple-chip.pkg"
  fi
  echo "Installing MAMP (admin password required)..."
  sudo installer -pkg "$PKG" -target /
fi

if [[ ! -d /Applications/MAMP ]]; then
  echo "MAMP not found after install. Open MAMP.app manually, then re-run this script."
  open /Applications/MAMP.app 2>/dev/null || open "$SETUP_DIR/mamp.pkg" 2>/dev/null || true
  exit 1
fi

echo "==> Patch Apache for this Mac user + enable rewrite"
CONF="/Applications/MAMP/conf/apache/httpd.conf"
if [[ -f "$CONF" ]]; then
  cp "$CONF" "$CONF.bak.smit" 2>/dev/null || true
  sed -i '' "s/^User mamp$/User $(whoami)/" "$CONF" || true
  sed -i '' "s/^Group #-1$/Group staff/" "$CONF" || true
  sed -i '' 's/^#LoadModule rewrite_module/LoadModule rewrite_module/' "$CONF" || true
fi

echo "==> Starting MAMP servers (open the app if needed)"
open -a MAMP || open /Applications/MAMP/MAMP.app || true
sleep 3

# Prefer CLI start if available
if [[ -x /Applications/MAMP/bin/startApache.sh ]]; then
  /Applications/MAMP/bin/startApache.sh || true
fi
if [[ -x /Applications/MAMP/bin/startMysql.sh ]]; then
  /Applications/MAMP/bin/startMysql.sh || true
fi

echo "==> Waiting for MySQL..."
for i in $(seq 1 30); do
  if [[ -x "$MYSQLADMIN" ]] && "$MYSQLADMIN" --host=127.0.0.1 --port=8889 -uroot -proot ping &>/dev/null; then
    break
  fi
  sleep 1
done

echo "==> Creating database smit_wp"
"$MYSQL" --host=127.0.0.1 --port=8889 -uroot -proot -e "CREATE DATABASE IF NOT EXISTS smit_wp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

echo "==> Installing WordPress into $WP_DIR"
if [[ ! -f "$WP_DIR/wp-load.php" ]]; then
  mkdir -p "$WP_DIR"
  if [[ -d "$SETUP_DIR/wordpress" ]]; then
    rsync -a "$SETUP_DIR/wordpress/" "$WP_DIR/"
  else
    curl -L --fail -o "$SETUP_DIR/wordpress.zip" "https://wordpress.org/latest.zip"
    unzip -q -o "$SETUP_DIR/wordpress.zip" -d "$SETUP_DIR"
    rsync -a "$SETUP_DIR/wordpress/" "$WP_DIR/"
  fi
fi

if [[ ! -f "$WP_DIR/wp-config.php" ]]; then
  cp "$WP_DIR/wp-config-sample.php" "$WP_DIR/wp-config.php"
  # MAMP defaults: root/root, port 8889 socket often used
  sed -i.bak "s/database_name_here/smit_wp/" "$WP_DIR/wp-config.php"
  sed -i.bak "s/username_here/root/" "$WP_DIR/wp-config.php"
  sed -i.bak "s/password_here/root/" "$WP_DIR/wp-config.php"
  # Force TCP host with port for MAMP
  if ! grep -q "DB_HOST.*," "$WP_DIR/wp-config.php"; then
    true
  fi
  sed -i.bak "s/define( *'DB_HOST', *'localhost' *);/define( 'DB_HOST', '127.0.0.1:8889' );/" "$WP_DIR/wp-config.php"
  # Salts
  if command -v curl >/dev/null; then
    SALTS="$(curl -fsSL https://api.wordpress.org/secret-key/1.1/salt/ || true)"
    if [[ -n "$SALTS" ]]; then
      python3 - "$WP_DIR/wp-config.php" <<'PY'
import sys,re
path=sys.argv[1]
text=open(path).read()
# leave salts as sample if fetch fails elsewhere
open(path,'w').write(text)
PY
    fi
  fi
fi

echo "==> Symlinking theme"
mkdir -p "$WP_DIR/wp-content/themes"
rm -rf "$WP_DIR/wp-content/themes/smit"
ln -sfn "$THEME_SRC" "$WP_DIR/wp-content/themes/smit"

# WP-CLI install if available
if command -v wp >/dev/null 2>&1 && [[ -n "${PHP:-}" ]]; then
  echo "==> Running WP-CLI install"
  wp core is-installed --path="$WP_DIR" 2>/dev/null || \
    wp core install --path="$WP_DIR" \
      --url="http://localhost:8888/smit" \
      --title="Saylani Mass IT Training" \
      --admin_user="admin" \
      --admin_password="admin123" \
      --admin_email="admin@example.com" \
      --skip-email
  wp theme activate smit --path="$WP_DIR" || true
  wp rewrite structure '/%postname%/' --path="$WP_DIR" --hard || true
  wp plugin install advanced-custom-fields --activate --path="$WP_DIR" || true
else
  echo "==> WP-CLI not found. Complete install in browser:"
  echo "    http://localhost:8888/smit"
  echo "    DB: smit_wp / user: root / pass: root / host: 127.0.0.1:8889"
fi

echo ""
echo "Done."
echo "1. Open MAMP → Start Servers (ports 8888 / 8889)"
echo "2. Site:   http://localhost:8888/smit"
echo "3. Admin:  http://localhost:8888/smit/wp-admin"
echo "4. Theme:  Appearance → Themes → activate SMIT (auto-seeds content)"
echo "Theme path: $THEME_SRC → $WP_DIR/wp-content/themes/smit"
