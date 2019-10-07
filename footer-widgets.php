<?php 
if(is_active_sidebar('footer-area-1')){?>
<div id="footer-widgets" class="footer-widgets">
    <div class="container">
        <div class="row py-5">
	    
	        <?php if(is_active_sidebar('footer-area-1')){ ?>
	        <div class="col">
				<?php dynamic_sidebar('footer-area-1'); ?>  
            </div>
     	    <?php } ?>
    
            <?php if(is_active_sidebar('footer-area-2')){ ?>
    		<div class="col">
                <?php dynamic_sidebar('footer-area-2'); ?>  
    		</div>
            <?php } ?>
    
            <?php if(is_active_sidebar('footer-area-3')){ ?>
    		<div class="col">
                <?php dynamic_sidebar('footer-area-3'); ?>  
    		</div>
            <?php } ?>
    
            <?php if(is_active_sidebar('footer-area-4')){ ?>
    		<div class="col">
                <?php dynamic_sidebar('footer-area-4'); ?>  
    		</div>
            <?php } ?>

        </div>
    </div>
</div>

<?php }?>