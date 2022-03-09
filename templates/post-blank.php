<?php 
/**
 * The template for displaying a template with without navbar
 * 
 * Template Name: Blank Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bootstrap-component-blox
 */

get_header(); ?>

<main id="main-container" role="main" class="px-0">
	<article id="post-<?php the_ID();?>" <?php post_class();?>>
		<div class="entry-content">
			<?php 
			if (have_posts()) {
			while (have_posts()) { the_post();
				the_content();
			}}?>
		</div>
	</article>
</main>

<?php get_footer(); ?>