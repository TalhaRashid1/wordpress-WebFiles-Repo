<?php

/**
 * Blog file - hellohv - Blog Panel
 * 
 * 
 * @version hellohv 1.9.0
 *
 * */

    $args = array( 

        'post_type' 		=> 'post', 
        'posts_per_page' 	=>  9,
        'post_status' 		=> 'publish',		

    );

    

    $blog_query = NULL;
    $blog_query = new WP_Query( $args );

    

    if ($blog_query->posts){

        ?>

        <section class="section hook-blog" id="news">
            <div class="container">
                <div class="blog_list">
                    <?php 
                        while ( $blog_query->have_posts() ) : $blog_query->the_post();				
                    ?>
                        <div class="sk_box">

                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                

                                    <div class="blog_info">

                                        <span class="day"><?php echo get_the_date('j'); ?></span>
                                        <span><?php echo get_the_date('M y'); ?></span>

                                    </div>
                                    <div class="blog_text">

                                        <h2 class="subheading"><a href="<?php echo esc_url(get_permalink());?>" title="<?php the_title();?>"><?php the_title('<h1 class="theme-heading">', '</h1>');?></a></h2>
                                        <div class="blog_para"><?php hellohv_stringModify(the_excerpt(), 0 , 80);?> <a href="<?php echo esc_url(get_permalink());?>" title="<?php the_title();?>"  class="readmore">
                                        <?php esc_html__( 'read more', 'hello-hv' ); ?>
                                    </a></div>

                                       

                                    </div>

                                

                            </div>

                        </div>
                    <?php endwhile;?>
                </div>
            </div>
        </section>

        <?php

    }

    wp_reset_postdata();



?>

