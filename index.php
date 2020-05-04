<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootstrap-component-blox
 */

get_header(); ?>

<main id="main-container" role="main" class="container-fluid px-0">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">

			<div class="container my-5">
				<div class="row">
					<div class="col-12 col-lg-8 px-5">
						<?php 
							get_template_part('loop');
							get_template_part('pagination'); 
						?>
					</div>

					<aside class="col-12 col-lg-4 px-5 border-left">
						<?php get_sidebar();?>
					</aside>

				</div>
			</div>

		</div>
	</article>
</main>

<?php get_footer(); ?>