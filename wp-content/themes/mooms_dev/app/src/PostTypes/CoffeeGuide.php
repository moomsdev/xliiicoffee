<?php
namespace App\PostTypes;
use Carbon_Fields\Container\Container;
use Carbon_Fields\Field;
use gaumap\Abstracts\AbstractPostType;

class CoffeeGuide extends \App\Abstracts\AbstractPostType {

    public function __construct()
    {
        $this->showThumbnailOnList = true;
        $this->supports            = [
            'title',
            'editor',
            'thumbnail',
            'page-attributes',
        ];

        $this->menuIcon            = 'dashicons-coffee'; //change icon in website: https://developer.wordpress.org/resource/dashicons/
        $this->post_type           = 'coffee_guide'; //Name Posttype
        $this->singularName        = $this->pluralName = __('Coffee Guides', 'gaumap'); // show name in admin: Bài viết, sản phẩm, ...
        $this->titlePlaceHolder    = __('Post', 'gaumap');
        $this->slug                = 'coffee-guide'; //slug posttype: bai-viet, san-pham, ...
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
                 ->add_fields([
                     Field::make('image', 'large_img', __('Large image', 'gaumap'))
                          ->set_width(20),
                     Field::make('textarea', 'description', __('Description', 'gaumap'))
                          ->set_width(80),
                 ]);
    }
}
