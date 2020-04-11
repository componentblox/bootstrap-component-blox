<!-- Sidebar Navbar  -->
<nav class="navbar-light navbar navbar-expand-lg <?php echo esc_attr($navbar_classes);?> py-0">
    <div class="container-fluid <?php echo esc_attr($navbar_inner_classes);?>">
                        
        <?php if(has_custom_logo()) {?>
        <a id="navbar-brand-logo" class="navbar-brand" href="/"> 
           <img src="<?php echo esc_url($custom_logo_url[0]);?>" alt="<?php echo esc_attr(get_bloginfo());?>" />    
        </a>
        <?php } else {?>
        <a id="navbar-brand-logo" class="navbar-brand" href="/"> 
           <i class="fas fa-cube fa-2x text-white bg-dark px-3 py-2"></i>
        </a>
        <?php }?>
        
        <button id="toggler" class="sidebar-navbar-collapse btn text-right collapsed" data-toggle="collapse" data-target="#sidebar-navbar" type="button" aria-expanded="false">
            <?php if (file_exists($child_theme_directory . '/template-parts/navbar/navbar-toggler.php') && filesize($child_theme_directory . '/template-parts/navbar/navbar-toggler.php')) { get_template_part('/template-parts/navbar/navbar' , 'toggler');
            } else {?><span class="navbar-toggler-icon"></span><?php }?>
        </button>

    </div>
</nav>

<nav id="sidebar-navbar" class="<?php echo esc_attr($sidebar_classes);?> navbar collapse navbar">
    <div id="sidebar-navbar-dismiss" data-toggle="collapse" data-target="#sidebar-navbar">
        <i class="fas fa-times text-muted"></i>
    </div>
    <?php main_nav('mt-3');?>
</nav>
