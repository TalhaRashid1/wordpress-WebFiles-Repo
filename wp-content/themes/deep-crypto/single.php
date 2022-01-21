<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package deep crypto
 */

get_header();

/**
 * The function is located in the following path
 * deep-crypto/inc/class-deep-crypto-init.php
 */
do_action( 'deep_crypto_single' );

get_footer();
