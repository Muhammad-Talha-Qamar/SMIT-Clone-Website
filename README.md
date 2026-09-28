# SMIT Clone Website

Saylani Mass IT Training site — static HTML archive + WordPress theme.

## Layout

| Path | Purpose |
|------|---------|
| `wp-theme/smit/` | WordPress theme (active source of truth) |
| `html-legacy/` | Original static HTML pages + assets |
| `scripts/` | MAMP setup helpers and local access notes |
| `local-wordpress/` | Local WP copy (gitignored; used with MAMP) |

## Local WordPress (MAMP)

See `scripts/LOCAL-ACCESS.txt` for URLs, admin login, and start steps.

Theme is symlinked into MAMP:

```text
wp-theme/smit  →  /Applications/MAMP/htdocs/smit/wp-content/themes/smit
```

## Static HTML preview

Open files under `html-legacy/` (e.g. `html-legacy/index.html`) in a browser. Assets live at `html-legacy/assets/`.
