<?php
/**
 * remove parent actions
 */
add_action( 'init', 'construction_choice_remove_action');

function construction_choice_remove_action() {
    remove_action('construction_light_action_banner_slider','construction_light_banner_slider', 25);
    remove_action('construction_light_action_about', 'construction_light_about', 35);   
    remove_action('construction_light_action_blog', 'construction_light_blog', 65); 
    remove_action('construction_light_action_counter', 'construction_light_counter', 60);
    remove_action('construction_light_action_team', 'construction_light_team', 75);

}

/**
 * Main Slider Function Area
*/
if (! function_exists( 'construction_choice_banner_slider' ) ):

    function construction_choice_banner_slider(){ 

        $all_slider = get_theme_mod('construction_light_slider');

        $banner_slider = json_decode( $all_slider );

        if ($banner_slider && $banner_slider[0]->slider_page ) {

         ?>

        <div id="banner-slider" class="banner-slider owl-carousel features-slider-<?php echo esc_attr(get_theme_mod('construction_light_nav_style', '1')); ?>">
            <?php 
                foreach ($banner_slider as $slider) {

                    $page_id = $slider->slider_page;

                if (!empty($page_id)) {

                    $slider_page = new WP_Query('page_id=' . $page_id);

                    if ($slider_page->have_posts()) { while ($slider_page->have_posts()) { $slider_page->the_post();
            ?>
                <div class="slider-item" data-img-url="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                    <div class="banner-table">
                        <div class="banner-table-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7 mx-auto">
                                        <div class="slider-content">
                                            <span class="super-title"><?php echo esc_html($slider->super_title); ?></span>
                                            <h2 class="slider-title">
                                                <?php the_title(); ?>
                                            </h2>
                                            <?php the_excerpt(); ?>
                                            <div class="btn-area video_calltoaction_wrap">
                                                <?php if (!empty( $slider->button_text ) ): ?>
                                                    <a href="<?php echo esc_url( $slider->button_url ); ?>" class="btn btn-primary">
                                                        <?php echo esc_html( $slider->button_text ); ?>
                                                        <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if (!empty( $slider->button_one_text ) ): ?>
                                                    <a href="<?php echo esc_url( $slider->button_one_url ); ?>" class="btn btn-border">
                                                        <?php echo esc_html($slider->button_one_text) ?>
                                                        <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                <?php endif; ?>
                                                
                                                <?php if (!empty( $slider->video_url ) ): ?>
                                                    <a href="<?php echo esc_url( $slider->video_url ); ?>" class="popup-youtube box-shadow-ripples">
                                                        <i class="fas fa-play "></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div> <!-- slider content end-->
                                    </div> <!-- col end-->
                                </div> <!-- row end-->
                            </div><!-- container end -->
                        </div><!-- banner table cell end -->
                    </div><!-- banner table end -->
                </div>
            <?php } } } } ?>
        </div><!-- Slider section end -->
    <?php } } 
endif;
add_action('construction_light_action_banner_slider', 'construction_choice_banner_slider', 25);

