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
	
	<head>
		<?php get_template_part('header' , 'scripts');?>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(get_theme_mod('body_container_classes'));?> >		
        <?php bcb_before_navbar();?>
        <?php if(!is_page_template('templates/post-blank.php')) {?>
        <header id="nav-header" class="clear" role="banner">
            <?php 
            if(get_theme_mod('navbar_type') == 'side') {
				get_template_part('template-parts/navbar/navbar' , 'sidebar');
            } else {
				get_template_part('template-parts/navbar/navbar' , 'nav');
            }?>
        </header>  
        <?php }?>      