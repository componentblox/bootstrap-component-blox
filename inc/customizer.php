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
	include(__DIR__ . '/customizer/panels.php');  

    // Sections.
    include(__DIR__ . '/customizer/sections.php');   
    
	// Settings. 
	include(__DIR__ . '/customizer/settings.php');   

    // Controls.
    include(__DIR__ . '/customizer/controls.php'); 

}
add_action('customize_register','add_custom_customizer_settings');
