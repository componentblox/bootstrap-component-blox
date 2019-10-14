<?php
/**
 * The template for displaying comments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootstrap-component-blox
 */

?>

<hr>
<div class="comments">
	<?php if (post_password_required()) : ?>
	<p><?php esc_html_e( 'Post is password protected. Enter the password to view any comments.', 'bootstrap-component-blox' ); ?></p>
</div>

<?php return; endif; ?>

<?php 
if (have_comments()) : ?>

<h4><small><?php comments_number(); ?></small></h4>

<ul><?php wp_list_comments( array('callback' => 'custom_comments') );?></ul>

<?php the_comments_navigation(); ?>

<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

<?php the_comments_navigation(); ?>

<p><?php esc_html_e( 'Comments are closed here.', 'bootstrap-component-blox' ); ?></p>

<?php endif; ?>

<?php comment_form(); ?>