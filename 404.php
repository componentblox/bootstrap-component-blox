<?php 

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bootstrap-component-blox
 */

get_header();?>

<main id="main-container" role="main" class="container-fluid px-0">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">

			<div class="container py-5">
				<div class="row text-center">

					<div class="col-12">
						<i class="fas fa-search fa-5x mb-4"></i>
						<h4><?php _e( 'Page not found', 'bootstrap-component-blox' ); ?></h4>
						<p>We're sorry, but it appears the search term you entered did not find a match.<br> Please try again using a different search term.</p>
						<?php get_template_part('searchform');?>
					</div>

				</div>
			</div>
		</div>
	</article>
</main>
	
<?php get_footer(); ?>