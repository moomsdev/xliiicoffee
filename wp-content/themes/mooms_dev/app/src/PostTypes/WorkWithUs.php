<?php
namespace App\PostTypes;
use Carbon_Fields\Container\Container;
use Carbon_Fields\Field;
use gaumap\Abstracts\AbstractPostType;

class WorkWithUs extends \App\Abstracts\AbstractPostType {

    public function __construct()
    {
        $this->showThumbnailOnList = true;
        $this->supports            = [
            'title',
            'editor',
            'thumbnail',
            'page-attributes',
        ];

        $this->menuIcon            = 'dashicons-money'; //change icon in website: https://developer.wordpress.org/resource/dashicons/
        $this->post_type           = 'work_with_us'; //Name Posttype
        $this->singularName        = $this->pluralName = __('Work with us', 'gaumap'); // show name in admin: Bài viết, sản phẩm, ...
        $this->titlePlaceHolder    = __('Post', 'gaumap');
        $this->slug                = 'work-with-us'; //slug posttype: bai-viet, san-pham, ...
        parent::__construct();
    }

    /**
     * Document: https://docs.carbonfields.net/#/containers/post-meta
     */
    // public function metaFields()
    // {
    //     Container::make('post_meta', __('Exclude', 'gaumap'))
    //              ->set_context('carbon_fields_after_title')
    //              ->set_priority('high')
    //              ->where('post_type', 'IN', [$this->post_type])
    //              ->add_fields([
    //                  Field::make('textarea', 'description' , __('Description', 'gaumap')),
    //              ]);
    // }
}
