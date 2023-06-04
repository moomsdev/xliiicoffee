<?php
/**
 * Theme header partial.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPEmergeTheme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php wp_head(); ?>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php theAsset('/favicon/apple-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php theAsset('/favicon/apple-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php theAsset('/favicon/apple-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php theAsset('/favicon/apple-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php theAsset('/favicon/apple-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php theAsset('/favicon/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php theAsset('/favicon/apple-icon-144x144.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php theAsset('/favicon/apple-icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php theAsset('/favicon/apple-icon-180x180.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php theAsset('/favicon/android-icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php theAsset('/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php theAsset('/favicon/favicon-96x96.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php theAsset('/favicon/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php theAsset('/favicon/manifest.json'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php theAsset('/favicon/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">

    <style>
        :root {
            --mb-bar-height: 2px;
        }
    </style>
</head>

<body <?php body_class(); ?>>
<?php app_shim_wp_body_open(); ?>

<div class="wrapper_mm">
    <header id="header">
        <div class="container-fluid">
            <div class="row-menu">
                <div class="logo-image">
                    <a href="<?php bloginfo('url') ?>" class="main-logo">
                        <img src="<?php theOptionImage('logo'); ?>" alt="<?php bloginfo('url'); ?>">
                    </a>
                    <a href="<?php bloginfo('url') ?>" class="fixed-logo">
                        <img src="<?php theOptionImage('logo_fixed'); ?>" alt="<?php bloginfo('url'); ?>">
                    </a>
                </div>
                <div class="both-menu">
                    <div class="main-menu">
                        <div class="pc-menu">
                            <?php
                            wp_nav_menu([
                                'menu'           => 'main-menu',
                                'theme_location' => 'main-menu',
                                'container'      => 'ul',
                                'menu_class'     => 'nav-menu',
                                'walker'         => new Bootstrap_Menu_Walker(),
                            ])
                            ?>
                        </div>
                        <div class="mb-menu">
                            <a class="__bar_menu" href="#mobile_menu">
                                <button class="mburger mburger--collapse">
                                    <b></b>
                                    <b></b>
                                    <b></b>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="right-menu">
                        <ul>
                            <li ><?php theLanguageSwitcher() ?></li>
                            <!--<li><a href="#"><img src="--><?php //theAsset('/icon/icon-search.png'); ?><!--" alt="search"></a></li>-->
                            <!--<li><a href="#"><img src="--><?php //theAsset('/icon/icon-user.png'); ?><!--" alt="search"></a></li>-->
                            <!--<li><a href="#"><img src="--><?php //theAsset('/icon/icon-cart.png'); ?><!--" alt="search"></a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
