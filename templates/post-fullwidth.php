<?php 
/**
 * The template for displaying all single posts in fullwidth
 * 
 * Template Name: Post Fullwidth
 * Template Post Type: post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bootstrap-component-blox
 */

get_header();?>

<main id="main-container" class="row container mx-auto mt-5" role="main">
	<section class="col-12 px-4">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">

				<?php 
				while (have_posts()) { the_post();
					get_template_part('post-content');
				}?>
			
			</div>
		</article>
	</section>
</main>

<?php get_footer();?>