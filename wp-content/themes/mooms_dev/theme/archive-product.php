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
?>
<div class="page-listing products">
    <div class="container-fluid">
        <?php
        $ProductCats = get_terms('product_cat', [
            'hide_empty' => true,
            'parent'   => 0,
        ]);

        foreach ( $ProductCats as $ProductCat ) :
                $titleCat = $ProductCat->name;
                $slugCat = get_term_link($ProductCat);
                $idCat = $ProductCat->term_id;
                $displayType = carbon_get_term_meta($idCat, 'product_display_type');

                $post_query = new WP_Query([
                    'post_type' => 'product',
                    'posts_per_page' => 5,
                    'post_status' => 'publish',
                    'tax_query'      => [
                        [
                            'taxonomy'         => 'product_cat',
                            'field'            => 'term_id',
                            'terms'            => $idCat,
                            'include_children' => true,
                        ],
                    ],
                ]);

            if ( $displayType === "grid-card" ) :

                $template_path = 'template-parts/products/loop-subscription.php';
                if (file_exists(get_template_directory() . '/' . $template_path)) :
                    include(get_template_directory() . '/' . $template_path);
                endif;

            else :

                $template_path = 'template-parts/products/loop-coffee_bean.php';
                if (file_exists(get_template_directory() . '/' . $template_path)) :
                    include(get_template_directory() . '/' . $template_path);
                endif;

            endif;

        endforeach;
        ?>
    </div>
</div>



