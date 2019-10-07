<?php 

/*
Template Name: Fullwidth
Template Post Type: post
*/

get_header();?>

<main id="main-container" class="row container mx-auto mt-5" role="main">
	<section class="col-12 px-4">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">

				<?php while ( have_posts() ) : the_post();?>
    		
					<?php get_template_part('post-content');?>

				<?php endwhile;?>
			
			</div>
		</article>
	</section>
</main>

<?php get_footer();?>