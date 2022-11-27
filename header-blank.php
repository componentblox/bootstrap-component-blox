<?php
/**
 * The theme header blank
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    
    <head>
        <?php get_template_part('header' , 'scripts');?>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>

		<body <?php body_class(get_theme_mod('body_container_classes'));?>>
			<?php 
				wp_body_open();     
				bcb_before_navbar();
				bcb_after_navbar();
			?>    