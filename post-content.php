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

if (has_post_thumbnail()) { ?>
	<img class="img-fluid rounded w-100" src="<?php echo esc_html(get_the_post_thumbnail_url());?>" alt="<?php echo esc_html($alt_text);?>"/>
<?php }?>

<h1 class="mt-4"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></h1>

<div class="post_meta">
	<span class="author"><?php esc_attr_e( 'Published by', 'bootstrap-component-blox' );?> <?php the_author_posts_link();?></span>
	<span class="date">| <?php the_time('F j, Y');?></span>
	<?php if(the_category()) {?> <span class="category">| <?php the_category(', ');?> </span><?php }?>
	<?php if(comments_open()) {?>
	<span class="comments">
		<?php if (comments_open(get_the_ID())) comments_popup_link( __( 'Leave your thoughts', 'bootstrap-component-blox' ), __( '1 Comment', 'bootstrap-component-blox' ), __( '% Comments', 'bootstrap-component-blox' ));?>
	</span>
	<?php }?>
</div>
<hr>

<?php the_content();?>
<?php get_template_part('post-comments');?>