<section class="subscription loop-colleague">
    <div class="row">
        <div class="col-12 title-link">
            <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
            <a href="<?php echo $slugCat; ?>" class="read-more-blocks underline-hover"><?php echo __('Xem tất cả', 'gaumap'); ?></a>
        </div>
    </div>

    <div class="row">
        <?php
        if ($post_query->have_posts()) :
            while ($post_query->have_posts()) : $post_query->the_post();
        ?>
                <div class="col-12 item item-full" style=" background: url('<?php thePostThumbnailUrl(); ?>') no-repeat center center; ">
                    <div class="left-column"></div>
                    <div class="right-column">
                            <div class="item__inner">
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="title-post"><?php theTitle(); ?>  </h3>
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
        endif;

        wp_reset_query();
        ?>
    </div>

</section>
