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

$tag = get_the_terms(get_the_ID(), 'journal_tags');
$desc = getPostMeta('description');
$content_blocks = getPostMeta('content_blocks');

?>
<main class="main-content single-collaboration">
    <div class="container-fluid">

        <section class="post-head">
            <div class="sub row">
                <div class="col-12 col-lg-6 text-start text-lg-end">
                    <h1 class="title-post"><?php theTitle(); ?></h1>
                </div>
                <div class="col-12 col-lg-6 pt-5">
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
                    </div>
                </div>
            </div>
        </section>

        <?php
        if ( $content_blocks ) :
            foreach ( $content_blocks as $block ) :
                $title = $block['title_cbs'];
                $image = $block['img_cbs'];
                $content = $block['content_cbs'];
                $expanded_content_cbs = $block['expanded_content_cbs'];
            ?>
                <?php
                if ( $block['content_blocks_display_type'] == "cbs-1" ) :
                ?>
                    <section class="content-blocks cbs-1">
                        <div class="sub row">
                            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end align-items-center">
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

                            <div class="col-12 col-lg-6">
                                <div class="inner">

                                    <?php
                                    if ( $title ) :
                                    ?>
                                        <h3 class="title-cbs"><?php echo $title; ?></h3>
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
                        <div class="sub row">
                            <div class="col-12 col-lg-6">

                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="inner">

                                    <?php
                                    if ( $title ) :
                                        ?>
                                        <h3 class="title-cbs"><?php echo $title; ?></h3>
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
                        <div class="sub row">
                            <div class="col-12 col-lg-6">

                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="inner">
                                    <?php
                                    if ( $title ) :
                                        ?>
                                        <h3 class="title-cbs"><?php echo $title; ?></h3>
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
                        <div class="sub row">
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
                        </div>
                    </section>
                <?php
                endif;
                ?>

            <?php
            endforeach;
        endif;
        ?>

        <section class="related-articles">
            <div class="sub row">
                <div class="col-12 col-lg-6">
                </div>
                <div class="col-12 col-lg-6">
                    <h4 class="title-related-articles"><?php echo __('Bài viết liên quan', 'gaumap'); ?></h4>
                    <ul class="list-articles">
                        <?php
                        the_post();
                        global $post;
                        $post_query = getRelatePosts(get_the_ID(),3);
                        if ( $post_query->have_posts() ) :
                            while ( $post_query->have_posts() ) : $post_query->the_post();
                                echo '<li>>>> <a href=" ' . get_permalink() . ' "> ' . get_the_title() . ' </a></li>';
                            endwhile;
                        endif;
                        ?>
                    </ul>
                    <ul class="tags">
                        <?php
                        foreach ( $tag as $item ) :
                            echo '<li><a href=" ' . $item->slug . ' "> # ' . $item->name . '</a></li>';
                        endforeach;
                        ?>
                    </ul>
                </div>
            </div>
        </section>

        section.
    </div>
</main>
