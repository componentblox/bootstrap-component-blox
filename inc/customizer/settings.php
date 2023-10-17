<?php

// Sticky Top.
$wp_customize->add_setting('sticky_top', array(
    'default'           => false,
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'absint',
));

// Theme Color Scheme.
$wp_customize->add_setting('theme_color_scheme', array(
    'default'           => false,  
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'absint',
));

// Navbar Type.
$wp_customize->add_setting( 'navbar_type', array(
	'default'   => 'top',
	'transport' => 'postMessage',
	'sanitize_callback' => 'esc_attr',
));   

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

// Sidebar Navbar Classes.
$wp_customize->add_setting( 'sidebar_classes', array(
	'default' => '',
	'transport' => 'postMessage',
	'sanitize_callback' => 'esc_attr',
));

// Navbar Search.
$wp_customize->add_setting( 'navbar_search', array(
	'default' => '',
	'transport' => 'refresh',
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

// Woocommerce Theme Support	 
$wp_customize->add_setting( 'bcb_disable_woocommerce_theme_support', array(
	'default' => 'no',
	'type' => 'option',
	'capability' => 'manage_woocommerce',
	'sanitize_callback' => 'wc_bool_to_string',
	'sanitize_js_callback' => 'wc_string_to_bool',
));

if(file_exists(get_stylesheet_directory() . '/customizer/settings.php')) {
	include(get_stylesheet_directory() . '/customizer/settings.php');
}