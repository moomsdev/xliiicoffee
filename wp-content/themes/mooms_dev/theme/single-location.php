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
$address = getPostMeta('location_detail');
$albums = getPostMeta('location_gallery');
$related = getPostMeta('location_articles');
$content = getPostMeta('location_content');
$location_opening_hours = getPostMeta('location_opening_hours');
$socials = getPostMeta('location_socials');

$location_menu = getPostMeta('location_menu');

?>
<main class="main-content single-location">
    <div class="container-fluid">
        <!--Post title-->
        <?php
        if ( is_singular(get_post_type()) ) :
            $parent_post_id = wp_get_post_parent_id(get_the_ID());
            echo '<h1 class="title-post"> ' . get_the_title($parent_post_id) . ' </h1>';
        else:
            echo '<h1 class="title-post"> ' . get_the_title() . ' </h1>';
        endif;
        ?>
        <!-- Address -->
        <?php
        if ( is_singular(get_post_type()) ) :
            $parent_post_id = wp_get_post_parent_id(get_the_ID());
            echo '<p class="location-detail"> ' . getPostMeta('location_detail', $parent_post_id) . ' </p>';
        else:
            echo '<p class="location-detail"> ' . $address . ' </p>';
        endif;
        ?>

        <?php
        //child post
        if ( is_singular(get_post_type()) ) :
        ?>
            <div class="location-menu">
                <ul class="nav nav-tabs" id="menuTab" role="tablist">
                    <?php
                    $i = 0;
                    foreach ( $location_menu as $ỉtem ) :
                        $type_name = $ỉtem['type_of_drink'];
                        ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo $i ==0 ? 'active' : ''; ?>" id="<?php echo sanitize_title($type_name); ?>" data-bs-toggle="tab" data-bs-target="#<?php echo sanitize_title($type_name); ?>-pane" type="button" role="tab" aria-controls="<?php echo sanitize_title($type_name); ?>-pane" aria-selected="true"><?php echo $type_name; ?></a>
                        </li>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                </ul>
                <div class="tab-content" id="menuTabContent">
                    <?php
                    $i = 0;
                    foreach ( $location_menu as $ỉtem ) :
                        $type_name = $ỉtem['type_of_drink'];
                        $menu_desc = $ỉtem['menu_desc'];
                        $drinks = $ỉtem['drinks'];

                        ?>
                        <div class="tab-pane fade <?php echo $i ==0 ? 'show active' : ''; ?>" id="<?php echo sanitize_title($type_name); ?>-pane" role="tabpanel" aria-labelledby="<?php echo sanitize_title($type_name); ?>" tabindex="0">
                            <div class="row">
                                <?php
                                if ( $drinks ) :
                                    foreach ( $drinks as $drink ) :
                                        $img = $drink['drink_img'];
                                        $name = $drink['drink_name'];
                                        $desc = $drink['drink_desc'];
                                        ?>
                                        <div class="col-12 col-sm-6 col-lg-3 mb-5">
                                            <div class="tab-pane__inner">

                                                <?php
                                                if ( $img ) :
                                                    echo '<figure class="media"> <img src=" ' . getImageUrlById($img) . ' " alt=" ' . get_the_title($img) . ' "> </figure>';
                                                endif;
                                                ?>

                                                <?php
                                                if ( $name ) :
                                                    echo ' <h4 class="title-post"> ' . $name . ' </h4>';
                                                endif;
                                                ?>

                                                <?php
                                                if ( $desc ) :
                                                    echo '<p class="desc-post"> ' . $desc . ' </p>';
                                                endif;
                                                ?>

                                            </div>
                                        </div>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                </div>
            </div>
        <?php
        else:
        ?>
            <!--Parent post-->
            <section class="slider-block">
                <div class="inner">
                    <div class="swiper sliders">
                        <div class="swiper-wrapper">
                            <?php foreach ($albums as $slider) : ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo getImageUrlById($slider); ?>" alt="<?php echo get_the_title($slider);  ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>

            <section class="article-inner">
            <div class="row">
                <div class="col-12 col-lg-6 article-related">
                    <?php
                    if ( $related ) :
                        foreach ( $related as $article ) :
                        ?>
                            <div class="related-item">
                                <a href="<?php echo $article['article_link']; ?>">
                                    <figure class="media">
                                        <img src="<?php echo getImageUrlById($article['article_img']); ?>" alt="<?php echo get_the_title($article['article_img']); ?>">
                                    </figure>
                                </a>
                                <span class="tag"><?php echo $article['article_tag']; ?></span>
                                <a href="<?php echo $article['article_link']; ?>">
                                    <h3 class="article-title"><?php echo $article['article_title']; ?></h3>
                                </a>
                                <p class="article-desc"><?php echo $article['article_desc']; ?></p>
                            </div>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </div>

                <div class="col-12 col-lg-6 article-content">

                    <div class="content">
                        <?php
                        if ( $content ) :
                        ?>
                            <div class="desc"><?php echo $content; ?></div>
                        <?php
                        endif;
                        ?>

                        <?php
                        $children = get_children([
                            'post_parent' => get_the_ID(),
                            'post_type'   => get_post_type(),
                        ]);
                        if ( $location_opening_hours || $children ) :
                        ?>
                            <div class="content-inner">
                                <?php
                                if ( $location_opening_hours ) :
                                ?>
                                    <div class="opening-hours">
                                        <p><?php echo __('Giờ mở cửa', 'gaumap'); ?></p>
                                        <p><?php echo $location_opening_hours; ?></p>
                                    </div>
                                <?php
                                endif;
                                ?>

                                <?php
                                if ( $children ) :
                                    foreach ($children as $child_post) :
                                        $child_post_link = get_permalink($child_post->ID);
                                        echo '<div class="menu"><a href="' . $child_post_link . '">' . __('>> Xem thêm Menu', 'gaumap') . '</a></div>';
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        <?php
                        endif;
                        ?>

                    </div>

                    <div class="socials border-top-1px">
                        <ul>
                            <?php
                            foreach ( $socials as $social ) :
                                echo '<li><a href=" ' . $social['socials_link'] . ' "> ' . $social['socials_name'] . ' </a></li>' ;
                            endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php
        endif;
        ?>
    </div>
</main>
