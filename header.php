<?php
/**
 * The theme header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	
	<?php
	$custom_logo = get_theme_mod('custom_logo');
	$custom_logo_url = wp_get_attachment_image_src($custom_logo , 'full');
	$body_classes = get_theme_mod('body_container_classes');
	$navbar_type = get_theme_mod('navbar_type');
	$navbar_classes = get_theme_mod('navbar_classes');
	$sidebar_classes = get_theme_mod('sidebar_classes');
	$navbar_inner_classes = get_theme_mod('navbar_inner_classes');
	$child_theme_directory = get_stylesheet_directory();
	?>
	
	<head>
		<?php if(file_exists($child_theme_directory . '/header-scripts.php')) { get_template_part('header' , 'scripts');}?>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class($body_classes);?> >		
       <?php bcb_before_navbar();?>
       <header id="nav-header" class="clear" role="banner">
            <?php 
            if(file_exists($child_theme_directory . '/template-parts/navbar/custom-navbar.php') && filesize($child_theme_directory . '/template-parts/navbar/custom-navbar.php')) { 
            	include($child_theme_directory . '/template-parts/navbar/custom-navbar.php');
            } elseif($navbar_type == 'side') {
				include('sidebar-navbar.php');
            } else {
				include('default-navbar.php');
            }?>
        </header>        