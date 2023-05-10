<?php

namespace App\PostTypes;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field;
use gaumap\Abstracts\AbstractPostType;

class Collaboration extends \App\Abstracts\AbstractPostType {

    public function __construct() {
        $this->showThumbnailOnList = true;
        $this->supports            = [
            'title',
            'editor',
            'thumbnail',
            'page-attributes',
        ];

        $this->menuIcon         = 'dashicons-share';                                 //change icon in website: https://developer.wordpress.org/resource/dashicons/
        $this->post_type        = 'collaboration';                                   //Name Posttype
        $this->singularName     = $this->pluralName = __('Collaboration', 'gaumap'); // show name in admin: Bài viết, sản phẩm, ...
        $this->titlePlaceHolder = __('Post', 'gaumap');
        $this->slug             = 'collaboration'; //slug posttype: bai-viet, san-pham, ...
        parent::__construct();
    }

    /**
     * Document: https://docs.carbonfields.net/#/containers/post-meta
     */
    public function metaFields() {
        Container::make('post_meta', __('Exclude', 'gaumap'))
                 ->set_context('carbon_fields_after_title')
                 ->set_priority('high')
                 ->where('post_type', 'IN', [$this->post_type])
                 ->add_tab(__('Images | Hình ảnh', 'gaumap'), [
                     Field::make('image', 'large_img', __('Large image', 'gaumap'))
                          ->set_width(20),
                     Field::make('textarea', 'description', __('Description', 'gaumap'))
                          ->set_width(80),
                 ])
                 ->add_tab(__('Cooperation | Hợp tác', 'gaumap'), [
                     Field::make('text', 'first_cooperation', __('First time cooperation | Lần đầu hợp tác', 'gaumap'))
                          ->set_width(50),
                     Field::make('text', 'cooperation_model', __('Cooperation model | Mô hình hợp tác', 'gaumap'))
                          ->set_width(50),
                     Field::make('text', 'title_cooperation', __('Title | Tiêu đề', 'gaumap'))
                          ->set_default_value('About'),
                     Field::make('rich_text', 'content_cooperation', __('Content | Nội dung', 'gaumap')),
                     Field::make('textarea', 'map_cooperation', __('Map | Bản đồ', 'gaumap')),
                 ])
                 ->add_tab(__('Core Values | Giá trị cốt lõi', 'gaumap'), [
                     Field::make('text', 'title_core_values', __('Title | Tiêu đề', 'gaumap'))
                          ->set_default_value('Core Values'),
                     Field::make('rich_text', 'content_core_values', __('Content | Nội dung', 'gaumap')),
                     Field::make('complex', 'expanded_content_core_values', __('Expanded content | Nội dung mở rộng', 'gaumap'))
                          ->set_layout('tabbed-vertical')
                          ->add_fields([
                              Field::make('text', 'title_expanded', __('Title | Tiêu đề', 'gaumap')),
                              Field::make('rich_text', 'dest_expanded', __('Desc | Mô tả', 'gaumap')),
                          ])->set_header_template('<% if (title_expanded) { %><%- title_expanded %><% } %>'),
                     Field::make('complex', 'gallery_core_values', __('Albums', 'gaumap'))
                          ->set_layout('tabbed-horizontal')
                          ->add_fields([
                              Field::make('image', 'img_gallery', __('', 'gaumap')),
                          ]),
                     Field::make('textarea', 'subtitle_core_values', __('Sub title | Tiêu đề phụ', 'gaumap'))
                          ->set_width(80),
                     Field::make('image', 'img_core_values', __('Image | Hình ảnh', 'gaumap'))
                          ->set_width(20),
                     Field::make('textarea', 'subcontent_core_values', __('Sub content | Nội dung phụ', 'gaumap')),
                 ])
                 ->add_tab(__('Content blocks | Khối nội dung', 'gaumap'), [
                     Field::make('complex', 'content_blocks', __('', 'gaumap'))
                          ->set_layout('tabbed-vertical')
                          ->add_fields([
                              Field::make('radio_image', 'content_blocks_display_type', __('Display type | Kiểu hiển thị', 'gaumap'))
                                   ->set_options([
                                       'cbs-1' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/content-block-1.png',
                                       'cbs-2' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/content-block-2.png',
                                       'cbs-3' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/content-block-3.png',
                                   ]),

                              Field::make('text', 'title_cbs', __('Title | Tiêu đề', 'gaumap'))
                                   ->set_width(80),
                              Field::make('image', 'img_cbs', __('Image | Hình ảnh', 'gaumap'))
                                   ->set_width(20),
                              Field::make('complex', 'expanded_content_cbs', __('Expanded content | Nội dung mở rộng', 'gaumap'))
                                   ->set_layout('tabbed-vertical')
                                   ->set_conditional_logic([
                                       'relation' => 'AND',
                                       ['field' => 'content_blocks_display_type', 'value' => 'cbs-3', 'compare' => '=',],
                                   ])
                                   ->add_fields([
                                       Field::make('text', 'title_expanded', __('Title | Tiêu đề', 'gaumap')),
                                       Field::make('rich_text', 'dest_expanded', __('Desc | Mô tả', 'gaumap')),
                                   ])->set_header_template('<% if (title_expanded) { %><%- title_expanded %><% } %>'),
                              Field::make('textarea', 'subtitle_cbs_1', __('Sub title | Tiêu đề phụ', 'gaumap'))
                                   ->set_conditional_logic([
                                       'relation' => 'AND',
                                       ['field' => 'content_blocks_display_type', 'value' => 'cbs-1', 'compare' => '=',],
                                   ]),
                              Field::make('textarea', 'subtitle_cbs_3', __('Sub title | Tiêu đề phụ', 'gaumap'))
                                   ->set_conditional_logic([
                                       'relation' => 'AND',
                                       ['field' => 'content_blocks_display_type', 'value' => 'cbs-3', 'compare' => '=',],
                                   ]),
                              Field::make('rich_text', 'content_cbs', __('Content | Nội dung', 'gaumap')),

                          ])->set_header_template('<% if (title_cbs) { %><%- title_cbs %><% } %>'),
                 ]);
    }
}
