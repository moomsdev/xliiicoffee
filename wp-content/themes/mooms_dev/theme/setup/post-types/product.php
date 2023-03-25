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


add_action('init', function () {
    register_post_type('product', [
        'labels'              => [
            'name'               => __('Sản phẩm', 'app'),
            'singular_name'      => __('Sản phẩm', 'app'),
            'add_new'            => __('Add New', 'app'),
            'add_new_item'       => __('Add new Custom Type', 'app'),
            'view_item'          => __('View Custom Type', 'app'),
            'edit_item'          => __('Edit Custom Type', 'app'),
            'new_item'           => __('New Custom Type', 'app'),
            'search_items'       => __('Search Custom Types', 'app'),
            'not_found'          => __('No custom types found', 'app'),
            'not_found_in_trash' => __('No custom types found in trash', 'app'),
        ],
        'public'              => true,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'has_archive' => true,
        '_edit_link'          => 'post.php?post=%d',
        'query_var'           => true,
        'menu_icon'           => 'dashicons-admin-post',
        'supports'            => ['title', 'editor', 'page-attributes'],
        'rewrite'             => [
            'slug'       => 'san-pham',
            'with_front' => false,
        ],
    ]);
});

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Cài đặt', 'gaumap'))
             ->set_context('side')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('default')// high, core, default or low
             ->where('post_type', 'IN', ['product'])
             ->add_fields([
                 Field::make('image', 'avatar_hover', __('Ảnh đại diện - Hover')),
             ]);
});

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Thuộc tính sản phẩm', 'gaumap'))
             ->set_context('side')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('high')// high, core, default or low
             ->where('post_type', 'IN', ['product'])
             ->add_fields([
                 Field::make('select','choose_featured',__('Thuộc tính sản phẩm nổi bật','gaumap'))
                      ->set_width(30)
                      ->add_options([
                          '0' => __( 'Không có' ),
                          '1' => __( 'NEW' ),
                          '2' => __( 'HOT' ),
                      ]),
             ]);
});

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Chính sách', 'gaumap'))
             ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('core')// high, core, default or low
             ->where('post_type', 'IN', ['product'])
             ->add_fields([
                 Field::make('text','policy_shield-check',__('Chính sách bảo hành','gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('Bảo hành 12 tháng'),
                 Field::make('text','policy_sync',__('Chính sách đổi trả','gaumap'))
                      ->set_width(33.33)
                     ->set_default_value('Đổi trả trong vòng 30 ngày'),
                 Field::make('text','policy_bag-dollar',__('Chính sách thanh toán','gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('Thanh toán online'),

             ]);
});

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('THÔNG SỐ KỸ THUẬT', 'gaumap'))
             ->set_context('normal')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('high')// high, core, default or low
             ->where('post_type', 'IN', ['product'])
             ->add_fields([
                 Field::make('rich_text', 'tskt', __('Nội dung')),
             ]);
});
add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Mô tả ngắn', 'gaumap'))
             ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('high')// high, core, default or low
             ->where('post_type', 'IN', ['product'])
             ->add_fields([
                 Field::make('textarea', 'exceprt', __('Nội dung')),
             ]);
});
