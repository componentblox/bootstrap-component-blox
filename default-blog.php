<?php
/**
 * The template for displaying default blog posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<div class="col-12 col-lg-4 mb-4">
	<div class="card d-block shadow p-3 border-0">
		<img class="post-image w-100 mb-2" src="<?php echo esc_html(get_the_post_thumbnail_url());?>" alt="<?php echo esc_html($alt_text);?>">
		<h4 class="post-title mb-0"><?php the_title();?></h4>
		<p class="post-meta"><small>By <?php the_author_posts_link();?> | <?php the_time('F j, Y');?> | <?php if(!empty($category)) { echo '<a href="' .  esc_html(get_category_link($category[0]->term_id)) . '">' . esc_html( $category[0]->name );}?></a> </small></p>
		<p class="post-content"><?php echo wp_trim_words( get_the_content(),20, '...' );?></p>
		<p class="post-link text-right mb-0">
			<a aria-label="Read More" class="btn btn-sm btn-dark" href="<?php the_permalink();?>" role="button">Read More</i></a>
		</p>
	</div>
</div>