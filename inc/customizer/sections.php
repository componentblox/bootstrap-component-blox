<?php

// Navbar Type.
$wp_customize->add_section( 'navbar_type_section', array(
	'priority' => 0,
	'capability' => 'edit_theme_options',
	'title' => __( 'Navbar Type', 'bootstrap-component-blox' ),
	'description' => '',
	'panel' => 'navbar_panel',
));

// Top Navbar Classes.
$wp_customize->add_section( 'navbar_classes_section', array(
	'priority' => 0,
	'capability' => 'edit_theme_options',
	'title' => __( 'Top Navbar Classes', 'bootstrap-component-blox' ),
	'description' => '',
	'panel' => 'navbar_panel',
));

// Top Navbar Inner Classes.
$wp_customize->add_section( 'navbar_inner_classes_section', array(
	'priority' => 0,
	'capability' => 'edit_theme_options',
	'title' => __( 'Top Navbar Inner Classes', 'bootstrap-component-blox' ),
	'description' => '',
	'panel' => 'navbar_panel',
));

// Sidebar Navbar Classes.
$wp_customize->add_section( 'sidebar_classes_section', array(
	'priority' => 0,
	'capability' => 'edit_theme_options',
	'title' => __( 'Sidebar Navbar Classes', 'bootstrap-component-blox' ),
	'description' => '',
	'panel' => 'navbar_panel',
));

// Add Search Icon to Navbar.
$wp_customize->add_section( 'navbar_search_section', array(
	'priority' => 0,
	'capability' => 'edit_theme_options',
	'title' => __( 'Enable Search', 'bootstrap-component-blox' ),
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

// Woocommerce Theme Support
$wp_customize->add_section( 'woocomerce_theme_support', array(
	'priority' => 0,
	'capability' => 'edit_theme_options',
	'title' => __( 'Theme Support', 'bootstrap-component-blox' ),
	'description' => '',
	'panel' => 'bcb_woocommerce_panel',
));

if(file_exists(get_stylesheet_directory() . '/customizer/sections.php')) {
	include(get_stylesheet_directory() . '/customizer/sections.php');
}