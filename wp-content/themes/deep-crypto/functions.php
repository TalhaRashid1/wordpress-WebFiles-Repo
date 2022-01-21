<?php
/**
 * deep crypto functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package deep crypto
 */

if ( ! defined( 'DEEPCRYPTO' ) ) {
	define( 'DEEPCRYPTO', '1.0.2' );
}

if ( ! defined( 'DEEP_HANDLE' ) ) {
	define( 'DEEP_HANDLE', 'true' );
}

if ( ! defined( 'DEEP_CRYPTO_DIR' ) ) {
	define( 'DEEP_CRYPTO_DIR', trailingslashit( get_template_directory() ) );
}

if ( ! defined( 'DEEP_CRYPTO_URI' ) ) {
	define( 'DEEP_CRYPTO_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
}

if ( ! function_exists( 'the_deep_crypto_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function the_deep_crypto_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on deep, use a find and replace
		 * to change 'deep-crypto' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'deep-crypto', DEEP_CRYPTO_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'deep-crypto-custom-size', 270, 270, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'deep-crypto' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'deep_crypto_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */

		if ( ! defined( 'DEEPCORE' ) ) {
			add_theme_support(
				'custom-logo',
				array(
					'height'      => 250,
					'width'       => 250,
					'flex-width'  => true,
					'flex-height' => true,
				)
			);
		}
	}
endif;
add_action( 'after_setup_theme', 'the_deep_crypto_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function deep_crypto_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'deep_crypto_content_width', 640 );
}
add_action( 'after_setup_theme', 'deep_crypto_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function deep_crypto_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'deep-crypto' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'deep-crypto' ),
			'before_widget' => '<section id="%1$s" class="title-wrap widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'deep_crypto_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function deep_crypto_scripts() {
	wp_enqueue_style( 'deep-crypto-style', get_stylesheet_uri(), array(), DEEPCRYPTO );
	wp_style_add_data( 'deep-crypto-style', 'rtl', 'replace' );

	wp_enqueue_script( 'deep-crypto-navigation', DEEP_CRYPTO_URI . '/js/navigation.js', array(), DEEPCRYPTO, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'deep_crypto_scripts' );

/**
 * The Excerpt.
 */
function deep_crypto_excerpt() {
	$deep_crypto_excerpt = get_the_excerpt();

	$deep_crypto_excerpt = substr( $deep_crypto_excerpt, 0, 80 );
	$excerpt = substr( $deep_crypto_excerpt, 0, strrpos( $deep_crypto_excerpt, ' ' ) );
	$excerpt .= '...';

	echo wp_kses_post($excerpt);
}

/**
 * Custom template tags for this theme.
 */
require DEEP_CRYPTO_DIR . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require DEEP_CRYPTO_DIR . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require DEEP_CRYPTO_DIR . '/inc/customizer.php';

/**
 * Deep Init.
 */
require DEEP_CRYPTO_DIR . '/inc/class-deep-crypto-init.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require DEEP_CRYPTO_DIR . '/inc/jetpack.php';
}

if ( is_admin() ) {

	/**
	 * Load Plugin Activator.
	 */
	require_once DEEP_CRYPTO_DIR . '/inc/plugin-activator/deep-crypto-plugins.php';

	/**
	 * Admin
	 */
	require_once DEEP_CRYPTO_DIR . '/inc/class-deep-crypto-admin.php';

}
