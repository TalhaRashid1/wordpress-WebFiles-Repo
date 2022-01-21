<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package deep crypto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php the_post_thumbnail( 'full' ); ?>

	<div class="deep-crypto-entry-content-single">
        <header class="deep-crypto-entry-header-single">
            <?php
            the_title( '<h1 class="entry-title">', '</h1>' );
            ?>
        </header><!-- .entry-header -->
        <?php

        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'deep-crypto' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'deep-crypto' ),
                'after'  => '</div>',
            )
        );

        // Display Tags
        $tags = the_tags('<div class="deep-crypto-tags">'. esc_html__( 'Tags', 'deep-crypto' ) .': ',', ','</div>');

        if ( $tags ) {
            wp_kses_post($tags);
        }

		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
