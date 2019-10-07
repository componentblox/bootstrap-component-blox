<nav class="navbar-light navbar navbar-expand-lg <?php echo $navbar_classes;?> py-0">
	<div class="container-fluid <?php echo $navbar_inner_classes;?>">
						
    	<?php if( has_custom_logo() ) {?>
    	<a id="navbar-brand-logo" class="navbar-brand" href="/"> 
    		<img src="<?php echo $custom_logo_url[0];?>" alt="<?php echo get_bloginfo();?> Logo" />	
    	</a>
    	<?php } else {?>
    	    <i class="fab fa-bootstrap fa-4x"></i>
    	<?php }?>
    	
    	<button class="navbar-toggler collapsed border-0" type="button" data-toggle="collapse" data-target="#navbarIcon" aria-controls="navbarIcon" aria-expanded="false" aria-label="Toggle navigation">
    		<?php if (file_exists($child_theme_directory . '/template-parts/navbar/navbar-toggler.php') && filesize($child_theme_directory . '/template-parts/navbar/navbar-toggler.php')) { get_template_part('/template-parts/navbar/navbar' , 'toggler');
    		} else {?><span class="navbar-toggler-icon"></span><?php }?>
    	</button>
    
        <div id="navbarIcon" class="navbar-collapse collapse">
          	<?php main_nav(); ?>
        </div>
  	
  	</div>
</nav>