<?php
/**
 * Register post types.
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * @hook    init
 * @package WPEmergeTheme
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// add_action('init', function () {
//     register_post_type('product', [
//         'labels'              => [
//             'name'               => __('Sản phẩm', 'app'),
//             'singular_name'      => __('Sản phẩm', 'app'),
//             'add_new'            => __('Add New', 'app'),
//             'add_new_item'       => __('Add new Custom Type', 'app'),
//             'view_item'          => __('View Custom Type', 'app'),
//             'edit_item'          => __('Edit Custom Type', 'app'),
//             'new_item'           => __('New Custom Type', 'app'),
//             'search_items'       => __('Search Custom Types', 'app'),
//             'not_found'          => __('No custom types found', 'app'),
//             'not_found_in_trash' => __('No custom types found in trash', 'app'),
//         ],
//         'public'              => true,
//         'exclude_from_search' => false,
//         'show_ui'             => true,
//         'capability_type'     => 'post',
//         'hierarchical'        => false,
//         'has_archive' => true,
//         '_edit_link'          => 'post.php?post=%d',
//         'query_var'           => true,
//         'menu_icon'           => 'dashicons-admin-post',
//         'supports'            => ['title', 'editor', 'page-attributes'],
//         'rewrite'             => [
//             'slug'       => 'san-pham',
//             'with_front' => false,
//         ],
//     ]);
// });

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('More information | Thông tin thêm', 'gaumap'))
             ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('default')// high, core, default or low
             ->where('post_type', 'IN', ['product'])
             ->add_fields([
                 Field::make('text', 'origin', __('Origin | Xuất xứ'))
                    ->set_width(33.33),
                 Field::make('text', 'region', __('Region | Vùng'))
                    ->set_width(33.33),
                 Field::make('text', 'farm', __('Farm | Nông trại'))
                    ->set_width(33.33),
                 Field::make('text', 'variety', __('Variety | Giống'))
                    ->set_width(33.33),
                 Field::make('text', 'crop_year', __('Crop year | Năm thu hoạch'))
                    ->set_width(33.33)
                    ->set_default_value('--/202-'),
                 Field::make('text', 'altitude', __('Altitude | Độ cao'))
                    ->set_width(33.33)
                    ->set_default_value('masl'),
                 Field::make('select', 'process', __('Process | Phương pháp sơ chế'))
                    ->set_width(33.33)
                    ->add_options([
                        'washed' => __( 'Washed' ),
                        'decaf' => __( 'Decaf' ),
                        'natural' => __( 'Natural' ),
                        'honey' => __( 'Honey' ),
                    ]),
                 Field::make('text', 'net_weight', __('Net weight | Trọng lượng'))
                    ->set_width(33.33)
                    ->set_default_value('gram'),
                 Field::make('text', 'flavor_profile', __('Flavor profile | Hồ sơ hương vị'))
                    ->set_width(33.33),
                 Field::make('text', 'sca_coffee_score', __('SCA coffee score | Điểm cà phê SCA'))
                    ->set_width(33.33)
                    ->set_default_value('--/100'),
                 Field::make('text', 'sourcing', __('Sourcing | Nguồn cung ứng'))
                    ->set_width(33.33),
                 Field::make('text', 'paid_for_producer', __('Paid for producer'))
                    ->set_width(33.33)
                    ->set_default_value('USD/kg'),
                 Field::make('text', 'fob_price', __('FOB price'))
                    ->set_width(33.33)
                    ->set_default_value('USD/kg'),
                 Field::make('text', 'ddp_price', __('DDP price'))
                    ->set_width(33.33)
                    ->set_default_value('VND/kg'),

             ]);
});

