# BCB Manifest — Bootstrap Component Blox

> Version: 2.8.4
> The authoritative reference for building child themes on `bootstrap-component-blox`.
> This file ships with the parent theme and evolves alongside it.

---

## 1. Stack & Dependencies

| Library | Version | Loaded via |
|---|---|---|
| Bootstrap | 5.3.8 | Local CSS + JS bundle |
| Font Awesome | 6.7.2 | CDN (`use.fontawesome.com`) |
| Bootstrap Icons | 1.13.1 | CDN (`cdn.jsdelivr.net`) |
| jQuery | WordPress bundled | Core dependency |

- **PHP:** 8.0+ required
- **WordPress:** tested up to 6.7.2
- **WooCommerce:** optional support (can be disabled via Customizer)

---

## 2. Helper Functions API

All functions are prefixed with `bcb_`. Use these instead of raw WordPress equivalents.

### Image Functions

| Function | Signature | Returns | Usage |
|---|---|---|---|
| `bcb_image_url` | `($id = '', $size = 'full')` | Image URL string | Background images and `<img>` src |
| `bcb_image_alt` | `($id)` | Alt text string | `<img>` alt attributes |
| `bcb_image_id` | `()` | Post thumbnail ID (int) | Get current post's featured image ID |

**Background image pattern:**
```php
style="background: url(<?php echo esc_url(bcb_image_url(ID)); ?>) center/cover no-repeat"
```

**Image tag pattern:**
```php
<img src="<?php echo esc_url(bcb_image_url(ID)); ?>" alt="<?php echo esc_attr(bcb_image_alt(ID)); ?>" class="w-100">
```

**WordPress thumbnail aspect-ratio fix:**
`the_post_thumbnail()` outputs `width` and `height` HTML attributes that override CSS `aspect-ratio`. Always include `height: auto`:
```php
the_post_thumbnail('medium_large', array(
    'class' => 'w-100',
    'style' => 'aspect-ratio: 8/5; object-fit: cover; height: auto;'
));
```

### Navigation Functions

| Function | Signature | Description |
|---|---|---|
| `bcb_main_nav` | `($classes = 'ms-auto')` | Outputs the Main Menu as a Bootstrap navbar |
| `bcb_aux_nav` | `($classes = 'ms-auto')` | Outputs the Auxiliary Menu as a Bootstrap navbar |
| `bcb_search_form` | `($searchClasses = '')` | Outputs a styled search form |

Three registered menus: `main-menu`, `sidebar-menu`, `aux-menu`.

### Content & Template Functions

| Function | Signature | Returns | Description |
|---|---|---|---|
| `bcb_get_the_content` | `($id)` | Filtered HTML string | Renders any post's content by ID |
| `bcb_check_template_name` | `($template_name)` | Boolean | Returns `true` if the current page template filename matches `$template_name` |
| `bcb_pagination` | `()` | void (echoes HTML) | Outputs Bootstrap-styled archive pagination |

### Icon Function

| Function | Signature | Description |
|---|---|---|
| `bcb_icon` | `($name = 'star-fill', $size = '20')` | Renders a Bootstrap Icon using the CDN font (`<i class="bi bi-{name}">`) |

- `$name` — icon name without the `bi-` prefix (e.g. `'check-circle'`). Sanitized via `sanitize_html_class()`.
- `$size` — pixel size applied as inline `font-size`. Sanitized via `absint()`.
- Fallback: `bi-star-fill` if name is empty or invalid
- Shortcode: `[bcb_icon name="..." size="..."]`
- No local SVG files needed — uses the Bootstrap Icons CDN font already enqueued by the parent theme

### Template Tag Functions

These live in `inc/template-tags.php` and are used in blog/post templates:

| Function | Signature | Description |
|---|---|---|
| `bcb_posted_on` | `()` | Prints HTML with post date/time meta |
| `bcb_posted_by` | `()` | Prints HTML with post author meta |
| `bcb_entry_footer` | `()` | Prints HTML with categories, tags, and comments meta |
| `bcb_post_thumbnail` | `()` | Displays optional post thumbnail — wraps in `<a>` on archives, `<div>` on singles |

### Taxonomy Function

| Function | Signature | Returns |
|---|---|---|
| `bcb_taxonomy_terms` | `($tax, $fields = 'names', $separator = ', ')` | Formatted string of taxonomy terms |

### Shortcodes

| Shortcode | Output |
|---|---|
| `[bcb-year]` | Current year (e.g. `2026`) |
| `[bcb_icon name="..." size="..."]` | Bootstrap Icon via CDN font |

---

## 3. Action Hooks

These fire at specific points in the template rendering. Use `add_action()` in child theme `functions.php` to inject content.

