<?php
/**
 * The template for displaying footer widgets
 *
 * @package bootstrap-component-blox
 */

if(is_active_sidebar('footer-area-1') || is_active_sidebar('footer-area-2') || is_active_sidebar('footer-area-3') || is_active_sidebar('footer-area-4')){?>
<div id="footer-widgets" class="footer-widgets px-3">
    <div class="container-fluid">
        <div class="row pb-0 pt-5 pb-lg-5">
        
            <?php if(is_active_sidebar('footer-area-1')){?>
            <div class="col mb-4 mb-lg-0">
                <?php dynamic_sidebar('footer-area-1');?>  
            </div>
            <?php }?>
    
            <?php if(is_active_sidebar('footer-area-2')){?>
            <div class="col mb-4 mb-lg-0">
                <?php dynamic_sidebar('footer-area-2');?>  
            </div>
            <?php }?>
    
            <?php if(is_active_sidebar('footer-area-3')){?>
            <div class="col mb-4 mb-lg-0">
                <?php dynamic_sidebar('footer-area-3');?>  
            </div>
            <?php }?>
    
            <?php if(is_active_sidebar('footer-area-4')){?>
            <div class="col mb-4 mb-lg-0">
                <?php dynamic_sidebar('footer-area-4');?>  
            </div>
            <?php }?>

        </div>
    </div>
</div>
<?php }?>