/**
 * About Us Section.
*/
if (! function_exists( 'construction_choice_about' ) ):

    function construction_choice_about(){ 

        $aboutus_options = get_theme_mod('construction_light_aboutus_service_section','enable');
        
        if( !empty( $aboutus_options ) && $aboutus_options == 'enable' ){
        ?>
        <section id="cl_aboutus" class="about_us_front">
            <div class="container">
                <div class="row">
                    <?php
                        $aboutus = get_theme_mod('construction_light_aboutus');

                        if (!empty( $aboutus ) ):

                        $aboutus_args = array(
                            'posts_per_page' => 1,
                            'post_type' => 'page',
                            'page_id' => $aboutus,
                            'post_status' => 'publish',
                        );

                        $aboutus_query = new WP_Query($aboutus_args);
                        $alignment = get_theme_mod('construction_light_aboutus_alignment', 'text-left');
                        if ( $aboutus_query->have_posts() ) : while ( $aboutus_query->have_posts() ) : $aboutus_query->the_post();
                    
                        $about_image = get_theme_mod('construction_light_aboutus_image');
                        if(filter_var($about_image, FILTER_VALIDATE_URL) === FALSE){
                            $about_image = get_theme_mod('construction_light_aboutus_image2');
                        }
                        $style = get_theme_mod('construction_light_aboutus_style', 'left');
                        $about_col = '';
                        if( !empty( $about_image ) ){
                            $about_col = 7;
                        }else{
                            $about_col = 12;
                        }
                        if($style == 'bottom'){
                            $about_col = 12;
                        }
                        
                        if (!empty($about_image) && $style == 'left'): ?>
                            <div class="col-lg-5 col-md-5 col-sm-12 align-part <?php echo esc_attr($alignment); ?>">
                                <img src="<?php echo esc_url( $about_image ); ?>"/>
                            </div>
                        <?php endif; ?>

                        <div class="col-lg-<?php echo intval( $about_col ); ?> col-md-<?php echo intval( $about_col ); ?> col-sm-12 <?php echo esc_attr($alignment); ?>">
                            <span class="small-title">About Us</span>
                            <h3 class="about-title"><?php the_title(); ?></h3>
                            
                            <?php
                                $aboutus_info = get_theme_mod('construction_light_aboutus_content', 'excerpt');
                                if ( !empty( $aboutus_info ) && $aboutus_info == 'excerpt') {

                                    the_excerpt();

                                } else {

                                    the_content();
                                } 
                            ?>

                            <?php 
                                $about_email  = get_theme_mod('construction_light_aboutus_email_address');
                                $about_phone  = get_theme_mod('construction_light_aboutus_phone_number');
                                $phone_number = preg_replace("/[^0-9]/","",$about_phone);

                                if( !empty( $about_email ) || !empty( $about_phone ) ){
                            ?>
                                <div class="address-info">
                                    <ul>
                                        <?php if( !empty( $about_email ) ){ ?>

                                            <li><?php esc_html_e('Email Us :','construction-choice'); ?>
                                                <a href="mailto:<?php echo esc_attr( antispambot( $about_email ) ); ?>">
                                                    <?php echo esc_html( antispambot( $about_email ) ); ?>
                                                </a>
                                            </li>

                                        <?php } if( !empty( $about_phone ) ){ ?>

                                            <li><?php esc_html_e('Contact Us :','construction-choice'); ?>
                                                <a href="tel:<?php echo intval( $phone_number ); ?>">
                                                    <?php echo esc_html( $about_phone ); ?>
                                                </a>
                                            </li>

                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>

                            <?php
                                $aboutus_info = get_theme_mod('construction_light_aboutus_content', 'excerpt');
                                
                                if( function_exists( 'pll_register_string' ) ){ 

                                    $about_button = pll__( get_theme_mod( 'construction_light_aboutus_button_text','Read More' ) ); 

                                }else{ 

                                    $about_button = get_theme_mod( 'construction_light_aboutus_button_text','Read More' );
                                }

                                if ( !empty( $aboutus_info ) && $aboutus_info == 'excerpt') {
                            ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                    <?php echo esc_html( $about_button ); ?><i class="fas fa-arrow-right"></i>
                                </a>

                            <?php } 

                                if (get_theme_mod('construction_light_aboutus_progressbar', true) == true):

                                $about_progressbar = get_theme_mod('construction_light_progressbar');

                                if (!empty( $about_progressbar ) ):
                            ?>
                                <div class="achivement-items">
                                    <ul>
                                        <?php
                                            $progressbars = json_decode($about_progressbar);
                                            foreach ($progressbars as $progressbar):
                                        ?>
                                            <li class="achivement-wrapper">
                                                <?php if($progressbar->progressbar_icon): ?>
                                                <span><i class="<?php echo esc_attr($progressbar->progressbar_icon); ?>"></i></span>
                                                <?php endif; ?>
                                                <div class="text-icon-wrap">
                                                    <span class="medium"><?php echo esc_html( $progressbar->progressbar_title ); ?></span>
                                                    <div class="timer achivement"><?php echo intval( $progressbar->progressbar_number ); ?></div>
                                                </div>
                                                
                                            </li>
                                        <?php endforeach; endif; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                        </div>


                        <?php if (!empty($about_image) && $style == 'right'): ?>
                            <div class="col-lg-5 col-md-5 col-sm-12 <?php echo esc_attr($alignment); ?>">
                                <img src="<?php echo esc_url( $about_image ); ?>"/>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($about_image) && $style == 'bottom'): ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3 <?php echo esc_attr($alignment); ?>">
                                <img src="<?php echo esc_url( $about_image ); ?>"/>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; endif; endif; ?>
                </div>
            </div>
        </section>
    <?php } }
endif;
add_action('construction_light_action_about', 'construction_choice_about', 35);

/**
 *  Blog Section.
*/
if (! function_exists( 'construction_choice_blog' ) ):
    function construction_choice_blog(){

        $title = get_theme_mod('construction_light_blog_title');
        $sub_title = get_theme_mod('construction_light_blog_sub_title');
        $alignment = get_theme_mod('construction_light_posts_alignment', 'center');
        $blog_options = get_theme_mod('construction_light_home_blog_section','enable');
        if( !empty( $blog_options ) && $blog_options == 'enable' ){
        ?>
        <section id="cl_blog" class="cons_light_blog-list-area">
            <div class="container">

                <?php construction_light_section_title( $title, $sub_title ); ?>

                <div class="row">
                    <?php
                        $blog = get_theme_mod('construction_light_blog');
                        $cat_id = explode(',', $blog);
                        $blog_posts = get_theme_mod('construction_light_posts_num', 'three');

                        if ($blog_posts == 'three') {

                            $post_num = 3;

                        } else {

                            $post_num = 6;

                        }

                        $args = array(
                            'posts_per_page' => $post_num,
                            'post_type' => 'post',
                            'tax_query' => array(

                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'term_id',
                                    'terms' => $cat_id
                                ),
                            ),
                        );

                        $blog_query = new WP_Query ($args);

                        if ( $blog_query->have_posts() ): while ( $blog_query->have_posts() ) : $blog_query->the_post();

                            if( function_exists( 'pll_register_string' ) ){ 

                                $blogreadmore_btn = pll__( get_theme_mod( 'construction_light_blogtemplate_btn', 'Continue Reading' ) );

                            }else{ 

                                $blogreadmore_btn = get_theme_mod( 'construction_light_blogtemplate_btn', 'Continue Reading' );

                            }
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 articlesListing blog-grid">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
                                <div class="blog-post-thumbnail">
                                    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <?php the_post_thumbnail('large'); ?>
                                        <span class="time-diffrence">
                                            <?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ) . ' ago'; ?>
                                        </span>
                                    </a>

                                    <div class="social-share">
                                        <a href="#" target="_blank">
                                            <i class="fas fa-search-plus"></i>
                                        </a>

                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>

                                        <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url(get_permalink()); ?>&text=" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="#" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>

                                         <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url(get_permalink()); ?>" target="_blank">
                                            <i class="fab fa-linkedin "></i>
                                        </a>

                                        <a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink()); ?>&media=&description=" target="_blank">
                                            <i class="fab fa-pinterest "></i>
                                        </a>

                                        <!-- <a href="mailto:info@example.com?&subject=&cc=&bcc=&body=<?php echo esc_url(get_permalink()); ?>" target="_blank">
                                            <i class="fab fa-play "></i>
                                        </a> -->

                                    </div>
                                </div>
                                <div class="box text-<?php echo esc_attr($alignment); ?>">
                                    <?php  the_title( '<h3 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );  ?>
                                </div>

                            </article><!-- #post-<?php the_ID(); ?> -->
                        </div>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </section>
    <?php } }
