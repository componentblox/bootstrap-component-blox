<?php 
/**
 * The template for displaying loop
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<?php if(bcb_check_template_name('index.php')) { $row_width = 2; } else { $row_width = 3; }?>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-<?php echo $row_width;?> g-4 g-lg-5">

	<?php
		if (have_posts()) {
		while (have_posts()) { the_post(); 		
	?>
	<div class="col">
		<div class="card h-100 border-0 shadow-lg">
			<?php if (has_post_thumbnail()) { ?>
			<a href="<?php echo get_the_permalink(); ?>" class="text-decoration-none" title="<?php the_title_attribute();?>">
				<img class="w-100 card-img-top object-fit-cover" src="<?php echo bcb_image_url(bcb_image_id(), 'medium');?>" alt="<?php echo bcb_image_alt(bcb_image_id());?>"/>
			</a>
			<?php }?>
			<div class="card-body p-4">
				<h4><a href="<?php echo get_the_permalink();?>" class="text-decoration-none text-dark" title="<?php the_title_attribute();?>"><?php the_title_attribute();?></a></h4>
		    	<p class="mb-0"><?php echo esc_html(wp_trim_words( get_the_content(),20, '...' ));?></p>
			</div>
			<div class="card-footer bg-transparent border-0 pt-0 pb-4 px-4">
				<a href="<?php echo get_the_permalink();?>" class="btn btn-dark"><?php esc_html_e('Read More' , 'bootstrap-component-blox');?></a>
			</div>
		</div>
	</div>

	<?php } } else { ?>
		<div class="col-lg-6 mx-auto">
			<p class="alert alert-warning text-center"><?php esc_html_e('No search result found. Please try again.' , 'bootstrap-component-blox');?></p>
			<?php get_template_part('searchform');?>
		</div>
	<?php }?>
 
</div>	