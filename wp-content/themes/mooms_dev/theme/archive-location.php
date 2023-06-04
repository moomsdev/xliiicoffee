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
<div class="page-listing locations">
    <div class="container-fluid">
        <section class="location">

            <div class="title-link">
                <h2 class="title-blocks"> <?php echo __('Địa điểm', 'gaumap') ?> </h2>
            </div>

            <div class="categories">
                <ul>
                    <?php
                    $locationCats = get_terms('location_cat', [
                        'hide_empty' => true,
                        'parent'   => 0,
                    ]);
                    foreach ($locationCats as $locationCat) :
                        $current_category = is_tax('location_cat', $locationCat->slug);
                        ?>
                        <li>
                            <a class="nav-link <?php echo $current_category ? 'active' : ''; ?>"  href="<?php echo $locationCat->slug ?>"><?php echo $locationCat->name ?></a>
                        </li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            </div>

            <div class="row items">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        $type = getPostMeta('location_type');
                        $address = getPostMeta('location_detail');
                        ?>
                        <div class="col-12 col-lg-6 location-item">
                            <div class="location-bg" style="background-image: url('<?php thePostThumbnailUrl(); ?>')">
                                <div class="item__inner">
                                    <div class="inner_head">
                                        <span class="location-type"><?php echo $type; ?></span>
                                        <a href="<?php the_permalink(); ?>"><h2 class="title-post fs-43"><?php theTitle(); ?></h2></a>
                                        <p class="location-detail"><?php echo $address; ?></p>
                                    </div>
                                    <div class="inner_bottom">
                                        <a href="<?php the_permalink(); ?>" class="see-more-post"><?php echo __('Xem thêm', 'gaumap'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                thePagination();
                ?>
            </div>
        </section>
    </div>
</div>



