<?php
/**
 * Bootstrap Component Blox functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bootstrap-component-blox
 */

if (!function_exists('bcb_setup')) :
    /** Sets theme defaults and registers support for various WordPress features. **/
    function bcb_setup() {
        
        load_theme_textdomain( 'bootstrap-component-blox', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'bcb_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
    }
endif;

add_action( 'after_setup_theme', 'bcb_setup' );

/** Set the content width in pixels, based on the theme's design and stylesheet. **/
function bcb_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'bcb_content_width', 640 );
}
add_action( 'after_setup_theme', 'bcb_content_width', 0 );

/** 
 * Theme implement editor styling. 
 */
function bcb_add_editor_styles() {
    add_editor_style( get_stylesheet_uri() );
}
add_action('init', 'bcb_add_editor_styles');

// Require custom template tags.
require get_template_directory() . '/inc/template-tags.php';

// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

// Include custom theme customizer settings.
require('inc/customizer.php');

// Include custom comments.
require_once( get_template_directory() . '/custom-comments.php' );

// Load styles and scripts.
if(!is_admin()) {
    function bcb_enqueue_theme_styles_scripts(){
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.3.8');
        wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v6.7.2/css/all.css', array(), '6.7.2');
        wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css', array(), '1.13.1');
        wp_enqueue_style('bootstrap-component-blox', get_stylesheet_uri());
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js' , array() , '5.3.8' , true);
        wp_enqueue_script('bootstrap-component-blox', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0' , true);
        if ( get_theme_mod('theme_color_scheme') ) {
            wp_enqueue_script('bootstrap-color-scheme', get_template_directory_uri() . '/js/bootstrap-color-scheme.js' , array() , '1.0' , true);
        }
        wp_enqueue_script('bootstrap-component-blox-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true );  
    }
    add_action('wp_enqueue_scripts', 'bcb_enqueue_theme_styles_scripts' , 11);
}

/**
 * Register Navigation 
 */
function bcb_register_menu() {
    register_nav_menus(array( 
        'main-menu' => esc_html__('Main Menu', 'bootstrap-component-blox'), 
        'sidebar-menu' => esc_html__('Sidebar Menu', 'bootstrap-component-blox'),
        'aux-menu' => esc_html__('Auxiliary Menu', 'bootstrap-component-blox'),
    ));
}
add_action('init', 'bcb_register_menu'); 

/** 
 * Main Navigation Parameters 
 *
 * @param string $classes custom menu classes.
 */
function bcb_main_nav($classes = 'ms-auto') {
    wp_nav_menu(
    array(
        'theme_location'  => 'main-menu',
        'container'       => 'false',
        'container_class' => 'menu-{menu slug}-container',
        'menu_class'      => 'menu',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'items_wrap'      => '<ul class="navbar-nav ' . $classes . '">%3$s</ul>',
        'depth'           => 0,
        'fallback_cb'     => '',
        )
    );
}

/** 
 * Auxiliary Navigation Parameters 
 *
 * @param string $classes custom menu classes.
 */
function bcb_aux_nav($classes = 'ms-auto') {
    wp_nav_menu(
    array(
        'theme_location'  => 'aux-menu',
        'container'       => 'false',
        'container_class' => 'menu-{menu slug}-container',
        'menu_class'      => 'menu',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'items_wrap'      => '<ul class="navbar-nav ' . $classes . '">%3$s</ul>',
        'depth'           => 0,
        'fallback_cb'     => '',
        )
    );
}

/**
 * Add Search Bar to Navbar
 */
function bcb_add_search_to_nav($items, $args) {
    if(get_theme_mod('navbar_search') && $args->theme_location == 'main-menu' ) {
        $items .= '<li><span class="nav-link"><i class="fas fa-search" data-bs-toggle="modal" data-bs-target="#searchModal"></i></span></li>';
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'bcb_add_search_to_nav', 10, 2 );

/**
 * Adds bootstrap 'dropdown-menu' class to 'sub-menu' class. 
 * 
 * @param string $menu adds additional class to sub-menu class.
 */
function bcb_change_submenu_class($menu) {  
  $menu = preg_replace('/ class="sub-menu"/','/ class="sub-menu dropdown-menu" /', $menu);  
  return $menu;  
}  
add_filter('wp_nav_menu','bcb_change_submenu_class');  

/**
 *  Adds 'nav-link' class to nav anchor.
 * 
 * @param string $item_output The menu item's starting HTML output.
 * @param string $item Menu item data object.
 * @param string $depth Depth of menu item. Used for padding.
 * @param string $args An object of wp_nav_menu() arguments.
 */
function bcb_walker_nav_menu_start_el($item_output, $item, $depth, $args) {
    $classes     = 'nav-link';
    $item_output = preg_replace('/<a /', '<a class="'.$classes.'"', $item_output, 1);
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'bcb_walker_nav_menu_start_el', 10, 4);

/** 
 * Remove the <div> surrounding the dynamic navigation to cleanup markup. 
 * 
 * @param string $args Array of wp_nav_menu() arguments.
 */
function bcb_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}

/**
 *  Remove injected classes, ID's and Page ID's from Navigation <li> items. 
 * 
 * @param string $var CSS Attributes.
 */
function bcb_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
}

/** 
 * Remove invalid rel attribute values in the categorylist. 
 * 
 * @param string $thelist Attribute value.
 */
function bcb_remove_category_rel_from_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

/**
 * Add page slug to body class. 
 * 
 * @param string $classes CSS class.
 */
function bcb_add_slug_to_body_class($classes) {
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
    return $classes;
}

/**
 * Dynamic sidebar and footer widgets. 
 */
function bcb_widgets_init() {
if (function_exists('register_sidebar')) {

    register_sidebar(array(
        'name' => esc_html__('Sidebar Area', 'bootstrap-component-blox'),
        'description' => esc_html__('Add Sibebar Widgets Here', 'bootstrap-component-blox'),
        'id' => 'sidebar-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s card mb-4">',
        'after_widget' => '</div>',
        'before_title' => '<div class="card-header">',
        'after_title' => '</div>'
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Footer Area 1', 'bootstrap-component-blox'),
        'description' => esc_html__('Add Footer Widgets Here', 'bootstrap-component-blox'),
        'id' => 'footer-area-1',
        'before_widget' => '<div id="%1$s"> ',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Area 2', 'bootstrap-component-blox'),
        'description' => esc_html__('Add Footer Widgets Here', 'bootstrap-component-blox'),
        'id' => 'footer-area-2',
        'before_widget' => '<div id="%1$s"> ',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Footer Area 3', 'bootstrap-component-blox'),
        'description' => esc_html__('Add Footer Widgets Here', 'bootstrap-component-blox'),
        'id' => 'footer-area-3',
        'before_widget' => '<div id="%1$s"> ',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Footer Area 4', 'bootstrap-component-blox'),
        'description' => esc_html__('Add Footer Widgets Here', 'bootstrap-component-blox'),
        'id' => 'footer-area-4',
        'before_widget' => '<div id="%1$s"> ',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));

    register_sidebar(array(
        'name' => esc_html__('Custom Area', 'bootstrap-component-blox'),
        'description' => esc_html__('Add Custom Widgets Here', 'bootstrap-component-blox'),
        'id' => 'custom-area-1',
        'before_widget' => '<div id="%1$s"> ',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}}
add_action('widgets_init', 'bcb_widgets_init');


/** 
 * Comment form submit button callback. 
 * 
 * @param string $submit_button HTML markup for the submit button.
 * @param string $args (array) Arguments passed to comment_form().
 */
function bcb_filter_comment_form_submit_button($submit_button, $args) {
    $submit_before = '<div class="form-group">';
    $submit_after = '</div>';
    $submit_button = '<input name="submit" type="submit" id="submit" class="submit btn btn-dark" value="Post Comment">';
    return $submit_before . $submit_button . $submit_after;
}
add_filter( 'comment_form_submit_button', 'bcb_filter_comment_form_submit_button', 10, 2 );


/** 
 * Does custom bootstrap pagination exist. 
 */
if(!function_exists('bcb_pagination')) :
    
    /** 
     * Custom Pagination. 
     */
    function bcb_pagination() {
        global $wp_query;

        $big = 999999999;

        echo wp_kses_post(paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_text'          => ('«'),
            'next_text'          => ('»'),

        ) ));
    }
endif;

/**
 * Check current template file name
 */
function bcb_check_template_name($template_name) {
    global $template;
    $template_file_name = basename($template);
    if($template_name == $template_file_name) {
        return true;
    } else {
        return false;
    } 
}
add_action('wp_head', 'bcb_check_template_name');

/** 
 * Render content with id
 */
function bcb_get_the_content($id) {
    return apply_filters('the_content', get_post_field('post_content', $id));
}

/** 
 * Threaded Comments. 
 */
function bcb_enable_threaded_comments() {
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}
add_action('get_header', 'bcb_enable_threaded_comments');

/**
 * SVG uploads disabled for security — SVGs can contain XSS payloads.
 * To re-enable safely, use a sanitizer library like enshrined/svg-sanitize.
 */

/**
 * Enqueue fixed sidebar column classes script when needed.
 */
function bcb_fixed_sidebar_classes() {
    if (get_theme_mod('navbar_type') == 'fixed_side') {
        wp_enqueue_script('bcb-fixed-sidebar', get_template_directory_uri() . '/js/fixed-sidebar.js', array(), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'bcb_fixed_sidebar_classes');

/**
 * Hook: Woocommerce Support
 */
function bcb_add_woocommerce_support() {
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        if (false === wc_string_to_bool(get_option('bcb_disable_woocommerce_theme_support', 'no'))) {
            add_theme_support( 'woocommerce' );
        }
    }
}
add_action( 'after_setup_theme', 'bcb_add_woocommerce_support' );

/**
 * Hook: Before Footer.
 */
function bcb_before_footer() {
    do_action('bcb_before_footer');
}

/**
 * Hook: Before Navbar.
 */
function bcb_before_navbar() {
    do_action('bcb_before_navbar');
}

/**
 * Hook: After Navbar.
 */
function bcb_after_navbar() {
    do_action('bcb_after_navbar');
}

/**
 * Hook: Customizer Panels.
 */
function bcb_customizer_panels() {
    do_action('bcb_customizer_panels');
}

/**
 * Hook: Customizer Sections.
 */
function bcb_customizer_sections() {
    do_action('bcb_customizer_sections');
}

/**
 * Hook: Customizer Settings.
 */
function bcb_customizer_settings() {
    do_action('bcb_customizer_settings');
}

/**
 * Hook: Customizer Controls.
 */
function bcb_customizer_controls() {
    do_action('bcb_customizer_controls');
}

/**
 *  Utility: output image URL when provided an image ID.
 *
 * @param string #id image ID.
 * @param string $size thumbnail size.
 */
function bcb_image_url($id = "", $size = "full") {
    $image = wp_get_attachment_image_url($id, $size);
    return $image;
}

/**
 *  Utility: Gets Featured Image Alt.
 *
 * @param string $id image ID.
 */
function bcb_image_alt($id) {
   $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
   return $alt;
}

/**
 *  Utility: Gets Thumbnail ID
 */
function bcb_image_id() {
    return get_post_thumbnail_id();
}

/**
 * Utility: Search Bar
 *
 * @param string $searchClasses Bootstrap or Unique Classes
 */
function bcb_search_form($searchClasses = "") {?>
    <form class="bcb-search position-relative" method="get" action="<?php echo esc_url(home_url('/'));?>" role="search">
        <input class="<?php echo esc_attr($searchClasses);?>" type="text" name="s" placeholder="Search..." value="<?php the_search_query(); ?>">
        <button type="submit" role="button" aria-label="search" class="fa fa-search"></button>
    </form>
<?php }

/**
 * Utility: Search Bar Modal
 */
function bcb_include_search_modal() { 
    if(get_theme_mod('navbar_search')) { 
        get_template_part('template-parts/post/post-searchModal');
    }
}
add_action('wp_footer', 'bcb_include_search_modal'); 

/**
 * Utility: Icon Render Function
 *
 * Renders a Bootstrap Icon using the CDN font (no local SVG files needed).
 * Fallback: bi-star-fill if no name provided.
 *
 * @param string $name Icon name without the bi- prefix (e.g. 'check-circle')
 * @param string $size Pixel size for font-size
 */
function bcb_icon($name = 'star-fill', $size = '20') {
    $name = sanitize_html_class(str_replace('bi-', '', $name));
    if (empty($name)) {
        $name = 'star-fill';
    }
    $size = absint($size);
    if ($size < 1) {
        $size = 20;
    }
    ?><i class="bi bi-<?php echo esc_attr($name); ?>" style="font-size:<?php echo $size; ?>px" aria-hidden="true"></i><?php
}

/**
 * Utility: Icon Render Shortcode Function
 *
 * @param array $atts Shortcode attributes: name, size
 */
function bcb_icon_shortcode($atts) {
    $a = shortcode_atts(array(
        'name' => 'star-fill',
        'size' => '20',
    ), $atts);

    $name = sanitize_html_class(str_replace('bi-', '', $a['name']));
    if (empty($name)) {
        $name = 'star-fill';
    }
    $size = absint($a['size']);
    if ($size < 1) {
        $size = 20;
    }
    return '<i class="bi bi-' . esc_attr($name) . '" style="font-size:' . $size . 'px" aria-hidden="true"></i>';
}
add_shortcode( 'bcb_icon', 'bcb_icon_shortcode' );

/**
 * Utility: Render Shortcode for copyright year
 *
 */
function bcb_copyright_year() {
    ob_start();
    echo date('Y');
    return ob_get_clean();
}
add_shortcode( 'bcb-year', 'bcb_copyright_year' );

/**
 * Utility: Render Selected Taxonomy Name
 *
 * @param string $tax Taxonomy Name
 * @param string $fields Taxonomy Field (e.g., Names, Slugs, ID, etc)
 * @param string $separator (e.g., comma, dash, post, ect))
 */
function bcb_taxonomy_terms($tax , $fields = "names", $separator = ", ") {
    $tax_name = wp_get_post_terms(get_the_ID(), $tax, array('fields' => $fields));
    return implode($separator , $tax_name);
}

// Add filters.
add_filter('nav_menu_css_class', function($classes) { $classes[] = 'nav-item'; return $classes;}, 10, 1 );
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');
add_theme_support('align-wide');
add_theme_support('responsive-embeds');
add_theme_support('wp-block-styles');

// Check theme for update releases via GitHub Releases.
require('update-checker.php');
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/componentblox/bootstrap-component-blox/',
    __FILE__,
    'bootstrap-component-blox'
);
$myUpdateChecker->getVcsApi()->enableReleaseAssets();