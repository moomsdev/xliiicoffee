<?php
global $product;
$product = wc_get_product(get_the_ID());
?>
<section class="coffee-bean">
    <div class="title-link">
        <h2 class="title-blocks"><?php echo $titleCat; ?></h2>
    </div>

    <div class="categories">
        <ul>
            <?php
               $ProductCats = get_terms('product_cat', [
                    'hide_empty' => true,
                    'parent'   => 0,
                ]);
                foreach ($ProductCats as $ProductCat) :
                    $child_product_cats = get_terms('product_cat', [
                        'hide_empty'	=> true,
                        'parent'   		=> $ProductCat->term_id,
                    ]);
                    foreach ($child_product_cats as $type) :
            ?>
                        <li>
                            <a class="nav-link <?php echo $active ?>"  href="<?php echo $type->slug ?>"><?php echo $type->name ?></a>
                        </li>
            <?php
                    endforeach;
                endforeach;
            ?>
        </ul>
    </div>

    <div class="row items">
        <?php
        $post_count = 0;
        $post_query = new WP_Query([
            'post_type' => 'product',
            'posts_per_page' => 9, // Số lượng bài viết hiển thị trên mỗi trang
            'post_status' => 'publish',
            'tax_query'      => [
                [
                    'taxonomy'         => 'product_cat',
                    'field'            => 'term_id',
                    'terms'            => $idCat,
                    'include_children' => true,
                ],
            ],
        ]);

        if ($post_query->have_posts()) :
            while ($post_query->have_posts()) : $post_query->the_post();
                $category = get_the_terms($post, 'product_cat');
                $tag = get_the_terms($post, 'product_tag');
        ?>

                <div class="item <?php echo $fistPost = ($post_count  == 0) ? 'first-post col-12' : 'col-12 col-sm-6 col-lg-4 col-xl-3'; ?>">
                    <?php
                    if ( $post_count == 0 ) :
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
                        if ( $category && $tag ) :
                        ?>
                            <div class="categories">
                                <ul>
                                    <li><?php echo $category[0]->name; ?></li>
                                    <li><?php echo $tag[0]->name; ?></li>
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
                        $origin = getPostMeta('origin');
                        if ( $origin ) :
                        ?>
                            <div class="origin-product">
                                <?php echo $origin; ?>
                            </div>
                        <?php
                        endif;
                        ?>

                        <?php
                        global $product;
                        $desc = apply_filters( 'the_content', $product->get_description() );
                        if ( $post_count == 0 ) :
                            if ( $desc ) :
                            ?>
                                <div class="desc-post">
                                    <?php echo $desc; ?>
                                </div>
                            <?php
                            endif;
                        endif;
                        ?>

                    </div>
                    <?php
                    if ( $post_count == 0 ) :
                        echo '</div>';
                    endif;
                    ?>
                </div>

        <?php
                $post_count++;
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
