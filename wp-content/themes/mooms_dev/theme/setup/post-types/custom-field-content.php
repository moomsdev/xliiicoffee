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
                                  Field::make('image', 'img_slider_block', __('Image', 'gaumap')),
                              ]),
                     ])

                     // Philosophy Blocks
                      ->add_fields('philosophy_blocks', __('Philosophy Blocks', 'gaumap'), [
                         Field::make('text', 'title_philosophy_block', __('Title', 'gaumap'))
                              ->set_width(60),
                         Field::make('image', 'img_lg_philosophy_block', __('Large image', 'gaumap'))
                              ->set_width(20),
                         Field::make('image', 'img_sm_philosophy_block', __('Small image', 'gaumap'))
                              ->set_width(20),
                         Field::make('rich_text', 'desc_philosophy_block', __('Description', 'gaumap')),
                         Field::make('select', 'type_read_more_link_philosophy_block', __('Type link: ', 'gaumap'))
                              ->set_width(20)
                              ->set_options([
                                  'manual-link'      => 'Manual link',
                                  'page'             => 'Page',
                                  'custom-post-type' => 'Custom post type',
                              ]),
                         Field::make('text', 'link_custom_philosophy_block', __('Custom link', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'type_read_more_link_philosophy_block', 'value' => 'manual-link', 'compare' => '=',]]),
                         Field::make('association', 'page_object_philosophy_block', __('Choose page:', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'type_read_more_link_philosophy_block', 'value' => 'page', 'compare' => '=',]])
                              ->set_max(1)
                              ->set_types([
                                  [
                                      'type'      => 'post',
                                      'post_type' => 'page',
                                  ],
                              ]),
                         Field::make('select', 'cpt_philosophy_block', __('Choose custom post type', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'type_read_more_link_philosophy_block', 'value' => 'custom-post-type', 'compare' => '=',]])
                              ->add_options('get_custom_post_types'),
                     ])

                     // Content Slider Blocks
                      ->add_fields('content_slider_blocks', __('Content + Slider Blocks', 'gaumap'), [
                         Field::make('text', 'title_content_slider_block', __('Title', 'gaumap')),
                         Field::make('textarea', 'desc_content_slider_block', __('Description', 'gaumap')),

                         Field::make('select', 'type_read_more_link_content_slider_block', __('Type of link input: ', 'gaumap'))
                              ->set_width(20)
                              ->set_options([
                                  'manual-link'      => 'Manual link',
                                  // 'page'             => 'Page',
                                  'custom-post-type' => 'Custom post type',
                              ]),

                         Field::make('text', 'link_custom_content_slider_block', __('Custom link', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'type_read_more_link_content_slider_block', 'value' => 'manual-link', 'compare' => '=',]]),
                         // Field::make('association', 'page_object_content_slider_block', __('Choose page:', 'gaumap'))
                         //      ->set_width(80)
                         //      ->set_conditional_logic(['relation' => 'AND', ['field' => 'type_read_more_link_content_slider_block', 'value' => 'page', 'compare' => '=',]])
                         //      ->set_max(1)
                         //      ->set_types([
                         //          [
                         //              'type'      => 'post',
                         //              'post_type' => 'page',
                         //          ],
                         //      ]),
                         Field::make('select', 'cpt_content_slider_block', __('Choose custom post type', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'type_read_more_link_content_slider_block', 'value' => 'custom-post-type', 'compare' => '=',]])
                              ->add_options('get_custom_post_types'),

                         Field::make('select', 'post_display_content_slider_block', __('Post display style', 'gaumap'))
                              ->set_width(20)
                              ->set_options([
                                  'auto'   => 'Auto',
                                  'manual' => 'Manual',
                              ]),

                         Field::make('separator', 'auto_separator_content_slider_block', __('Automatically display the last 8 posts', 'gaumap'))
                              ->set_width(80)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'post_display_content_slider_block', 'value' => 'auto', 'compare' => '=',]]),

                         Field::make('association', 'coffee_guide_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'cpt_content_slider_block', 'value' => 'coffee_guide', 'compare' => '=',], ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',]])
                              ->set_types([['type' => 'post', 'post_type' => 'coffee_guide',],]),

                         Field::make('association', 'collaboration_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'cpt_content_slider_block', 'value' => 'collaboration', 'compare' => '=',], ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',]])
                              ->set_types([['type' => 'post', 'post_type' => 'collaboration',],]),

                         Field::make('association', 'location_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'cpt_content_slider_block', 'value' => 'location', 'compare' => '=',], ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',]])
                              ->set_types([['type' => 'post', 'post_type' => 'location',],]),

                         Field::make('association', 'work_with_us_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'cpt_content_slider_block', 'value' => 'work_with_us', 'compare' => '=',], ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',]])
                              ->set_types([['type' => 'post', 'post_type' => 'work_with_us',],]),

                         Field::make('association', 'product_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'cpt_content_slider_block', 'value' => 'product', 'compare' => '=',], ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',]])
                              ->set_types([['type' => 'post', 'post_type' => 'product',],]),

                         Field::make('association', 'journal_guide_object_content_slider_block', __('Choose post:', 'gaumap'))
                              ->set_width(80)
                              ->set_min(4)
                              ->set_max(8)
                              ->set_conditional_logic(['relation' => 'AND', ['field' => 'cpt_content_slider_block', 'value' => 'journal', 'compare' => '=',], ['field' => 'post_display_content_slider_block', 'value' => 'manual', 'compare' => '=',]])
                              ->set_types([['type' => 'post', 'post_type' => 'journal',],]),

                     ]),

                    // Featured post block
             ]);
});
