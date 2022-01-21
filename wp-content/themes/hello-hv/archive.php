<?php
/**
 * The template for displaying archive pages
 *
 * @version hellohv 1.9.0
 */

get_header();
?>

	<main id="primary" class="site-main">
		<section class="section">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">

					<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->
						<div class="blog_list">
                    		<div class="ul row">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							$banner_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
							if(!$banner_image){
								$banner_image = get_template_directory_uri().'/assets/images/blog.jpg';
							}
							?>
							<div class="col-sm-6">
								<div class="sk_box">
									<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<a href="<?php echo esc_url(get_permalink());?>" title="<?php the_title();?>">
											<figure>
												<img src="<?php echo esc_url($banner_image);?>" alt="<?php the_title_attribute();?>">
												<div class="blog_info">
													<span><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
												</div>
											</figure>
											<div class="blog_text">
												<?php the_title('<h2 class="subheading">', '<h2>'); ?>
												<div class="blog_para"><?php hellohv_stringModify(the_excerpt(), 0 , 80);?></div>
												<span class="readmore"><?php esc_html__( 'Read More', 'hello-hv' ); ?></span>
											</div>
										</a>
									</div>
								</div>
							</div>
							<?php

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
					</div>
					</div>
				</div>
				<div class="col-sm-4">
				<?php get_sidebar();?>
				</div>
			</div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
