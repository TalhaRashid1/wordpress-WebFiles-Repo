<?php
/**
 * The template for displaying full width pages
 *
 * Template Name: Full Width Page
 * @version hellohv 1.9.0
 *
 */

get_header();
$thumb_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>

	<main id="primary" class="site-main">

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
                                <h1 class="theme-heading"><?php the_title();?></h1>
                                <?php 
                                    while ( have_posts() ) : the_post();
                                        the_content();
                                    endwhile; 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

	</main><!-- #main -->

<?php
get_footer();
