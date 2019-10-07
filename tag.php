<?php get_header(); ?>

<div class="container my-5">
    <div class="row">
    	<div class="col-md-8">

    		<h1><?php _e( 'Tag Archive: ', 'bootstrap-component-blox' ); echo single_tag_title('', false); ?></h1>
			<?php 
				get_template_part('loop');
				get_template_part('pagination'); 
			?>
		</div>

		<div class="col-md-4">
		    <?php get_sidebar();?>
		</div>

	</div>
</div>

<?php get_footer(); ?>

