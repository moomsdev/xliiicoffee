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
            $slugCat = $current_term->slug;
            $idCat = $current_term->term_id;
            $displayType = carbon_get_term_meta($idCat, 'journal_display_type');

        if ($displayType == "find") :

            $template_path = 'template-parts/journal/loop-tax-find.php';
            if (file_exists(get_template_directory() . '/' . $template_path)) :
                include(get_template_directory() . '/' . $template_path);
            endif;

        elseif ($displayType == "protect") :

            $template_path = 'template-parts/journal/loop-tax-protect.php';
            if (file_exists(get_template_directory() . '/' . $template_path)) :
                include(get_template_directory() . '/' . $template_path);
            endif;

        elseif ($displayType == "describe") :

            $template_path = 'template-parts/journal/loop-tax-describe.php';
            if (file_exists(get_template_directory() . '/' . $template_path)) :
                include(get_template_directory() . '/' . $template_path);
            endif;

        else :

            $template_path = 'template-parts/journal/loop-tax-taste.php';
            if (file_exists(get_template_directory() . '/' . $template_path)) :
                include(get_template_directory() . '/' . $template_path);
            endif;

        endif;
        ?>
    </div>
</div>
