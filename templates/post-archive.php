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
				<div class="row px-3">
					<div class="card-deck">
						<?php 
						if (have_posts()): 
						while (have_posts()) : the_post(); 
								
						$image_id = get_post_thumbnail_id(get_the_ID());
						$category = get_the_category();
						$child_theme_directory = get_stylesheet_directory();?>
							
						<div class="card d-block p-3 mb-4" style="min-width: 18rem;">
							<?php if($image_id) {?>
							<img class="post-image w-100 mb-2" src="<?php bcb_image_url($image_id, 'medium');?>" alt="<?php bcb_image_alt($image_id);?>">
							<?php }?>
							<h4 class="post-title mb-0"><?php the_title_attribute();?></h4>
							<p class="post-meta"><small><?php esc_html_e('By' , 'bootstrap-component-blox');?> <?php the_author_posts_link();?> | <?php the_time('F j, Y');?> | <?php if(!empty($category)) { echo '<a href="' .  esc_url(get_category_link($category[0]->term_id)) . '">' . esc_html( $category[0]->name ) . '</a>';}?></small></p>
							<p class="post-content"><?php echo esc_html(wp_trim_words( get_the_content(),20, '...' ));?></p>
							<p class="post-link text-right mb-0">
								<a aria-label="Read More" class="btn btn-sm btn-dark" href="<?php the_permalink();?>" role="button"><?php esc_html_e('Read More' , 'bootstrap-component-blox');?></a>
							</p>
						</div>

						<?php
						endwhile;	
			    		endif;
						?>
					</div>
				</div>

				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<nav aria-label="Page navigation">
  							<ul class="pagination">
								<?php bcb_pagination();?>
							</ul>
						</nav>
					</div>
				</div>

				<?php wp_reset_query();?>
			
			</div>
		</div>
	</article>
</main>

<?php get_footer(); ?>