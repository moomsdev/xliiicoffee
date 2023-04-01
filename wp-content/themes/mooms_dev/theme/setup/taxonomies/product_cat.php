<?php
/**
 * Register custom taxonomies.
 *
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 *
 * @hook    init
 * @package WPEmergeTheme
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('carbon_fields_register_fields', function () {
    Container::make('term_meta', __('More option | Thêm lựa chọn', 'gaumap'))
             ->where('term_taxonomy', 'IN', ['product_cat'])
             ->add_fields([
                     Field::make('radio_image','display_type', __('Display type | Kiểu hiển thị','gaumap'))
                        ->set_options([
                        'grid-card' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/grid-card-type.jpg' ,
                        'grid-content-img' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/grid-content-img-type.png' ,
                    ]),
             ]);
});
