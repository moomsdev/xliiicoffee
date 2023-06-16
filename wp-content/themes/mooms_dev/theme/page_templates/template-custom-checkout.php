<?php
//Template name: Custom Checkout

/**
 * App Layout: layouts/app.php
 *
 * This is the template that is used for displaying 404 errors.
 *
 * @package WPEmergeTheme
 */
global $woocommerce;
$checkout = WC()->checkout;
?>

<main class="main-content custom-checkout">
    <div class="container-fluid">
        <section class="post-head">
            <div class="row">
                <div class="col-12 text-start">
                    <h1 class="title-post"><?php theTitle(); ?></h1>
                </div>
            </div>
        </section>

        <section class="inner-custom-checkout">
            <div class="row-custom">
                <!--Thông tin giỏ hàng-->

                <div class="cart-info">
                    <div class="title">
                        <a href="#">< <?php echo __('Quay lại cửa hàng', 'gaumap'); ?></a>
                    </div>

                    <ul class="product-reviews">
                        <?php
                        do_action( 'woocommerce_review_order_before_cart_contents' );
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
                        ?>
                            <li>
                                <figure class="media">
                                    <?php
                                    $thumbnail_url = $_product->get_image();
                                    echo $thumbnail_url;
                                    ?>
                                </figure>
                                <div class="info-product">
                                    <div class="name-qtt">
                                        <h5 class="product-name">
                                            <?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
                                        </h5>
                                        <span class="product-qtt">
                                            <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                                        </span>
                                    </div>
                                    <span class="product-price">
                                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                    </span>
                                </div>
                            </li>
                        <?php
                            endif;
                        endforeach;
                        do_action( 'woocommerce_review_order_after_cart_contents' );
                        ?>
                    </ul>

                    <form class="woocommerce-coupon-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                        <?php if ( wc_coupons_enabled() ) { ?>
                            <div class="coupon under-proceed mobile d-flex mb-4 justify-content-between">
                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" style="width: 100%" />
                                <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" style="width: 100%"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
                            </div>
                        <?php } ?>
                    </form>

                    <?php do_action('woocommerce_before_cart_totals'); ?>

                        <div class="subtotal-shipping">
                            <div class="subtotal">

                            </div>
                            <div class="shipping">

                            </div>
                        </div>

                        <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
                            <div class="total">
                                <span><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
                                <span><?php wc_cart_totals_order_total_html(); ?></span>
                            </div>
                        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

                    <?php do_action('woocommerce_after_cart_totals'); ?>

                </div>

                <!--Thông tin đặt hàng-->
                <div class="checkout-info">
                    <div class="woocommerce-billing-fields">
                        <?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

                            <h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

                        <?php else : ?>

                            <h3><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>

                        <?php endif; ?>

                        <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

                        <div class="woocommerce-billing-fields__field-wrapper">
                            <?php
                            $fields = $checkout->get_checkout_fields( 'billing' );

                            foreach ( $fields as $key => $field ) {
                                woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                            }
                            ?>
                        </div>

                        <?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
                    </div>

                    <?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
                        <div class="woocommerce-account-fields">
                            <?php if ( ! $checkout->is_registration_required() ) : ?>

                                <p class="form-row form-row-wide create-account">
                                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
                                    </label>
                                </p>

                            <?php endif; ?>

                            <?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

                            <?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

                                <div class="create-account">
                                    <?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
                                        <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                                    <?php endforeach; ?>
                                    <div class="clear"></div>
                                </div>

                            <?php endif; ?>

                            <?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="payment-method">

                </div>
            </div>
        </section>

    </div>
</main>

