<?php

/**
 * Footer file - hellohv - Default Footer
 * 
 * 
 * @version hellohv 1.9.0
 **/

?>
</main>
    <section class="section hook-sidebar">
        <div class="container">
            <div class="widget-area">
                <?php dynamic_sidebar('sidebar'); ?>
            </div>
        </div>
    </section>

        <footer>
            <div class="copyright">
                <p><?php esc_html_e( '&copy;', 'hello-hv' ); ?> <?php echo date("Y"); ?> 
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <?php bloginfo( 'name' );?></a> <?php esc_html_e( 'All Rights Reserved.', 'hello-hv' ); ?>
                </p>
            </div>
        </footer>
        
        <?php wp_footer(); ?>
        
    </body>
</html>