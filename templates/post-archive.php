<?php 
/**
 * The template for displaying all blog posts
 * 
 * Template Name: Post Archive
 * Template Post Type: page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootstrap-component-blox
 */

$blog_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

query_posts(array(
    'post_type'      => 'post',
    'paged'          => $blog_paged,
    'posts_per_page' => 12,
    'ignore_sticky_posts' => 1,
));

get_header(); ?>

<main id="main-container" role="main" class="container-fluid px-0">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<div class="container mt-5">

				<?php 
					get_template_part('template-parts/post/post' , 'loop');
					get_template_part('template-parts/post/post' , 'pagination');
					wp_reset_query();
				?>
			
			</div>
		</div>
	</article>
</main>

<?php get_footer(); ?>