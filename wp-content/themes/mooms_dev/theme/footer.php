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
    <div class="container">

    </div>
</footer>

</div>

<nav id="mobile_menu" class="d-none">
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
