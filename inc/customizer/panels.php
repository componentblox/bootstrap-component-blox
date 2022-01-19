<?php

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

// Single Layout.
$wp_customize->add_panel( 'single_post_panel', array(
	'capability' => 'edit_theme_options',
	'theme_supports' => '',
	'title' => __( 'Single Post', 'bootstrap-component-blox' ),
	'description' => __( 'Controls the single post layout', 'bootstrap-component-blox' ),
));

// Woocommerce Settings.
$wp_customize->add_panel( 'bcb_woocommerce_panel', array(
	'capability' => 'edit_theme_options',
	'theme_supports' => '',
	'title' => __( 'Woocommerce Theme Settings', 'bootstrap-component-blox' ),
	'description' => __( 'Adds Woocommerce Custom Settings', 'bootstrap-component-blox' ),
	'priority' => 200,
));

if(file_exists(get_stylesheet_directory() . '/customizer/panels.php')) {
	include(get_stylesheet_directory() . '/customizer/panels.php');
}