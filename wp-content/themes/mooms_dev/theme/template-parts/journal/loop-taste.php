<section class="find-the-origin taste-the-origin">
    <div class="row">
        <div class="col-12 title-link">
            <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
            <a href="<?php echo $slugCat; ?>" class="read-more-blocks underline-hover"><?php echo __('Xem tất cả', 'gaumap'); ?></a>
        </div>
    </div>

    <div class="items">
        <div class="item">
            <?php
            $post_query = new WP_Query([
                'post_type'      => 'journal',
                'posts_per_page' => 1,
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
                    $tag = get_the_terms($post, 'journal_tags');
                    $desc = getPostMeta('description');
                ?>
                    <div class="inner-item">
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
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </div>

        <div class="item">
            <?php
            $post_query = new WP_Query([
                'post_type'      => 'journal',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
                'offset'            => 1,
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
                        <div class="inner-item">
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
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </div>

        <div class="item">
            <?php
            $post_query = new WP_Query([
                'post_type'      => 'journal',
                'posts_per_page' => 4,
                'post_status'    => 'publish',
                'offset'            => 4,
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
                    <div class="inner-item">
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
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </div>
    </div>
</section>
