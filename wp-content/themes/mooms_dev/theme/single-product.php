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
global $product;
$product = wc_get_product(get_the_ID());

$galleries = getPostMeta('product_gallery');

$category = get_the_terms($post, 'product_cat');
$tag = get_the_terms($post, 'product_tag');
?>
<main class="main-content single-product">
    <div class="container-fluid">

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

        <!--info-product-->
        <section class="info-product">
            <div class="row">
                <!--Gallery product-->
                <div class="col-12 col-lg-6">
                    <div class="swiper gallery-product">
                        <div class="swiper-wrapper">
                            <?php
                            foreach( $galleries as $image ) :
                            ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo getImageUrlById($image['img_gallery_product']) ?>" alt="<?php echo get_the_title($image['img_gallery_product']); ?>">
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <!--Info product-->
                <div class="col-12 col-lg-6">
                    <div class="inner-info-product">
                        <h1 class="title-product"><?php theTitle(); ?></h1>

                        <?php
                        theProductPrice($product);
                        ?>

                        <div class="list-info">
                            <ul>
                                <?php
                                $origin = getPostMeta('origin');
                                if ($origin) :
                                    echo "<li>
                                            <span>" . __('Xuất xứ', 'gaumap') . "</span>
                                            <span>" . $origin . "</span>
                                          </li>";
                                endif;

                                $region = getPostMeta('region');
                                if ($region) :
                                    echo "<li>
                                            <span>" . __('Vùng', 'gaumap') . "</span>
                                            <span>" . $region . "</span>
                                          </li>";
                                endif;

                                $farm = getPostMeta('farm');
                                if ($farm) :
                                    echo "<li>
                                            <span>" . __('Trang trại', 'gaumap') . "</span>
                                            <span>" . $farm . "</span>
                                          </li>";
                                endif;

                                $variety = getPostMeta('variety');
                                if ($variety) :
                                    echo "<li>
                                            <span>" . __('Giống', 'gaumap') . "</span>
                                            <span>" . $variety . "</span>
                                          </li>";
                                endif;

                                $crop_year = getPostMeta('crop_year');
                                if ($crop_year) :
                                    echo "<li>
                                            <span>" . __('Năm thu hoạch', 'gaumap') . "</span>
                                            <span>" . $crop_year . "</span>
                                          </li>";
                                endif;

                                $altitude = getPostMeta('altitude');
                                if ($altitude) :
                                    echo "<li>
                                            <span>" . __('Độ cao', 'gaumap') . "</span>
                                            <span>" . $altitude . "</span>
                                          </li>";
                                endif;

                                $process = getPostMeta('process');
                                if ($process) :
                                    echo "<li>
                                            <span>" . __('Phương pháp sơ chế', 'gaumap') . "</span>
                                            <span>" . $process . "</span>
                                          </li>";
                                endif;

                                $net_weight = getPostMeta('net_weight');
                                if ($net_weight) :
                                    echo "<li>
                                            <span>" . __('Trọng lượng', 'gaumap') . "</span>
                                            <span>" . $net_weight . "</span>
                                          </li>";
                                endif;

                                $flavor_profile = getPostMeta('flavor_profile');
                                if ($flavor_profile) :
                                    echo "<li>
                                            <span>" . __('Hồ sơ hương vị', 'gaumap') . "</span>
                                            <span>" . $flavor_profile . "</span>
                                          </li>";
                                endif;

                                $sca_coffee_score = getPostMeta('sca_coffee_score');
                                if ($sca_coffee_score) :
                                    echo "<li>
                                            <span>" . __('Điểm cà phê SCA', 'gaumap') . "</span>
                                            <span>" . $sca_coffee_score . "</span>
                                          </li>";
                                endif;

                                $sourcing = getPostMeta('sourcing');
                                if ($sourcing) :
                                    echo "<li>
                                            <span>" . __('Nguồn cung ứng', 'gaumap') . "</span>
                                            <span>" . $sourcing . "</span>
                                          </li>";
                                endif;

                                $paid_for_producer = getPostMeta('paid_for_producer');
                                if ($paid_for_producer) :
                                    echo "<li>
                                            <span>" . __('Trả tiền cho nhà sản xuất', 'gaumap') . "</span>
                                            <span>" . $paid_for_producer . "</span>
                                          </li>";
                                endif;

                                $fob_price = getPostMeta('fob_price');
                                if ($fob_price) :
                                    echo "<li>
                                            <span>" . __('Giá FOB', 'gaumap') . "</span>
                                            <span>" . $fob_price . "</span>
                                          </li>";
                                endif;

                                $ddp_price = getPostMeta('ddp_price');
                                if ($ddp_price) :
                                    echo "<li>
                                            <span>" . __('Giá DDP', 'gaumap') . "</span>
                                            <span>" . $ddp_price . "</span>
                                          </li>";
                                endif;
                                ?>
                            </ul>
                        </div>

                        <?php
                        if ($product instanceof WC_Product) {
                            $shortDescription = $product->get_short_description();
                            echo "<div class='product-short-desc'>" . apply_filters('the_content', $shortDescription) . "</div>";
                        }
                        ?>

                        <div class="cart-product">
                            <!--<button type="submit" name="add-to-cart" class="btn-block notice addtoCart"><span>THÊM VÀO GIỎ HÀNG</span></button>-->
                            <?php echo do_shortcode('[add_to_cart id="'.get_the_ID().'"]') ?>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!--collaboration-product-->
        <?php
        $title_collaboration = getPostMeta('title_collaboration');
        $desc_collaboration = getPostMeta('desc_collaboration');
        $table_collaboration = getPostMeta('table_collaboration');
        $url_collaboration = getPostMeta('url_collaboration_product');
        $map_farm_product = getPostMeta('map_farm_product');

        if ( $title_collaboration || $desc_collaboration || $url_collaboration || $map_farm_product ) :
        ?>
        <section class="collaboration-product">
            <div class="row">
                <?php
                if ( $title_collaboration || $desc_collaboration || $table_collaboration || $url_collaboration ) :
                ?>
                    <div class="col-12 col-lg-6"></div>
                    <div class="col-12 col-lg-6">
                        <?php
                        if ( $title_collaboration ) :
                            echo " <h3 class='title-part'>" . $title_collaboration . "</h3>";
                        endif;

                        if ( $desc_collaboration ) :
                            echo " <div class='desc-part'>" . apply_filters('the_content', $desc_collaboration) . "</div>";
                        endif;

                        if (  $table_collaboration ) :
                        ?>
                            <div class="list-info">
                                <ul>
                                    <?php
                                    foreach ( $table_collaboration as $value ) :
                                        echo "<li>
                                            <span>" . $value['title_table'] . "</span>
                                            <span>" . $value['dest_table'] . "</span>
                                          </li>";
                                    endforeach;
                                    ?>

                                </ul>
                            </div>
                        <?php
                        endif;

                        if ( $url_collaboration ) :
                            echo "<a class='link-to' href=' " . get_permalink($url_collaboration[0]['id']) . " ' target='_blank'> " . '>> ' .  __('Liên kết đến', 'gaumap') . ' ' . get_the_title($url_collaboration[0]['id']) . " </a>";
                        endif;
                        ?>
                    </div>
                <?php
                endif;
                ?>

                <?php
                if ( $map_farm_product ) :
                ?>
                    <div class="col-12 farm-location">
                        <div class="inner">
                            <iframe src="<?php echo getIframeSrc($map_farm_product); ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </section>
        <?php
        endif;
        ?>

        <!--journal-product-->
        <?php
        $desc_journal = getPostMeta('desc_journal');
        $url_journal = getPostMeta('url_journal_product');
        $video_journal = getPostMeta('video_journal');
        if ( $desc_journal || $url_journal || $video_journal ) :
        ?>
        <section class="journal-product">
            <div class="row">
                <div class="col-12 col-lg-6 right-column">
                    <div class="media">
                        <div class="video">
                            <iframe class="_iframe"
                                    src="<?php echo getYoutubeEmbedUrl($video_journal); ?>"
                                    frameborder="0"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 left-column border-bottom-custom">
                        <?php
                        if ( $desc_journal ) :
                            echo " <div class='desc-part'>" . apply_filters('the_content', $desc_journal) . "</div>";
                        endif;
                        ?>

                        <div class="list-info">
                            <ul>
                                <?php
                                $aroma_journal = getPostMeta('aroma_journal');
                                if ($aroma_journal) :
                                    echo "<li>
                                            <span>" . __('Aroma', 'gaumap') . "</span>
                                            <span>" . $aroma_journal . "</span>
                                          </li>";
                                endif;

                                $hot_journal = getPostMeta('hot_journal');
                                if ($hot_journal) :
                                    echo "<li>
                                            <span>" . __('Hot', 'gaumap') . "</span>
                                            <span>" . $hot_journal . "</span>
                                          </li>";
                                endif;

                                $warm_journal = getPostMeta('warm_journal');
                                if ($warm_journal) :
                                    echo "<li>
                                            <span>" . __('Warm', 'gaumap') . "</span>
                                            <span>" . $warm_journal . "</span>
                                          </li>";
                                endif;

                                $cold_journal = getPostMeta('cold_journal');
                                if ($cold_journal) :
                                    echo "<li>
                                            <span>" . __('Cold', 'gaumap') . "</span>
                                            <span>" . $cold_journal . "</span>
                                          </li>";
                                endif;

                                $aftertaste_journal = getPostMeta('aftertaste_journal');
                                if ($aftertaste_journal) :
                                    echo "<li>
                                            <span>" . __('Aftertaste', 'gaumap') . "</span>
                                            <span>" . $aftertaste_journal . "</span>
                                          </li>";
                                endif;

                                $acidity_journal = getPostMeta('acidity_journal');
                                if ($acidity_journal) :
                                    echo "<li>
                                            <span>" . __('Acidity', 'gaumap') . "</span>
                                            <span>" . $acidity_journal . "</span>
                                          </li>";
                                endif;

                                $body_journal = getPostMeta('body_journal');
                                if ($body_journal) :
                                    echo "<li>
                                            <span>" . __('Body', 'gaumap') . "</span>
                                            <span>" . $body_journal . "</span>
                                          </li>";
                                endif;

                                $balance_journal = getPostMeta('balance_journal');
                                if ($balance_journal) :
                                    echo "<li>
                                            <span>" . __('Balance', 'gaumap') . "</span>
                                            <span>" . $balance_journal . "</span>
                                          </li>";
                                endif;
                                ?>
                            </ul>
                        </div>

                        <?php
                        if ( $url_journal ) :
                            echo "<a class='link-to' href=' " . get_permalink($url_journal[0]['id']) . " ' target='_blank'> " . '>> ' .  __('Liên kết đến', 'gaumap') . ' ' . get_the_title($url_journal[0]['id']) . " </a>";
                        endif;
                        ?>
                </div>
            </div>
        </section>
        <?php
        endif;
        ?>

        <!--Roasting profile-->
        <?php
        $title_roasting_profile = getPostMeta('title_roasting_profile');
        $img_roasting_profile = getPostMeta('img_roasting_profile');

        $choose_cpt_roasting_profile = getPostMeta('choose_post_type_roasting_profile');
        if ( $choose_cpt_roasting_profile == "journal" ) :
            $url_roasting_profile = getPostMeta('url_journal_roasting_profile');
        else:
            $url_roasting_profile = getPostMeta('url_coffee_guide_roasting_profile');
        endif;

        if ( $title_roasting_profile || $url_roasting_profile || $img_roasting_profile ) :
            ?>
            <section class="roasting-profile-product">
                <div class="row">
                    <div class="col-12 col-lg-6 right-column">
                    </div>
                    <div class="col-12 col-lg-6 left-column border-bottom-custom">
                        <?php
                        if ( $title_roasting_profile ) :
                            echo " <h3 class='title-part'>" . $title_roasting_profile . "</h3>";
                        endif;
                        ?>

                        <div class="list-info">
                            <ul>
                                <?php
                                $roast_machine = getPostMeta('roast_machine');
                                if ($roast_machine) :
                                    echo "<li>
                                            <span>" . __('Roast Machine', 'gaumap') . "</span>
                                            <span>" . $roast_machine . "</span>
                                          </li>";
                                endif;

                                $roasting_profile = getPostMeta('roasting_profile');
                                if ($roasting_profile) :
                                    echo "<li>
                                            <span>" . __('Roast Profile', 'gaumap') . "</span>
                                            <span>" . $roasting_profile . "</span>
                                          </li>";
                                endif;

                                $roast_duration = getPostMeta('roast_duration');
                                if ($roast_duration) :
                                    echo "<li>
                                            <span>" . __('Roast Duration', 'gaumap') . "</span>
                                            <span>" . $roast_duration . "</span>
                                          </li>";
                                endif;

                                $drying_phase = getPostMeta('drying_phase');
                                if ($drying_phase) :
                                    echo "<li>
                                            <span>" . __('Drying Phase', 'gaumap') . "</span>
                                            <span>" . $drying_phase . "</span>
                                          </li>";
                                endif;

                                $maillard_phase = getPostMeta('maillard_phase');
                                if ($maillard_phase) :
                                    echo "<li>
                                            <span>" . __('Maillard Phase', 'gaumap') . "</span>
                                            <span>" . $maillard_phase . "</span>
                                          </li>";
                                endif;

                                $development_phase = getPostMeta('development_phase');
                                if ($development_phase) :
                                    echo "<li>
                                            <span>" . __('Development Phase', 'gaumap') . "</span>
                                            <span>" . $development_phase . "</span>
                                          </li>";
                                endif;

                                $development_ratio = getPostMeta('development_ratio');
                                if ($development_ratio) :
                                    echo "<li>
                                            <span>" . __('Development Ratio', 'gaumap') . "</span>
                                            <span>" . $development_ratio . "</span>
                                          </li>";
                                endif;

                                $charge_temperature = getPostMeta('charge_temperature');
                                if ($charge_temperature) :
                                    echo "<li>
                                            <span>" . __('Charge Temperature', 'gaumap') . "</span>
                                            <span>" . $charge_temperature . "</span>
                                          </li>";
                                endif;

                                $turning_point = getPostMeta('turning_point');
                                if ($turning_point) :
                                    echo "<li>
                                            <span>" . __('Turning Point', 'gaumap') . "</span>
                                            <span>" . $turning_point . "</span>
                                          </li>";
                                endif;

                                $dry_end_temperature = getPostMeta('dry_end_temperature');
                                if ($dry_end_temperature) :
                                    echo "<li>
                                            <span>" . __('Dry-end Temperature', 'gaumap') . "</span>
                                            <span>" . $dry_end_temperature . "</span>
                                          </li>";
                                endif;

                                $first_crack_temperature = getPostMeta('first_crack_temperature');
                                if ($first_crack_temperature) :
                                    echo "<li>
                                            <span>" . __('First Crack Temperature', 'gaumap') . "</span>
                                            <span>" . $first_crack_temperature . "</span>
                                          </li>";
                                endif;

                                $end_bean_temperature = getPostMeta('end_bean_temperature');
                                if ($end_bean_temperature) :
                                    echo "<li>
                                            <span>" . __('End Bean Temperature', 'gaumap') . "</span>
                                            <span>" . $end_bean_temperature . "</span>
                                          </li>";
                                endif;

                                $end_air_temperature = getPostMeta('end_air_temperature');
                                if ($end_air_temperature) :
                                    echo "<li>
                                            <span>" . __('End Air Temperature', 'gaumap') . "</span>
                                            <span>" . $end_air_temperature . "</span>
                                          </li>";
                                endif;

                                ?>
                            </ul>
                        </div>

                        <?php
                        if ( $img_roasting_profile ) :
                            echo "<figure class='media'> <img src=' " . getImageUrlById($img_roasting_profile) . " ' alt=' " . get_the_title($img_roasting_profile) . " '> </figure>";
                        endif;
                        ?>

                        <?php
                        if ( $url_roasting_profile ) :
                            echo "<a class='link-to' href=' " . get_permalink($url_roasting_profile[0]['id']) . " ' target='_blank'> " . '>> ' .  __('Liên kết đến', 'gaumap') . ' ' . get_the_title($url_roasting_profile[0]['id']) . " </a>";
                        endif;
                        ?>
                    </div>
                </div>
            </section>
        <?php
        endif;
        ?>

        <!--Recommend-->
        <?php
        $title_recommend = getPostMeta('title_recommend');
        $desc_recommend = getPostMeta('desc_recommend');

        if ( $title_recommend || $desc_recommend ) :
            ?>
            <section class="recommend-product">
                <div class="row">
                    <div class="col-12 col-lg-6 right-column">
                    </div>
                    <div class="col-12 col-lg-6 left-column border-bottom-custom">
                        <?php
                        if ( $title_recommend ) :
                            echo " <h3 class='title-part'>" . $title_recommend . "</h3>";
                        endif;

                        if ( $desc_recommend ) :
                            echo " <div class='desc-part'>" . apply_filters('the_content', $desc_recommend) . "</div>";
                        endif;
                        ?>

                    </div>
                </div>
            </section>
        <?php
        endif;
        ?>

        <!--Water quality-->
        <?php
        $title_water_quality = getPostMeta('title_water_quality');

        $choose_cpt_water_quality = getPostMeta('choose_post_type_water_quality');
        if ( $choose_cpt_water_quality == "journal" ) :
            $url_water_quality = getPostMeta('url_journal_water_quality');
        else:
            $url_water_quality = getPostMeta('url_coffee_guide_water_quality');
        endif;

        if ( $title_water_quality || $url_water_quality ) :
            ?>
            <section class="water-quality-product">
                <div class="row">
                    <div class="col-12 col-lg-6 right-column">
                    </div>
                    <div class="col-12 col-lg-6 left-column">
                        <?php
                        if ( $title_water_quality ) :
                            echo " <h3 class='title-part'>" . $title_water_quality . "</h3>";
                        endif;
                        ?>

                        <div class="list-info">
                            <ul>
                                <?php
                                $calcium_hardness = getPostMeta('calcium_hardness');
                                if ($calcium_hardness) :
                                    echo "<li>
                                            <span>" . __('Calcium Hardness', 'gaumap') . "</span>
                                            <span>" . $calcium_hardness . "</span>
                                          </li>";
                                endif;

                                $magnesium_hardness = getPostMeta('magnesium_hardness');
                                if ($magnesium_hardness) :
                                    echo "<li>
                                            <span>" . __('Magnesium Hardness', 'gaumap') . "</span>
                                            <span>" . $magnesium_hardness . "</span>
                                          </li>";
                                endif;

                                $total_alkalinity = getPostMeta('total_alkalinity');
                                if ($total_alkalinity) :
                                    echo "<li>
                                            <span>" . __('Total Alkalinity', 'gaumap') . "</span>
                                            <span>" . $total_alkalinity . "</span>
                                          </li>";
                                endif;

                                $sodium = getPostMeta('sodium');
                                if ($sodium) :
                                    echo "<li>
                                            <span>" . __('Sodium', 'gaumap') . "</span>
                                            <span>" . $sodium . "</span>
                                          </li>";
                                endif;
                                ?>
                            </ul>
                        </div>

                        <?php
                        if ( $url_water_quality ) :
                            echo "<a class='link-to' href=' " . get_permalink($url_water_quality[0]['id']) . " ' target='_blank'> " . '>> ' .  __('Liên kết đến', 'gaumap') . ' ' . get_the_title($url_water_quality[0]['id']) . " </a>";
                        endif;
                        ?>
                    </div>
                </div>
            </section>
        <?php
        endif;
        ?>

        <!--Coffee Guide-->
        <?php
        $img_coffee_guide_product = getPostMeta('img_coffee_guide_product');

        if ( $img_coffee_guide_product ) :
        ?>
            <section class="coffee-guide-product">
                <div class="row">
                    <div class="col-12">
                        <?php
                        if ( $img_coffee_guide_product ) :
                            echo "<figure class='media full-width-media'> <img src=' " . getImageUrlById($img_coffee_guide_product) . " ' alt=' " . get_the_title($img_coffee_guide_product) . " '> </figure>";
                        endif;
                        ?>
                    </div>
                </div>
            </section>
        <?php
        endif;
        ?>

        <!--YOU MAY LIKE-->
        <?php
        global $post;
        $post_query = getRelatePosts(get_the_ID(),8);
        if ( $post_query->post_count != 0 ) :
        ?>
        <section class="content-slider-block">
            <div class="row">
                <div class="col-12 title-link">
                    <h2 class="title-blocks"><?php echo __('CÓ THỂ BẠN THÍCH', 'gaumap'); ?></h2>
                    <a href="#" class="read-more-blocks underline-hover"><?php echo __('Xem tất cả', 'gaumap'); ?></a>
                </div>

                <div class="col-12 items">
                    <div class="swiper content-slider swiper-backface-hidden">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <?php
                            if ( $post_query->have_posts() ) :
                                while ( $post_query->have_posts() ) : $post_query->the_post();
                                    $taxonomy = "product_cat";
                                    $categories = get_the_terms(get_the_ID(), $taxonomy);
                                    ?>

                                    <div class="swiper-slide">
                                        <div class="item">
                                            <figure class="media">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php thePostThumbnailUrl(); ?>" alt="<?php theTitle(); ?>">
                                                </a>
                                            </figure>

                                            <div class="content">
                                                <?php
                                                if ( $categories ) :
                                                    ?>
                                                    <div class="categories">
                                                        <ul>
                                                            <?php
                                                            foreach ($categories as $category) {
                                                                echo  "<li> $category->name </li>";
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


                                                <?php theProductPrice(); ?>

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

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                        <div class="swiper-scrollbar swiper-scrollbar-horizontal"></div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        endif;
        ?>
    </div>
</main>
