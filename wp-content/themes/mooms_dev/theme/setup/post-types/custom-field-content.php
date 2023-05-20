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
use Carbon_Fields\Field;

if (!defined('ABSPATH')) {
    exit;
}

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', __('Content', 'gaumap'))
             ->set_context('carbon_fields_after_title')
             ->set_priority('core')
             ->where('post_type', 'IN', ['page', 'coffee_guide', 'collaboration', 'journal', 'location', 'work_with_us', 'product'])
             ->add_fields([
                 Field::make('complex', 'choose_block', __('Choose blocks:', 'gaumap'))
                      ->set_layout('tabbed-vertical')
                      ->set_collapsed(true)

                     // Slider Blocks
                      ->add_fields('slider_blocks', __('Slider Blocks', 'gaumap'), [
                         Field::make('complex', 'slider_block', __('Add slider:', 'gaumap'))
                              ->set_layout('tabbed-horizontal')
                              ->add_fields([
                                  Field::make('separator', 'name_slider_block', __('Slider block', 'gaumap')),

                                  Field::make('image', 'img_slider_block', __('Image', 'gaumap'))
                                       ->set_required(true),

                              ]),
                     ])

                     // Philosophy Blocks
                      ->add_fields('philosophy_blocks', __('Philosophy Blocks - style 1', 'gaumap'), [

                         Field::make('separator', 'name_philosophy_block', __('Philosophy Blocks', 'gaumap')),

                         Field::make('radio_image', 'display_type', __('Display type | Kiểu hiển thị', 'gaumap'))
                              ->set_options([
                                  'style-1' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/blocks/grid-content-img-type.png',
                                  'style-2' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/blocks/grid-card-type.jpg',
                              ]),

                         Field::make('text', 'title_philosophy_block', __('Title', 'gaumap'))
                              ->set_width(60)
                              ->set_required(true),

                         Field::make('image', 'img_lg_philosophy_block', __('Large image', 'gaumap'))
                              ->set_width(20)
                              ->set_required(true),

                         Field::make('image', 'img_sm_philosophy_block', __('Small image', 'gaumap'))
                              ->set_width(20)
                              ->set_required(true),

                         Field::make('rich_text', 'desc_philosophy_block', __('Description', 'gaumap'))
                              ->set_required(true),

                         Field::make('select', 'type_read_more_link_philosophy_block', __('Type link: ', 'gaumap'))
                              ->set_width(20)
                              ->set_required(true)
                              ->set_options([
                                  'page'        => 'Page',
                                  'manual-link' => 'Manual link',
                              ]),

                         Field::make('text', 'link_custom_philosophy_block', __('Custom link', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'type_read_more_link_philosophy_block', 'value' => 'manual-link', 'compare' => '=',],
                              ]),

                         Field::make('association', 'page_object_philosophy_block', __('Choose page:', 'gaumap'))
                              ->set_width(80)
                              ->set_max(1)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'type_read_more_link_philosophy_block', 'value' => 'page', 'compare' => '=',],
                              ])
                              ->set_types([
                                  [
                                      'type'      => 'post',
                                      'post_type' => 'page',
                                  ],
                              ]),

                     ])->set_header_template('<% if (title_philosophy_block) { %><%- title_philosophy_block %><% } %>')

                      ->add_fields('philosophy_blocks_2', __('Philosophy Blocks - style 2', 'gaumap'), [

                          Field::make('separator', 'name_philosophy_block_2', __('Philosophy Blocks', 'gaumap')),

                          Field::make('text', 'title_philosophy_block_2', __('Title', 'gaumap'))
                               ->set_width(60)
                               ->set_required(true),

                          Field::make('image', 'img_philosophy_block_2', __('Image', 'gaumap'))
                               ->set_width(20)
                               ->set_required(true),

                          Field::make('rich_text', 'desc_philosophy_block_2', __('Description', 'gaumap'))
                               ->set_required(true),

                          Field::make('select', 'type_read_more_link_philosophy_block_2', __('Type link: ', 'gaumap'))
                               ->set_width(20)
                               ->set_required(true)
                               ->set_options([
                                   'page'        => 'Page',
                                   'manual-link' => 'Manual link',
                               ]),

                          Field::make('text', 'link_custom_philosophy_block_2', __('Custom link', 'gaumap'))
                               ->set_width(80)
                               ->set_conditional_logic([
                                   'relation' => 'AND',
                                   ['field' => 'type_read_more_link_philosophy_block_2', 'value' => 'manual-link', 'compare' => '=',],
                               ]),

                          Field::make('association', 'page_object_philosophy_block_2', __('Choose page:', 'gaumap'))
                               ->set_width(80)
                               ->set_max(1)
                               ->set_conditional_logic([
                                   'relation' => 'AND',
                                   ['field' => 'type_read_more_link_philosophy_block_2', 'value' => 'page', 'compare' => '=',],
                               ])
                               ->set_types([
                                   [
                                       'type'      => 'post',
                                       'post_type' => 'page',
                                   ],
                               ]),

                      ])->set_header_template('<% if (title_philosophy_block_2) { %><%- title_philosophy_block_2 %><% } %>')

                     // Content Slider Blocks
                      ->add_fields('content_slider_blocks', __('Content + Slider Blocks', 'gaumap'), [

                         Field::make('separator', 'name_content_slider_block', __('Content + Slider Blocks', 'gaumap')),

                         Field::make('text', 'title_content_slider_block', __('Title', 'gaumap'))
                              ->set_required(true),

                         Field::make('textarea', 'desc_content_slider_block', __('Description', 'gaumap')),

                         Field::make('select', 'type_read_more_link_content_slider_block', __('Type of link input: ', 'gaumap'))
                              ->set_width(20)
                              ->set_options([
                                  'custom-post-type' => 'Custom post type',
                                  'manual-link'      => 'Manual link',
                              ]),

                         Field::make('text', 'link_custom_content_slider_block', __('Custom link', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'type_read_more_link_content_slider_block', 'value' => 'manual-link', 'compare' => '=',],
                              ]),

                         Field::make('select', 'cpt_content_slider_block', __('Choose custom post type', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'type_read_more_link_content_slider_block', 'value' => 'custom-post-type', 'compare' => '=',],
                              ])
                              ->add_options('get_custom_post_types'),

                         Field::make('select', 'post_display_content_slider_block', __('Post display style', 'gaumap'))
                              ->set_width(20)
                              ->set_options([
                                  'manual' => 'Manual',
                                  'auto'   => 'Auto',
                              ]),

                         Field::make('separator', 'auto_separator_content_slider_block', __('Automatically display the last 8 posts', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'post_display_content_slider_block', 'value' => 'auto', 'compare' => '=',],
                              ]),

                         Field::make('association', 'coffee_guide_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_content_slider_block', 'value' => 'coffee_guide', 'compare' => '=',],
                                  ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'post', 'post_type' => 'coffee_guide',],
                              ]),

                         Field::make('association', 'collaboration_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_content_slider_block', 'value' => 'collaboration', 'compare' => '=',],
                                  ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'term', 'taxonomy' => 'collaboration_cat',],
                                  ['type' => 'post', 'post_type' => 'collaboration',],
                              ]),

                         Field::make('association', 'location_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_content_slider_block', 'value' => 'location', 'compare' => '=',],
                                  ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'post', 'post_type' => 'location',],
                              ]),

                         Field::make('association', 'work_with_us_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_content_slider_block', 'value' => 'work_with_us', 'compare' => '=',],
                                  ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'term', 'taxonomy' => 'work_with_us_cat',],
                                  ['type' => 'post', 'post_type' => 'work_with_us',],
                              ]),

                         Field::make('association', 'product_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_content_slider_block', 'value' => 'product', 'compare' => '=',],
                                  ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'term', 'taxonomy' => 'product_cat',],
                                  // ['type' => 'post', 'post_type' => 'product',],
                              ]),

                         Field::make('association', 'journal_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_content_slider_block', 'value' => 'journal', 'compare' => '=',],
                                  ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'term', 'taxonomy' => 'journal_cat',],
                                  ['type' => 'post', 'post_type' => 'journal',],
                              ]),

                     ])->set_header_template('<% if (title_content_slider_block) { %><%- title_content_slider_block %><% } %>')

                     // Featured post block
                      ->add_fields('featured_post_blocks', __('Featured Post Blocks', 'gaumap'), [

                         Field::make('separator', 'name_featured_post_block', __('Featured Post Blocks', 'gaumap')),

                         Field::make('text', 'title_featured_post_block', __('Title', 'gaumap'))
                              ->set_required(true),

                         Field::make('select', 'type_read_more_link_featured_post_block', __('Type of link input: ', 'gaumap'))
                              ->set_width(20)
                              ->set_required(true)
                              ->set_options([
                                  'custom-post-type' => 'Custom post type',
                                  'manual-link'      => 'Manual link',
                              ]),

                         Field::make('text', 'link_custom_featured_post_block', __('Custom link', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'type_read_more_link_featured_post_block', 'value' => 'manual-link', 'compare' => '=',],
                              ]),

                         Field::make('select', 'cpt_featured_post_block', __('Choose custom post type', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'type_read_more_link_featured_post_block', 'value' => 'custom-post-type', 'compare' => '=',],
                              ])
                              ->add_options('get_custom_post_types'),

                         Field::make('select', 'post_display_featured_post_block', __('Post display style', 'gaumap'))
                              ->set_width(20)
                              ->set_options([
                                  'manual' => 'Manual',
                                  'auto'   => 'Auto',
                              ]),

                         Field::make('separator', 'auto_separator_featured_post_block', __('Automatically display the last 2 posts', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'post_display_featured_post_block', 'value' => 'auto', 'compare' => '=',],
                              ]),

                         Field::make('association', 'coffee_guide_object_featured_post_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_max(2)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_featured_post_block', 'value' => 'coffee_guide', 'compare' => '=',],
                                  ['field' => 'post_display_featured_post_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'post', 'post_type' => 'coffee_guide',],
                              ]),

                         Field::make('association', 'collaboration_object_featured_post_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_max(2)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_featured_post_block', 'value' => 'collaboration', 'compare' => '=',],
                                  ['field' => 'post_display_featured_post_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'term', 'taxonomy' => 'collaboration_cat',],
                                  ['type' => 'post', 'post_type' => 'collaboration',],
                              ]),

                         Field::make('association', 'location_object_featured_post_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_max(2)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_featured_post_block', 'value' => 'location', 'compare' => '=',],
                                  ['field' => 'post_display_featured_post_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'post', 'post_type' => 'location',],
                              ]),

                         Field::make('association', 'work_with_us_object_featured_post_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_max(2)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_featured_post_block', 'value' => 'work_with_us', 'compare' => '=',],
                                  ['field' => 'post_display_featured_post_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'term', 'taxonomy' => 'work_with_us_cat',],
                                  ['type' => 'post', 'post_type' => 'work_with_us',],
                              ]),

                         Field::make('association', 'product_object_featured_post_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_max(2)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_featured_post_block', 'value' => 'product', 'compare' => '=',],
                                  ['field' => 'post_display_featured_post_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'term', 'taxonomy' => 'product_cat',],
                                  ['type' => 'post', 'post_type' => 'product',],
                              ]),

                         Field::make('association', 'journal_object_featured_post_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_max(2)
                              ->set_conditional_logic([
                                  'relation' => 'AND',
                                  ['field' => 'cpt_featured_post_block', 'value' => 'journal', 'compare' => '=',],
                                  ['field' => 'post_display_featured_post_block', 'value' => 'manual', 'compare' => '=',],
                              ])
                              ->set_types([
                                  ['type' => 'term', 'taxonomy' => 'journal_cat',],
                                  ['type' => 'post', 'post_type' => 'journal',],
                              ]),

                     ])->set_header_template('<% if (title_featured_post_block) { %><%- title_featured_post_block %><% } %>'),


             ]);
});
