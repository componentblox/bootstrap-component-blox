<?php
/**
 * The template for posts content
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-component-blox
 */

?>

<?php

$image_id = get_post_thumbnail_id(get_the_ID());
$alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
$category = get_the_category();

if (has_post_thumbnail()) { ?>
	<img class="img-fluid rounded w-100" src="<?php echo esc_html(get_the_post_thumbnail_url());?>" alt="<?php echo esc_html($alt_text);?>"/>
<?php }?>

<h1 class="mt-4"><?php the_title();?></h1>

<div class="post_meta mb-3">
	<span class="author badge badge-light border p-2"><?php esc_attr_e( 'Published by', 'bootstrap-component-blox' );?> <?php the_author_posts_link();?></span>
	<span class="date badge badge-light border p-2"> <?php the_time('F j, Y');?></span> 
	<span class="date badge badge-light border p-2">Category: <?php if(!empty($category)) { echo '<a href="' .  esc_html(get_category_link($category[0]->term_id)) . '">' . esc_html( $category[0]->name );}?></a></span>
	
	<?php if(comments_open()) {?>
	
	<span class="comments badge badge-light border p-2">
		<?php if (comments_open(get_the_ID())) comments_popup_link( __( 'Leave your thoughts', 'bootstrap-component-blox' ), __( '1 Comment', 'bootstrap-component-blox' ), __( '% Comments', 'bootstrap-component-blox' ));?>
	</span>
	
	<?php }?>
</div>
<?php the_content();?>
<?php if(comments_open()) { get_template_part('post-comments'); }?>