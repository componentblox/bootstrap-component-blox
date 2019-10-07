<?php
function better_comments( $comment, $args, $depth ) {
	global $post;
	$author_id = $post->post_author;
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="pingback-entry">
			<span class="pingback-heading"><?php esc_html_e( 'Pingback:', 'bootstrap-component-blox' ); ?></span> 
			<?php comment_author_link(); ?>
		</div>
	
	<?php
		break;
		default :
	?>
	
	<li id="li-comment-<?php comment_ID();?>" class="p-3 mb-3 shadow-sm">
		<article id="comment-<?php comment_ID(); ?>" <?php comment_class('clr'); ?>>
			<div class="media mb-2">
				<?php echo get_avatar( $comment, 45 ); ?>
				<div class="media-body ml-3">
					
					<cite class="fn"><?php comment_author_link(); ?></cite>
					
					<div class="comment-date">
						<?php printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							sprintf( _x( '%1$s', '1: date', 'bootstrap-component-blox' ), get_comment_date() )
						); ?> 
					</div>
				
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'bootstrap-component-blox' ); ?></p>
					<?php endif; ?>
				
					<div class="comment-content entry clr">
						<?php comment_text(); ?>
					</div>
				
					<button class="btn btn-light float-right">
						<?php comment_reply_link( array_merge( $args, array(
						'reply_text' => esc_html__( 'Reply', 'bootstrap-component-blox' ),
						'depth'      => $depth,
						'max_depth'	 => $args['max_depth'] )
						) ); ?>
					</button>
					
				</div>
			</div>
		</article>
	<?php
		break;
	endswitch;
}