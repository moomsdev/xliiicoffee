<?php
$sliders = $args['slider_block'];

$title  = $args['title_featured_post_block'];
$typeLink   = $args['type_read_more_link_featured_post_block'];
$readLink   = $args['link_custom_featured_post_block'];

$cpt = $args['cpt_featured_post_block'];
$postStyle = $args['post_display_featured_post_block'];
$coffeeGuide = $args['coffee_guide_object_featured_post_block'];
$collaboration = $args['collaboration_object_featured_post_block'];
$location = $args['location_object_featured_post_block'];
$workWithUs = $args['work_with_us_object_featured_post_block'];
$product = $args['product_object_featured_post_block'];
$journal = $args['journal_object_featured_post_block'];

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

endif;

?>
<section class="featured-post-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 title-link">
                <h2 class="title-blocks"><?php echo $title; ?></h2>
                <a href="<?php echo $link; ?>" class="read-more-blocks text-shadow"><?php echo __('Xem tất cả', 'gaumap'); ?></a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-6 left-column">
                <?php
                if ( $postStyle == 'auto' ) :

                // Automatically display the last 2 posts
                    $post_query = new WP_Query([
                        'post_type'        => $cpt,
                        'posts_per_page'   => 1,
                        'post_status'      => 'publish',
                        'order'            => 'DESC',
                    ]);

                    if ($post_query->have_posts()) :
                        while ($post_query->have_posts()) : $post_query->the_post();
                            $imgLarge = getPostMetaImageUrl('large_img');

                            if ($imgLarge) :
                                $img = $imgLarge;
                            else:
                                $img = getPostThumbnailUrl(get_the_ID());
                            endif;
                            ?>
                                <figure class="media lg-img">
                                    <img src="<?php echo $img; ?>" alt="<?php theTitle();?>">
                                </figure>
                            <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    wp_reset_query();

                else:

                    // Select 2 articles manually
                    $i = 0;
                    foreach ( $cptQuery as $post ) :
                        $imgLarge = getPostMetaImageUrl('large_img',$post['id']);

                        if ($imgLarge) :
                            $img = $imgLarge;
                        else:
                            $img = getPostThumbnailUrl($post['id']);
                        endif;
                    ?>
                        <figure class="media lg-img">
                            <img src="<?php echo $img; ?>" alt="<?php echo get_the_title($post['id']); ?>">
                        </figure>
                    <?php
                        $i= 1;
                        break;
                    $i++;
                    endforeach;

                endif;
                ?>
            </div>

            <div class="col-12 col-xl-6 right-column">
                <div class="post-items">
                    <?php
                    if ( $postStyle == 'auto' ) :

                         // Automatically display the last 2 posts
                        $post_query = new WP_Query([
                            'post_type'        => $cpt,
                            'posts_per_page'   => 2,
                            'post_status'      => 'publish',
                            'order'            => 'DESC',
                        ]);

                        if ($post_query->have_posts()) :
                            while ($post_query->have_posts()) : $post_query->the_post();
                                $imgLarge = getPostMetaImageUrl('large_img');
                                $title = get_the_title();
                                $desc = getPostMeta('description');

                                if ($imgLarge) :
                                    $img = $imgLarge;
                                else:
                                    $img = getPostThumbnailUrl(get_the_ID());
                                endif;
                                ?>

                                    <div class="post-item">
                                        <div class="post-item__inner">
                                            <div class="inner__content">
                                                <?php
                                                $tags = get_the_terms(get_the_ID(), $tagsCPT);
                                                if($tags) :
                                                ?>
                                                    <div class="tags">
                                                            <ul>
                                                                <?php
                                                                foreach ($tags as $tag) :
                                                                ?>
                                                                    <li>
                                                                        <a href="<?php echo get_term_link($tag->term_id) ?>" class="text-shadow">
                                                                            <?php echo $tag->name ?>
                                                                        </a>
                                                                    </li>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                            </ul>
                                                    </div>
                                                <?php
                                                endif;
                                                ?>

                                                <a href="<?php the_permalink(); ?>">
                                                    <h3 class="title-post"><?php theTitle(); ?>  </h3>
                                                </a>

                                                <div class="desc-post">
                                                    <?php echo apply_filters('the_content', $desc); ?>
                                                </div>
                                            </div>

                                            <div class="inner__media">
                                                <a href="<?php the_permalink(); ?>">
                                                    <figure class="media sm-img">
                                                        <img src="<?php thePostThumbnailUrl(); ?>" alt="<?php theTitle(); ?>">
                                                    </figure>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        wp_reset_query();

                    else:

                        // Select 2 articles manually
                        foreach ( $cptQuery as $post ) :
                        ?>

                            <div class="post-item">
                                <div class="post-item__inner">
                                    <div class="inner__content">
                                        <?php
                                        $tags = get_the_terms($post['id'], $tagsCPT);
                                        if($tags) :
                                        ?>
                                            <div class="tags">
                                                <ul>
                                                    <?php
                                                    foreach ($tags as $tag) :
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo get_term_link($tag->term_id) ?>" class="text-shadow">
                                                                <?php echo $tag->name ?>
                                                            </a>
                                                        </li>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </ul>
                                            </div>
                                        <?php
                                        endif;
                                        ?>

                                        <a href="<?php echo get_permalink($post['id']); ?>">
                                            <h3 class="title-post fs-43"><?php echo get_the_title($post['id']); ?>  </h3>
                                        </a>

                                        <div class="desc-post">
                                            <?php
                                            $desc = getPostMeta('description',$post['id']);
                                            echo apply_filters('the_content', $desc);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="inner__media">
                                        <a href="<?php echo get_permalink($post['id']); ?>">
                                            <figure class="media sm-img">
                                                <img src="<?php echo getPostThumbnailUrl($post['id']); ?>" alt="<?php echo get_the_title($post['id']); ?>">
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php
                        endforeach;

                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
