<?php
/**
 * App Layout: layouts/app_custom.php
 *
 * This is the template that is used for displaying all posts by default.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPEmergeTheme
 */
?>
<div class="main_content">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                    <div class="product-image">
                            <?php
                            global $product;
                            $attachment_ids = $product->get_gallery_attachment_ids();
                            $first = true ;
                            $i = 0;
							foreach( $attachment_ids as $attachment_id ) {
								if ($i == 0){
									$active = 'active';
								}else{
                                    $active = 'none';
								}
							?>
								<div class="product_img_box <?php echo $active ?>">
									<img id="product_img" src='<?php echo getImageUrlById($attachment_id) ?>' data-zoom-image="<?php echo getImageUrlById($attachment_id)?>" alt="product_img1">
									<a href="#" class="product_img_zoom" title="Zoom">
										<span class="linearicons-zoom-in"></span>
									</a>
								</div>
							<?php
								$i++;
								$first = false ;
                            }
							?>
                        <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                            <?php
                            if(count($attachment_ids) > 0) {
                                $first = true;
                                foreach( $attachment_ids as $attachment_id ) {
							?>
									<div class="item">
										<a href="#" class="product_gallery_item <?php echo $first ? 'active' : null ?>" data-image="<?php echo getImageUrlById($attachment_id)?>" data-zoom-image="<?php echo getImageUrlById($attachment_id)?>">
											<img src="<?php echo getImageUrlById($attachment_id, 116, 124) ?>" alt="product_small">
										</a>
									</div>
							<?php
								$first = false;
								}
							}
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="pr_detail">
                        <div class="product_description">
                            <h4 class="product_title"><a href="#"><?php the_title() ?></a></h4>
                            <div class="product_price">
                                <?php
                                theProductPrice();
                                ?>
                                <?php
                                if(!empty(theProductPercentageSaleOff())){
                                    theProductPercentageSaleOff();
                                }
                                ?>
                            </div>
							<div class="pr_desc">
                            <?php $hover_product = getPostMeta('exceprt');?>
                            <?php
								if (!empty($hover_product)){
									echo apply_filters('the_content', $hover_product);
								}
						 	?>
							</div>
                            <div class="product_sort_info">
                                <ul>
                                    <?php
                                    $check  = getPostMeta('policy_shield-check');
                                    $sync   = getPostMeta('policy_sync');
                                    $cash   = getPostMeta('policy_bag-dollar');
                                    ?>
                                    <?php if (!empty($check)){ ?>
                                        <li><i class="linearicons-shield-check"></i> <?php echo $check ?></li>
                                    <?php } ?>
                                    <?php if (!empty($sync)){ ?>
                                    <li><i class="linearicons-sync"></i> <?php echo $sync ?></li>
                                    <?php } ?>
                                    <?php if (!empty($cash)){ ?>
                                    <li><i class="linearicons-bag-dollar"></i> <?php echo $cash ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="cart_extra" >
                            <?php do_action('woocommerce_simple_add_to_cart'); ?>
                        </div>
                        <hr>
                        <div class="product_share">
                            <span>Chia sẻ bài viết:</span>
                            <?php get_template_part('/part_templates/share_product_custom'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="large_divider clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Mô tả</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab">
                            <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="small_divider"></div>
                    <div class="divider"></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="heading_s1">
                        <h3>Sản phẩm liên quan</h3>
                    </div>
                    <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "2"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
						<?php
						the_post();
						global $post;
						$types = get_the_terms($post, 'tin-tuc-cat');
						$post_query = getRelatePosts(get_the_ID(),8);
						if ( $post_query->have_posts() ) :
							while ( $post_query->have_posts() ) : $post_query->the_post();
							get_template_part('/loop_templates/product_show_template');
                        	endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
