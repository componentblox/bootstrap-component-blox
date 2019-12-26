<?php 
/**
 * The template for post comments
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

if(comments_template()) {?>
<hr>
<div class="card my-4 border">
	<h5 class="card-header"><?php esc_html_e('Leave a Comment' , 'bootstrap-component-blox');?></h5>
	<div class="card-body">
		<?php comments_template();?>
	</div>
</div>
<?php }?>