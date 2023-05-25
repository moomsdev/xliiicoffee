<section class="subscription loop-colleague">
    <div class="row">
        <div class="col-12 title-link">
            <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $post_count = 0;
        $post_query = new WP_Query([
            'post_type' => 'collaboration',
            'posts_per_page' => -1, // Số lượng bài viết hiển thị trên mỗi trang
            'post_status' => 'publish',
            'tax_query'      => [
                [
                    'taxonomy'         => 'collaboration_cat',
                    'field'            => 'term_id',
                    'terms'            => $idCat,
                    'include_children' => true,
                ],
            ],
        ]);

        if ($post_query->have_posts()) :
            while ($post_query->have_posts()) : $post_query->the_post();
                $desc = getPostMeta('description');
            ?>
                <div class="col-12 item item-full" style=" background: url('<?php thePostThumbnailUrl(); ?>') no-repeat center center; ">
                    <div class="left-column"></div>
                    <div class="right-column">
                            <div class="item__inner">
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="title-post"><?php theTitle(); ?>  </h3>
                                </a>

                                <?php
                                if ( $desc ) :
                                ?>
                                    <div class="desc-post">
                                        <?php echo $desc; ?>
                                    </div>
                                <?php
                                endif;
                                ?>

                            </div>
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
