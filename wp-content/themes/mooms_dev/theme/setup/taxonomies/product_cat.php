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

// Custom hierarchical taxonomy (like categories).
// phpcs:disable

add_action('init', function () {
    register_taxonomy(
        'product_cat',
        array( 'product' ),
        array(
            'labels'            => array(
                'name'              => __( 'Danh mục sản phẩm', 'app' ),
                'singular_name'     => __( 'Custom Taxonomy', 'app' ),
                'search_items'      => __( 'Search Custom Taxonomies', 'app' ),
                'all_items'         => __( 'All Custom Taxonomies', 'app' ),
                'parent_item'       => __( 'Parent Custom Taxonomy', 'app' ),
                'parent_item_colon' => __( 'Parent Custom Taxonomy:', 'app' ),
                'view_item'         => __( 'View Custom Taxonomy', 'app' ),
                'edit_item'         => __( 'Edit Custom Taxonomy', 'app' ),
                'update_item'       => __( 'Cập nhật', 'app' ),
                'add_new_item'      => __( 'Thêm mới', 'app' ),
                'new_item_name'     => __( 'New Custom Taxonomy Name', 'app' ),
                'menu_name'         => __( 'Danh mục sản phẩm', 'app' ),
            ),
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'loai-san-pham' ),
        )
    );
});

// phpcs:enable

add_action('carbon_fields_register_fields', function () {
    Container::make('term_meta', __('Cài đặt', 'gaumap'))
             ->where('term_taxonomy', 'IN', ['product_cat'])
             ->add_fields([
                 // Field::make('separator', 'icon_tax_sepa', __('-----------Biểu tượng ', 'gaumap')),
                    Field::make('image', 'icon_tax', __('Icon ', 'gaumap'))->set_width(20),
                 // Field::make('separator', 'ads_tax_sepa', __('-----------ADS Danh mục menu', 'gaumap')),
                     Field::make('select','choose_ads',__('Hiển thị ADS','gaumap'))
                        ->set_width(30)
                        ->add_options([
                        '0' => __( 'Không hiển thị' ),
                        '1' => __( '1 ADS' ),
                        '2' => __( '2 ADS' ),
                    ]),

                     Field::make( 'complex', 'ads_img_1', __( 'Hình ảnh ADS (245x235)' ) )
                         ->set_layout( 'tabbed-horizontal' )
                         ->set_conditional_logic( [
                             'relation' => 'AND',
                             [
                                 'field' => 'choose_ads',
                                 'value' => '1',
                                 'compare' => '=',
                             ]])
                          ->add_fields( [
                              Field::make( 'image', 'img_ads', __( 'Hình ảnh' ) )->set_width(20),
                              Field::make( 'text', 'link_ads', __( 'Đường dẫn bài viết' ) )->set_width(60),
                            ] )
                            ->set_max(1),

                     Field::make( 'complex', 'ads_img_2', __( 'Hình ảnh ADS (245x235)' ) )
                          ->set_layout( 'tabbed-horizontal' )
                          ->set_conditional_logic( [
                              'relation' => 'AND',
                              [
                                  'field' => 'choose_ads',
                                  'value' => '2',
                                  'compare' => '=',
                              ]])
                          ->add_fields( [

                              Field::make( 'image', 'img_ads', __( 'Hình ảnh' ) )->set_width(20),
                              Field::make( 'text', 'link_ads', __( 'Đường dẫn bài viết' ) )->set_width(60),
                          ] )
                          ->set_max(2),
                 // Field::make('separator', 'ads_tax_sidebar_sepa', __('-----------ADS sidebar', 'gaumap')),
                    Field::make('image', 'ads_sidebar', __('ADS cạnh danh mục ', 'gaumap')),
                    Field::make('text', 'ads_sidebar_link', __('Đường dẫn bài viết ', 'gaumap')),

             ]);
});
