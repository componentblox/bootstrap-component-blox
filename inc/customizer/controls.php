<?php

// Sticky Top.
$wp_customize->add_control('sticky_top', array(
    'label'           => __('Sticky Top', 'bootstrap-component-blox'),
    'section'         => 'navbar_type_section',
    'settings'        => 'sticky_top',
    'type'            => 'checkbox',
    'priority'        => 30, // Just an example, you can adjust.
    'active_callback' => function() use ($wp_customize) {
        return 'top' === $wp_customize->get_setting('navbar_type')->value();
    },
));

// Theme Color Scheme.
$wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'theme_color_scheme',
    array(
        'label'       => __('Enable Theme Color Scheme', 'bootstrap-component-blox'),
        'section'     => 'colors',
        'settings'    => 'theme_color_scheme',
        'type'        => 'checkbox',
    )
));

// Navbar Type.
$wp_customize->add_control( 'navbar_type', array(
	'label'    => __( 'Navbar Type' , 'bootstrap-component-blox' ),
	'section'  => 'navbar_type_section',
	'priority' => 20, 
	'default'  => 'top',
	'type'     => 'select',
	'choices'  => array(
		'top'  => 'Top',
		'side' => 'Side',
		'fixed_side' => 'Fixed Side',
	),
	'capability' => 'edit_theme_options',
));     

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

// Sidebar Classes.
$wp_customize->add_control( 'sidebar_classes', array(
	'label' => __( 'Sidebar Classes' , 'bootstrap-component-blox' ),
	'section' => 'sidebar_classes_section',
	'priority' => 20, 
	'type' => 'text',
	'capability' => 'edit_theme_options',
));

// Enable Search.
$wp_customize->add_control( 'navbar_search', array(
	'label' => __( 'Enable Search' , 'bootstrap-component-blox' ),
	'section' => 'navbar_search_section',
	'priority' => 20, 
	'type'=> 'checkbox',
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

// Woocommerce Theme Support.
$wp_customize->add_control( 'bcb_disable_woocommerce_theme_support', array(
	'label' => 'Disable Theme Support',
	'description' => '',
	'section' => 'woocomerce_theme_support',
	'settings' => 'bcb_disable_woocommerce_theme_support',
	'type' => 'checkbox',
)); 

if(file_exists(get_stylesheet_directory() . '/customizer/controls.php')) {
	include(get_stylesheet_directory() . '/customizer/controls.php');
}