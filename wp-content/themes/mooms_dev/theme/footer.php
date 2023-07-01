<?php

/**
 * Theme footer partial.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPEmergeTheme
 */

?>
<footer class="footer">
    <div class="container-fluid">
        <div class="footer-top">
            <div class="columns left-column">
                <ul>
                    <?php
                    $payments = getOption('payments');
                    if ($payments) :
                        foreach ( $payments as $payment ) :
                            ?>
                            <li>
                                <img src="<?php echo getImageUrlById($payment['icon_payment']); ?>" alt="<?php theOption($payment['name_payment']); ?>">
                            </li>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>

            <div class="columns right-column">
                <ul>
                    <?php
                    $socials = getOption('social_media');
                    if ($socials) :
                        foreach ( $socials as $social ) :
                    ?>
                        <li>
                            <a href="<?php echo $social['link_social']; ?>" target="_blank">
                                <img src="<?php echo getImageUrlById($social['icon_social']); ?>" alt="<?php echo $social['name_social']; ?>">
                            </a>
                        </li>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="row">
                <div class="col-12 col-xxl-6 text-center text-xxl-start">
                    <div class="info-company">
                        <h3 class="name"><?php theOption('company'); ?></h3>
                        <p class="info address"><?php theOption('address'); ?></p>
                        <p class="info phone">
                            <?php echo __('Phone number:', 'gaumap') ?>
                            <a href="tel:<?php echo str_replace(['.', ',', ' '], '', getOption('phone_number')) ?>" class="underline-hover"><?php theOption('phone_number'); ?></a>
                        </p>
                        <p class="info email">
                            <?php echo __('Email:', 'gaumap') ?>
                            <a href="mailto:<?php theOption('email'); ?>" class="underline-hover"><?php theOption('email'); ?></a>
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xxl-3 text-center text-lg-start">
                    <nav class="footer-menu">
                        <?php
                        wp_nav_menu([
                            'menu'           => 'footer-menu',
                            'theme_location' => 'footer-menu',
                            'container'      => 'ul',
                            'menu_class'     => '',
                        ])
                        ?>
                    </nav>
                </div>
                <div class="col-12 col-lg-6 col-xxl-3 text-center text-lg-start">
                    <div class="certificate">
                        <div class="information">
                            <?php
                            $certificate = getOption('certificate');
                            echo apply_filters('the_content', $certificate);
                            ?>
                        </div>
                        <div class="media">
                            <a href="<?php theOption('link_bocongthuong'); ?>" target="_blank">
                                <img src="<?php theOptionImage('bocongthuong'); ?>" alt="">
                            </a>

                            <a href="<?php theOption('link_dmca'); ?>" target="_blank">
                                <img src="<?php echo theOptionImage('dmca'); ?>" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal right fade" id="search" tabindex="-1" role="dialog" aria-labelledby="search">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <h2 class="title-post"><?php echo __('Tìm kiếm', 'gaumap'); ?></h2>
                <form action="<?php bloginfo('url'); ?>" method="GET" role="form" >

                    <div class="input-group">
                        <button type="submit"  class="search_btn"><i class="fa fa-search"></i></button>
                        <input class="form-control" id="search-input" name="s" type="search" aria-label="Search" aria-describedby="search-addon">
                        <span id="clear-icon" class="clear-icon">&#10006;</span>
                    </div>
                </form>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>

