# Bootstrap Component Blox

A lightweight, stable WordPress parent theme built on Bootstrap 5. Designed for building client sites via child themes using the BCB manifest system.

## Stack

| Library | Version |
|---|---|
| Bootstrap | 5.3.8 |
| Font Awesome | 6.7.2 |
| Bootstrap Icons | 1.13.1 |
| jQuery | WordPress bundled |

**Requirements:** PHP 8.0+, WordPress 6.7.2+

## Features

- Full Bootstrap 5 grid, components, and utilities
- Font Awesome 6 + Bootstrap Icons via CDN
- Three registered nav menus (main, sidebar, auxiliary)
- Six widget areas (sidebar + 4 footer + 1 custom)
- Customizer settings for navbar type, sticky nav, color scheme, footer credit
- Optional WooCommerce support (toggleable via Customizer)
- `bcb_*` helper functions for images, navigation, icons, content, pagination, and taxonomy terms
- Action hooks for injecting content before/after navbar and footer
- Customizer extension hooks for child theme panels, sections, settings, and controls
- Auto-updates via GitHub Releases (Puc v4.9)

## Child Theme Development

BCB is not meant to be used standalone. All site-specific work goes in a child theme.

Two manifest files drive development:

1. **`bcb-manifest.md`** (this theme) -- API reference, file conventions, CSS architecture, section patterns, enqueue rules
2. **`project-manifest.md`** (child theme) -- project-specific config: colors, typography, button variants, image registry, page templates

See `bcb-manifest.md` for the full API reference and conventions.

## File Structure (Child Theme)

```
child-theme/
├── style.css                        Global CSS: variables, utilities, shared classes
├── functions.php                    Enqueue styles/scripts, child theme setup
├── header-scripts.php               Google Fonts and external <link> tags
├── templates/
│   └── {page}.php                   Page template orchestrators
├── archive-{cpt}.php               CPT archive orchestrators
├── single-{cpt}.php                CPT single orchestrators
└── template-parts/
    ├── {context}/                   Section template parts
    │   └── {context}-{section}.php
    ├── css/                         Scoped stylesheets (conditionally enqueued)
    └── js/                          Third-party JS stored locally
```

## Releasing a New Version

1. Bump the version in `style.css`
2. Commit and push to `master`
3. Tag and push:
   ```
   git tag v2.9.0
   git push origin v2.9.0
   ```
4. GitHub Actions validates PHP/JS and creates a draft release with a clean `.zip` asset
5. Validate compatibility and production auto-update exposure, then publish the draft. Only published releases appear in Dashboard > Updates. Never publish while unreviewed automatic installs are possible.

## License

GNU General Public License v3 -- see [LICENSE](LICENSE)

## Shared UI opt-in

New child themes call `add_theme_support('bcb-ui-v1')` on `after_setup_theme`. Existing children keep legacy behavior until reviewed. See `bcb-manifest-core.md` for the token and component contract. No SMTP or form configuration is performed by theme activation.
