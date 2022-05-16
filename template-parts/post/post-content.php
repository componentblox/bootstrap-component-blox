<?php
/**
 * The template for displaying post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<?php

$category = get_the_category();

if (bcb_image_url(bcb_image_id())) {?>
	<img id="bcb-featured-image" class="w-100" src="<?php echo bcb_image_url(bcb_image_id());?>" alt="<?php echo bcb_image_alt(bcb_image_id());?>"/>
<?php }?>

<h1 class="mt-4"><?php the_title_attribute();?></h1>
<div class="post-meta mb-3">
	<span class="author me-2 small"><?php esc_html_e( 'Published by ', 'bootstrap-component-blox' );?> <?php the_author_posts_link();?></span>
	<span class="date me-2 small"><?php the_time('F j, Y');?></span> 
	
	<?php if(!empty($category)) {?>
	    <span class="category small"><?php esc_html_e('Category: ' , 'bootstrap-component-blox'); if(!empty($category)) { echo '<a href="' .  esc_url(get_category_link($category[0]->term_id)) . '">' . esc_html( $category[0]->name );}?></a></span>
    <?php }?>

	<?php if(comments_open()) {?>
    	<span class="comments badge badge-light border p-2">
    		<?php if (comments_open(get_the_ID())) comments_popup_link( __( 'Leave your thoughts', 'bootstrap-component-blox' ), __( '1 Comment', 'bootstrap-component-blox' ), __( '% Comments', 'bootstrap-component-blox' ));?>
    	</span>
	<?php }?>
</div>

<?php the_content();?>
<?php if(comments_open()) { get_template_part('template-parts/post/post' , 'comments'); }?>