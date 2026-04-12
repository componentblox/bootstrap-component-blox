# BCB Core Manifest — Bootstrap Component Blox

> Version: 2.8.4
> Quick reference for every child theme task. For full code examples, CPT patterns, and integration boilerplate, see `bcb-manifest.md`.

---

## Stack

| Library | Version |
|---|---|
| Bootstrap | 5.3.8 |
| Font Awesome | 6.7.2 |
| Bootstrap Icons | 1.13.1 |
| WordPress | tested up to 6.7.2 |
| PHP | 8.0+ |

Do not enqueue different versions — the parent theme already loads them.

---

## Helper Functions

All prefixed with `bcb_`. Use instead of raw WordPress equivalents.

| Function | Signature | Returns |
|---|---|---|
| `bcb_image_url` | `($id, $size = 'full')` | Image URL string |
| `bcb_image_alt` | `($id)` | Alt text string |
| `bcb_image_id` | `()` | Current post's featured image ID |
| `bcb_main_nav` | `($classes = 'ms-auto')` | Main Menu navbar |
| `bcb_aux_nav` | `($classes = 'ms-auto')` | Auxiliary Menu navbar |
| `bcb_search_form` | `($searchClasses = '')` | Styled search form |
| `bcb_get_the_content` | `($id)` | Filtered HTML for any post |
| `bcb_check_template_name` | `($name)` | `true` if current page template matches |
| `bcb_pagination` | `()` | Bootstrap-styled archive pagination |
| `bcb_icon` | `($name, $size = 20)` | Bootstrap Icon via CDN font |
| `bcb_taxonomy_terms` | `($tax, $fields, $sep)` | Formatted taxonomy term string |

**Template tags** (blog/post templates, overridable via `function_exists()`):
`bcb_posted_on()`, `bcb_posted_by()`, `bcb_entry_footer()`, `bcb_post_thumbnail()`

---

## Action Hooks

| Hook | Location |
|---|---|
| `bcb_head_meta` | `<head>` before `wp_head()` |
| `bcb_before_navbar` / `bcb_after_navbar` | Around main navbar |
| `bcb_before_content` / `bcb_after_content` | Around main content |
| `bcb_before_footer` | Before `<footer>` |
| `bcb_customizer_panels` / `_sections` / `_settings` / `_controls` | Customizer registration |

---

## File Structure

```
child-theme/
├── style.css                  Global: variables, utilities, shared classes
├── functions.php              Enqueue, setup, conditional loads
├── header-scripts.php         Google Fonts, external <link> tags
├── acf-json/                  ACF local JSON sync
├── css/{context}.css          Scoped stylesheets (one per page/view)
├── js/                        Custom JS (animations, interactions)
├── templates/{page}.php       Page template orchestrators
├── archive-{cpt}.php         CPT archive orchestrators
├── single-{cpt}.php          CPT single orchestrators
└── template-parts/
    ├── common/common-{section}.php
    └── {context}/{context}-{section}.php
```

**All templates are orchestrators** — only `get_template_part()` calls, no markup directly in them.

---

## Section Template Pattern

```php
<section id="{prefix}-{name}" class="px-3 py-4 p-lg-5">
    <div class="container">
        <div class="row">
            <!-- content -->
        </div>
    </div>
</section>
```

- Unique `id` on every section: `{prefix}-{name}`
- `container` for standard max-width, `container-fluid` for edge-to-edge
- Layout via Bootstrap grid: `row` / `col-lg-*`

---

## Scoped CSS Rules

1. **One CSS file per view** — `css/{context}.css`
2. **Conditionally enqueued** — only on the page that needs it
3. **`style.css` is read-only** unless the operator explicitly permits edits
4. **New section CSS goes in the scoped file** — never in `style.css`
5. **Reuse before creating** — check `style.css` for existing classes first

### Enqueue Pattern

```php
if (is_front_page()) {
    wp_enqueue_style('home', get_stylesheet_directory_uri() . '/css/home.css');
}
if (bcb_check_template_name('about.php')) {
    wp_enqueue_style('about', get_stylesheet_directory_uri() . '/css/about.css');
}
```

### Naming Convention

| Template | CSS file | Handle |
|---|---|---|
| `templates/{page}.php` | `css/{page}.css` | `{page}` |
| `archive-{cpt}.php` | `css/{cpt}-archive.css` | `{cpt}-archive` |
| `single-{cpt}.php` | `css/{cpt}-single.css` | `{cpt}-single` |

---

## CSS Architecture

- **Prefix:** Every project uses a unique prefix for custom classes, variables, and section IDs
- **Heading font:** `h1–h5` and `.{prefix}-font-header` inherit heading font. `.btn` does NOT by default — add per project if needed
- **Button base:** `.btn` → `font-weight: 600`, `text-transform: uppercase`, `padding: 10px 25px`, `cursor: pointer`. Border-radius, font-size, and hover are project-specific
- **Color classes:** `.{prefix}-text-primary`, `.{prefix}-bg-primary`, etc. — defined per project
- **Overlays:** `.bcb-overlay` (parent, 50% black) or custom `.overlay` per project — parent needs `position: relative`
- **Accent divider:** `.{prefix}-line` or `.{prefix}-divider` — project-specific naming and size

### Font Size Hierarchy

| Element | Class |
|---|---|
| Hero `<h1>` | `display-3` |
| Section `<h2>` | `display-5` |
| Sub-headings | `display-6` |
| Card titles | `fs-1` |
| Body emphasis | `fs-5` |

---

## Responsive Rules (mandatory)

- **Mobile-first:** always provide mobile value before desktop
- **Grid gaps:** `g-4 g-lg-5` — never `g-5` alone
- **Bottom margins:** `mb-4 mb-lg-5` — never `mb-5` alone
- **No inline `style` for font-family** — use font utility classes
- **Breakpoints:** 1200px, 992px, 768px, 576px

---

## Enqueuing

- Scoped page CSS in `css/`, conditionally enqueued
- Custom JS in `js/`
- Third-party libs: **CDN preferred**, local is acceptable
- Use `get_stylesheet_directory_uri()` for local files

---

## Safety Constraints

- **Image URLs:** Always `esc_url(bcb_image_url($id))` in output
- **Text content:** `esc_html()` for text, `esc_attr()` for attributes
- **Shortcodes:** `echo do_shortcode('[...]')` directly — do NOT wrap with `wp_kses_post()` (breaks form elements)
- **Icons:** `bcb_icon()` uses CDN font. No local SVGs in v2.8.0+. Never re-enable SVG uploads without a sanitizer plugin
- **Deprecated in v2.8.0:** `bcb_remove_thumbnail_dimensions()`, `bcb_mime_types()`, `bcb_detect_theme_update()`, `/icons/` directory — delete any calls found in child themes
