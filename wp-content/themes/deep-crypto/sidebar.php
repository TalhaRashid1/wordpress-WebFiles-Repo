<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package deep crypto
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

/**
 * The function is located in the following path
 * deep-crypto/inc/class-deep-crypto-init.php
 */
do_action( 'deep_crypto_sidebar' );