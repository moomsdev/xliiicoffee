<?php
$title = $args['title_content_slider_block'];
$desc = $args['desc_content_slider_block'];
$typeLink = $args['type_read_more_link_content_slider_block'];
$readLink = $args['link_custom_content_slider_block'];

$cpt = $args['cpt_content_slider_block'];
$postStyle = $args['post_display_content_slider_block'];
$coffeeGuide = $args['coffee_guide_object_content_slider_block'];
$collaboration = $args['collaboration_object_content_slider_block'];
$location = $args['location_object_content_slider_block'];
$workWithUs = $args['work_with_us_object_content_slider_block'];
$product = $args['product_object_content_slider_block'];
$journal = $args['journal_object_content_slider_block'];

if ( $typeLink == 'manual' ) :
    $link = $readLink;
else:
    $link = get_post_type_archive_link( $cpt );
endif;

if ( $cpt == 'coffee_guide' ) :
    $tagsCPT = 'coffee_guide_tags';
    $cptQuery = $coffeeGuide;

elseif ( $cpt == 'collaboration' ) :
    $tagsCPT = 'collaboration_tags';
    $cptQuery = $collaboration;

elseif ( $cpt == 'location' ) :
    $tagsCPT = 'location_tags';
    $cptQuery = $location;

elseif ( $cpt == 'work_with_us' ) :
    $tagsCPT = 'work_with_us_tags';
    $cptQuery = $workWithUs;

elseif ( $cpt == 'journal' ) :
    $tagsCPT = 'journal_tags';
    $cptQuery = $journal;

else :
    $tagsCPT = 'product_tag';
    $cptQuery = $product;
    $classProduct = 'product-img';

endif;

