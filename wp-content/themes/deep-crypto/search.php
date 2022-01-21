<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package deep crypto
 */

get_header();

/**
 * The function is located in the following path
 * deep-crypto/inc/class-deep-crypto-init.php
 */
do_action( 'deep_crypto_search' );

get_footer();