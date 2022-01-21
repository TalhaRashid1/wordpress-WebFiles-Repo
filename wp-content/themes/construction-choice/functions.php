<?php
/**
 * Describe child theme functions
 *
 * @package Construction Light
 * @subpackage Construction Business
 * 
 */

 if ( ! function_exists( 'construction_choice_setup' ) ) :

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Construction Business, use a find and replace
     * to change 'construction-choice' to the name of your theme in all the template files.
    */
    load_theme_textdomain( 'construction-choice', get_template_directory() . '/languages' );

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function construction_choice_setup() {
        
        $construction_choice_theme_info = wp_get_theme();
        $GLOBALS['construction_choice_version'] = $construction_choice_theme_info->get( 'Version' );
    }
endif;
add_action( 'after_setup_theme', 'construction_choice_setup' );


/**
 * Enqueue child theme styles and scripts
*/
function construction_choice_scripts() {
    
    global $construction_choice_version;

    wp_enqueue_style( 'construction-choice-fonts', construction_choice_fonts_url(), array(), null );
    wp_dequeue_style( 'construction-light-style' );
    
    wp_enqueue_style( 'construction-choice-parent-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'style.css', array(), esc_attr( $construction_choice_version ) );
    
    wp_enqueue_style( 'construction-choice-style', get_stylesheet_uri(), esc_attr( $construction_choice_version ) );

    wp_add_inline_style('construction-choice-style', construction_choice_dymanic_styles());

    wp_enqueue_style( 'construction-choice-responsive', get_template_directory_uri(). '/assets/css/responsive.css');

    wp_enqueue_script('construction-choice', get_stylesheet_directory_uri() . '/js/construction-choice.js', array('jquery','masonry'), esc_attr( $construction_choice_version ), true);

}
add_action( 'wp_enqueue_scripts', 'construction_choice_scripts', 20 );

function construction_choice_css_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}

/**
 * Dynamic Style
 */
function construction_choice_dymanic_styles() {
    
    $services_bg = get_theme_mod('construction_light_service_image');
 
    $customcss = "
 
        #cl_services{background-image: url(" . esc_url($services_bg) . "); background-size: cover; background-repeat: no-repeat;}

    ";

    return construction_choice_css_strip_whitespace($customcss);
}
/** modify customizer */
if ( ! function_exists( 'construction_choice_child_options' ) ) {

    function construction_choice_child_options( $wp_customize ) {
        // List All Pages
        $pages = array();

        $pages_obj = get_pages();

        $pages[''] = esc_html__('Select Page', 'construction-choice');

        foreach ($pages_obj as $page) {
            $pages[$page->ID] = $page->post_title;
        }
        // Normal Page Slider Type
		$wp_customize->add_setting('construction_light_slider', array(
		    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
		    'default' => json_encode(array(
		        array(
                    'super_title',
		            'slider_page' => '',
		            'button_text' => '',
		            'button_url' => '',
		            'button_one_text' => '',
		            'button_one_url' => '',
		            'video_url' => '',
		        )
		    ))
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control( $wp_customize, 
			'construction_light_slider', 

			array(
			    'label' 	   => esc_html__('Banner Slider Page Settings', 'construction-choice'),
			    'section' 	   => 'construction_light_slider_section',
			    'settings' 	   => 'construction_light_slider',
			    'cl_box_label' => esc_html__('Slider Settings Options', 'construction-choice'),
			    'cl_box_add_control' => esc_html__('Add New Slider', 'construction-choice'),
			),

		    array(
                'super_title' => array(
		            'type' => 'text',
		            'label' => esc_html__('Super Title', 'construction-choice'),
		            'default' => ''
		        ),

		        'slider_page' => array(
		            'type' => 'select',
		            'label' => esc_html__('Select Slider Page', 'construction-choice'),
		            'options' => $pages
		        ),

		        'button_text' => array(
		            'type' => 'text',
		            'label' => esc_html__('Enter First Button Text', 'construction-choice'),
		            'default' => ''
		        ),
		        
		        'button_url' => array(
		            'type' => 'url',
		            'label' => esc_html__('Enter First Button Url', 'construction-choice'),
		            'default' => ''
		        ),

		        'button_one_text' => array(
		            'type' => 'text',
		            'label' => esc_html__('Enter Second Button Text', 'construction-choice'),
		            'default' => ''
		        ),
		        
		        'button_one_url' => array(
		            'type' => 'url',
		            'label' => esc_html__('Enter Second Button Url', 'construction-choice'),
		            'default' => ''
		        ),

                'video_url' => array(
		            'type' => 'url',
		            'label' => esc_html__('Video URL', 'construction-choice'),
		            'default' => ''
		        ),
			)
		));
        
        

        // About Us Progress Bar.
		$wp_customize->add_setting('construction_light_progressbar', array(
		    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
		    'default' => json_encode(array(
		        array(
                    'progressbar_icon' => '',
		            'progressbar_title'  =>'',
		            'progressbar_number'  =>'',	            
		        )
		    ))
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control($wp_customize, 
			'construction_light_progressbar', 

			array(
			    'label' 	   => esc_html__('Achievement Awards Settings', 'construction-choice'),
			    'section' 	   => 'construction_light_aboutus_section',
			    'settings' 	   => 'construction_light_progressbar',
			    'cl_box_label' => esc_html__('Achievement Awards Settings', 'construction-choice'),
			    'cl_box_add_control' => esc_html__('Add New Awards', 'construction-choice'),
			    'active_callback' => 'construction_light_active_progressbar'
			),
		    array(
                'progressbar_icon' => array(
		            'type' => 'icons',
		            'label' => esc_html__('Icon', 'construction-choice'),
		            'default' => ''
		        ),

		        'progressbar_title' => array(
		            'type' => 'text',
		            'label' => esc_html__('Awards Title', 'construction-choice'),
		            'default' => ''
		        ),

		        'progressbar_number' => array(
		            'type' => 'text',
		            'label' => esc_html__('Achievement Awards Count', 'construction-choice'),
		            'default' => ''
		        ),
		        
			)
		));


    }
}
add_action( 'customize_register' , 'construction_choice_child_options', 11 );

/** include files */
require get_stylesheet_directory() . '/inc/theme-functions.php';
if ( ! function_exists( 'construction_choice_fonts_url' ) ) :

	/**
	 * Register Google fonts for Construction Light
	 *
	 * Create your own construction_choice_fonts_url() function to override in a child theme.
	 *
	 * @since Construction Light 1.0.0
	 *
	 * @return string Google fonts URL for the theme.
	 */

    function construction_choice_fonts_url() {

        $fonts_url = '';

        $font_families = array();

        
        if ( 'off' !== _x( 'on', 'Roboto: on or off', 'construction-choice' ) ) {
            $font_families[] = 'Roboto:400,400i,500,500i,700,700i';
        }
        if ( 'off' !== _x( 'on', 'El Messiri: on or off', 'construction-choice' ) ) {
            $font_families[] = 'El Messiri:400,400i,500,500i,700,700i';
        }

        if ( 'off' !== _x( 'on', 'Open Sans: on or off', 'construction-choice' ) ) {
            $font_families[] = 'Open Sans:300,400,600,700,800';
        }

        if( $font_families ) {

            $query_args = array(

                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return esc_url ( $fonts_url );
    }

endif;