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
        <?php if(get_theme_mod('navbar_type') == 'fixed_side') {$fixed_sidebar_row_classes = 'row g-0';}?>
	</head>

	<body <?php body_class( $fixed_sidebar_row_classes . get_theme_mod('body_container_classes'));?>>
		<?php wp_body_open();?>		
        <?php bcb_before_navbar();?>
        <?php if(!is_page_template('templates/post-blank.php')) {?>
        <header id="nav-header" class="clear <?php if(get_theme_mod('navbar_type') == 'fixed_side') { echo 'col-lg-3 col-xl-2'; };?>" role="header">
            <?php 
                if(get_theme_mod('navbar_type') == 'side') {
                    get_template_part('template-parts/navbar/navbar' , 'sidebar');
                } elseif(get_theme_mod('navbar_type') == 'fixed_side') {
                    get_template_part('template-parts/navbar/navbar' , 'fixed-sidebar');
                } else {
                    get_template_part('template-parts/navbar/navbar' , 'nav');
                }
            ?>
        </header>  
        <?php }?>  
        <?php bcb_after_navbar();?>    