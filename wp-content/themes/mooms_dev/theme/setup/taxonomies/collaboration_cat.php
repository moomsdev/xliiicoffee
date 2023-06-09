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
if (!defined('ABSPATH')) {
    exit;
}
// Custom hierarchical taxonomy (like categories).
// phpcs:disable
add_action('init', function () {
    register_taxonomy(
        'collaboration_cat',
        ['collaboration'],
        [
            'labels'    => [
                                'name'              => __('Danh mục CO', 'app'),
                                'singular_name'     => __('Danh mục Co', 'app'),
                                'search_items'      => __('Tìm kiếm Danh mục', 'app'),
                                'all_items'         => __('Tất cả Danh mục', 'app'),
                                'parent_item'       => __('Parent item', 'app'),
                                'parent_item_colon' => __('Danh mục cha:', 'app'),
                                'view_item'         => __('Hiển thị Danh mục', 'app'),
                                'edit_item'         => __('Chỉnh sửa Danh mục', 'app'),
                                'update_item'       => __('Cập nhật Danh mục', 'app'),
                                'add_new_item'      => __('Thêm mới Danh mục', 'app'),
                                'new_item_name'     => __('Tên mới Danh mục', 'app'),
                                'menu_name'         => __('Danh mục', 'app'),
                           ],
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'collaboration-cat'],
        ]
    );
});
// phpcs:enable

add_action('carbon_fields_register_fields', function () {
    Container::make('term_meta', __('More option | Thêm lựa chọn', 'gaumap'))
             ->where('term_taxonomy', 'IN', ['collaboration_cat'])
             ->add_fields([
                 Field::make('radio_image','co_display_type', __('Display type | Kiểu hiển thị','gaumap'))
                      ->set_options([
                          'partner-cat' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/partner-cat.png' ,
                          'customer-cat' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/customer-cat.png' ,
                          'colleague-cat' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/colleague-cat.png' ,
                      ]),
             ]);
});
