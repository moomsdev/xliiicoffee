<?php
/**
 * Register post types.
 *
 * @link    https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * @hook    init
 * @package WPEmergeTheme
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

if (!defined('ABSPATH')) {
    exit;
}

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Product gallery | Thư viện sản phẩm', 'gaumap'))
             ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('high')// high, core, default or low
             ->where('post_type', 'IN', ['product'])
             ->add_fields([
                 Field::make('complex', 'product_gallery', __('', 'gaumap'))
                      ->set_layout('tabbed-horizontal')
                      ->add_fields([
                          Field::make('image', 'img_gallery_product', __('', 'gaumap')),
                      ]),
             ]);
});

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('More information | Thông tin thêm', 'gaumap'))
             ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
             ->set_priority('default')// high, core, default or low
             ->where('post_type', 'IN', ['product'])
             ->add_tab(__('Product information | Thông tin sản phẩm', 'gaumap'), [
                 Field::make('text', 'origin', __('Origin | Xuất xứ', 'gaumap'))
                      ->set_width(33.33),
                 Field::make('text', 'region', __('Region | Vùng', 'gaumap'))
                      ->set_width(33.33),
                 Field::make('text', 'farm', __('Farm | Trang trại', 'gaumap'))
                      ->set_width(33.33),
                 Field::make('text', 'variety', __('Variety | Giống', 'gaumap'))
                      ->set_width(33.33),
                 Field::make('text', 'crop_year', __('Crop year | Năm thu hoạch', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('--/202-'),
                 Field::make('text', 'altitude', __('Altitude | Độ cao', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('masl'),
                 Field::make('text', 'process', __('Process | Phương pháp sơ chế', 'gaumap'))
                      ->set_width(33.33),
                 Field::make('text', 'net_weight', __('Net weight | Trọng lượng', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('gram'),
                 Field::make('text', 'flavor_profile', __('Flavor profile | Hồ sơ hương vị', 'gaumap'))
                      ->set_width(33.33),
                 Field::make('text', 'sca_coffee_score', __('SCA coffee score | Điểm cà phê SCA', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('--/100'),
                 Field::make('text', 'sourcing', __('Sourcing | Nguồn cung ứng', 'gaumap'))
                      ->set_width(33.33),
                 Field::make('text', 'paid_for_producer', __('Paid for producer | Trả tiền cho nhà sản xuất', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('USD/kg'),
                 Field::make('text', 'fob_price', __('FOB price | Giá FOB', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('USD/kg'),
                 Field::make('text', 'ddp_price', __('DDP price | Giá DDP', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('VND/kg'),

             ])
             ->add_tab(__('Collaboration | Cộng tác', 'gaumap'), [
                 Field::make('text', 'title_collaboration', __('Title | Tiêu đề', 'gaumap')),
                 Field::make('rich_text', 'desc_collaboration', __('Description | Mô tả', 'gaumap')),
                 Field::make('complex', 'table_collaboration', __('Info table | Bảng thông tin', 'gaumap'))
                      ->set_layout('tabbed-vertical')
                      ->add_fields([
                          Field::make('text', 'title_table', __('Title | Tiêu đề', 'gaumap'))
                               ->set_width(50),
                          Field::make('text', 'dest_table', __('Desc | Mô tả', 'gaumap'))
                              ->set_width(50),
                      ])->set_header_template('<% if (title_table) { %><%- title_table %><% } %>'),
                 Field::make('association', 'url_collaboration_product', __('Choose article | Chọn bài viết', 'gaumap'))
                     ->set_width(50)
                     ->set_max(1)
                     ->set_types([
                         [
                              'type'      => 'post',
                              'post_type' => 'collaboration',
                         ],
                     ]),
                 Field::make('textarea', 'map_farm_product', __('Farm location | Vị trí trang trại', 'gaumap')),

             ])
             ->add_tab(__('Journal | Trải nhiệm', 'gaumap'), [
                 Field::make('rich_text', 'desc_journal', __('Description | Mô tả', 'gaumap')),
                 Field::make('text', 'aroma_journal', __('Aroma', 'gaumap'))
                      ->set_width(50),
                 Field::make('text', 'hot_journal', __('Hot', 'gaumap'))
                      ->set_width(50),
                 Field::make('text', 'warm_journal', __('Warm', 'gaumap'))
                      ->set_width(50),
                 Field::make('text', 'cold_journal', __('Cold', 'gaumap'))
                      ->set_width(50),
                 Field::make('text', 'aftertaste_journal', __('Aftertaste', 'gaumap'))
                      ->set_width(50),
                 Field::make('text', 'acidity_journal', __('Acidity', 'gaumap'))
                      ->set_width(50),
                 Field::make('text', 'body_journal', __('Body', 'gaumap'))
                      ->set_width(50),
                 Field::make('text', 'balance_journal', __('Balance', 'gaumap'))
                      ->set_width(50),

                 Field::make('oembed', 'video_journal', __('Video', 'gaumap'))
                      ->set_width(85),
                 Field::make( 'radio', 'video_position', __( '', 'gaumap'))
                      ->set_width(15)
                      ->set_options([
                          'left' => __( 'Left' ),
                          'right' => __( 'Right' ),
                      ]),
                 Field::make('association', 'url_journal_product', __('Choose article | Chọn bài viết', 'gaumap'))
                      ->set_max(1)
                      ->set_types([
                          [
                              'type'      => 'post',
                              'post_type' => 'journal',
                          ],
                      ]),

             ])
             ->add_tab(__('Roasting profile', 'gaumap'), [
                 Field::make('text', 'title_roasting_profile', __('Title | Tiêu đề', 'gaumap'))
                      ->set_width(70)
                      ->set_default_value('Roasting profile'),
                 Field::make('image', 'img_roasting_profile', __('Image | Hình ảnh', 'gaumap'))
                      ->set_width(30),

                 Field::make('text', 'roast_machine', __('Roast Machine', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('Giesen W1A'),
                 Field::make('text', 'roasting_profile', __('Roast Profile', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('-- USD/kg'),
                 Field::make('text', 'roast_duration', __('Roast Duration', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('-- USD/kg'),
                 Field::make('text', 'drying_phase', __('Drying Phase', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('-- VND/kg'),
                 Field::make('text', 'maillard_phase', __('Maillard Phase', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('Giesen W1A'),
                 Field::make('text', 'development_phase', __('Development Phase', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('-- USD/kg'),
                 Field::make('text', 'development_ratio', __('Development Ratio', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('-- USD/kg'),
                 Field::make('text', 'charge_temperature', __('Charge Temperature', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('-- VND/kg'),
                 Field::make('text', 'turning_point', __('Turning Point', 'gaumap'))
                      ->set_width(33.33)
                      ->set_default_value('-- Celsius'),
                 Field::make('text', 'dry_end_temperature', __('Dry-end Temperature', 'gaumap'))
                      ->set_width(25)
                      ->set_default_value('-- Celsius'),
                 Field::make('text', 'first_crack_temperature', __('First Crack Temperature', 'gaumap'))
                      ->set_width(25)
                      ->set_default_value('-- Celsius'),
                 Field::make('text', 'end_bean_temperature', __('End Bean Temperature', 'gaumap'))
                      ->set_width(25)
                      ->set_default_value('-- Celsius'),
                 Field::make('text', 'end_air_temperature', __('End Air Temperature', 'gaumap'))
                      ->set_width(25)
                      ->set_default_value('-- Celsius'),


                 Field::make('select', 'choose_post_type_roasting_profile', __('Choose post type | Chọn loại bài viết ', 'gaumap'))
                      ->set_width(20)
                      ->set_options([
                          'journal'      => 'Journal',
                          'coffee-guide' => 'Coffee guide',
                      ]),
                 Field::make('association', 'url_journal_roasting_profile', __('Choose article | Chọn bài viết', 'gaumap'))
                      ->set_width(80)
                      ->set_max(1)
                      ->set_conditional_logic([
                          'relation' => 'AND',
                          ['field' => 'choose_post_type_roasting_profile', 'value' => 'journal', 'compare' => '=',],
                      ])
                      ->set_types([
                          [
                              'type'      => 'post',
                              'post_type' => 'journal',
                          ],
                      ]),
                 Field::make('association', 'url_coffee_guide_roasting_profile', __('Choose article | Chọn bài viết', 'gaumap'))
                      ->set_width(80)
                      ->set_max(1)
                      ->set_conditional_logic([
                          'relation' => 'AND',
                          ['field' => 'choose_post_type_roasting_profile', 'value' => 'coffee-guide', 'compare' => '=',],
                      ])
                      ->set_types([
                          [
                              'type'      => 'post',
                              'post_type' => 'coffee_guide',
                          ],
                      ]),
             ])
             ->add_tab(__('Recommend | Khuyến nghị', 'gaumap'), [
                 Field::make('text', 'title_recommend', __('Title | Tiêu đề', 'gaumap'))
                      ->set_default_value('Recommendations for storage and use'),
                 Field::make('rich_text', 'desc_recommend', __('Description | Mô tả', 'gaumap')),
             ])
             ->add_tab(__('Water quality | Chất lượng nước', 'gaumap'), [
                 Field::make('text', 'title_water_quality', __('Title | Tiêu đề', 'gaumap'))
                      ->set_default_value('The optimum water quality for brewing coffee'),

                 Field::make('text', 'calcium_hardness', __('Calcium Hardness', 'gaumap'))
                      ->set_width(50)
                      ->set_default_value('-- ppm CaCO3'),
                 Field::make('text', 'magnesium_hardness', __('Magnesium Hardness', 'gaumap'))
                      ->set_width(50)
                     ->set_default_value('-- ppm CaCO3'),
                 Field::make('text', 'total_alkalinity', __('Total Alkalinity', 'gaumap'))
                      ->set_width(50)
                     ->set_default_value('-- ppm CaCO3'),
                 Field::make('text', 'sodium', __('Sodium'))
                      ->set_width(50)
                     ->set_default_value('-- ppm CaCO3'),

                 Field::make('select', 'choose_post_type_water_quality', __('Choose post type | Chọn loại bài viết ', 'gaumap'))
                      ->set_width(20)
                      ->set_options([
                          'journal'      => 'Journal',
                          'coffee-guide' => 'Coffee guide',
                      ]),
                 Field::make('association', 'url_journal_water_quality', __('Choose article | Chọn bài viết', 'gaumap'))
                      ->set_width(80)
                      ->set_max(1)
                      ->set_conditional_logic([
                          'relation' => 'AND',
                          ['field' => 'choose_post_type_water_quality', 'value' => 'journal', 'compare' => '=',],
                      ])
                      ->set_types([
                          [
                              'type'      => 'post',
                              'post_type' => 'journal',
                          ],
                      ]),
                 Field::make('association', 'url_coffee_guide_water_quality', __('Choose article | Chọn bài viết', 'gaumap'))
                      ->set_width(80)
                      ->set_max(1)
                      ->set_conditional_logic([
                          'relation' => 'AND',
                          ['field' => 'choose_post_type_water_quality', 'value' => 'coffee-guide', 'compare' => '=',],
                      ])
                      ->set_types([
                          [
                              'type'      => 'post',
                              'post_type' => 'coffee_guide',
                          ],
                      ]),
             ])
             ->add_tab(__('Coffee Guide ', 'gaumap'), [
                 Field::make('image', 'img_coffee_guide_product', __('Image | Hình ảnh', 'gaumap')),
             ]);
});

