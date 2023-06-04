<?php
namespace App\PostTypes;
use Carbon_Fields\Container\Container;
use Carbon_Fields\Field;
use gaumap\Abstracts\AbstractPostType;

class Location extends \App\Abstracts\AbstractPostType {

    public function __construct()
    {
        $this->showThumbnailOnList = true;
        $this->supports            = [
            'title',
            'editor',
            'thumbnail',
            'page-attributes',
        ];

        $this->menuIcon            = 'dashicons-location-alt'; //change icon in website: https://developer.wordpress.org/resource/dashicons/
        $this->post_type           = 'location'; //Name Posttype
        $this->singularName        = $this->pluralName = __('Locations', 'gaumap'); // show name in admin: Bài viết, sản phẩm, ...
        $this->titlePlaceHolder    = __('Post', 'gaumap');
        $this->slug                = 'location'; //slug posttype: bai-viet, san-pham, ...
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
                 ->add_tab(__('PARENT PAGE | TRANG CHA', 'gaumap'), [
                     Field::make( 'text', 'location_type', __('Type | Loại', 'gaumap') )
                          ->set_width(30),
                     Field::make( 'text', 'location_detail', __('Address | Địa chỉ', 'gaumap') )
                          ->set_width(70),
                     Field::make( 'media_gallery', 'location_gallery', __('Albums | Hình ảnh', 'gaumap') ),

                     Field::make( 'separator', 'crb_separator_1', __( 'Articles | Bài viết liên quan', 'gaumap') ),
                     Field::make( 'complex', 'location_articles', __('', 'gaumap') )
                          ->set_layout('tabbed-vertical')
                          ->add_fields([
                              Field::make( 'image', 'article_img', __('Image | Hình ảnh', 'gaumap') ),
                              Field::make( 'text', 'article_tag', __('Tag | Thẻ', 'gaumap') )
                                   ->set_width(50),
                              Field::make( 'text', 'article_link', __('Link | Đường dẫn', 'gaumap') )
                                   ->set_width(50),
                              Field::make( 'text', 'article_title', __('Title | Tiêu đề', 'gaumap') ),
                              Field::make( 'textarea', 'article_desc', __('Desc | Mô tả', 'gaumap') ),
                          ])->set_header_template('<% if (article_title) { %><%- article_title %><% } %>'),

                     Field::make( 'separator', 'crb_separator_2', __( 'Content | Nội dung bài viết', 'gaumap') ),
                     Field::make( 'rich_text', 'location_content', __( '', 'gaumap') ),
                     Field::make( 'text', 'location_opening_hours', __('Opening hours | Giờ mở cửa', 'gaumap') )
                          ->set_default_value('6:30 - 22:30 daily'),

                     Field::make( 'separator', 'crb_separator_3', __( 'Socials | Mạng xã hội', 'gaumap') ),
                     Field::make( 'complex', 'location_socials', __('', 'gaumap') )
                          ->set_layout('tabbed-horizontal')
                          ->add_fields([
                              Field::make( 'text', 'socials_name', __('Name | Tên', 'gaumap') )
                                   ->set_width(30),
                              Field::make( 'text', 'socials_link', __('Link | Đường dẫn', 'gaumap') )
                                   ->set_width(70),
                          ])->set_header_template('<% if (socials_name) { %><%- socials_name %><% } %>'),

                 ])
                 ->add_tab(__('CHILDREN PAGE | TRANG CON', 'gaumap'), [
                     Field::make( 'separator', 'crb_separator_4', __( 'Menu', 'gaumap') ),
                     Field::make( 'complex', 'location_menu', __('', 'gaumap') )
                          ->set_layout('tabbed-horizontal')
                          ->add_fields([
                              Field::make( 'text', 'type_of_drink', __('Type of drink | Loại đồ uống', 'gaumap') )
                                   ->set_width(30),
                              Field::make( 'rich_text', 'menu_desc', __( 'Desc | Mô tả', 'gaumap') )
                                   ->set_width(70),
                              Field::make( 'complex', 'drinks', __('Drinks | Thức uống', 'gaumap') )
                                   ->set_layout('tabbed-horizontal')
                                   ->add_fields([
                                       Field::make( 'image', 'drink_img', __('Image | Hình ảnh', 'gaumap') )
                                            ->set_width(30),
                                       Field::make( 'text', 'drink_name', __('Drink name | Tên đồ uống', 'gaumap') )
                                            ->set_width(70),
                                       Field::make( 'textarea', 'drink_desc', __('Desc | Mô tả', 'gaumap') ),
                                   ])->set_header_template('<% if (drink_name) { %><%- drink_name %><% } %>'),
                          ])->set_header_template('<% if (type_of_drink) { %><%- type_of_drink %><% } %>'),
                 ]);
    }
}
