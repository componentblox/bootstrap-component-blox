<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bootstrap-component-blox
 */

if ( ! function_exists( 'bcb_posted_on' ) ) :
	
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */ 
	function bcb_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html( 'Posted on %s', 'post date', 'bootstrap-component-blox' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo esc_attr('<span class="posted-on">' . $posted_on . '</span>');

	}
endif;

if ( ! function_exists( 'bootstrap_component_blox_posted_by' ) ) :
	
	/**
	 * Prints HTML with meta information for the current author.
	 */ 
	function bcb_posted_by() {
		$byline = sprintf(
			esc_attr( 'by %s', 'post author', 'bootstrap-component-blox' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo esc_attr('<span class="byline"> ' . $byline . '</span>');

	}
endif;

if ( ! function_exists( 'bcb_entry_footer' ) ) :
	/** 
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function bcb_entry_footer() {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'bootstrap-component-blox' ) );
			if ( $categories_list ) {
				printf ( '<span class="cat-links">' . esc_attr( 'Posted in %1$s', 'bootstrap-component-blox' ) . '</span>', esc_html($categories_list));
			}

			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'bootstrap-component-blox' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_attr( 'Tagged %1$s', 'bootstrap-component-blox' ) . '</span>', esc_html($tags_list)); 
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					/* translators: %s: WordPress. */
					wp_kses(__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'bootstrap-component-blox' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					esc_attr( 'Edit <span class="screen-reader-text">%s</span>', 'bootstrap-component-blox' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'bcb_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function bcb_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif;
	}
endif;
