<?php 
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bootstrap-component-blox
 */

get_header();

if(!is_active_sidebar('sidebar-area-1')) {
    $column_value = '9 mx-auto';
} else {
    $column_value = '8';
}?>

<main id="main-container" class="row container mx-auto my-5" role="main">
	<section class="col-lg-<?php echo $column_value;?>">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">

				<?php 
				while (have_posts()) { the_post();
					get_template_part('template-parts/post/post' , 'content');
				}?>
			
			</div>
		</article>
	</section>

	<?php 
	if(is_active_sidebar('sidebar-area-1')) {?>
	<aside class="col-lg-4">
		<?php get_sidebar();?>
	</aside>
	<?php }?>

</main>

<?php get_footer();?>