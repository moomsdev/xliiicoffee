<?php
//Template name: Philosophy

/**
 * App Layout: layouts/app.php
 *
 * This is the template that is used for displaying 404 errors.
 *
 * @package WPEmergeTheme
 */

$title_core_values = getPostMeta('title_core_values');
$content_core_values = getPostMeta('content_core_values');
$expanded_content_core_values = getPostMeta('expanded_content_core_values');
$gallery_core_values = getPostMeta('gallery_core_values');
$subtitle_core_values = getPostMeta('subtitle_core_values');
$img_core_values = getPostMeta('img_core_values');
$subcontent_core_values = getPostMeta('subcontent_core_values');

$content_blocks = getPostMeta('philosophy_content_blocks');
?>
<main class="main-content single-collaboration philosophy-page">
    <div class="container-fluid">

        <section class="post-head">
            <div class="row">
                <div class="col-12 text-start">
                    <h1 class="title-post"><?php theTitle(); ?></h1>
                </div>
            </div>
        </section>

        <section class="full-width">
            <figure class="media">
                <img src="<?php echo getPostThumbnailUrl(get_the_ID()); ?>" alt="<?php theTitle(); ?>">
            </figure>
        </section>

        <?php
        if ( $content_blocks ) :
            foreach ( $content_blocks as $block ) :
                $title = $block['title_cbs'];
                $image = $block['img_cbs'];
                $content = $block['content_cbs'];
                $expanded_content_cbs_1 = $block['expanded_content_cbs_1'];
                $expanded_content_cbs_2 = $block['expanded_content_cbs_2'];
                $expanded_content_cbs_3 = $block['expanded_content_cbs_3'];
                $content_blocks_display_type = $block['content_blocks_display_type'];
                ?>
                <?php
                if ( $content_blocks_display_type == "cbs-1" ) :
                    ?>
                    <section class="content-blocks cbs-1">
                        <div class="sub row">
                            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end align-items-center">
                                <?php
                                if ( $title ) :
                                    ?>
                                    <h3 class="title-cbs"><?php echo $title; ?></h3>
                                <?php
                                endif;
                                ?>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="inner">

                                    <?php
                                    if ( $content ) :
                                        ?>
                                        <div class="content-cbs"><?php echo $content; ?></div>
                                    <?php
                                    endif;
                                    ?>

                                    <?php
                                    if ( $expanded_content_cbs_1 ) :
                                        ?>
                                        <div class="expanded-content">

                                            <ul class="<?php echo count($expanded_content_cbs_1) %2 != 0 ? 'odd' : ''; ?>">
                                                <?php
                                                foreach ( $expanded_content_cbs_1 as $value ) :
                                                ?>
                                                    <li>
                                                        <h4 class="title-expanded"><?php echo $value['title_expanded'] ?></h4>
                                                        <div class="desc-expanded"><?php echo $value['desc_expanded'] ?></div>
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
                    </section>
                <?php
                endif;
                ?>

                <?php
                if ( $content_blocks_display_type == "cbs-2" ) :
                    ?>
                    <section class="content-blocks cbs-2">
                        <div class="sub row">
                            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end">
                                <?php
                                if ( $title ) :
                                    ?>
                                    <h3 class="title-cbs"><?php echo $title; ?></h3>
                                <?php
                                endif;
                                ?>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="inner">

                                    <?php
                                    if ( $expanded_content_cbs_2 ) :
                                        ?>
                                        <div class="expanded-content">

                                            <ul>
                                                <?php
                                                foreach ( $expanded_content_cbs_2 as $value ) :
                                                    ?>
                                                    <li>
                                                        <h4 class="title-expanded"><?php echo $value['title_expanded'] ?></h4>
                                                        <div class="desc-expanded"><?php echo $value['desc_expanded'] ?></div>
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
                    </section>
                <?php
                endif;
                ?>

                <?php
                if ( $content_blocks_display_type == "cbs-3" ) :
                    ?>
                    <section class="content-blocks cbs-3">
                        <div class="sub row">
                            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end">
                                <?php
                                if ( $title ) :
                                    ?>
                                    <h3 class="title-cbs"><?php echo $title; ?></h3>
                                <?php
                                endif;
                                ?>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="inner">

                                    <?php
                                    if ( $expanded_content_cbs_3 ) :
                                        ?>
                                        <div class="expanded-content">
                                            <ul>
                                                <?php
                                                foreach ( $expanded_content_cbs_3 as $value ) :
                                                    ?>
                                                    <li>
                                                        <?php
                                                        if ( $value['img_expanded'] ) :
                                                        ?>
                                                            <figure class="media">
                                                                <img src="<?php echo getImageUrlById($value['img_expanded']) ?>" alt="<?php echo get_the_title($value['img_expanded']); ?>">
                                                            </figure>
                                                        <?php
                                                        endif;
                                                        ?>
                                                        <h4 class="title-expanded"><?php echo $value['name_expanded'] ?></h4>
                                                        <span class="desc-expanded"><?php echo $value['position_expanded'] ?></span>
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
                if ( $content_blocks_display_type == "cbs-4" ) :
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
    </div>
</main>