<div class="modal right fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="cart">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <?php do_action('woocommerce_before_cart'); ?>
                <div class="top-body">
                    <h2 class="title-post"><?php echo __('Giỏ hàng', 'gaumap'); ?></h2>
                    <?php
                    global $woocommerce;
                    // Lấy đối tượng giỏ hàng
                    $cart = $woocommerce->cart;
                    // In số lượng sản phẩm
                    echo ' <span class="qtt-product">('. $cart->get_cart_contents_count() . ' products)</span>';
                    ?>
                </div>
                <div class="product-cart border-top-1px">
                    <?php do_action('woocommerce_before_cart_contents'); ?>

                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                    $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) :
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                        ?>
                            <div class="item-product-cart">
                                <div class="inner-product-cart">
                                    <div class="product-info">
                                        <div class="product-thumbnail">
                                             <span>
                                                 <?php
                                                 echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                     'woocommerce_cart_item_remove_link',
                                                     sprintf(
                                                         '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                         esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                         esc_html__('Remove this item', 'woocommerce'),
                                                         esc_attr($product_id),
                                                         esc_attr($_product->get_sku())
                                                     ),
                                                     $cart_item_key
                                                 );
                                                 ?>
                                            </span>
                                            <figure class="media">


                                                <?php
                                                $thumbnail = get_the_post_thumbnail_url($product_id);

                                                if (!$product_permalink) {
                                                    echo '<a href="'.get_permalink($product_id).'"><img src="'.$thumbnail.'"> </a>';
                                                } else {
                                                    echo '<a href="'.get_permalink($product_id).'"><img src="'.$thumbnail.'"></a>';
                                                }
                                                ?>
                                            </figure>

                                        </div>

                                        <div class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                            <div class="inner-product-name">
                                                <?php
                                                if (!$product_permalink) {
                                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                                } else {
                                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                                }

                                                do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                                // Meta data.
                                                echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                                // Backorder notification.
                                                if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                                }

                                                $categories = get_the_terms($product_id, 'product_cat');
                                                $varieties = get_the_terms($product_id, 'variety_cat');
                                                if ( $categories && $varieties ) :
                                                    ?>
                                                    <div class="categories">
                                                        <ul>
                                                            <?php
                                                            foreach ($categories as $category) {
                                                                $children = get_term_children($category->term_id, 'product_cat');
                                                                if (!empty($children) && !is_wp_error($children)) {
                                                                    foreach ($children as $child) {
                                                                        $child_category = get_term_by('term_id', $child, 'product_cat');
                                                                        if (has_term($child_category->term_id, 'product_cat', $product_id)) {
                                                                            echo "<li>$child_category->name</li>";
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                            foreach ($varieties as $variety) {
                                                                echo  "<li> $variety->name </li>";
                                                                break;
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                <?php
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="product-price-qtt">
                                        <div class="inner-product-price-qtt">
                                            <div class="product-price">
                                                <?php
                                                echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                ?>
                                            </div>
                                            <div class="product-quantity">
                                                <?php
                                                if ($_product->is_sold_individually()) {
                                                    $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                                } else {
                                                    $product_quantity = woocommerce_quantity_input(
                                                        [
                                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                                            'input_value'  => $cart_item['quantity'],
                                                            'max_value'    => $_product->get_max_purchase_quantity(),
                                                            'min_value'    => '0',
                                                            'product_name' => $_product->get_name(),
                                                        ],
                                                        $_product,
                                                        false
                                                    );
                                                }

                                                echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php
                        endif;
                    endforeach;
                    ?>
                    <?php do_action('woocommerce_after_cart_table'); ?>
                </div>
                <div class="checkout-cart border-top-1px">
                    <?php do_action('woocommerce_before_cart_totals'); ?>
                    <div class="subtotal">
                        <label for="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php esc_html_e('Subtotal', 'woocommerce'); ?></label>
                        <span data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php wc_cart_totals_subtotal_html(); ?></span>
                    </div>

                    <div class="wc-proceed-to-checkout">
                        <?php do_action('woocommerce_proceed_to_checkout'); ?>
                        <div class="custom-control custom-checkbox">
                            <!--<input type="checkbox" class="custom-control-input" name="agree_term" id="agree_term" value="yes" checked>-->
                            <label class="custom-control-label mb-4" for="agree_term"><?php echo __('No Taxes or Duties on arrival','gaumap') ?></label>
                        </div>
                    </div>

                    <?php do_action('woocommerce_after_cart_totals'); ?>

                </div>
                <?php do_action('woocommerce_after_cart_contents'); ?>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>

</div>

<!-- Back to top button -->
<a id="button" style="background-image: url('<?php theAsset('icon/back-to-top.png'); ?>')"></a>

<nav id="mobile_menu">
    <?php
    wp_nav_menu([
        'menu'           => 'main-menu',
        'theme_location' => 'main-menu',
        'container'      => 'ul',
        'menu_class'     => '',
    ])
    ?>
</nav>
<?php wp_footer(); ?>
</body>

</html>
