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
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', '5.1.3' , false);
        wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v6.0.0/css/all.css', false, '6.0.0');
        wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css' , false, '1.8.0');
        wp_enqueue_style('bootstrap-component-blox', get_stylesheet_uri());
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js' , array() , '5.1.3' , true);
        wp_enqueue_script('bootstrap-component-blox', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0' , true);
        wp_enqueue_script('bootstrap-component-blox-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true );  
    }
    add_action('wp_enqueue_scripts', 'bcb_enqueue_theme_styles_scripts');
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
 * Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail. 
 *
 * @param string $html Removes thumbnail width and height HTML Markup.
 */
function bcb_remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

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
function bcb_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'bcb_mime_types');

/** 
 * Output Fixed Sidebar classes.
 */
function bcb_fixed_sidebar_classes() {
    if(get_theme_mod('navbar_type') == 'fixed_side') {?>
        <script>
            let addColumnClasses = document.querySelectorAll('main');
        
            addColumnClasses.forEach(function(addColumnClass) {
                addColumnClass.classList.add('col-lg-8' , 'col-xl-9');
            });
        </script>
    <?php }
}
add_action( 'wp_footer' , 'bcb_fixed_sidebar_classes' );

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
function bcb_image_url($id, $size = "full") {
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
    <form class="search position-relative" method="get" action="<?php echo esc_url(home_url('/'));?>" role="search">
        <input class="<?php echo $searchClasses;?>" type="text" name="s" placeholder="Search..." value="<?php the_search_query(); ?>">
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
 * @param string $name Icon Name
 * @param string $size Controls Sizing
 */
function bcb_icon($name = 'question', $size = '20') {
    $trimmed_name = str_replace("bi-",  "" , $name);
    ?>
    <svg width="<?php echo $size;?>" height="<?php echo $size;?>" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <?php 
            $icon_svg_file = locate_template('/icons/' . $trimmed_name . '.svg');
            if($icon_svg_file)
                include($icon_svg_file);
            else {
                include(locate_template('/icons/question-diamond-fill.svg'));
            }
        ?>
    </svg>
<?php }

/**
 * Utility: Icon Render Shortcode Function
 *
 * @param string $name Icon Name
 * @param string $size Control Sizing
 */
function bcb_icon_shortcode($atts) {
    $a = shortcode_atts( array(
        'name' => '',
        'size' => '20',
    ), $atts);
    
    $size = $a['size'];
    
    ob_start();?>
    <svg width="<?php echo $size;?>" height="<?php echo $size;?>" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <?php include(locate_template('/icons/' . $a['name'] . '.svg'));?>
    </svg>
    <?php 
    return ob_get_clean();
}
add_shortcode( 'bcb_icon', 'bcb_icon_shortcode' );

// Add filters.
add_filter('nav_menu_css_class', function($classes) { $classes[] = 'nav-item'; return $classes;}, 10, 1 );
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');
add_theme_support('align-wide');
add_theme_support('responsive-embeds');
add_theme_support('wp-block-styles');

// Check theme for update releases
require('update-checker.php');
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker( 'https://theme.componentblox.com/wp-content/themes/theme.json', __FILE__, 'bootstrap-component-blox');