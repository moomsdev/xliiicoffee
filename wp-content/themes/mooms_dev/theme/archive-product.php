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
?>
<div class="page-listing works">
    <div class="container">
        <h2 class="title-section bold text-dark-blue border-line-bottom">
            <?php echo __('Our projects', 'gaumap') ; ?>
        </h2>
        <div class="main-body">
            <div class="grid">
                <div class="grid-sizer"></div>
            <?php
            if (have_posts()) :
                while(have_posts()) : the_post();
                    $featured = getPostMeta('is_feature');
                    $img_sm = getPostThumbnailUrl(get_the_ID(),383, 272);
                    $img_lg = getPostThumbnailUrl(get_the_ID(),792,562 );
                    $postThumbnail = $featured == true ?  $img_lg : $img_sm;
                    $sizer = $featured == false ?  "img-sm" : "img-lg";
                    $terms = wp_get_post_terms(get_the_ID(), 'service_type');
                    ?>
                    <div class="grid-item <?php echo $sizer; ?>">
                        <a href="<?php the_permalink(); ?>">
                            <figure class="media">
                                <img src="<?php echo $postThumbnail; ?>" />
                            </figure>
                            <div class="content">
                                <h2 class="title-post"><?php theTitle(); ?></h2>
                                <div class="bottom">
                                    <ul class="service-type">
                                        <?php foreach ($terms as $term) : ?>
                                            <li><?php echo $term->name; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <img src="<?php echo getImageAsset('top.svg'); ?>" alt="icon-arrow">
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            </div>
        </div>
    </div>
</div>



