<?php 
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bootstrap-component-blox
 */

get_header();?>

<main id="main-container" class="row container mx-auto mt-5" role="main">
	<section class="col-12 col-lg-8 px-4">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">

				<?php 
				while (have_posts()) { the_post();
					get_template_part('post-content');
				}?>
			
			</div>
		</article>
	</section>
	
	<aside class="col-12 col-lg-4 px-4 border-left">
		<?php get_sidebar();?>
	</aside>

</main>

<?php get_footer();?>