<?php
global $product;
?>
<section class="coffee-bean">
    <div class="row">
        <div class="col-12 title-link">
            <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
            <a href="<?php echo $slugCat; ?>" class="read-more-blocks underline-hover"><?php echo __('Xem tất cả', 'gaumap'); ?></a>
        </div>
    </div>

    <div class="row items">
        <?php
        if ( $post_query->have_posts() ) :
            while ( $post_query->have_posts() ) : $post_query->the_post();
                $categories = get_the_terms(get_the_ID(), 'product_cat');
                $varieties = get_the_terms(get_the_ID(), 'variety_cat');
                $origin = getPostMeta('origin',$post['id']);
                $region = getPostMeta('region',$post['id']);
                $product = wc_get_product(get_the_ID());
                $descCoffee = apply_filters( 'the_content', $product->get_description() );
        ?>
                <div class="item <?php echo $fistPost = ($post_query->current_post == 0) ? 'col-12' : 'col-12 col-sm-6 col-lg-4 col-xl-3'; ?>">

                    <?php
                    if ( $post_query->current_post == 0 ) :
                        echo '<div class="first-post">';
                    endif;
                    ?>
                        <figure class="media">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php thePostThumbnailUrl(); ?>" alt="<?php theTitle(); ?>">
                            </a>
                        </figure>
                        <div class="content">

                            <?php
                            if ( $categories && $varieties ) :
                            ?>
                                <div class="categories">
                                    <ul>
                                        <?php
                                        foreach ($categories as $category) {
                                            $children = get_term_children($category->term_id, 'product_cat');
                                            if (!empty($children) && !is_wp_error($children)) {
                                                foreach ($children as $child) {
                                                    $child_category = get_term_by('term_id', $child, 'product_cat');
                                                    if (has_term($child_category->term_id, 'product_cat', get_the_ID())) {
                                                        echo "<li>$child_category->name</li>";
                                                    }
                                                }
                                            }
                                        }

                                        foreach ($varieties as $variety) {
                                            echo  "<li> $variety->name </li>";
                                            break;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            <?php
                            endif;
                            ?>

                            <a href="<?php the_permalink(); ?>">
                                <h4 class="title-post fs-30"><?php theTitle(); ?></h4>
                            </a>


                            <?php theProductPrice($product); ?>

                            <?php
                            if ( $origin || $region) :
                                echo ' <div class="origin-product">' . $origin . ', ' . $region . '</div>';
                            endif;
                            ?>

                            <?php
                            if ( $post_query->current_post == 0 ) :
                                if ( $descCoffee ) :
                                    ?>
                                    <div class="desc-post">
                                        <?php echo $descCoffee; ?>
                                    </div>
                                <?php
                                endif;
                            endif;
                            ?>

                        </div>

                    <?php
                    if ( $post_query->current_post == 0 ) :
                        echo '</div>';
                    endif;
                    ?>

                </div>
        <?php
            endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>
</section>