endif;
add_action('construction_light_action_blog', 'construction_choice_blog', 65);

/**
 *  Success Product Counter Section.
*/
if (! function_exists( 'construction_choice_counter' ) ):

    function construction_choice_counter(){
        
        $title = get_theme_mod('construction_light_counter_title');
        $sub_title = get_theme_mod('construction_light_counter_sub_title');

        $counter_bg = get_theme_mod('construction_light_counter_image');

        $counter_options = get_theme_mod('construction_light_counter_section','enable');
        if( !empty( $counter_options ) && $counter_options == 'enable' ){
        ?>
        <section id="cl_counter" class="cons_light_counter_wrap" style="background-image:url(<?php echo esc_url( $counter_bg ); ?>);">
            <div class="container">

                <?php construction_light_section_title( $title, $sub_title ); ?>

                <div class="row cons_light_team-counter-wrap">
                    <?php
                        $counter_page = get_theme_mod('construction_light_counter');

                        if (!empty($counter_page)):

                        $counters = json_decode($counter_page);
                        $i = 1;
                        foreach ( $counters as $counter ):
                    ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="cons_light_counter_part">
                                <div class="cons_light_counter-icon achivement-wrapper">
                                    <i class="<?php echo esc_attr( $counter->counter_icon ); ?>"></i>
                                </div>
                                <div class="text-icon-wrap">                               
                                <h6 class="cons_light_counter-title">
                                    <?php echo esc_html( $counter->counter_title ); ?>
                                </h6>
                                <div class="cons_light_counter_wrapper">
                                    <?php if( isset($counter->counter_prefix)): ?>
                                    <div class="counter_prefix"><?php echo esc_html($counter->counter_prefix); ?></div>
                                    <?php endif; ?>
                                    <div class="cons_light_counter-count odometer odometer<?php echo esc_attr($i); ?>" data-count="<?php echo absint($counter->counter_number); ?>">
                                        99
                                    </div>
                                    <?php if(isset($counter->counter_suffix)): ?>
                                    <div class="counter_suffix"><?php echo esc_html($counter->counter_suffix); ?></div>
                                    <?php endif; ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    <?php  $i++; endforeach; endif; ?>
                </div>
            </div>
        </section>
    <?php } }
