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
<div class="page-listing products collaboration">
    <div class="container-fluid">

        <?php
            $titleCat = $current_term->name;
            $idCat = $current_term->term_id;
            $displayType = carbon_get_term_meta($idCat, 'co_display_type');

        if ( $displayType == "partner-cat" ) :

            $template_path = 'template-parts/collaboration/loop-tax-partner.php';
            if (file_exists(get_template_directory() . '/' . $template_path)) :
                include(get_template_directory() . '/' . $template_path);
            endif;

        elseif ( $displayType == "customer-cat" ) :

            $template_path = 'template-parts/collaboration/loop-tax-customer.php';
            if (file_exists(get_template_directory() . '/' . $template_path)) :
                include(get_template_directory() . '/' . $template_path);
            endif;

        else :

            $template_path = 'template-parts/collaboration/loop-tax-colleague.php';
            if (file_exists(get_template_directory() . '/' . $template_path)) :
                include(get_template_directory() . '/' . $template_path);
            endif;

        endif;
        ?>
    </div>
</div>
