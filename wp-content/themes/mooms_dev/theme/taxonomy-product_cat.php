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
$current_term = get_queried_object();
?>
<div class="page-listing products">
    <div class="container-fluid">
        <?php
            $titleCat = $current_term->name;
            $idCat = $current_term->term_id;
            $displayType = carbon_get_term_meta($idCat, 'product_display_type');

        if ( $displayType === "grid-card" ) :

            $template_path = 'template-parts/products/loop-tax-subscription.php';
            if (file_exists(get_template_directory() . '/' . $template_path)) :
                include(get_template_directory() . '/' . $template_path);
            endif;

        else :

            $template_path = 'template-parts/products/loop-tax-coffee_bean.php';
            if (file_exists(get_template_directory() . '/' . $template_path)) :
                include(get_template_directory() . '/' . $template_path);
            endif;

        endif;
        ?>
    </div>
</div>
