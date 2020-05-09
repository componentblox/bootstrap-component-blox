<?php
/**
 * The template for displaying navbar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

    $custom_logo = get_theme_mod('custom_logo');
    $custom_logo_url = wp_get_attachment_image_src($custom_logo , 'full');
    $navbar_classes = get_theme_mod('navbar_classes');
    $sidebar_classes = get_theme_mod('sidebar_classes');
    $navbar_inner_classes = get_theme_mod('navbar_inner_classes');

?>

<nav class="navbar-light navbar navbar-expand-lg py-0 <?php echo esc_attr($navbar_classes);?>">
	<div class="container-fluid <?php echo esc_attr($navbar_inner_classes);?>">
						
    	<?php if(has_custom_logo()) {?>
    	<a id="navbar-brand-logo" class="navbar-brand" href="/"> 
    	   <img src="<?php echo esc_url($custom_logo_url[0]);?>" alt="<?php echo esc_attr(get_bloginfo());?>" />	
    	</a>
    	<?php } else {?>
        <a id="navbar-brand-logo" class="navbar-brand" href="/"> 
    	   <?php get_template_part('template-parts/navbar/navbar' , 'logo');?>
        </a>
    	<?php }?>
    	
    	<button id="toggler" class="navbar-toggler collapsed border-0" type="button" data-toggle="collapse" data-target="#navbar-main-menu" aria-controls="navbar-main-menu" aria-expanded="false" aria-label="Toggle Navigation">
    		<?php get_template_part('template-parts/navbar/navbar' , 'toggler');?>
    	</button>
    
        <div id="navbar-main-menu" class="navbar-collapse collapse">
          	<?php bcb_main_nav(); ?>
        </div>

  	</div>
</nav>