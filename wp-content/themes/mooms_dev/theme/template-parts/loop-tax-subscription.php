<div class="subscription">
    <div class="title-link">
        <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
        <a href="<?php echo $slugCat; ?>" class="read-more-blocks up-hover"><?php echo __('Xem tất cả', 'gaumap'); ?></a>
    </div>

    <div class="row">
        <?php

        if (have_posts()) :
            while (have_posts()) : the_post();;

                if ( $post_query->found_posts == 1 ) :
                ?>
                    <div class="col-12 item">
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="title-post"><?php theTitle(); ?>  </h3>

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
                                </a>
                            </div>
                        </div>
                    </div>

                <?php
                else:
                ?>

                    <div class="col-12 col-sm-6 item">
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
            endwhile;
            wp_reset_postdata();
        endif;

        wp_reset_query();
        ?>
    </div>

</div>
