<?php
/**
 * Function file - hellohv - Default Function
 * 
 * 
 * @version hellohv 1.9.0
 **/


# Theme Setup
add_action('after_setup_theme', 'hellohv_setup');
function hellohv_setup()
{
    add_theme_support( 'custom-logo' );
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');
	register_nav_menus(
        array(
        'menu-1' => esc_html__('Primary Menu', 'hello-hv'),
        )
    );
	add_theme_support('editor-styles');
    add_editor_style('style-editor.css');

}

# Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'hellohv_load_scripts' );
function hellohv_load_scripts()
{
	wp_enqueue_style( 'hellohv-style', get_stylesheet_uri(), array(), '' );
	wp_style_add_data( 'hellohv-style', 'rtl', 'replace' );
	
	# CSS
	wp_enqueue_style('hellohv-main-style', get_template_directory_uri() . '/style.css',  array(), '1.9.0');
    wp_enqueue_style('hellohv-custom-style', get_template_directory_uri() . '/assets/css/custom-style.css',  array(), '1.9.0');
    

    # JS
	
	wp_localize_script( 'hellohv-scripts', 'hellohv', array(
        'ajaxurl' => esc_url( admin_url('admin-ajax.php') )
    ));
    
    if ( is_singular() && get_option('thread_comments') ) {
        wp_enqueue_script('comment-reply');
    }
}


# Set hellohv Content Width
if ( ! isset( $content_width ) ) { $content_width = 1170; }


/* -------------------------------------------------- */
function hellohv_stringModify($string, $start, $limit) {
	$str = trim(strip_tags($string));
	if($limit) {
		$str = trim(substr($str, $start, $limit));
		if(strlen($string)>$limit)
			$str .= '...';
	}
	return $str;
}

# hellohv Pagination
function hellohv_pagination()
{
    if ( get_the_posts_pagination() ) : ?>
    <div class="hellohv-pagination"><?php
        $args = array(
            'prev_text' => '<span class="fa fa-angle-left"></span>',
            'next_text' => '<span class="fa fa-angle-right"></span>'
        );
        the_posts_pagination($args);
    ?>
    </div>
    <?php
    endif;
}

# hellohv Register Sidebar
add_action( 'widgets_init', 'hellohv_widgets_init' );
function hellohv_widgets_init() {
    register_sidebar(array(
		'name'            => esc_html__('Sidebar', 'hello-hv'),
		'id'              => 'sidebar',
		'before_widget'   => '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>',
		'before_title'    => '<h4 class="widget-title">',
		'after_title'     => '</h4>'
	));
}

# Language 
load_theme_textdomain( 'hello-hv', get_template_directory() . '/languages' );
/* -------------------------------------------------- */
