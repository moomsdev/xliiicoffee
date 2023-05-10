<section class="coffee-bean loop-partner">
    <div class="row">
        <div class="col-12 title-link">
            <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
            <a href="<?php echo $slugCat; ?>" class="read-more-blocks underline-hover"><?php echo __('Xem tất cả', 'gaumap'); ?></a>
        </div>

        <?php if ( $desc ) : ?>
            <div class="col-12 col-lg-6 description-blocks">
                <?php echo apply_filters('the_content', $desc); ?>
            </div>
        <?php endif; ?>
    </div>


    <div class="row items">
        <?php
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
        endif;
        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>
</section>
