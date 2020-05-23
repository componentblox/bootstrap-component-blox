<?php 
/**
 * The template for displaying loop
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<div class="row justify-content-center">
	<div class="card-deck flex-fill">

	<?php
		if (have_posts()) {
		while (have_posts()) { the_post(); 		
		$image_id = get_post_thumbnail_id($post->ID);
	?>
		<div class="card p-3 mb-4" style="min-width: 18rem;">
			<?php if (has_post_thumbnail()) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
				<img class="w-100 mb-3" src="<?php bcb_image_url($image_id, 'medium');?>" alt="<?php bcb_image_alt($image_id);?>"/>
			</a>
			<?php }?>
			<h4><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title_attribute();?></a></h4>
		    <p><?php echo esc_html(wp_trim_words( get_the_content(),20, '...' ));?></p>
			<div class="mt-auto">
				<a href="<?php the_permalink();?>" class="btn btn-dark"><?php esc_html_e('Read More' , 'bootstrap-component-blox');?></a>
			</div>
		</div>

	<?php }} else { ?>
		<div class="col-12 col-lg-6 mx-auto mb-4">
			<p class="alert alert-warning text-center"><?php esc_html_e('We could not find your search. Please try Again.' , 'bootstrap-component-blox');?></p>
			<?php get_template_part('searchform');?>
		</div>
		
	<?php }?>
    </div>	
</div>	