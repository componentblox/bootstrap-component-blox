<?php
/**
 * The template for displaying default navbar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<nav class="navbar-light navbar navbar-expand-lg py-0 <?php echo esc_attr($navbar_classes);?>">
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
    	
    	<button id="toggler" class="navbar-toggler collapsed border-0" type="button" data-toggle="collapse" data-target="#navbar-main-menu" aria-controls="navbar-main-menu" aria-expanded="false" aria-label="Toggle Navigation">
    		<?php if (file_exists($child_theme_directory . '/template-parts/navbar/navbar-toggler.php') && filesize($child_theme_directory . '/template-parts/navbar/navbar-toggler.php')) { get_template_part('/template-parts/navbar/navbar' , 'toggler');
    		} else {?><span class="navbar-toggler-icon"></span><?php }?>
    	</button>
    
        <div id="navbar-main-menu" class="navbar-collapse collapse">
          	<?php bcb_main_nav(); ?>
        </div>

  	</div>
</nav>
