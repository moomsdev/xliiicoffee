<?php
while (have_posts()) : the_post();
    $blocks = carbon_get_the_post_meta('choose_block');
    foreach ($blocks as $block) {
        $args = [

            // Content Blocks
            'content_block'     => $block['content_block'],

            // Slider Blocks
            'slider_block'     => $block['slider_block'],

            // Philosophy Blocks - style 1
            'title_philosophy_block'    => $block['title_philosophy_block'],
            'img_lg_philosophy_block'   => $block['img_lg_philosophy_block'],
            'img_sm_philosophy_block'   => $block['img_sm_philosophy_block'],
            'desc_philosophy_block' => $block['desc_philosophy_block'],
            'type_read_more_link'   => $block['type_read_more_link_philosophy_block'],
            'link_custom_philosophy_block'  => $block['link_custom_philosophy_block'],
            'page_object_philosophy_block'  => $block['page_object_philosophy_block'],

            // Philosophy Blocks - style 2
            'title_philosophy_block_2'    => $block['title_philosophy_block_2'],
            'img_philosophy_block_2'   => $block['img_philosophy_block_2'],
            'desc_philosophy_block_2' => $block['desc_philosophy_block_2'],
            'type_read_more_link_philosophy_block_2'   => $block['type_read_more_link_philosophy_block_2'],
            'link_custom_philosophy_block_2'  => $block['link_custom_philosophy_block_2'],
            'page_object_philosophy_block_2'  => $block['page_object_philosophy_block_2'],

            // Content Slider Blocks
            'title_content_slider_block'    => $block['title_content_slider_block'],
            'desc_content_slider_block' => $block['desc_content_slider_block'],
            'type_read_more_link_content_slider_block'  => $block['type_read_more_link_content_slider_block'],
            'link_custom_content_slider_block'  => $block['link_custom_content_slider_block'],
            'cpt_content_slider_block'  => $block['cpt_content_slider_block'],
            'post_display_content_slider_block' => $block['post_display_content_slider_block'],
            'coffee_guide_object_content_slider_block'  => $block['coffee_guide_object_content_slider_block'],
            'collaboration_object_content_slider_block'  => $block['collaboration_object_content_slider_block'],
            'location_object_content_slider_block'  => $block['location_object_content_slider_block'],
            'work_with_us_object_content_slider_block'  => $block['work_with_us_object_content_slider_block'],
            'product_object_content_slider_block'  => $block['product_object_content_slider_block'],
            'journal_object_content_slider_block'  => $block['journal_object_content_slider_block'],


            // Featured post block
            'title_featured_post_block'    => $block['title_featured_post_block'],
            'type_read_more_link_featured_post_block'    => $block['type_read_more_link_featured_post_block'],
            'link_custom_featured_post_block'    => $block['link_custom_featured_post_block'],
            'cpt_featured_post_block'    => $block['cpt_featured_post_block'],
            'post_display_featured_post_block'    => $block['post_display_featured_post_block'],
            'coffee_guide_object_featured_post_block'    => $block['coffee_guide_object_featured_post_block'],
            'collaboration_object_featured_post_block'    => $block['collaboration_object_featured_post_block'],
            'location_object_featured_post_block'    => $block['location_object_featured_post_block'],
            'work_with_us_object_featured_post_block'    => $block['work_with_us_object_featured_post_block'],
            'product_object_featured_post_block'    => $block['product_object_featured_post_block'],
            'journal_object_featured_post_block'    => $block['journal_object_featured_post_block'],

        ];
        switch ($block['_type']) {

            // Content Blocks
            case 'content_blocks':
                get_template_part('template-parts/block', 'content', $args);
                break;

            // Slider Blocks
            case 'slider_blocks':
                get_template_part('template-parts/block', 'slider', $args);
                break;

            // Philosophy Blocks - style 1
            case 'philosophy_blocks':
                get_template_part('template-parts/block', 'philosophy', $args);
                break;

            // Philosophy Blocks - style 2
            case 'philosophy_blocks_2':
                get_template_part('template-parts/block', 'philosophy_2', $args);
                break;

            // Content Slider Blocks
            case 'content_slider_blocks':
                get_template_part('template-parts/block', 'content-slider', $args);
                break;

            // Featured post block
            case 'featured_post_blocks':
                get_template_part('template-parts/block', 'featured-post', $args);
                break;

        }
    }
endwhile;
