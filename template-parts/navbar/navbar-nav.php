<?php
/**
 * The template for displaying navbar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<nav class="navbar-light navbar navbar-expand-lg py-0 <?php echo esc_attr(get_theme_mod('navbar_classes'));?>">
	<div class="container-fluid <?php echo esc_attr(get_theme_mod('navbar_inner_classes'));?>">
						
    	<a id="navbar-brand-logo" class="navbar-brand" href="<?php echo get_site_url();?>"> 
            <?php if(has_custom_logo()) {?>
                <img src="<?php echo esc_url(bcb_image_url(get_theme_mod('custom_logo')));?>" alt="<?php echo esc_attr(get_bloginfo());?>" />	
            <?php } else {
                get_template_part('template-parts/navbar/navbar' , 'logo');
            }?>
    	</a>
    	
    	<button id="toggler" class="navbar-toggler collapsed border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-main-menu" aria-controls="navbar-main-menu" aria-expanded="false" aria-label="Toggle Navigation">
    		<?php get_template_part('template-parts/navbar/navbar' , 'toggler');?>
    	</button>
    
        <div id="navbar-main-menu" class="navbar-collapse collapse">
          	<?php bcb_main_nav(); ?>
        </div>

  	</div>
</nav>