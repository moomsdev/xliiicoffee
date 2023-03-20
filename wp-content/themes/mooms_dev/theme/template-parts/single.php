<?php
while (have_posts()) : the_post();
    $blocks = carbon_get_the_post_meta('choose_block');
    foreach ($blocks as $block) {
        $args = [

            // Slider Blocks
            'slider_block'     => $block['slider_block'],

            // Philosophy Blocks
            'title_philosophy_block'    => $block['title_philosophy_block'],
            'img_lg_philosophy_block'   => $block['img_lg_philosophy_block'],
            'img_sm_philosophy_block'   => $block['img_sm_philosophy_block'],
            'desc_philosophy_block' => $block['desc_philosophy_block'],
            'type_read_more_link'   => $block['type_read_more_link'],
            'link_custom_philosophy_block'  => $block['link_custom_philosophy_block'],
            'page_object_philosophy_block'  => $block['page_object_philosophy_block'],

            // Content Slider Blocks
            'title_content_slider_block'    => $block['title_content_slider_block'],
            'desc_content_slider_block' => $block['desc_content_slider_block'],
            'type_read_more_link_content_slider_block'  => $block['type_read_more_link_content_slider_block'],
            'link_custom_content_slider_block'  => $block['link_custom_content_slider_block'],
            'cpt_content_slider_block'  => $block['cpt_content_slider_block'],
            'post_display_content_slider_block' => $block['post_display_content_slider_block'],
            'post_object_content_slider_block'  => $block['post_object_content_slider_block'],
            // ''    => $block[''],


        ];
        switch ($block['_type']) {

            // Slider Blocks
            case 'slider_blocks':
                get_template_part('template-parts/block', 'slider', $args);
                break;

            // Philosophy Blocks
            case 'philosophy_blocks':
                get_template_part('template-parts/block', 'philosophy', $args);
                break;

            // Content Slider Blocks
            case 'content_slider_blocks':
                get_template_part('template-parts/block', 'content-slider', $args);
                break;
        }
    }
endwhile;
