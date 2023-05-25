<section class="coffee-bean loop-partner">
    <div class="row">
        <div class="col-12 title-link">
            <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
        </div>

        <?php if ( $desc ) : ?>
            <div class="col-12 col-lg-6 description-blocks">
                <?php echo apply_filters('the_content', $desc); ?>
            </div>
        <?php endif; ?>
    </div>


    <div class="row items">
        <?php
        $post_query = new WP_Query([
            'post_type' => 'collaboration',
            'posts_per_page' => 8, // Số lượng bài viết hiển thị trên mỗi trang
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
        ?>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="item">
                    <figure class="media">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php thePostThumbnailUrl(); ?>" alt="<?php theTitle(); ?>">
                        </a>
                    </figure>

                    <div class="content">

                        <a href="<?php the_permalink(); ?>">
                            <h4 class="title-post fs-30"><?php theTitle(); ?></h4>
                        </a>

                        <?php
                        $desc = getPostMeta('description');
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
