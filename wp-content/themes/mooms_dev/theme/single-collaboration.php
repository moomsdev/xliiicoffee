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

$first_cooperation = getPostMeta('first_cooperation');
$cooperation_model = getPostMeta('cooperation_model');
$title_cooperation = getPostMeta('title_cooperation');
$content_cooperation = getPostMeta('content_cooperation');
$map_cooperation = getPostMeta('map_cooperation');

$title_core_values = getPostMeta('title_core_values');
$content_core_values = getPostMeta('content_core_values');
$expanded_content_core_values = getPostMeta('expanded_content_core_values');
$gallery_core_values = getPostMeta('gallery_core_values');
$subtitle_core_values = getPostMeta('subtitle_core_values');
$img_core_values = getPostMeta('img_core_values');
$subcontent_core_values = getPostMeta('subcontent_core_values');

$content_blocks = getPostMeta('content_blocks');
?>
<main class="main-content single-collaboration">
    <div class="container-fluid">

        <section class="post-head">
            <div class="sub row">
                <div class="col-12 col-lg-6 text-start text-lg-end">
                    <h1 class="title-post"><?php theTitle(); ?></h1>
                </div>
                <div class="cooperation col-12 col-lg-6 pt-5">
                    <div class="inner">
                        <?php
                        if ( $first_cooperation || $cooperation_model ) :
                        ?>
                            <div class="list-info">
                                <ul>
                                    <?php
                                    if ( $first_cooperation ) :
                                    ?>
                                        <li>
                                            <span><?php echo __('First time cooperation','gaumap'); ?>:</span>
                                            <span><?php echo $first_cooperation; ?></span>
                                        </li>
                                    <?php
                                    endif;
                                    ?>

                                    <?php
                                    if ( $cooperation_model ) :
                                    ?>
                                        <li>
                                            <span><?php echo __('Cooperation model','gaumap'); ?>:</span>
                                            <span><?php echo $cooperation_model; ?></span>
                                        </li>
                                    <?php
                                    endif;
                                    ?>
                                </ul>
                            </div>
                        <?php
                            endif;
                        ?>

                        <div class="cooperation-info">
                            <?php
                            if ( $title_cooperation ) :
                            ?>
                                <h3 class="title-cooperation"><?php echo $title_cooperation; ?></h3>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ( $content_cooperation ) :
                            ?>
                                <div class="content-cooperation">
                                    <?php echo apply_filters('the_content', $content_cooperation); ?>
                                </div>
                            <?php
                            endif;
                            ?>



                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                    if ( $map_cooperation ) :
                        ?>
                        <div class="map-cooperation">
                            <div class="inner">
                                <iframe src="<?php echo getIframeSrc($map_cooperation); ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <section class="core-value">
            <div class="sub row">
                <div class="col-12 col-lg-6">
                </div>

                <div class="col-12 col-lg-6">
                    <div class="inner">
                        <?php
                        if ( $title_core_values ) :
                            ?>
                            <h3 class="title-core-value"><?php echo $title_core_values; ?></h3>
                        <?php
                        endif;
                        ?>

                        <?php
                        if ( $content_core_values ) :
                            ?>
                            <div class="content-core-value">
                                <?php echo apply_filters('the_content', $content_core_values); ?>
                            </div>
                        <?php
                        endif;
                        ?>

                        <?php
                        if ( $expanded_content_core_values ) :
                        ?>
                            <div class="expanded-content">
                                <ul>
                                    <?php
                                    foreach ( $expanded_content_core_values as $value ) :
                                    ?>
                                        <li>
                                            <h4 class="title-expanded"><?php echo $value['title_expanded'] ?></h4>
                                            <div class="desc-expanded"><?php echo apply_filters('the_content', $value['dest_expanded']); ?></div>
                                        </li>
                                    <?php
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
            <?php
            if ( $gallery_core_values ) :
            ?>
                <div class="row">
                    <?php
                    foreach ( $gallery_core_values as $image ) :
                        echo "<div class='gallery-core-values col-12 col-md-6 col-lg-3'>
                                <figure class='media'>
                                    <img src='" . getImageUrlById($image['img_gallery']) . "' alt='" . get_the_title($image['img_gallery']) . "'>
                                </figure>
                              </div>";
                    endforeach;
                    ?>
                </div>
            <?php
            endif;
            ?>

            <div class="sub row">
                <div class="col-12 col-lg-6"></div>
                <div class="col-12 col-lg-6">
                    <div class="inner">
                        <?php
                        if ( $subtitle_core_values ) :
                            ?>
                            <span class="subtitle"><?php echo $subtitle_core_values; ?></span>
                        <?php
                        endif;
                        ?>

                        <?php
                        if ( $subcontent_core_values ) :
                            ?>
                            <div class="subcontent"><?php echo apply_filters('the_content', $subcontent_core_values); ?></div>
                        <?php
                        endif;
                        ?>

                    </div>
                </div>

                <?php
                if ( $img_core_values ) :
                ?>
                    <div class="col-12">
                        <figure class="media">
                            <img src="<?php echo getImageUrlById($img_core_values) ?>" alt="<?php echo get_the_title($img_core_values); ?>">
                        </figure>
                    </div>
                <?php
                endif;
                ?>

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
                                        <figure class="<?php echo $typeImage = ( $type_img_cbs == 'ratio' ) ? 'media' : 'media-original'; ?>">
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
            endforeach;
        endif;
        ?>
    </div>
</main>
