<?php
/**
 * Deep Crypto.
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Deep_Crypto_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Crypto_Admin
	 */
	public static $instance;

	/**
	 * Page title.
	 *
	 * @since   1.0.0
	 * @var     page_title
	 */
	public static $page_title = 'deep-crypto';

	/**
	 * Menu title.
	 *
	 * @since   1.0.0
	 * @var     menu_title
	 */
	public static $menu_title = 'Deep Theme';

	/**
	 * Plugin Slug.
	 *
	 * @since   1.0.0
	 * @var     plugin_slug
	 */
	public static $plugin_slug = 'deep-crypto';

	/**
	 * Provides access to a single instance of a module using the singleton pattern.
	 *
	 * @since   1.0.0
	 * @return  object
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Define the core functionality of the theme.
	 *
	 * Load the dependencies.
	 *
	 * @since   1.0.0
	 */
	public function __construct() {
        if ( ! is_admin() ) {
            return;
        }

		add_action( 'admin_menu', [$this, 'deep_crypto_admin_menu'] );
		add_action( 'deep_crypto_rate', [$this, 'deep_crypto_rate'] );
		add_action( 'admin_notices', [$this, 'deep_crypto_admin_notices'] );
		add_action( 'admin_enqueue_scripts', [$this, 'deep_crypto_admin_assets'] );
		add_action( 'deep_crypto_admin_header', [$this, 'deep_crypto_admin_header'] );
		add_action( 'deep_crypto_more_options', [$this, 'deep_crypto_more_options'] );
		add_action( 'deep_crypto_admin_content', [$this, 'deep_crypto_admin_content'] );
		add_action( 'deep_crypto_plugin_notice', [$this, 'deep_crypto_plugin_notice'] );
		add_action( 'deep_crypto_knowledge_base', [$this, 'deep_crypto_knowledge_base'] );
		add_action( 'deep_crypto_import_template', [$this, 'deep_crypto_import_template'] );
		add_action( 'deep_crypto_customizer_links', [$this, 'deep_crypto_customizer_links'] );
	}

	/**
	 * Deep Admin Assets.
	 *
	 * @since   1.0.0
	 */
	public function deep_crypto_admin_assets() {
		wp_enqueue_style( 'deep-crypto-admin-page', DEEP_CRYPTO_URI . 'inc/assets/css/deep-crypto-admin-page.css' , array(), DEEPCRYPTO );
	}

	/**
	 * Deep Admin Menu.
	 *
	 * @since   1.0.0
	 */
	public function deep_crypto_admin_menu() {
		$capability = 'manage_options';
		$menu_slug  = self::$plugin_slug;
		$page_title = self::$page_title;
		$menu_title = self::$menu_title;
		$admin_menu_callback = __CLASS__ . '::deep_crypto_admin_menu_callback';

		add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $admin_menu_callback );
	}

	/**
	 * Deep Admin Menu Callback.
	 *
	 * @since   1.0.0
	 */
	public static function deep_crypto_admin_menu_callback() {
		?>
		<div class="deep-crypto-admin-page">
			<?php
				do_action( 'deep_crypto_admin_header' );
				do_action( 'deep_crypto_admin_content' );
			?>
		</div>
		<?php
	}

	/**
	 * Deep Admin Header.
	 *
	 * @since   1.0.0
	 */
	public function deep_crypto_admin_header() {
		?>
		<div class="deep-crypto-admin-header">
			<div class="dp-admin-top-bar">
				<div class="dp-admin-top-title">
					<a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme/' ); ?>" target="_blank">
						<img src="<?php echo esc_url( DEEP_CRYPTO_URI . 'inc/assets/img/deep-logo.svg' ) ?>" width="120">
					</a>
				</div>
				<div class="dp-admin-top-links">
					<a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme/' ) ?>" target="_blank"><?php esc_html_e( 'Intro', 'deep-crypto' ); ?></a>
					<a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme/#demos' ) ?>" target="_blank"><?php esc_html_e( 'Demos', 'deep-crypto' ); ?></a>
					<a href="<?php echo esc_url( 'https://webnus.net/pricing/' ) ?>" target="_blank"><?php esc_html_e( 'Pro', 'deep-crypto' ); ?></a>
					<a href="<?php echo esc_url( 'https://webnus.net/support/' ); ?>" target="_blank"><?php esc_html_e( 'Support', 'deep-crypto' ); ?></a>
					<a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme-documentation/' ); ?>" target="_blank"><?php esc_html_e( 'Help', 'deep-crypto' ); ?></a>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Deep Admin Content.
	 *
	 * @since   1.0.0
	 */
	public function deep_crypto_admin_content() {
		?>
		<div class="deep-crypto-admin-content">
			<?php
				do_action( 'deep_crypto_plugin_notice' );
			?>
			<div class="deep-crypto-admin-left">
			<?php
				do_action( 'deep_crypto_customizer_links' );
				do_action( 'deep_crypto_more_options' );
			?>
			</div>
			<div class="deep-crypto-admin-right">
			<?php
				do_action( 'deep_crypto_import_template' );
				do_action( 'deep_crypto_knowledge_base' );
				do_action( 'deep_crypto_rate' );
			?>
			</div>
		</div>
		<?php
	}

	/**
	 * Deep Install plugin Notice.
	 *
	 * @since   1.0.0
	 */
	public static function deep_crypto_plugin_notice() {
		if ( ! defined( 'DEEPCOREPRO' ) ) {
			?>
			<div class="deep-crypto-plugin-notice">
				<?php if( ! defined( 'DEEPCORE' ) ): ?>
					<h2><?php esc_html_e( 'Enable all Features of the Deep theme', 'deep-crypto' ); ?></h2>
					<p><?php esc_html_e( 'In order to take full advantage of the Deep theme and enabling its demo importer, please install the recommended plugins.', 'deep-crypto' ); ?></p>
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>"><?php esc_html_e( 'Install Plugin', 'deep-crypto' ); ?></a>
				<?php else: ?>
					<h2><?php esc_html_e( 'Go Pro & Full Access to Advanced Features', 'deep-crypto' ); ?></h2>
					<p><?php esc_html_e( 'Get full access to more demos and all advanced features of Deep theme by upgrading to Pro version right away.', 'deep-crypto' ); ?></p>
					<a href="<?php echo esc_url( 'https://webnus.net/pricing/' ); ?>" target="_blank"><?php esc_html_e( 'Go Pro', 'deep-crypto' ); ?></a>
				<?php endif; ?>
			</div>
			<?php
		}
	}

	/**
	 * Deep Customizer Links.
	 *
	 * @since   1.0.0
	 */
	public function deep_crypto_customizer_links() {
		if ( is_plugin_active( 'deepcore/deepcore.php' ) || is_plugin_active( 'deep-core-pro/deep-core-pro.php' ) ) {
			$customizer_url = admin_url( 'customize.php' ) . '?autofocus[panel]=';

			$customizer_links = apply_filters(
				'deep_customizer_links',
				array(
					'general' => array(
						'name'     => __( 'General', 'deep-crypto' ),
						'icon'  => 'dashicons-admin-generic',
						'url' => $customizer_url . 'general_opts',
					),
					'typography'       => array(
						'name'     => __( 'Typography', 'deep-crypto' ),
						'icon'  => 'dashicons-editor-textcolor',
						'url' => $customizer_url . 'typography_opts',
					),
					'blog'   => array(
						'name'     => __( 'Blog Settings', 'deep-crypto' ),
						'icon'  => 'dashicons-welcome-write-blog',
						'url' => $customizer_url . 'blog-opts',
					),
					'styling'       => array(
						'name'     => __( 'Styling', 'deep-crypto' ),
						'icon'  => 'dashicons-layout',
						'url' => $customizer_url . 'styling_opts',
					),
					'header-builder'       => array(
						'name'     => __( 'Header Builder', 'deep-crypto' ),
						'icon'  => 'dashicons-align-center',
						'url' => admin_url( 'admin.php?page=webnus_header_builder' ),
					),
					'pages'  => array(
						'name'     => __( 'Pages Settings', 'deep-crypto' ),
						'icon'  => 'dashicons-welcome-write-blog',
						'url' => $customizer_url . 'pages_opts',
					),
					'footer'       => array(
						'name'     => __( 'Footer Settings', 'deep-crypto' ),
						'icon'  => 'dashicons-admin-generic',
						'url' => $customizer_url . 'start_footer_opts',
					),
					'sidebars'     => array(
						'name'     => __( 'Site Identity', 'deep-crypto' ),
						'icon'  => 'dashicons-format-image',
						'url' => admin_url( 'customize.php?autofocus[section]=title_tagline' ),
					),
				)
			);
			?>

			<div class="deep-crypto-customizer-links">
				<h2 class="deep-crypto-admin-title">
				<i class="dashicons dashicons-admin-customizer"></i>
				<?php esc_html_e( 'Start Customizing', 'deep-crypto' ); ?>
				</h2>
				<?php
				if ( ! empty( $customizer_links ) ) :
					?>
					<ul class="customizer-links">
						<?php
						foreach ( $customizer_links as $link ) {
							echo '<li><a href="' . esc_url( $link['url'] ) . '" target="_blank"><span class="dashicons ' . esc_attr( $link['icon'] ) . '"></span> ' . esc_html( $link['name'] ) . '</a></li>';
						}
						?>
					</ul>
				<?php endif; ?>
			</div>

			<?php
		}
	}

	/**
	 * Deep More Options.
	 *
	 * @since   1.0.0
	 */
	public function deep_crypto_more_options() {
		$more_options = apply_filters(
			'deep_crypto_pro_options',
			array(
				'header-builder' => array(
					'title' => __( 'Header Builder', 'deep-crypto' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/header-builder/',
						'text'    => __( 'Learn More', 'deep-crypto' ),
					),
				),
				'defined-headers' => array(
					'title' => __( 'Pre-defined Headers', 'deep-crypto' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/import-pre-defined-headers/',
						'text'    => __( 'Learn More', 'deep-crypto' ),
					),
				),
				'footer-builder' => array(
					'title' => __( 'Footer Builder', 'deep-crypto' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/footer-builder/',
						'text'    => __( 'Learn More', 'deep-crypto' ),
					),
				),
				'portfolio' => array(
					'title' => __( 'Portfolio', 'deep-crypto' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/webnus-portfolio/',
						'text'    => __( 'Learn More', 'deep-crypto' ),
					),
				),
				'gallery' => array(
					'title' => __( 'Gallery', 'deep-crypto' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/webnus-gallery/',
						'text'    => __( 'Learn More', 'deep-crypto' ),
					),
				),
				'shop' => array(
					'title' => __( 'Shop', 'deep-crypto' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/shop-theme-options/',
						'text'    => __( 'Learn More', 'deep-crypto' ),
					),
				),
				'typography' => array(
					'title' => __( 'Typography', 'deep-crypto' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/typography/',
						'text'    => __( 'Learn More', 'deep-crypto' ),
					),
				),
				'blog' => array(
					'title' => __( 'Blog Options', 'deep-crypto' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/blog-options/',
						'text'    => __( 'Learn More', 'deep-crypto' ),
					),
				),
				'importer' => array(
					'title' => __( 'One Click Demo Importer', 'deep-crypto' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/import-demo/',
						'text'    => __( 'Learn More', 'deep-crypto' ),
					),
				),
				'plugins' => array(
					'title' => __( 'Premium Plugins', 'deep-crypto' ),
					'link'  => array(
						'url'     =>   'https://webnus.net/deep-premium-wordpress-theme-documentation/other-premium-plugins/',
						'text'    => __( 'Learn More', 'deep-crypto' ),
					),
				),
			)
		);

		?>
		<div class="deep-crypto-more-options">
			<h2 class="deep-crypto-admin-title">
			<i class="dashicons dashicons-star-filled"></i>
			<?php esc_html_e( 'Deep Features', 'deep-crypto' ); ?>
			</h2>
			<?php
			if ( ! empty( $more_options ) ) :
				?>
				<ul class="pro-more-options">
					<?php
						foreach ( $more_options as $option ) {
							$title = $option['title'];
							$url   = $option['link']['url'];
							$text  = $option['link']['text'];

							echo '<li>';
								echo '<a href="' . esc_url( $url ) . '" target="_blank"> ' . esc_html( $title ) . ' <span> ' . esc_html( $text ) . ' <i class="dashicons dashicons-arrow-right-alt2"></i> </span> </a>';
							echo '</li>';
						}
					?>
				</ul>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Deep Import Starter Template.
	 *
	 * @since   1.0.0
	 */
	public function deep_crypto_import_template() {
		?>
		<div class="deep-crypto-import-template deep-crypto-r-admin">
			<h2><i class="dashicons dashicons-database-import"></i> <?php esc_html_e( 'Demo Importer', 'deep-crypto' ); ?></h2>
			<img src="<?php echo esc_url( DEEP_CRYPTO_URI . 'inc/assets/img/crypto-importer.jpg' ); ?>" width="245">
			<p>
			<?php esc_html_e( 'In order to import the demo, you need to install the Deep Core plugin.', 'deep-crypto' ); ?>
			</p>
			<p>
			<?php esc_html_e( 'Click', 'deep-crypto' ); ?> <a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme-documentation/import-demo/' )?>" target="_blank"><?php esc_html_e( 'here', 'deep-crypto' ); ?></a><?php esc_html_e( ' to see the documentation.', 'deep-crypto' ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Deep Knowledge Base.
	 *
	 * @since   1.0.0
	 */
	public function deep_crypto_knowledge_base() {
		?>
		<div class="deep-crypto-knowledge-base deep-crypto-r-admin">
			<h2><i class="dashicons dashicons-book"></i> <?php esc_html_e( 'Knowledge Base', 'deep-crypto' ); ?></h2>
			<p><?php esc_html_e( 'To find out more details of the features and sections please follow the documentation.', 'deep-crypto' ); ?></p>
			<p><a href="<?php echo esc_url( 'https://webnus.net/deep-premium-wordpress-theme-documentation/' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'deep-crypto' ); ?></a></p>
		</div>
		<?php
	}

	/**
	 * Deep Rate.
	 *
	 * @since   1.0.0
	 */
	public function deep_crypto_rate() {
		?>
		<div class="deep-crypto-rate deep-crypto-r-admin">
			<h2><i class="dashicons dashicons-star-filled"></i> <?php esc_html_e( 'Rate us', 'deep-crypto' ); ?></h2>
			<p><?php esc_html_e( 'If you interested in the Deep Theme please rate us on WordPress.', 'deep-crypto' ); ?></p>
			<p><a href="<?php echo esc_url( 'https://wordpress.org/support/theme/deep/reviews/#new-post' ); ?>" target="_blank"><?php esc_html_e( 'Rate Us', 'deep-crypto' ); ?></a></p>
		</div>
		<?php
	}

	/**
	 * Deep Admin Notices.
	 *
	 * @since   1.0.0
	 */
	public function deep_crypto_admin_notices() {
		$screen = get_current_screen();

		if ( $screen -> id == 'dashboard' || $screen -> id == 'themes' || $screen -> id == 'plugins' ) {
			if ( ! get_theme_mod( 'deep_crypto_install' ) ) set_theme_mod( 'deep_crypto_install', 'true' );

			if ( ! defined( 'DEEPCOREPRO' ) ) {

				if ( get_theme_mod( 'deep_crypto_install' ) == 'false' ) {
					return;
				}

				if ( isset( $_GET['deep_crypto_hide'] ) && $_GET['deep_crypto_hide'] == 'false' ) {
					if ( isset( $_GET['deep_crypto_hide'] ) ) {
						set_theme_mod( 'deep_crypto_install', 'false' );
					}

					return;
				}

				?>
				<div class="deep-crypto-admin-notice">
					<?php
					self::deep_crypto_plugin_notice();
					?>
					<a class="notice-dismiss" href="?deep_crypto_hide=false"></a>
				</div>
				<?php
			}
		}
	}

}
// Run
Deep_Crypto_Admin::get_instance();
