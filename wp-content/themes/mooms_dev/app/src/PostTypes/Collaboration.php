<?php
namespace App\PostTypes;
use Carbon_Fields\Container\Container;
use Carbon_Fields\Field;
use gaumap\Abstracts\AbstractPostType;

class Collaboration extends \App\Abstracts\AbstractPostType {

    public function __construct()
    {
        $this->showThumbnailOnList = true;
        $this->supports            = [
            'title',
            'editor',
            'thumbnail',
            'page-attributes',
        ];

        $this->menuIcon            = 'dashicons-share'; //change icon in website: https://developer.wordpress.org/resource/dashicons/
        $this->post_type           = 'collaboration'; //Name Posttype
        $this->singularName        = $this->pluralName = __('Collaboration', 'gaumap'); // show name in admin: Bài viết, sản phẩm, ...
        $this->titlePlaceHolder    = __('Post', 'gaumap');
        $this->slug                = 'collaboration'; //slug posttype: bai-viet, san-pham, ...
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
					 Field::make('rich_text','content_cooperation', __('Content | Nội dung','')),
					 Field::make('textarea', 'map_cooperation', __('Map | Bản đồ', 'gaumap')),
					 Field::make('textarea', 'map_cooperation', __('Map | Bản đồ', 'gaumap')),

				 ])
				 ->add_tab(__('Core Values | Giá trị cốt lõi', 'gaumap'), [
					 Field::make('text', 'title_core_values', __('Title | Tiêu đề', 'gaumap'))
						 ->set_default_value('Core Values'),
					 Field::make('rich_text','content_core_values', __('Content | Nội dung','')),
					 Field::make('complex', 'expanded_content_core_values', __('Expanded content | Nội dung mở rộng', 'gaumap'))
						 ->set_layout('tabbed-vertical')
						 ->add_fields([
							 Field::make('text', 'title_expanded', __('Title | Tiêu đề', 'gaumap')),
							 Field::make('rich_text', 'dest_expanded', __('Desc | Mô tả', 'gaumap')),
						 ])->set_header_template('<% if (title_expanded) { %><%- title_expanded %><% } %>'),
					 Field::make('complex', 'gallery_core_values', __('', 'gaumap'))
						 ->set_layout('tabbed-horizontal')
						 ->add_fields([
							 Field::make('image', 'img_gallery', __('', 'gaumap')),
						 ]),

				 ]);
    }
}
