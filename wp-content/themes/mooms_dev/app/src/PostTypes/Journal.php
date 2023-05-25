<?php

namespace App\PostTypes;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field;
use gaumap\Abstracts\AbstractPostType;

class Journal extends \App\Abstracts\AbstractPostType {

    public function __construct() {
        $this->showThumbnailOnList = true;
        $this->supports            = [
            'title',
            'editor',
            'thumbnail',
            'page-attributes',
        ];

        $this->menuIcon         = 'dashicons-book-alt';                        //change icon in website: https://developer.wordpress.org/resource/dashicons/
        $this->post_type        = 'journal';                                   //Name Posttype
        $this->singularName     = $this->pluralName = __('Journal', 'gaumap'); // show name in admin: Bài viết, sản phẩm, ...
        $this->titlePlaceHolder = __('Post', 'gaumap');
        $this->slug             = 'journal'; //slug posttype: bai-viet, san-pham, ...
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
                 ->add_tab(__('Images & Desc | Hình ảnh và mô tả ngắn', 'gaumap'), [
                     Field::make('image', 'large_img', __('Large image', 'gaumap'))
                          ->set_width(20),
                     Field::make('textarea', 'description', __('Description', 'gaumap'))
                          ->set_width(80),
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
                                       'cbs-4' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/philosophy-content-block-4.png',
                                   ]),

                              Field::make('text', 'title_cbs', __('Title | Tiêu đề', 'gaumap'))
                                   ->set_width(80)
                                  ->set_conditional_logic([
                                      'relation' => 'AND',
                                      ['field' => 'content_blocks_display_type', 'value' => 'cbs-4', 'compare' => 'EXCLUDES',],
                                  ]),

                              Field::make('image', 'img_cbs', __('Image | Hình ảnh', 'gaumap'))
                                   ->set_width(20)
                                  ->set_conditional_logic([
                                      'relation' => 'AND',
                                      ['field' => 'content_blocks_display_type', 'value' => ['cbs-1', 'cbs-2'], 'compare' => 'EXCLUDES',],
                                  ]),

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

                              // Field::make('textarea', 'subtitle_cbs_1', __('Sub title | Tiêu đề phụ', 'gaumap'))
                              //      ->set_conditional_logic([
                              //          'relation' => 'AND',
                              //          ['field' => 'content_blocks_display_type', 'value' => 'cbs-1', 'compare' => '=',],
                              //      ]),

                              // Field::make('textarea', 'subtitle_cbs_3', __('Sub title | Tiêu đề phụ', 'gaumap'))
                              //      ->set_conditional_logic([
                              //          'relation' => 'AND',
                              //          ['field' => 'content_blocks_display_type', 'value' => 'cbs-3', 'compare' => '=',],
                              //      ]),

                              Field::make('rich_text', 'content_cbs', __('Content | Nội dung', 'gaumap'))
                                  ->set_conditional_logic([
                                      'relation' => 'AND',
                                      ['field' => 'content_blocks_display_type', 'value' => 'cbs-4', 'compare' => 'EXCLUDES',],
                                  ]),

                          ])->set_header_template('<% if (title_cbs) { %><%- title_cbs %><% } %>'),
                 ]);
    }
}
