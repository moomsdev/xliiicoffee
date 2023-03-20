<?php
/**
 * All public facing functions
 */
namespace Codexpert\ThumbPress\App;
use Codexpert\Plugin\Base;
use Codexpert\ThumbPress\Helper;
/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Front
 * @author Codexpert <hi@codexpert.io>
 */
class Front extends Base {

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

	/**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {
		$min = defined( 'THUMBPRESS_DEBUG' ) && THUMBPRESS_DEBUG ? '' : '.min';

		wp_enqueue_style( $this->slug, plugins_url( "/assets/css/front{$min}.css", THUMBPRESS ), '', $this->version, 'all' );
	}

	public function credit() {

		if( Helper::get_option( 'image-sizes_tools', 'footer_credit' ) != 'yes' ) return;

		$disclaimer = ' ';
		if( 1 == 2 && current_user_can( 'manage_options' ) ) {
			$disclaimer .= sprintf(
				'[<a href="%1$s" target="_blank">%2$s</a>]',
				add_query_arg( [
					'page'	=> 'image-sizes_setup',
					'step'	=> 'complete'
				], admin_url( 'admin.php' ) ),
				__( 'hide this', 'image-sizes' )
			);
		}

		echo '<p id="image-sizes-credit">';

		printf( __( 'Thumbnails managed by <a href="%s" target="_blank">ThumbPress</a>', 'image-sizes' ), 'https://codexpert.io/' );

		echo $disclaimer;

		echo '</p>';
	}
}