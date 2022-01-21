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

	<div class="deep-crypto-thumbnail">
		<?php deep_crypto_post_thumbnail(); ?>
	</div>

	<div class="deep-crypto-entry-content">
		<header class="deep-crypto-entry-header">
			<div class="deep-crypto-post-meta-date">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10"><path d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"/></svg>
				<span class="post-date"><?php echo esc_html( get_the_date() ); ?></span>
			</div>

			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div class="deep-crypto-excerpt">
			<?php deep_crypto_excerpt(); ?>
		</div>

		<div class="deep-crypto-author">
			<span class="deep-crypto-author-avatar"><?php echo get_avatar(esc_html(get_the_author_meta( 'ID' )), 30); ?></span>
			<span class="deep-crypto-author-name"><?php echo esc_html(get_the_author_meta( 'display_name' )) ?></span>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
