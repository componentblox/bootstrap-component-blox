<?php 
/**
 * The template for displaying loop
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */


?>
<div class="row px-3">
	<div class="card-deck">

<?php
	if (have_posts()) {
	while (have_posts()) { the_post(); 
		
	$image_id = get_post_thumbnail_id( $post->ID );
?>

	<div class="card d-block p-3 mb-4" style="min-width: 18rem;">
		<?php if (has_post_thumbnail()) { ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<img class="w-100 mb-3" src="<?php bcb_image_url($image_id, 'medium');?>" alt="<?php bcb_image_alt($image_id);?>""/>
		</a>
		<?php }?>
		
		<h4 class="mb-0"><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title_attribute();?></a></h4>
		<hr>
    	<?php echo esc_html(wp_trim_words( get_the_content(),20, '...' ));?>
		<p class="mb-0"><a href="<?php the_permalink();?>" class="btn btn-dark text-white my-2"><?php esc_html_e('Read More' , 'bootstrap-component-blox');?></a></p>
		<?php wp_link_pages();?>
	</div>

	<?php }} else { ?>
	
	<div class="col-12 my-4 text-center">
		<h2><?php esc_html_e( 'Sorry, nothing to display.', 'bootstrap-component-blox' ); ?></h2>
	</div>
	
    <?php }?>
    </div>	
</div>	