<?php
/** Optional shared presentation. Existing children retain their legacy output. */
function bcb_ui_enabled() {
    return current_theme_supports('bcb-ui-v1');
}
add_filter('body_class', function ($classes) {
    if (bcb_ui_enabled()) { $classes[] = 'bcb-ui-v1'; }
    return $classes;
});
add_action('wp_enqueue_scripts', function () {
    if (!bcb_ui_enabled()) { return; }
    $version = wp_get_theme(get_template())->get('Version');
    wp_enqueue_style('bcb-ui', get_template_directory_uri() . '/css/bcb-ui.css', array('bootstrap'), $version);
    wp_enqueue_script('bcb-ui', get_template_directory_uri() . '/js/bcb-ui.js', array('bootstrap', 'bootstrap-component-blox'), $version, true);
}, 12);

/** Render where the child design needs it; no plugin means no output. */
function bcb_language_switcher($args = array()) {
    if (!bcb_ui_enabled() || !function_exists('trp_custom_language_switcher')) { return; }
    $languages = trp_custom_language_switcher();
    if (count($languages) < 2) { return; }
    global $TRP_LANGUAGE;
    get_template_part('template-parts/navbar/navbar', 'language', array(
        'languages' => $languages,
        'current' => $TRP_LANGUAGE,
        'flags' => !empty($args['flags']),
    ));
}

// The fixed header's spacer is JavaScript-driven. Without JS, keep content in flow.
add_action('wp_head', function () {
    if (!bcb_ui_enabled()) { return; }
    echo '<noscript><style>.bcb-ui-v1 .fixed-top{position:static!important}.bcb-ui-v1 .navbar-toggler{display:none}.bcb-ui-v1 .navbar-collapse.collapse{display:block}.bcb-ui-v1 .navbar .dropdown-menu{display:block;position:static}</style></noscript>';
});
