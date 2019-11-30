<?php 
/**
 * The template for displaying all blog posts
 * 
 * Template Name: Blog
 * Template Post Type: page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootstrap-component-blox
 */

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

query_posts(array(
    'post_type'      => 'post',
    'paged'          => $paged,
    'posts_per_page' => 10
));

get_header(); ?>

<main id="main-container" role="main" class="container-fluid px-0">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<div class="container mt-5">
				<div class="row">
					<?php 
					if (have_posts()): 
					while (have_posts()) : the_post(); 
							
					$image_id = get_post_thumbnail_id(get_the_ID());
					$alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
					$category = get_the_category();
					$child_theme_directory = get_stylesheet_directory();?>
						
					<?php if(file_exists($child_theme_directory . '/template-parts/blog/custom-blog.php') && filesize($child_theme_directory . '/template-parts/blog/custom-blog.php')) { include($child_theme_directory . '/template-parts/blog/custom-blog.php');} else { include('default-blog.php');
					}?>	

					<?php 
					endwhile;	
		    		endif;
					?>
				</div>

				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<nav aria-label="Page navigation">
  							<ul class="pagination">
								<?php my_pagination();?>
							</ul>
						</nav>
					</div>
				</div>
			
			</div>
		</div>
	</article>
</main>

<?php get_footer(); ?>