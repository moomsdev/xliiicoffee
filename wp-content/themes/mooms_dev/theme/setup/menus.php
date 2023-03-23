<?php
/**
 * Register menu locations.
 *
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 *
 * @hook    after_setup_theme
 * @package WPEmergeTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

register_nav_menus(
	[
		'main-menu' => __( 'Main Menu', 'app' ),
        // 'product-menu' => __( 'Products Menu', 'app' ),
        'footer-menu' => __( 'Footer Menu', 'app' ),
	]
);

/**
 * Create custom menu metaz
 */
// Container::make('nav_menu_item', __('Cài dặt mở rộng'))
//          ->add_fields([
//              Field::make('icon', 'menu_icon', __('Menu icon', 'gaumap')),
//          ]);
