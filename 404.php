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

<main id="main-container" role="main">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content px-3 py-4 p-lg-5">
			<div class="container">
				<div class="row justify-content-center text-center">

					<div class="col-lg-7">
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