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
				<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
						<?php 
						if (have_posts()): 
						while (have_posts()) : the_post();
						?>

						<div class="col mb-4">
							
							<div class="card p-3 h-100">
								<?php if(bcb_image_id()) {?>
								<img class="post-image w-100 mb-2" src="<?php bcb_image_url(bcb_image_id(), 'medium');?>" alt="<?php bcb_image_alt(bcb_image_id());?>">
								<?php }?>
								<h4 class="post-title mb-0"><?php the_title_attribute();?></h4>
								<p class="post-meta"><small><?php esc_html_e('By' , 'bootstrap-component-blox');?> <?php the_author_posts_link();?> | <?php the_time('F j, Y');?> | <?php if(!empty(get_the_category())) { echo '<a href="' .  esc_url(get_category_link(get_the_category()[0]->term_id)) . '">' . esc_html( get_the_category()[0]->name ) . '</a>';}?></small></p>
								<p class="post-content"><?php echo esc_html(wp_trim_words( get_the_content(),20, '...' ));?></p>
								<p class="post-link mb-0 mt-auto">
									<a aria-label="Read More" class="btn btn btn-dark" href="<?php the_permalink();?>" role="button"><?php esc_html_e('Read More' , 'bootstrap-component-blox');?></a>
								</p>
							</div>
						</div>

						<?php
						endwhile;	
			    		endif;
						?>
				</div>

				<?php get_template_part('template-parts/post/post' , 'pagination');?>
				<?php wp_reset_query();?>
			
			</div>
		</div>
	</article>
</main>

<?php get_footer(); ?>