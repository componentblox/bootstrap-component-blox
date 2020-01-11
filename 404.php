<?php 
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bootstrap-component-blox
 */

?>

<?php get_header();?>

<main id="main-container" role="main" class="container-fluid px-0">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">

			<div class="container py-5">
				<div class="row text-center">

					<div class="col-12">
						<i class="fas fa-search fa-5x mb-4"></i>
						<h4><?php esc_html_e( 'Page not found', 'bootstrap-component-blox' ); ?></h4>
						<p><?php esc_html_e("We're sorry, but it appears the search term you entered did not find a match. Please try again using a different search term." , "bootstrap-component-blox");?></p>
						<?php get_template_part('searchform');?>
					</div>

				</div>
			</div>
		</div>
	</article>
</main>
	
<?php get_footer();?>