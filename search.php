<?php get_header();?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            
			<h1 class="mb-5"><?php echo sprintf( __( '%s Search Results for ', 'bootstrap-component-blox' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>
        
        </div>
        
        <div class="col-md-4">
            <?php get_sidebar();?>
        </div>
        
    </div>
</div>

<?php get_footer();?>
