<?php
/**
 * The template for displaying archive pages (category, tag, date, author)
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
				<?php do_action('bcb_before_content'); ?>
				<div class="row px-4">
					<div class="col-lg-8">
						<header class="archive-header mb-4">
							<?php the_archive_title('<h1 class="archive-title">', '</h1>'); ?>
							<?php the_archive_description('<div class="archive-description">', '</div>'); ?>
						</header>
						<?php
							get_template_part('template-parts/post/post', 'loop');
							get_template_part('template-parts/post/post', 'pagination');
						?>
					</div>

					<aside class="col-lg-4 px-0 px-lg-4">
						<?php get_sidebar(); ?>
					</aside>

				</div>
				<?php do_action('bcb_after_content'); ?>
			</div>

		</div>
	</article>
</main>

<?php get_footer(); ?>
