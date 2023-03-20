<?php
/**
 * All settings related functions
 */
namespace Codexpert\ThumbPress\App;
use Codexpert\ThumbPress\Helper;
use Codexpert\Plugin\Base;
use Codexpert\Plugin\Settings as Settings_API;

/**
 * @package Plugin
 * @subpackage Settings
 * @author Codexpert <hi@codexpert.io>
 */
class Settings extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];
	}
	
	public function init_menu() {
		
		$site_config = [
			'PHP Version'				=> PHP_VERSION,
			'WordPress Version' 		=> get_bloginfo( 'version' ),
			'WooCommerce Version'		=> is_plugin_active( 'woocommerce/woocommerce.php' ) ? get_option( 'woocommerce_version' ) : 'Not Active',
			'Memory Limit'				=> defined( 'WP_MEMORY_LIMIT' ) && WP_MEMORY_LIMIT ? WP_MEMORY_LIMIT : 'Not Defined',
			'Debug Mode'				=> defined( 'WP_DEBUG' ) && WP_DEBUG ? 'Enabled' : 'Disabled',
			'Active Plugins'			=> get_option( 'active_plugins' ),
		];

		$settings = [
			'id'            => $this->slug,
			'label'         => __( 'ThumbPress', 'image-sizes' ),
			'title'         => sprintf( '%1$s v%2$s', __( 'ThumbPress', 'image-sizes' ), $this->version ),
			'header'        => $this->name,
			'parent'		=> 'upload.php',
			'sections'      => [
				'prevent_image_sizes'	=> 	[
					'id'        => 'prevent_image_sizes',
					'label'     => __( 'Disable Thumbnails', 'image-sizes' ),
					'icon'      => 'dashicons-images-alt2',
					'sticky'	=> false,
					'content'	=> Helper::get_template( 'disable-sizes', 'views/settings', [ 'image_sizes' => get_option( '_image-sizes', [] ) ] ),
					'fields'    => []
				],
				'image-sizes_regenerate'	=> [
					'id'        => 'image-sizes_regenerate',
					'label'     => __( 'Regenerate', 'image-sizes' ),
					'icon'      => 'dashicons-format-gallery',
					'hide_form'	=> true,
					'content'	=> Helper::get_template( 'regenerate-thumbnails', 'views/settings' ),
					'fields'    => []
				],
				'image-sizes_tools'	=> [
					'id'        => 'image-sizes_tools',
					'label'     => __( 'Tools', 'image-sizes' ),
					'icon'      => 'dashicons-hammer',
					'sticky'	=> false,
					'fields'    => [
						'enable_debug' => [
							'id'      	=> 'enable_debug',
							'label'     => __( 'Enable Debug', 'image-sizes' ),
							'type'      => 'switch',
							'desc'      => __( 'Enable this if you face any CSS or JS related issues.', 'image-sizes' ),
							'disabled'  => false,
						],
						'report' => [
							'id'      => 'report',
							'label'     => __( 'Report', 'image-sizes' ),
							'type'      => 'textarea',
							'desc'     	=> '<button id="image-sizes_report-copy" class="button button-primary"><span class="dashicons dashicons-admin-page"></span></button>',
							'columns'   => 24,
							'rows'      => 10,
							'default'   => json_encode( $site_config, JSON_PRETTY_PRINT ),
							'readonly'  => true,
						],
						'footer_credit' => [
							'id'      	=> 'footer_credit',
							'label'     => __( 'Footer Credit', 'image-sizes' ),
							'type'      => 'radio',
							'desc'      => __( 'Show appreciation for our work with footer credit. It\'s optional, but we recommend you keep this checked and help spread the word.', 'image-sizes' ),
							'options'	=> [
								'yes'	=> __( 'Yes', 'image-sizes' ),
								'no'	=> __( 'No', 'image-sizes' ),
							],
							'default'	=> 'yes'
						],
					]
				],
			],
		];

		new Settings_API( $settings );
	}

	public function reset( $option_name ) {
		if( $option_name == 'prevent_image_sizes' ) {
			update_option( '_image-sizes', Helper::default_image_sizes() );
		}
	}
}