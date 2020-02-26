<?php
/**
 * Bootstrap Component Blox functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bootstrap-component-blox
 */

if ( ! function_exists( 'bcb_setup' ) ) :
    /** Sets theme defaults and registers support for various WordPress features. **/
    function bcb_setup() {
        
        load_theme_textdomain( 'bootstrap-component-blox', get_template_directory() . '/languages' );

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
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'bcb_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

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
add_action( 'init', 'bcb_add_editor_styles' );

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

// Custom Customizer Settings.
require('inc/customizer.php');

// Include Custom Comments.
require_once( get_template_directory() . '/custom-comments.php' );

// Load Styles and Scripts.
if(!is_admin()) {
    /** Enqueue Files. **/
    function bcb_enqueue_external_files(){
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', '4.4.1' , false);
        wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.11.2/css/all.css', false, '5.11.2');
        wp_enqueue_style('bootstrap-component-blox', get_stylesheet_uri());
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js' , array() , '4.4.1' , true);
        wp_enqueue_script('bootstrap-component-blox', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0' , true);
        wp_enqueue_script('bootstrap-component-blox-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true );	
    }
    add_action('wp_enqueue_scripts', 'bcb_enqueue_external_files' , 99);
}

/**
 * Register Navigation 
 */
function bcb_register_menu() {
    register_nav_menus(array( 
        'main-menu' => esc_html__('Main Menu', 'bootstrap-component-blox'), 
        'sidebar-menu' => esc_html__('Sidebar Menu', 'bootstrap-component-blox'),
    ));
}
add_action('init', 'bcb_register_menu'); 

/** 
 * Main Navigation Parameters 
 *
 * @param string $classes Custom menu classes.
 */
function main_nav($classes = 'ml-auto') {
    wp_nav_menu(
    array(
        'theme_location'  => 'main-menu',
        'menu'            => '',
        'container'       => 'false',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul class="navbar-nav ' . $classes . '">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}

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
 * Dynamic Sidebar Function. 
 */
function bcb_widgets_init() {
if (function_exists('register_sidebar')) {

    register_sidebar(array(
        'name' => esc_html__('Sidebar Area', 'bootstrap-component-blox'),
        'description' => esc_html__('Add Sibebar Widgets Here', 'bootstrap-component-blox'),
        'id' => 'sidebar-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s card border mb-4">',
        'after_widget' => '</div>',
        'before_title' => '<div class="card-header">',
        'after_title' => '</div>'
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Footer Area 1', 'bootstrap-component-blox'),
        'description' => esc_html__('Add Footer Widgets Here', 'bootstrap-component-blox'),
        'id' => 'footer-area-1',
        'before_widget' => '<div id="%1$s" class="h-100"> ',
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
function bcb_filter_comment_form_submit_button( $submit_button, $args ) {
    $submit_before = '<div class="form-group">';
    $submit_after = '</div>';
    $submit_button = '<input name="submit" type="submit" id="submit" class="submit btn btn-dark" value="Post Comment">';
    return $submit_before . $submit_button . $submit_after;
};
add_filter( 'comment_form_submit_button', 'bcb_filter_comment_form_submit_button', 10, 2 );


/** 
 * Does Custom Bootstrap Pagination Exist. 
 */
if ( ! function_exists( 'bcb_pagination' ) ) :
    
    /** 
     * Custom Pagination. 
     */
    function bcb_pagination() {
        global $wp_query;

        $big = 999999999; // need an unlikely integer.

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
 * Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail. 
 *
 * @param string $html Removes thumbnail width and height HTML Markup.
 */
function bcb_remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
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
 * Enable SVG Import.
 * 
 * @param string $mimes Media type.
 */
function bcb_cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'bcb_cc_mime_types');


/** 
 * Include search bar function.
 * 
 * @param  string $search_form_id Custom ID for form container.
 * @param  string $search_form_btn_class Custom class for form button.
 */
function bcb_get_searchbar($search_form_id, $search_form_btn_class = "btn-dark" ) {
    include('searchform.php');
}

/**
 * Before Footer 
 */
function cb_before_footer() {
    do_action('cb_before_footer');
}

/**
 * Before Navbar
 */
function cb_before_navbar() {
    do_action('cb_before_navbar');
}

// Add Filters.
add_filter('nav_menu_css_class', function($classes) { $classes[] = 'nav-item'; return $classes;}, 10, 1 );
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');