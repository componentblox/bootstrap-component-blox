<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootstrap-component-blox
 */

get_header();?>

<main id="main-container" role="main" class="container-fluid px-0">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">

			<div class="container my-5">
				<div class="row px-4">
					<div class="col-12 col-lg-8">
						<?php 
							get_template_part('template-parts/post/post' , 'loop');
							get_template_part('template-parts/post/post' , 'pagination'); 
						?>
					</div>

					<aside class="col-12 col-lg-4 px-0 px-lg-4">
						<?php get_sidebar();?>
					</aside>

				</div>
			</div>

		</div>
	</article>
</main>

<?php get_footer();?>