| Hook | Fires... |
|---|---|
| `bcb_head_meta` | In `<head>` before `wp_head()` — for preload hints, custom meta tags |
| `bcb_before_navbar` | Before the main navbar renders |
| `bcb_after_navbar` | After the main navbar renders |
| `bcb_before_content` | Before the main content in `single.php`, `page.php`, `archive.php` — for breadcrumbs, alerts |
| `bcb_after_content` | After the main content — for related posts, CTAs, share buttons |
| `bcb_before_footer` | Before the `<footer>` tag |
| `bcb_customizer_panels` | When registering Customizer panels |
| `bcb_customizer_sections` | When registering Customizer sections |
| `bcb_customizer_settings` | When registering Customizer settings |
| `bcb_customizer_controls` | When registering Customizer controls |

---

## 4. File Structure Conventions

```
child-theme/
├── style.css                          ← Global CSS: variables, utilities, shared classes
├── functions.php                      ← Enqueue styles/scripts, child theme setup
├── header-scripts.php                 ← Google Fonts and external <link> tags
├── acf-json/                          ← ACF local JSON sync (auto-generated)
├── css/                               ← Scoped stylesheets (one per page/view)
│   └── {context}.css                  ← e.g. home.css, why-beach-house-shake.css
├── js/                                ← Custom JS (animations, interactions)
├── templates/
│   └── {page}.php                     ← Page template — orchestrator only
├── archive.php                        ← Default archive (category, tag, date, author)
├── archive-{cpt}.php                 ← CPT archive orchestrator
├── single-{cpt}.php                  ← CPT single orchestrator
└── template-parts/
    ├── common/                        ← Shared parts reused across pages
    │   └── common-{section}.php       ← e.g. common-hero.php, common-contact.php
    └── {context}/                     ← e.g. home/, service/, shingle/
        └── {context}-{section}.php   ← e.g. home-hero.php, shingle-classic.php
```

**Naming pattern:** `{context}-{section}.php` — e.g. `home-header.php`, `service-slider.php`

**All templates are orchestrators.** Page templates, archive templates, and single templates only call `get_template_part()` — no markup lives directly in them.

---

## 5. Section Template Pattern

Every section follows this structure:

```php
<section id="{prefix}-{name}" class="px-3 py-4 p-lg-5">
    <div class="container">
        <div class="row">
            <!-- content -->
        </div>
    </div>
</section>
```

- Unique `id` on every section: `id="{prefix}-{name}"`
- Standard padding: `px-3 py-4 p-lg-5`
- **Container choice:** `container` for standard max-width, `container-fluid` for edge-to-edge — choose based on the design
- Layout via Bootstrap grid: `row` / `col-lg-*`

---

## 6. Scoped CSS Convention

Every page template / view gets its own dedicated CSS file. This prevents regression and keeps diffs clean.

### Rules

1. **One CSS file per view** — named `{context}.css` inside `css/`
2. **Conditionally enqueued** — only loaded on the page that needs it
3. **`style.css` is read-only for agents** — contains global variables, utilities, and shared styles. Agents read it to discover reusable classes but never write to it unless the operator explicitly permits
4. **All new section-specific CSS goes in the scoped file** — overlays, section IDs, component classes, responsive overrides
5. **Reuse before creating** — always check `style.css` for existing utility classes before adding new ones

### Conditional Enqueue Pattern

```php
// Global — always loaded
wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

// Scoped — conditionally loaded per template
if (is_front_page()) {
    wp_enqueue_style('home', get_stylesheet_directory_uri() . '/css/home.css');
}
if (bcb_check_template_name('about.php')) {
    wp_enqueue_style('about', get_stylesheet_directory_uri() . '/css/about.css');
}
```

### Naming Convention

| Template | CSS file | Enqueue handle |
|---|---|---|
| `templates/{page}.php` | `css/{page}.css` | `{page}` |
| `archive-{cpt}.php` | `css/{cpt}-archive.css` | `{cpt}-archive` |
| `single-{cpt}.php` | `css/{cpt}-single.css` | `{cpt}-single` |

---

## 7. CPT Template Pattern

When a custom post type (e.g. `service`) is registered:

**Archive orchestrator** — `archive-{cpt}.php` at child theme root:
```php
<?php
/* Template Name: Archive Service */
get_header();?>
<main id="main-container" role="main" class="container-fluid px-0">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">
            <?php get_template_part('template-parts/{cpt}/{cpt}', 'archive'); ?>
        </div>
    </article>
</main>
<?php get_footer();?>
```

**Single orchestrator** — `single-{cpt}.php` at child theme root:
```php
<?php
/* Template Name: Single Service */
get_header();?>
<main id="main-container" role="main" class="container-fluid px-0">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">
            <?php get_template_part('template-parts/{cpt}/{cpt}', 'single'); ?>
        </div>
    </article>
</main>
<?php get_footer();?>
```

