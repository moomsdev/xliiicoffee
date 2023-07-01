<section class="newest">

    <div class="row">
        <div class="col-12 title-link">
            <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        // Show the last 2 posts
        $post_query = new WP_Query([
            'post_type'      => 'journal',
            'posts_per_page' => 2,
            'post_status'    => 'publish',
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
                $category = get_the_terms(get_the_ID(), 'journal_cat');
                $tag = get_the_terms(get_the_ID(), 'journal_tags');
                ?>
                <div class="col-12 col-lg-6 newest-post">
                    <figure class="media">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php thePostThumbnailUrl(); ?>" alt="<?php theTitle(); ?>">
                        </a>
                    </figure>
                    <div class="content">
                        <?php
                        if ( $category && $tag ) :
                            ?>
                            <div class="categories">
                                <ul>
                                    <?php
                                    foreach ( $category as $term ) :
                                        echo "<li> $term->name </li>";
                                        break;
                                    endforeach;

                                    foreach ( $tag as $item ) :
                                        echo "<li> $item->name </li>";
                                        break;
                                    endforeach;
                                    ?>

                                </ul>
                            </div>
                        <?php
                        endif;
                        ?>

                        <a href="<?php the_permalink(); ?>">
                            <h4 class="title-post fs-30"><?php theTitle(); ?></h4>
                        </a>

                    </div>
                </div>
            <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>
</section>

<section class="find-the-origin">

    <div class="row items">
        <?php
        $post_query = new WP_Query([
            'post_type'      => 'journal',
            'posts_per_page' => 12,
            'post_status'    => 'publish',
            'offset'            => 2,
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
                $tag = get_the_terms($post, 'journal_tags');
                $desc = getPostMeta('description');
                ?>
                <div class="item col-12 col-lg-6">
                    <div class="item-media">
                        <figure class="media">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php thePostThumbnailUrl(); ?>" alt="<?php theTitle(); ?>">
                            </a>
                        </figure>
                    </div>

                    <div class="content">
                        <?php
                        if ( $tag ) :
                            ?>
                            <div class="categories">
                                <ul>
                                    <?php
                                    foreach ( $tag as $item ) :
                                        echo "<li> $item->name </li>";
                                        break;
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                        <?php
                        endif;
                        ?>

                        <a href="<?php the_permalink(); ?>">
                            <h4 class="title-post fs-30"><?php theTitle(); ?></h4>
                        </a>

                        <?php
                        if ( $desc ) :
                            ?>
                            <div class="desc-post">
                                <?php echo apply_filters( 'the_content', $desc); ?>
                            </div>
                        <?php
                        endif;
                        ?>

                    </div>
                </div>
            <?php

            endwhile;
            wp_reset_postdata();
            // Tạo phân trang
            $total_pages = $post_query->max_num_pages;
            if ($total_pages > 1) {
                $current_page = max(1, get_query_var('paged'));
                echo '<div class="pagination">';
                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => 'page/%#%',
                    'current' => $current_page,
                    'total' => $total_pages,
                    'prev_text' => __('«'),
                    'next_text' => __('»'),
                ));
                echo '</div>';
            }
        endif;
        wp_reset_query();
        ?>
    </div>
</section>

