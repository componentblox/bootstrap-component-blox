<?php 
/**
 * The template for displaying loop
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

	<?php
		if (have_posts()) {
		while (have_posts()) { the_post(); 		
	?>
	<div class="col mb-4">
		<div class="card p-3 h-100">
			<?php if (has_post_thumbnail()) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
				<img class="w-100 mb-3" src="<?php bcb_image_url(bcb_image_id(), 'medium');?>" alt="<?php bcb_image_alt(bcb_image_id());?>"/>
			</a>
			<?php }?>
			<h4><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title_attribute();?></a></h4>
		    <p><?php echo esc_html(wp_trim_words( get_the_content(),20, '...' ));?></p>
			<div class="mt-auto">
				<a href="<?php the_permalink();?>" class="btn btn-dark"><?php esc_html_e('Read More' , 'bootstrap-component-blox');?></a>
			</div>
		</div>
	</div>

	<?php } } else { ?>
		<div class="col-12 col-lg-6 mx-auto mb-4">
			<p class="alert alert-warning text-center"><?php esc_html_e('No search result found. Please try again.' , 'bootstrap-component-blox');?></p>
			<?php get_template_part('searchform');?>
		</div>
	<?php }?>
 
</div>	