**Template parts** — all markup under `template-parts/{cpt}/`:
- `{cpt}-archive.php` — archive layout (header, loop, cards grid, pagination)
- `{cpt}-single.php` — single post layout
- `{cpt}-card.php` — reusable card partial
- `{cpt}-slider.php` — optional slider section

---

## 8. CSS Architecture

### Prefix Convention

Every project uses a unique CSS prefix for custom classes. The prefix is defined in the project manifest (e.g. `gec-` for Generate Electric, `tc-` for another client). All custom classes, CSS variables, and section IDs use this prefix.

### Standard Utility Classes

These are defined in child theme `style.css` and available across all pages:

| Class | Effect |
|---|---|
| `.fw-600` | `font-weight: 600` |
| `.rounded-lg` | `border-radius: 20px` |
| `.z-front` | `z-index: 5` |
| `.z-back` | `z-index: 1` |
| `.p-lg-6` | `padding-top: 120px; padding-bottom: 120px` (optional — add per project if needed) |
| `.{prefix}-font-body` | Forces body font on elements inheriting heading font |
| `.{prefix}-font-header` | Applies heading font explicitly |
| `.bcb-overlay` | Absolute dark overlay (50% opacity) — parent needs `position: relative`. Projects may define a custom `.overlay` class (e.g. gradient overlays) instead |

### Button System

Base `.btn` class sets: `font-weight: 600`, `text-transform: uppercase`, `padding: 10px 25px`, `cursor: pointer`. Border-radius, font-size, and hover behavior are **project-specific** — defined in child theme `style.css`.

Common button variants (exact colors/hover defined per project in the project manifest):

| Variant | Role | Pattern |
|---|---|---|
| `.{prefix}-btn-primary` | Primary CTA | Brand color bg, white text |
| `.{prefix}-btn-dark` | Secondary CTA | Dark bg, white text |
| `.{prefix}-btn-light` | CTA on dark backgrounds | White bg, dark text |

Additional variants (e.g. `.{prefix}-btn-orange`, `.{prefix}-btn-light-outline`) are added per project as needed.

### Heading Font Inheritance

`h1–h5` and `.{prefix}-font-header` inherit the heading font. `.btn` does **not** inherit heading font by default — add it per project if the design requires it.

### Font Size Hierarchy

| Element | Class | Approx size |
|---|---|---|
| Hero `<h1>` | `display-3` | ~3rem |
| Section `<h2>` headings | `display-5` | ~3rem |
| Card titles | `fs-1` | ~2.5rem |
| Sub-headings / feature titles | `h3 display-6` | ~2.5rem |
| Body copy | default / `fs-5` | — |

**Weight convention:** Heading font handles weight via the typeface itself. Body font uses `fw-500` by default, `fw-600` for emphasis.

### Color & Background Classes

Defined per project using the prefix pattern:
- `.{prefix}-text-primary`, `.{prefix}-text-dark`
- `.{prefix}-bg-primary`, `.{prefix}-bg-dark`
- `.{prefix}-divider` — 3px solid primary accent bar (width controlled by container)

---

## 9. Responsive Rules

- **Always** provide a mobile-first value before the desktop value
- **Grid gaps:** `g-4 g-lg-5` — never `g-5` alone
- **Bottom margins:** `mb-4 mb-lg-5` — never `mb-5` alone
- **Section padding:** use `p-lg-5` for standard sections; add `.p-lg-6` per project if 120px padding is needed
- **Standard breakpoints:** 1200px, 992px, 768px, 576px
- **Never use inline `style` for font-family.** Use font utility classes or let inheritance handle it.

---

## 10. Enqueuing Pattern

- Scoped page stylesheets live in `css/` and are enqueued conditionally (see section 6)
- Custom JS lives in `js/` — enqueue globally or conditionally as needed
- Third-party libraries (Swiper, GSAP, etc.) can be loaded via **CDN** or stored **locally** — CDN is preferred for cache efficiency
- Enqueue in `functions.php` using `get_stylesheet_directory_uri()` for local files

```php
// Third-party — CDN (preferred)
wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true);

// Custom JS — local
wp_enqueue_script('{prefix}-animations', get_stylesheet_directory_uri() . '/js/animations.js', array('gsap'), '1.0.0', true);
```

---

## 11. WordPress Patterns

### Image Usage
- Always use `bcb_image_url($id)` for background images
- Always use `bcb_image_alt($id)` for `<img>` alt attributes
- Images are uploaded to the WP media library and referenced by attachment ID

### Icons
- Use **Font Awesome** for decorative elements (quote marks, arrows, dividers) — never use HTML entities like `&rdquo;`
- Use **Bootstrap Icons** (`bi-*` classes or `bcb_icon()`) for UI elements — both render via the CDN font, no local SVG files
- Example: `<i class="fa-solid fa-quote-right"></i>`
- Example: `<?php bcb_icon('lightning-charge-fill', 48); ?>`