global $product;
?>
<section class="content-slider-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 title-link">
                <h2 class="title-blocks"><?php echo $title; ?></h2>
                <a href="<?php echo $link; ?>" class="read-more-blocks text-shadow"><?php echo __('Xem tất cả', 'gaumap'); ?></a>
            </div>
        </div>

        <?php if ( $desc ) : ?>
        <div class="row">
            <div class="col-12 col-lg-6 description-blocks">
                <?php echo apply_filters('the_content', $desc); ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="items">
            <div class="swiper content-slider swiper-backface-hidden">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <?php
                    if ( $postStyle == 'auto' ) :

                        // Automatically display the last 8 posts
                        $post_query = new WP_Query([
                            'post_type'        => $cpt,
                            'posts_per_page'   => 8,
                            'post_status'      => 'publish',
                            'orderby'          => 'date',
                            'order'            => 'DESC',
                        ]);

                        if ($post_query->have_posts()) :
                            while ($post_query->have_posts()) : $post_query->the_post();

                                $post_type = get_post_type();
                                if ( $post_type == 'product' ) :
                                    $taxonomy = "product_cat";
                                    $varieties = get_the_terms(get_the_ID(), 'variety_cat');
                                    $origin = getPostMeta('origin');
                                    $region = getPostMeta('region');
                                elseif ( $post_type == 'coffee_guide' ) :
                                    $taxonomy = "coffee_guide_cat";
                                elseif ( $post_type == 'work_with_us' ) :
                                    $taxonomy = "work_with_us_cat";
                                elseif ( $post_type == 'collaboration' ) :
                                    $taxonomy = "collaboration_cat";
                                elseif ( $post_type == 'journal' ) :
                                    $taxonomy = "journal_cat";
                                endif;

                                $categories = get_the_terms(get_the_ID(), $taxonomy);
                                $productID = wc_get_product(get_the_ID());
                                $desc = getPostMeta('description');
                        ?>

                                <div class="swiper-slide">
                                    <div class="item">
                                        <figure class="media">
                                            <a href="<?php the_permalink(); ?>">
                                                <img <?php echo $classProduct; ?> src="<?php thePostThumbnailUrl(); ?>" alt="<?php theTitle(); ?>">
                                            </a>
                                        </figure>

                                        <div class="content">
                                            <?php
                                            if ( $categories && $varieties ) :
                                                ?>
                                                <div class="categories">
                                                    <ul>
                                                        <?php
                                                        foreach ($categories as $category) {
                                                            $children = get_term_children($category->term_id, 'product_cat');
                                                            if (!empty($children) && !is_wp_error($children)) {
                                                                foreach ($children as $child) {
                                                                    $child_category = get_term_by('term_id', $child, 'product_cat');
                                                                    if (has_term($child_category->term_id, 'product_cat', get_the_ID())) {
                                                                        echo "<li>$child_category->name</li>";
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        foreach ($varieties as $variety) {
                                                            echo  "<li> $variety->name </li>";
                                                            break;
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            <?php
                                            endif;
                                            ?>

                                            <a href="<?php the_permalink(); ?>">
                                                <h4 class="title-post fs-30"><?php theTitle(); ?></h4>
                                            </a>


                                            <?php //theProductPrice($productID); ?>

                                            <?php
                                            if ( $origin || $region) :
                                                echo ' <div class="origin-product">'. $origin .', ' . $region . '</div>';
                                            endif;
                                            ?>

                                            <?php
                                            if ( $desc ) :
                                                echo '<div class="desc-post"> ' . $desc . '</div>';
                                            endif;
                                            ?>

                                        </div>
                                    </div>
                                </div>

                        <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        wp_reset_query();

                    else:

                        foreach ( $cptQuery as $post ) :

                            $post_type = get_post_type($post['id']);
                            if ( $post_type == 'product' ) :
                                $taxonomy = "product_cat";
                                $variety = "variety_cat";

                            elseif ( $post_type == 'coffee_guide' ) :
                                $taxonomy = "coffee_guide_cat";
                            elseif ( $post_type == 'work_with_us' ) :
                                $taxonomy = "work_with_us_cat";
                            elseif ( $post_type == 'collaboration' ) :
                                $taxonomy = "collaboration_cat";
                            elseif ( $post_type == 'journal' ) :
                                $taxonomy = "journal_cat";
                            endif;

                            $categories = get_the_terms($post['id'], $taxonomy);
                            $varieties = get_the_terms($post['id'], $variety);
                            $origin = getPostMeta('origin',$post['id']);
                            $region = getPostMeta('region',$post['id']);
                            $desc = getPostMeta('description',$post['id']);
                            ?>
                            <div class="swiper-slide">
                                <div class="item">
                                    <figure class="media">
                                        <a href="<?php echo get_permalink($post['id']); ?>">
                                            <img class="<?php echo $classProduct; ?>" src="<?php echo getPostThumbnailUrl($post['id']); ?>" alt="<?php echo get_the_title($post['id']); ?>">
                                        </a>
                                    </figure>

                                    <div class="content">
                                        <?php
                                        if ( $categories && $varieties ) :
                                            ?>
                                            <div class="categories">
                                                <ul>
                                                    <?php
                                                    foreach ($categories as $category) {
                                                        $children = get_term_children($category->term_id, $taxonomy);
                                                        if (!empty($children) && !is_wp_error($children)) {
                                                            foreach ($children as $child) {
                                                                $child_category = get_term_by('term_id', $child, $taxonomy);
                                                                if (has_term($child_category->term_id, $taxonomy, $post['id'])) {
                                                                    echo "<li>$child_category->name</li>";
                                                                }
                                                            }
                                                        }
                                                    }

                                                    foreach ($varieties as $variety) {
                                                        echo  "<li> $variety->name </li>";
                                                        break;
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        <?php
                                        endif;
                                        ?>

                                        <a href="<?php echo get_permalink($post['id']); ?>">
                                            <h4 class="title-post fs-30">
                                                <?php echo get_the_title($post['id']); ?>
                                            </h4>
                                        </a>

                                        <?php
                                        if ( $origin || $region) :
                                            echo ' <div class="origin-product">' . $origin . ', ' . $region . '</div>';
                                        endif;
                                        ?>

                                        <?php
                                        if ( $desc ) :
                                            echo '<div class="desc-post">' . $desc . '</div>';
                                        endif;
                                        ?>

                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;

                    endif;
                    ?>
                </div>
                <div class="swiper-scrollbar swiper-scrollbar-horizontal"></div>
            </div>
        </div>

    </div>
</section>
<?php
