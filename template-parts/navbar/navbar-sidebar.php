<?php
/**
 * The template for displaying navbar sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<nav class="navbar-light navbar navbar-expand-lg <?php echo esc_attr(get_theme_mod('navbar_classes'));?> py-0">
    <div class="container-fluid <?php echo esc_attr(get_theme_mod('navbar_inner_classes'));?>">
                        
        <a id="navbar-brand-logo" class="navbar-brand" href="<?php echo get_site_url();?>"> 
            <?php if(has_custom_logo()) {?>
                <img src="<?php echo esc_url(bcb_image_url(get_theme_mod('custom_logo')));?>" alt="<?php echo esc_attr(get_bloginfo());?>" />   
            <?php } else {
                get_template_part('template-parts/navbar/navbar' , 'logo');
            }?>
        </a>
        
        <button id="toggler" class="sidebar-navbar-collapse btn text-right collapsed" data-bs-toggle="collapse" data-bs-target="#sidebar-navbar" type="button" aria-expanded="false">
            <?php get_template_part('/template-parts/navbar/navbar' , 'toggler');?>
        </button>

    </div>
</nav>

<nav id="sidebar-navbar" class="<?php echo esc_attr(get_theme_mod('sidebar_classes'));?> navbar collapse navbar">
    <div id="sidebar-navbar-dismiss" data-bs-toggle="collapse" data-bs-target="#sidebar-navbar">
        <i class="fas fa-times text-muted"></i>
    </div>
    <?php bcb_main_nav('mt-3');?>
</nav>