### Forms

Forms are project-specific. Common integrations:

- **WPForms:** `<?php echo do_shortcode('[wpforms id="ID"]'); ?>`
- **HubSpot:** Inline `<script>` embed via `hbspt.forms.create({ portalId, formId, region })`

Form wrapper uses `.has-form` class for submit button and spacing overrides. Style overrides go in `style.css` to match the project's form provider.

---

## 12. Swiper Integration Pattern

When a section requires a slider:

- Enqueue Swiper CSS/JS via CDN in `functions.php`
- Init via inline `<script>` at the bottom of the template part
- Wrap in `DOMContentLoaded` listener
- Autoplay with `disableOnInteraction: false`
- Custom pagination/navigation styled per project — not Swiper's defaults

```js
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.{prefix}-swiper', {
        loop: true,
        autoplay: { delay: 6000, disableOnInteraction: false },
        pagination: {
            el: '.{prefix}-swiper .swiper-pagination',
            clickable: true,
        },
    });
});
```

---

## 12a. GSAP Scroll Animation Pattern

For scroll-triggered animations, enqueue GSAP + ScrollTrigger via CDN, then create a custom `js/animations.js` file.

### Enqueue

```php
wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js', array(), '3', true);
wp_enqueue_script('gsap-st', 'https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollTrigger.min.js', array('gsap'), '3', true);
wp_enqueue_script('{prefix}-animations', get_stylesheet_directory_uri() . '/js/animations.js', array('gsap', 'gsap-st'), '1.0.0', true);
```

### Fade Classes

Add these CSS classes to any element to animate it on scroll. Siblings with the same class within the same parent stagger automatically.

| Class | Effect |
|---|---|
| `.{prefix}-fade-up` | Fades in from below |
| `.{prefix}-fade-down` | Fades in from above |
| `.{prefix}-fade-start` | Fades in from the left |
| `.{prefix}-fade-end` | Fades in from the right |

### Line Grow Class

| Class | Effect |
|---|---|
| `.{prefix}-line-grow` | Scrub-based width expansion (pair with accent line element) |

### Inline Script Animations

For section-specific animations (e.g. parallax on a hero video), use an inline `<script>` at the bottom of the template part:

```js
document.addEventListener('DOMContentLoaded', function () {
    gsap.registerPlugin(ScrollTrigger);
    gsap.to('#section-id video', {
        scale: 1.1,
        ease: 'none',
        scrollTrigger: {
            trigger: '#section-id',
            start: 'top top',
            end: 'bottom top',
            scrub: true,
        }
    });
});
```

---

## 13. Registered Widget Areas

| ID | Name |
|---|---|
| `sidebar-area-1` | Sidebar Area |
| `footer-area-1` | Footer Area 1 |
| `footer-area-2` | Footer Area 2 |
| `footer-area-3` | Footer Area 3 |
| `footer-area-4` | Footer Area 4 |
| `custom-area-1` | Custom Area |

---

## 14. Customizer Settings

The parent theme exposes these customizer options:

| Setting | Type | Description |
|---|---|---|
| `navbar_type` | Select | `'top'`, `'side'`, or `'fixed_side'` |
| `sticky_top` | Checkbox | Makes navbar sticky |
| `theme_color_scheme` | Checkbox | Enables dark mode toggle |
| `navbar_search` | Checkbox | Adds search icon to main menu |
| `navbar_classes` | Text | Custom CSS classes for navbar |
| `navbar_inner_classes` | Text | Custom CSS classes for inner navbar |
| `sidebar_classes` | Text | Custom CSS classes for sidebar |
| `body_container_classes` | Text | Custom CSS classes for body |
| `footer_classes` | Text | Custom CSS classes for footer |
| `footer_credit` | Textarea | Custom footer credit HTML |
| `bcb_disable_woocommerce_theme_support` | Checkbox | Disables WooCommerce theme support when checked |

Child themes can extend the Customizer via the `bcb_customizer_*` action hooks.

---

## 15. Theme Update & Release Workflow

Updates are distributed via **GitHub Releases** using the bundled Puc v4.9 library.

### How it works

1. Puc checks `https://github.com/componentblox/bootstrap-component-blox/` for new releases
2. WordPress sites see the update in Dashboard > Updates
3. Users click "Update" and Puc downloads the `.zip` asset from the GitHub Release

### Publishing a new release

1. Bump the version in `style.css` header
2. Commit and push to `main`
3. Tag and push: `git tag v2.8.0 && git push origin v2.8.0`
4. GitHub Actions (`.github/workflows/release.yml`) auto-creates the release with a clean `.zip` asset
5. All sites running the theme will see the update within 12 hours

### Version tag format

Tags must match `v*` (e.g. `v2.8.0`). Puc strips the `v` prefix to compare against the version in `style.css`.
