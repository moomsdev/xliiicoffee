<?php
/**
 * Plugin Name: ThumbPress - Stop Generating Unnecessary Thumbnails
 * Description: Stop generating unnecessary thumbnails and save your server space.
 * Plugin URI: https://codexpert.io
 * Author: Codexpert, Inc
 * Author URI: https://codexpert.io
 * Version: 4.0.4
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Text Domain: image-sizes
 * Domain Path: /languages
 */

namespace Codexpert\ThumbPress;
use Codexpert\Plugin\Widget;
use Codexpert\Plugin\Survey;
use Codexpert\Plugin\Notice;
use Codexpert\Plugin\Feature;
use Codexpert\Plugin\Deactivator;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main class for the plugin
 * @package Plugin
 * @author Codexpert <hi@codexpert.io>
 */
final class Plugin {
	
	/**
	 * Plugin instance
	 * 
	 * @access private
	 * 
	 * @var Plugin
	 */
	private static $_instance;

	/**
	 * The constructor method
	 * 
	 * @access private
	 * 
	 * @since 0.9
	 */
	private function __construct() {
		/**
		 * Includes required files
		 */
		$this->include();

		/**
		 * Defines contants
		 */
		$this->define();

		/**
		 * Runs actual hooks
		 */
		$this->hook();
	}

	/**
	 * Includes files
	 * 
	 * @access private
	 * 
	 * @uses composer
	 * @uses psr-4
	 */
	private function include() {
		require_once( dirname( __FILE__ ) . '/inc/functions.php' );
		require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
	}

	/**
	 * Define variables and constants
	 * 
	 * @access private
	 * 
	 * @uses get_plugin_data
	 * @uses plugin_basename
	 */
	private function define() {

		/**
		 * Define some constants
		 * 
		 * @since 0.9
		 */
		define( 'THUMBPRESS', __FILE__ );
		define( 'THUMBPRESS_DIR', dirname( THUMBPRESS ) );
		define( 'THUMBPRESS_ASSET', plugins_url( 'assets', THUMBPRESS ) );
		define( 'THUMBPRESS_DEBUG', apply_filters( 'image-sizes_debug', Helper::get_option( 'image-sizes_tools', 'enable_debug', false ) ) );

		/**
		 * The plugin data
		 * 
		 * @since 0.9
		 * @var $plugin
		 */
		$this->plugin					= get_plugin_data( THUMBPRESS );
		$this->plugin['basename']		= plugin_basename( THUMBPRESS );
		$this->plugin['file']			= THUMBPRESS;
		$this->plugin['server']			= apply_filters( 'image-sizes_server', 'https://codexpert.io/dashboard' );
		$this->plugin['icon']			= THUMBPRESS_ASSET . '/img/icon.png';
		$this->plugin['depends']		= [];
	}

	/**
	 * Hooks
	 * 
	 * @access private
	 * 
	 * Executes main plugin features
	 *
	 * To add an action, use $instance->action()
	 * To apply a filter, use $instance->filter()
	 * To register a shortcode, use $instance->register()
	 * To add a hook for logged in users, use $instance->priv()
	 * To add a hook for non-logged in users, use $instance->nopriv()
	 * 
	 * @return void
	 */
	private function hook() {

		if( is_admin() ) :

			/**
			 * Admin facing hooks
			 */
			$admin = new App\Admin( $this->plugin );
			$admin->action( 'admin_footer', 'modal' );
			$admin->action( 'admin_footer', 'upgrade' );
			$admin->action( 'plugins_loaded', 'i18n' );
			$admin->action( 'admin_enqueue_scripts', 'enqueue_scripts' );
			$admin->action( 'admin_head', 'set_init_sizes' );
			$admin->filter( 'intermediate_image_sizes_advanced', 'image_sizes' );
			$admin->filter( 'big_image_size_threshold', 'big_image_size', 10, 1 );
			$admin->filter( "plugin_action_links_{$this->plugin['basename']}", 'action_links' );
			$admin->filter( 'plugin_row_meta', 'plugin_row_meta', 10, 2 );
			$admin->action( 'admin_footer_text', 'footer_text' );
			$admin->action( 'admin_notices', 'admin_notices' );

			/**
			 * The setup wizard
			 */
			$wizard = new App\Wizard( $this->plugin );
			$wizard->action( 'plugins_loaded', 'render' );
			$wizard->filter( "plugin_action_links_{$this->plugin['basename']}", 'action_links' );

			/**
			 * Settings related hooks
			 */
			$settings = new App\Settings( $this->plugin );
			$settings->action( 'plugins_loaded', 'init_menu' );
			$settings->filter( 'cx-settings-reset', 'reset' );

			/**
			 * Asks to participate in a survey
			 * 
			 * @package Codexpert\Plugin
			 * 
			 * @author Codexpert <hi@codexpert.io>
			 */
			$survey = new Survey( $this->plugin );

			/**
			 * Blog posts from Codexpert blog
			 * 
			 * @package Codexpert\Plugin
			 * 
			 * @author Codexpert <hi@codexpert.io>
			 */
			$widget = new Widget( $this->plugin );

			/**
			 * Renders different notices
			 * 
			 * @package Codexpert\Plugin
			 * 
			 * @author Codexpert <hi@codexpert.io>
			 */
			$notice = new Notice( $this->plugin );

			/**
			 * Shows a popup window asking why a user is deactivating the plugin
			 * 
			 * @package Codexpert\Plugin
			 * 
			 * @author Codexpert <hi@codexpert.io>
			 */
			$deactivator = new Deactivator( $this->plugin );

			/**
			 * Alters featured plugins
			 * 
			 * @package Codexpert\Plugin
			 * 
			 * @author Codexpert <hi@codexpert.io>
			 */
			$feature = new Feature( $this->plugin );

		else : // !is_admin() ?

			/**
			 * Front facing hooks
			 */
			$front = new App\Front( $this->plugin );
			$front->action( 'wp_enqueue_scripts', 'enqueue_scripts' );
			$front->action( 'wp_footer', 'credit' );

		endif;

		/**
		 * Cron facing hooks
		 */
		$cron = new App\Cron( $this->plugin );
		$cron->activate( 'install' );
		$cron->deactivate( 'uninstall' );

		/**
		 * AJAX related hooks
		 */
		$ajax = new App\AJAX( $this->plugin );
		$ajax->priv( 'image_sizes-regen-thumbs', 'regen_thumbs' );
	}

	/**
	 * Cloning is forbidden.
	 * 
	 * @access public
	 */
	public function __clone() { }

	/**
	 * Unserializing instances of this class is forbidden.
	 * 
	 * @access public
	 */
	public function __wakeup() { }

	/**
	 * Instantiate the plugin
	 * 
	 * @access public
	 * 
	 * @return $_instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

Plugin::instance();