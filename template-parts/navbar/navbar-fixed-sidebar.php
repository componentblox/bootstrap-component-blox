<nav id="bcb-main-navbar" class="<?php echo esc_attr(get_theme_mod('navbar_classes'));?> navbar-expand-lg h-100 d-none d-lg-block">
    <div class="position-fixed p-4 navbar-light col-lg-3 col-xl-2 bg-inherit">
        
        <a id="navbar-brand-logo" class="navbar-brand" href="<?php echo get_site_url();?>"> 
            <?php if(has_custom_logo()) {?>
                <img src="<?php echo esc_url(bcb_image_url(get_theme_mod('custom_logo')));?>" alt="<?php echo esc_attr(get_bloginfo());?>"/>
            <?php } else {
                get_template_part('template-parts/navbar/navbar' , 'logo');
            }?>
        </a>

        <div id="navbar-main-menu">
            <?php bcb_main_nav('flex-column');?>
        </div>
    
    </div>
</nav>