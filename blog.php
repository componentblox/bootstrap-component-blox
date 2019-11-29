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

$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 18,
    'order' => 'DESC',
);

$blog_posts = new WP_Query($args);

get_header(); ?>

<main id="main-container" role="main" class="container-fluid px-0">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<div class="container">
				<div class="row">
					<?php 
					if ($blog_posts->have_posts()): 
					while ($blog_posts->have_posts()) : $blog_posts->the_post(); 
							
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
			</div>
		</div>
	</article>
</main>

<?php get_footer(); ?>