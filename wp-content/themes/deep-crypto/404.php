<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package deep crypto
 */

get_header();

/**
* The function is located in the following path
* deep-crypto/inc/class-deep-crypto-init.php
*/
do_action( 'deep_crypto_notfound_page' );

get_footer();
