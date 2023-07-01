<?php
/**
 * App Layout: layouts/app.php
 *
 * This is the template that is used for displaying all pages by default.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPEmergeTheme
 */

?>
<div class="page-listing journal">
<section class="find-the-origin">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php
                global $wp_query; // Lấy đối tượng truy vấn tìm kiếm hiện tại
                $total_results = $wp_query->found_posts; // Số lượng bài viết trong kết quả tìm kiếm
                $title = sprintf(__('%s', 'gaumap'), get_search_query());
                if ( is_search() ) :
                    echo '<h2 class="title-blocks"> '. $title .' </h2>';
                    echo '<h4 class="title-result"> '. $total_results .' '. __('kết quả cho từ khóa', 'gaumap') .' "'. $title .'" </h4>';
                endif;
                ?>
            </div>
        </div>

        <div class="row items">
        <?php
        if (have_posts()) :
            while(have_posts()) : the_post();
                // $tag = get_the_terms($post, 'journal_tags');
                $cpt = get_post_type();
                if ( $cpt == 'collaboration' ) :
                    $tag = get_the_terms($post, 'collaboration_tags');
                elseif ( $cpt == 'journal' ) :
                    $tag = get_the_terms($post, 'journal_tags');
                elseif ( $cpt == 'location' ) :
                    $tag = get_the_terms($post, 'location_tags');
                elseif ( $cpt == 'product' ) :
                    $tag = get_the_terms($post, 'product_tag');
                elseif ( $cpt == 'work_with_us' ) :
                    $tag = get_the_terms($post, 'work_with_us_tags');
                endif;

                $desc = getPostMeta('description');
                ?>
                <div class="item col-12 col-lg-6">
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
            wp_reset_postdata();
        else:
            echo '<h3> '. __('Không có bài viết liên quan tới từ khóa tìm kiếm', 'gaumap') .' </h3>';
        endif;
        thePagination();
        ?>
    </div>

    </div>
</section>
</div>
