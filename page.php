<?php 
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootstrap-component-blox
 */

get_header(); ?>

<main id="main-container" role="main" class="container-fluid px-0">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
			<div class="entry-content">
				<?php the_content();
				 wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bootstrap-component-blox' ),
					'after'  => '</div>',
				));?>
			</div>
			  <?php bcb_search_form('bg-dark');?>
		
		</article>
		
		<?php 
			endwhile;	
		    endif;
		?>
</main>

<?php get_footer(); ?>
