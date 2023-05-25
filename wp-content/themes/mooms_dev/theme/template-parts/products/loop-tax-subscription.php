<section class="subscription">
    <div class="title-link">
        <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
    </div>

    <div class="row">
        <?php
        $post_count = 0;
        if (have_posts()) :
            while (have_posts()) : the_post();
                if ( $post_count < 1 ) :
                ?>

                    <div class="col-12 item item-full">
                        <figure class="item__bg">
                            <img src="<?php thePostThumbnailUrl(); ?>" alt="<?php theTitle(); ?>">
                        </figure>

                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6 item__inner">
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="title-post"><?php theTitle(); ?>  </h3>
                                </a>

                                <?php theProductPrice(); ?>

                                <?php
                                global $product;
                                $desc = apply_filters( 'the_content', $product->get_description() );
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
                else:
                ?>

                    <div class="col-12 col-sm-6 item item-half">
                        <figure class="item__bg">
                            <img src="<?php thePostThumbnailUrl(); ?>" alt="<?php theTitle(); ?>">
                        </figure>

                        <div class="item__inner">
                            <a href="<?php the_permalink(); ?>">
                                <h3 class="title-post"><?php theTitle(); ?>  </h3>
                            </a>

                            <?php theProductPrice(); ?>

                            <?php
                            global $product;
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
                $post_count++;
            endwhile;
            wp_reset_postdata();
        endif;
        thePagination();
        ?>
    </div>

</section>
