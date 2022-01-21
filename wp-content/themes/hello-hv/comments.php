<?php
/*
 * The template for displaying comments
 *
 * @version hellohv 1.9.0
 */
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$HV_News_comment_count = get_comments_number();
			if ( '1' === $HV_News_comment_count ) {
				printf(
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'hello-hv' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $HV_News_comment_count, 'comments title', 'hello-hv' ) ), number_format_i18n( $HV_News_comment_count ), 
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ul',
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'hello-hv' ); ?></p>
			<?php
		endif;

	endif; 

	comment_form();
	?>

</div>
