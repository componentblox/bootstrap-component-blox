<?php 
/**
 * The loop template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

if (have_posts()): while (have_posts()) : the_post(); ?>

		<div class="mb-3">		
			<?php if (has_post_thumbnail()) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img class="img-fluid rounded" style="width: 100%;" src="<?php echo get_the_post_thumbnail_url();?>" alt="">
			</a>
			<?php endif; ?>
			
			<h1 class="mt-4"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></h1>

			<div class="post_meta">
				<span class="author"><?php _e( 'Published by', 'bootstrap-component-blox' );?> <?php the_author_posts_link();?></span>
				<span class="date">| <?php the_time('F j, Y');?></span>
				<span class="category">| <?php the_category(', ');?> </span>
				<span class="comments">
					<?php if (comments_open(get_the_ID())) comments_popup_link( __( 'Leave your thoughts', 'bootstrap-component-blox' ), __( '1 Comment', 'bootstrap-component-blox' ), __( '% Comments', 'bootstrap-component-blox' ));?>
				</span>
			</div>
			
			<hr>

	    	<?php the_content();?>

			<a href="<?php the_permalink();?>" class="btn btn-dark text-white">Read More</a>
			<?php wp_link_pages(); ?> 	
		</div>	

	<?php 
	endwhile; 
	else: 
	?>
	
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'bootstrap-component-blox' ); ?></h2>
	</article>

<?php endif; ?>