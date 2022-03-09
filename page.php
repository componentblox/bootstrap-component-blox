<?php 
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootstrap-component-blox
 */

get_header(); ?>

<main id="main-container" role="main" class="px-0 <?php echo bcb_fixed_sidebar_classes();?>">
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
