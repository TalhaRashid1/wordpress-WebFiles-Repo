<?php
/**
 * Header file - hellohv - Default Header
 * 
 * 
 * @version hellohv 1.9.0
 **/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
    </head>

	<body <?php body_class(); ?>>
    <?php wp_body_open();?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hello-hv' ); ?></a>
    <header class="mainHeader">
        <div class="hbottom">
            <div class="container clearfix">
            <div class="logo">
                <?php the_custom_logo(); ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <p class="site-description"><?php echo esc_html(get_bloginfo( 'description', 'display' ));?></p>
            </div>
                <div class="nav_wrapper">
                    <nav class="nav_container">
                        <?php get_template_part( 'template-parts/navigation/navigation-primary' );?>
                    </nav>
                    <button class="menu-toggle responsive_btn" aria-controls="main-navigation" aria-expanded="false" type="button" >
                        <span></span>
                        <span aria-hidden="true"><?php esc_html_e( 'Menu', 'hello-hv' ); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <section>
        <?php 
        if(is_front_page()){
            get_template_part( 'template-parts/header/header', 'image' ); 
        }
        ?>
    </section>
    <div class="main" id="content">
    
    

		
