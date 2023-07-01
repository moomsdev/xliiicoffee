<section class="featured-post-block describe-the-origin">
    <div class="row">
        <div class="col-12 title-link">
            <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
            <a href="<?php echo $slugCat; ?>" class="read-more-blocks underline-hover"><?php echo __('Xem tất cả', 'gaumap'); ?></a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-6 left-column">
            <?php
            $post_query = new WP_Query([
                'post_type'        => get_post_type(),
                'posts_per_page'   => 1,
                'post_status'      => 'publish',
                'order'            => 'DESC',
                'tax_query'      => [
                    [
                        'taxonomy'         => 'journal_cat',
                        'field'            => 'term_id',
                        'terms'            => $idCat,
                        'include_children' => true,
                    ],
                ],
            ]);

            if ($post_query->have_posts()) :
                while ($post_query->have_posts()) : $post_query->the_post();
                    $imgLarge = getPostMetaImageUrl('large_img');
                    ?>
                    <figure class="media lg-img">
                        <img src="<?php echo getPostThumbnailUrl(get_the_ID()) ?>" alt="<?php get_the_title() ?>">';
                    </figure>
                <?php
                endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </div>

        <div class="col-12 col-xl-6 right-column">
            <div class="post-items">
                <?php
                    $post_query = new WP_Query([
                        'post_type'        => get_post_type(),
                        'posts_per_page'   => 2,
                        'post_status'      => 'publish',
                        'order'            => 'DESC',
                        'tax_query'      => [
                            [
                                'taxonomy'         => 'journal_cat',
                                'field'            => 'term_id',
                                'terms'            => $idCat,
                                'include_children' => true,
                            ],
                        ],
                    ]);

                    if ($post_query->have_posts()) :
                        while ($post_query->have_posts()) : $post_query->the_post();
                            $imgLarge = getPostMetaImageUrl('large_img');
                            $title = get_the_title();
                            $desc = getPostMeta('description');
                            ?>

                            <div class="post-item">
                                <div class="post-item__inner">
                                    <div class="inner__content">
                                        <?php
                                        $tags = get_the_terms(get_the_ID(), 'journal_tags');
                                        if($tags) :
                                            ?>
                                            <div class="tags">
                                                <ul>
                                                    <?php
                                                    foreach ($tags as $tag) :
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo get_term_link($tag->term_id) ?>" class="text-shadow">
                                                                <?php
                                                                echo $tag->name;
                                                                ?>
                                                            </a>
                                                        </li>
                                                    <?php
                                                        break;
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
                                                <?php
                                                if ($imgLarge) :
                                                    echo ' <img src="' . $imgLarge . '" alt="' . get_the_title() . '">';
                                                else:
                                                    echo ' <img src="' . getPostThumbnailUrl(get_the_ID()) . '" alt="' . get_the_title() . '">';
                                                endif;
                                                ?>
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


                ?>
            </div>
        </div>
    </div>

</section>
