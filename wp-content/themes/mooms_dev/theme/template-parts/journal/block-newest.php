<section class="newest">

    <div class="row">
        <div class="col-12 title-link">
            <h2 class="title-blocks"><?php echo __('Mới nhất', 'gaumap'); ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        // Show the last 2 posts
        $post_query = new WP_Query([
            'post_type'        => 'journal',
            'posts_per_page'   => 2,
            'post_status'      => 'publish',
            'orderby'          => 'date',
            'order'            => 'DESC',
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
