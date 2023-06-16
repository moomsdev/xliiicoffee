<?php
/**
 * App Layout: layouts/app.php
 *
 * This is the template that is used for displaying all posts by default.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPEmergeTheme
 */

$desc = getPostMeta('description');
$content_blocks = getPostMeta('content_blocks');
?>
<main class="main-content single-collaboration single-journal">
    <div class="container-fluid">

        <section class="post-head">
            <div class="section-half">
                <div class="col-12">
                    <h1 class="title-post text-center"><?php theTitle(); ?></h1>
                </div>
                <div class="col-12">
                    <div class="inner">
                        <?php
                        if ( $desc ) :
                        ?>
                            <div class="desc-post">
                                <?php echo apply_filters( 'the_content', $desc); ?>
                            </div>
                        <?php
                        endif;
                        ?>

                        <?php
                        if ( $content_blocks ) :
                        ?>
                        <div class="table-of-content">
                            <h2 class="title-table-of-content"><?php echo __('Mục lục', 'gaumap') ?></h2>
                            <ul>
                                <?php
                                foreach ( $content_blocks as $block ) :
                                    $title = $block['title_cbs'];
                                    $type = $block['content_blocks_display_type'];
                                    if ( $type == "cbs-1" || $type == "cbs-2" || $type == "cbs-3" ) :
                                        if ( $title ) :
                                            echo '<li> <a href="#' . sanitize_title($title) . ' "> ' . $title . ' </a> </li>';
                                        endif;
                                    endif;
                                endforeach;
                                ?>
                            </ul>
                        </div>

                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
        if ( $content_blocks ) :
            foreach ( $content_blocks as $block ) :
                $title = $block['title_cbs'];
                $image = $block['img_cbs'];
                $type_img_cbs = $block['type_img_cbs'];
                $url_img_cbs = $block['url_img_cbs'];
                $content = $block['content_cbs'];
                $albums_cbs = $block['albums_cbs'];
                $expanded_content_cbs = $block['expanded_content_cbs'];
            ?>
                <?php
                if ( $block['content_blocks_display_type'] == "cbs-1" ) :
                ?>
                    <section class="content-blocks cbs-1">
                        <div class="section-half">
                            <div class="col-12">
                                <?php
                                if ( $image ) :
                                ?>
                                    <figure class="media">
                                        <img src="<?php echo getImageUrlById($image) ?>" alt="<?php echo get_the_title($image); ?>">
                                    </figure>
                                <?php
                                endif;
                                ?>
                            </div>

                            <div class="col-12">
                                <div class="inner">

                                    <?php
                                    if ( $title ) :
                                    ?>
                                        <h3 id="<?php echo sanitize_title($title); ?>" class="title-cbs"><?php echo $title; ?></h3>
                                    <?php
                                    endif;
                                    ?>

                                    <?php
                                    if ( $block['subtitle_cbs_1'] ) :
                                    ?>
                                        <span class="subtitle"><?php echo $block['subtitle_cbs_1']; ?></span>
                                    <?php
                                    endif;
                                    ?>

                                    <?php
                                    if ( $content ) :
                                    ?>
                                        <div class="content-cbs"><?php echo $content; ?></div>
                                    <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                    endif;
                ?>

                <?php
                if ( $block['content_blocks_display_type'] == "cbs-2" ) :
                ?>
                    <section class="content-blocks cbs-2">
                        <div class="section-half">
                            <div class="col-12">

                            </div>

                            <div class="col-12">
                                <div class="inner">

                                    <?php
                                    if ( $title ) :
                                    ?>
                                        <h3 id="<?php echo sanitize_title($title); ?>" class="title-cbs"><?php echo $title; ?></h3>
                                    <?php
                                    endif;
                                    ?>

                                    <?php
                                    if ( $content ) :
                                        ?>
                                        <div class="content-cbs"><?php echo $content; ?></div>
                                    <?php
                                    endif;
                                    ?>

                                    <?php
                                    if ( $image ) :
                                    ?>
                                    <div class="inner-media">

                                            <img src="<?php echo getImageUrlById($image) ?>" alt="<?php echo get_the_title($image); ?>" style="shape-outside: url(<?php echo getImageUrlById($image) ?>);">

                                    </div>

                                    <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                endif;
                ?>

                <?php
                if ( $block['content_blocks_display_type'] == "cbs-3" ) :
                ?>
                    <section class="content-blocks cbs-3">
                        <div class="section-half">
                            <div class="col-12">

                            </div>

                            <div class="col-12">
                                <div class="inner">
                                    <?php
                                    if ( $title ) :
                                        ?>
                                        <h3 id="<?php echo sanitize_title($title); ?>" class="title-cbs"><?php echo $title; ?></h3>
                                    <?php
                                    endif;
                                    ?>

                                    <?php
                                    if ( $expanded_content_cbs ) :
                                        ?>
                                        <div class="expanded-content">
                                            <ul>
                                                <?php
                                                foreach ( $expanded_content_cbs as $value ) :
                                                    ?>
                                                    <li>
                                                        <h4 class="title-expanded"><?php echo $value['title_expanded'] ?></h4>
                                                        <div class="desc-expanded"><?php echo $value['dest_expanded'] ?></div>
                                                    </li>
                                                <?php
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    <?php
                                    endif;
                                    ?>

                                    <?php
                                    if ( $image ) :
                                        ?>
                                        <figure class="media">
                                            <img src="<?php echo getImageUrlById($image) ?>" alt="<?php echo get_the_title($image); ?>">
                                        </figure>
                                    <?php
                                    endif;
                                    ?>

                                    <?php
                                    if ( $block['subtitle_cbs_3'] ) :
                                        ?>
                                        <span class="subtitle"><?php echo $block['subtitle_cbs_3']; ?></span>
                                    <?php
                                    endif;
                                    ?>

                                    <?php
                                    if ( $content ) :
                                        ?>
                                        <div class="content-cbs"><?php echo $content; ?></div>
                                    <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php
                endif;
                ?>

                <?php
                if ( $block['content_blocks_display_type'] == "cbs-4" ) :
                    ?>
                    <section class="content-blocks cbs-4">
                        <div class="row">
                            <div class="col-12">
                                <?php
                                if ( $image ) :
                                    ?>
                                    <?php
                                    if ($url_img_cbs ) :
                                        echo '<a href=" ' . $url_img_cbs . ' ">';
                                    endif;
                                    ?>
                                    <figure class="text-center <?php echo $typeImage = ( $type_img_cbs == 'ratio' ) ? 'media' : 'media-original'; ?>">
                                        <img src="<?php echo getImageUrlById($image) ?>" alt="<?php echo get_the_title($image); ?>">
                                    </figure>
                                    <?php
                                    if ( $url_img_cbs ) :
                                        echo '</a>';
                                    endif;
                                    ?>
                                <?php
                                endif;
                                ?>
                            </div>
                        </div>
                    </section>
                <?php
                endif;
                ?>

                <?php
                if ( $block['content_blocks_display_type'] == "cbs-5" ) :
                ?>
                    <section class="content-blocks cbs-5">
                        <div class="row items">
                            <?php
                            if ( $albums_cbs ) :
                                foreach ( $albums_cbs as $item ) :
                                    $img = $item['img'];
                                    $link = $item['link'];
                            ?>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="item">
                                            <figure class="media">
                                                <?php
                                                if ( $link ) :
                                                    echo '<a href=" ' . $link . ' ">';
                                                endif;
                                                ?>
                                                    <img src="<?php echo getImageUrlById($img); ?>" alt="<?php echo get_the_title($img); ?>">
                                                <?php
                                                if ( $link ) :
                                                    echo '</a>';
                                                endif;
                                                ?>
                                            </figure>
                                        </div>
                                    </div>
                            <?php
                                endforeach;
                            endif;
                            ?>

                        </div>
                    </section>
                <?php
                endif;
                ?>

            <?php
            endforeach;
        endif;
        ?>


        <?php
        $post_query = getRelatePosts(get_the_ID(),3);
        $tag = get_the_terms(get_the_ID(), 'journal_tags');
        if ( $post_query && $tag ) :
        ?>
            <section class="related-articles">
                <div class="section-half">
                    <div class="col-12 ">
                        <h4 class="title-related-articles"><?php echo __('Bài viết liên quan', 'gaumap'); ?></h4>

                        <?php
                        if ( $post_query ) :
                        ?>
                            <ul class="list-articles">
                                <?php

                                if ( $post_query->have_posts() ) :
                                    while ( $post_query->have_posts() ) : $post_query->the_post();
                                        echo '<li>>>> <a href=" ' . get_permalink() . ' "> ' . get_the_title() . ' </a></li>';
                                    endwhile;
                                endif;
                                ?>
                            </ul>
                        <?php
                        endif;
                        ?>

                        <?php
                        if ( $tag ) :
                        ?>
                            <ul class="tags">
                                <?php
                                foreach ( $tag as $item ) :
                                    echo '<li><a href=" ' . $item->slug . ' "> # ' . $item->name . '</a></li>';
                                endforeach;
                                ?>
                            </ul>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </section>
        <?php
        endif;
        ?>


        <?php
        $post_query = new WP_Query([
            'post_type'      => 'journal',
            'posts_per_page' => 12,
            'post_status'    => 'publish',
        ]);
        if ($post_query->have_posts()) :
            $current_post_id = get_the_ID();
        ?>
        <section class="new-articles">
            <div class="row">
                <div class="col-12">
                    <h4 class="title-related-articles"><?php echo __('Bài viết mới', 'gaumap'); ?></h4>
                </div>
            </div>

            <div class="row items">
                <?php
                while ($post_query->have_posts()) : $post_query->the_post();
                    $categories = get_the_terms(get_the_ID(), 'journal_cat');
                    $tag = get_the_terms(get_the_ID(), 'journal_tags');
                    $descNew = getPostMeta('description');

                    if (get_the_ID() == $current_post_id) :
                        continue;
                    endif;
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
                            if ( $categories || $tag ) :
                                ?>
                                <div class="categories">
                                    <ul>

                                        <?php
                                        if ( $categories ) :
                                            foreach ( $categories as $item ) :
                                                echo "<li> $item->name </li>";
                                                break;
                                            endforeach;
                                        endif;
                                        ?>
                                        <?php
                                        if ( $tag ) :
                                            foreach ( $tag as $item ) :
                                                echo "<li> $item->name </li>";
                                                break;
                                            endforeach;
                                        endif;
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
                            if ( $descNew ) :
                                ?>
                                <div class="desc-post">
                                    <?php echo apply_filters( 'the_content', $descNew); ?>
                                </div>
                            <?php
                            endif;
                            ?>

                        </div>
                    </div>
                <?php

                endwhile;
                wp_reset_query();
                ?>
            </div>
        </section>
        <?php
        endif;
        wp_reset_postdata();
        ?>
    </div>
</main>