endif;
add_action('construction_light_action_counter', 'construction_choice_counter', 60);

/**
 *  Our Team Member Section
*/
if (! function_exists( 'construction_choice_team' ) ):
    function construction_choice_team(){

        $title = get_theme_mod('construction_light_team_title');
        $sub_title = get_theme_mod('construction_light_team_sub_title');

        $team_layout = get_theme_mod('construction_light_team_layout', 'layout_one');
        $team_page = get_theme_mod('construction_light_team');

        $team_options = get_theme_mod('construction_light_team_options','enable');
        if( !empty( $team_options ) && $team_options == 'enable' ){
        ?>
        <section id="cl_team" class="cons_light_team_layout_two <?php echo esc_attr( $team_layout ); ?>">
            <div class="container">
                
                <?php construction_light_section_title( $title, $sub_title ); ?>

                <div class="row">
                    <?php

                        if (!empty( $team_page ) ):

                        $team_pages = json_decode($team_page);

                        foreach ($team_pages as $team_page):
                        
                        $page_id = $team_page->team_page;

                            if (!empty( $page_id )):

                            $team_query = new WP_Query('page_id=' . $page_id);

                            if ($team_query->have_posts()): while ($team_query->have_posts()): $team_query->the_post();
                    ?>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="box">
                                <figure>
                                    <?php
                                        if( !empty( $team_layout ) && $team_layout == 'layout_two') {

                                            the_post_thumbnail('thumbnail');

                                        } else {

                                            the_post_thumbnail('construction-choice-team');

                                        }
                                    ?>
                                </figure>

                                <div class="team-wrap">

                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                    <?php if (!empty( $team_page->designation ) ): ?>

                                        <span><?php echo esc_html($team_page->designation); ?></span>

                                    <?php endif; ?>

                                    <?php the_excerpt(); ?>

                                    <ul class="sp_socialicon">
                                        <?php if (!empty( $team_page->facebook ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $team_page->facebook ); ?>">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        <?php endif; if (!empty( $team_page->twitter ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($team_page->twitter); ?>">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                        <?php endif; if (!empty( $team_page->linkedin ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($team_page->linkedin); ?>">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        <?php endif; if (!empty( $team_page->instagram ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url($team_page->instagram); ?>">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>

                                </div>
                            </div>
                        </div>

                    <?php endwhile; endif; endif; endforeach; endif; ?>
                </div>
            </div>
        </section>
    <?php } }
endif;
add_action('construction_light_action_team', 'construction_choice_team', 75);