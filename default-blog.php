<?php
/**
 * The template for displaying default blog posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>


<div class="card d-block p-3 mb-4" style="min-width: 18rem;">
	<?php if($image_id) {?>
	<img class="post-image w-100 mb-2" src="<?php bcb_image_url($image_id, 'medium');?>" alt="<?php bcb_image_alt($image_id);?>">
	<?php }?>
	<h4 class="post-title mb-0"><?php the_title_attribute();?></h4>
	<p class="post-meta"><small><?php esc_html_e('By' , 'bootstrap-component-blox');?> <?php the_author_posts_link();?> | <?php the_time('F j, Y');?> | <?php if(!empty($category)) { echo '<a href="' .  esc_url(get_category_link($category[0]->term_id)) . '">' . esc_html( $category[0]->name ) . '</a>';}?></small></p>
	<p class="post-content"><?php echo esc_html(wp_trim_words( get_the_content(),20, '...' ));?></p>
	<p class="post-link text-right mb-0">
		<a aria-label="Read More" class="btn btn-sm btn-dark" href="<?php the_permalink();?>" role="button"><?php esc_html_e('Read More' , 'bootstrap-component-blox');?></a>
	</p>
</div>

