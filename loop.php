<?php 
/**
 * The loop template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

if (have_posts()): while (have_posts()) : the_post(); 
	
	// vars
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
	$image = wp_get_attachment_image_url( $thumbnail_id, 'medium' );?>

	<div class="card p-3">	
		<?php if (has_post_thumbnail()) { ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<img class="w-100 mb-3" src="<?php echo esc_url($image);?>" alt="<?php echo $alt;?>">
		</a>
		<?php }?>
		
		<h4 class="mb-0"><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title_attribute();?></a></h4>
		<hr>
    	<p><?php echo esc_html(wp_trim_words( get_the_content(),20, '...' ));?></p>
		<p class="mb-0"><a href="<?php the_permalink();?>" class="btn btn-dark text-white"><?php esc_html_e('Read More' , 'bootstrap-component-blox');?></a>
		<?php wp_link_pages();?></p>
	</div>	


	<?php 
		endwhile; 
		else: 
	?>
	
	<div class="col-12 text-center my-4">
		<h2><?php esc_html_e( 'Sorry, nothing to display.', 'bootstrap-component-blox' ); ?></h2>
	</div>

<?php endif; ?>