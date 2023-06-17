<?php
global $product;
?>
<section class="subscription">
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

                if ( $post_query->found_posts == 1 ) :
                ?>
                    <div class="col-12 item item-full" style=" background: url('<?php thePostThumbnailUrl(); ?>') no-repeat center center; ">
                        <div class="left-column"></div>
                        <div class="right-column">
                                <div class="item__inner">
                                    <a href="<?php the_permalink(); ?>">
                                        <h3 class="title-post"><?php theTitle(); ?>  </h3>
                                    </a>

                                    <?php theProductPrice($product); ?>

                                    <?php
                                    $desc = apply_filters( 'the_content', $product->get_description() );
                                    if ( $desc ) :
                                        ?>
                                        <div class="desc-post">
                                            <?php echo $desc; ?>
                                        </div>
                                    <?php
                                    endif;
                                    ?>

                                    <a href="<?php the_permalink(); ?>" class="see-more-post"><?php echo __('Xem thêm', 'gaumap'); ?></a>

                                </div>
                            </div>
                    </div>

                <?php
                else:
                ?>

                    <div class="col-12 col-lg-6 item item-half" style=" background: url('<?php thePostThumbnailUrl(); ?>') no-repeat center center; ">

                        <div class="item__inner">
                            <a href="<?php the_permalink(); ?>">
                                <h3 class="title-post"><?php theTitle(); ?>  </h3>
                            </a>

                            <?php theProductPrice($product); ?>

                            <?php
                            $product = wc_get_product(get_the_ID());
                            $desc = apply_filters( 'the_content', $product->get_description() );
                            if ( $desc ) :
                            ?>
                                <div class="desc-post">
                                    <?php echo $desc; ?>
                                </div>
                            <?php
                            endif;
                            ?>

                            <a href="<?php the_permalink(); ?>" class="see-more-post"><?php echo __('Xem thêm', 'gaumap'); ?></a>

                        </div>
                    </div>

        <?php
                endif;
            endwhile;
            wp_reset_postdata();
        endif;

        wp_reset_query();
        ?>
    </div>

</section>
