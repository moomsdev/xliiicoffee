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
