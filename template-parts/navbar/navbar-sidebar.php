<?php
/**
 * The template for displaying navbar sidebar
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

<nav class="navbar-light navbar navbar-expand-lg <?php echo esc_attr($navbar_classes);?> py-0">
    <div class="container-fluid <?php echo esc_attr($navbar_inner_classes);?>">
                        
        <?php if(has_custom_logo()) {?>
        <a id="navbar-brand-logo" class="navbar-brand" href="/"> 
           <img src="<?php echo esc_url($custom_logo_url[0]);?>" alt="<?php echo esc_attr(get_bloginfo());?>" />    
        </a>
        <?php } else {?>
        <a id="navbar-brand-logo" class="navbar-brand" href="/"> 
            <?php get_template_part('inc/svg' , 'logo');?>
        </a>
        <?php }?>
        
        <button id="toggler" class="sidebar-navbar-collapse btn text-right collapsed" data-toggle="collapse" data-target="#sidebar-navbar" type="button" aria-expanded="false">
            <?php get_template_part('/template-parts/navbar/navbar' , 'toggler');?>
        </button>

    </div>
</nav>

<nav id="sidebar-navbar" class="<?php echo esc_attr($sidebar_classes);?> navbar collapse navbar">
    <div id="sidebar-navbar-dismiss" data-toggle="collapse" data-target="#sidebar-navbar">
        <i class="fas fa-times text-muted"></i>
    </div>
    <?php bcb_main_nav('mt-3');?>
</nav>