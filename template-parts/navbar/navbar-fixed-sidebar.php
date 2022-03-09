<nav class="<?php echo esc_attr(get_theme_mod('sidebar_classes'));?> navbar-expand-lg h-100">
    
    <div class="fixed-top px-3 py-2 p-lg-4 navbar-light col-lg-3 col-xl-2 bg-inherit">
        <div class="row row-cols-2 g-0 align-items-center">
            
            <div class="col">
                <a id="navbar-brand-logo" class="navbar-brand" href="<?php echo get_site_url();?>"> 
                    <?php if(has_custom_logo()) {?>
                        <img src="<?php echo esc_url(bcb_image_url(get_theme_mod('custom_logo')));?>" alt="<?php echo esc_attr(get_bloginfo());?>"/>
                    <?php } else {
                        get_template_part('template-parts/navbar/navbar' , 'logo');
                    }?>
                </a>
            </div>

            <div class="col text-end">
                <button id="toggler" class="navbar-toggler collapsed d-inline-block d-lg-none" data-bs-toggle="collapse" data-bs-target="#navbar-main-menu" aria-controls="navbar-main-menu" aria-expanded="false" aria-label="Toggle Navigation">
                    <?php get_template_part('template-parts/navbar/navbar' , 'toggler');?>
                </button >
            </div>
        
        </div>
    
        <div id="navbar-main-menu" class="navbar-collapse collapse">
            <?php bcb_main_nav('flex-column');?>
        </div>
    </div>

</nav>