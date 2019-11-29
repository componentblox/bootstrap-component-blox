<?php 
/**
 * Adds Custom Settings to Customizer
 *
 * @package bootstrap-component-blox
 */

add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 400,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
	'crop'        => false,
));

// Add Theme Support.
add_theme_support( 'custom-header', array(
    'default-image'          => '',
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => false,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
) );

/**
 * Add Body Settings.
 *
 * @param string $wp_customize the WP_Customize_Manager object.
 */
function add_custom_customizer_settings( $wp_customize ) {
    
	// Panels.    

	// Navbar.
	$wp_customize->add_panel( 'navbar_panel', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Navbar', 'bootstrap-component-blox' ),
		'description' => __( 'Adds Class Option to Menu', 'bootstrap-component-blox' ),
		'priority' => 125,
	));
        
	
	// Footer.
	$wp_customize->add_panel( 'footer_panel', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Footer', 'bootstrap-component-blox' ),
		'description' => __( 'Controls the navigation layouts', 'bootstrap-component-blox' ),
	));
	

    // Sections.

	// Navbar Classes.
	$wp_customize->add_section( 'navbar_classes_section', array(
		'priority' => 0,
		'capability' => 'edit_theme_options',
		'title' => __( 'Navbar Classes', 'bootstrap-component-blox' ),
		'description' => '',
		'panel' => 'navbar_panel',
	));
	
	// Navbar Inner Classes.
	$wp_customize->add_section( 'navbar_inner_classes_section', array(
		'priority' => 0,
		'capability' => 'edit_theme_options',
		'title' => __( 'Inner Navbar Classes', 'bootstrap-component-blox' ),
		'description' => '',
		'panel' => 'navbar_panel',
	));
	
	// Body Classes.
	$wp_customize->add_section( 'body' , array(
		'title'      => __( 'Body', 'bootstrap-component-blox' ),
		'priority'   => 130,
	));
    
	// Footer Classes.
	$wp_customize->add_section( 'footer_class_section', array(
		'priority' => 20,
		'capability' => 'edit_theme_options',
		'title' => __( 'Classes', 'bootstrap-component-blox' ),
		'description' => '',
		'panel' => 'footer_panel',
	));
	
	// Footer Credit.
	$wp_customize->add_section( 'footer_credit_section', array(
		'priority' => 0,
		'capability' => 'edit_theme_options',
		'title' => __( 'Credit', 'bootstrap-component-blox' ),
		'description' => '',
		'panel' => 'footer_panel',
	));

	
	// Settings.    
    
	// Navbar Classes.
	$wp_customize->add_setting( 'navbar_classes', array(
        'default' => '',
        'transport' => 'postMessage',
		'sanitize_callback' => 'esc_attr',
    ));
	
	// Navbar Inner Classes.
	$wp_customize->add_setting( 'navbar_inner_classes', array(
        'default' => '',
        'transport' => 'postMessage',
		'sanitize_callback' => 'esc_attr',
    ));
	
	// Body Classes.
	$wp_customize->add_setting('body_container_classes', array(
		'default' => '',
		'sanitize_callback' => 'esc_attr',
	));
	
	// Footer Classes.	
	$wp_customize->add_setting( 'footer_classes', array(
        'default' => '',
        'transport' => 'postMessage',
		'sanitize_callback' => 'esc_attr',
    ));
	
	// Footer Credit.		 
    $wp_customize->add_setting( 'footer_credit', array(
        'default' => '',
        'transport' => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
    ));
 
    // Controls.     
 
    // Navbar Classes.
    $wp_customize->add_control( 'navbar_classes', array(
		'label' => __( 'Navbar Classes' , 'bootstrap-component-blox' ),
		'section' => 'navbar_classes_section',
		'priority' => 20, 
		'type' => 'text',
		'capability' => 'edit_theme_options',
	));

	// Navbar Inner Classes.
	 $wp_customize->add_control( 'navbar_inner_classes', array(
		'label' => __( 'Navbar Inner Classes' , 'bootstrap-component-blox' ),
		'section' => 'navbar_inner_classes_section',
		'priority' => 20, 
		'type' => 'text',
		'capability' => 'edit_theme_options',
	));
	
	// Footer Classes.
    $wp_customize->add_control( 'footer_classes', array(
		'label' => __( 'Footer Classes', 'bootstrap-component-blox' ),
		'section' => 'footer_class_section',
		'priority' => 20, 
		'type' => 'text',
		'capability' => 'edit_theme_options',
	));
    
	// Body Classes.
	$wp_customize->add_control( 'body_classes' , array(
		'type' => 'text',
		'label'      => __( 'Classes', 'bootstrap-component-blox' ),
		'section'    => 'body',
		'settings'   => 'body_container_classes'
	));
    
	// Footer Credit.
	$wp_customize->add_control( 'footer_credit', array(
        'label' => __( 'Footer Credit' , 'bootstrap-component-blox' ),
        'section' => 'footer_credit_section',
        'priority' => 5,
        'type' => 'textarea',
        'capability' => 'edit_theme_options',
    ));        

}
add_action('customize_register','add_custom_customizer_settings');
