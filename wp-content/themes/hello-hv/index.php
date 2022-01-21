<?php
/**
 * Index file - hellohv - Default Page
 * 
 * 
 * @version hellohv 1.9.0
 **/


get_header();

$thumb_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>

<?php
    if(is_front_page()){
        get_template_part( 'template-parts/panel/our', 'blog' ); 
    }
    else{
        ?>
            <section class="section">
                <div class="container">
                    <div class="sk_content_wrap">
                        <div class="sk_content">
                        <?php if($thumb_img ){ ?>
                            <figure class="sk_img_left">
                                <img src="<?php echo esc_url($thumb_img);?>" alt="<?php the_title_attribute();?>">
                            </figure>
                        <?php } ?>
                            <div class="editor_text">
                                <?php the_title('<h1 class="theme-heading">','</h1>');?>
                                <?php 
                                    while ( have_posts() ) : the_post();
                                        the_content();
                                        the_tags();
                                        wp_link_pages(
                                            array(
                                                'before'   => '<p class="page-nav">' . esc_html__( 'Pages:', 'hello-hv' ),
                                                'after'    => '</p>'
                                            )
                                        );
                                        paginate_comments_links(array(
                                            'screen_reader_text'=> __('Pagination','hello-hv'),
                                            'prev_text'=> __('Previous','hello-hv'),
                                            'next_text'=> __('Next','hello-hv'),
                                        ));
                                    endwhile; 
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php comments_template(); ?>
                </div>
            </section>
        <?php 
    }
?>

<?php get_footer(); ?>