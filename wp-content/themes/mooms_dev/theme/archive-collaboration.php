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
<div class="page-listing products collaboration">
    <div class="container-fluid">
        <?php
        $collaborationCats = get_terms('collaboration_cat', [
            'hide_empty' => true,
            'parent'   => 0,
        ]);

        foreach ( $collaborationCats as $collaborationCat ) :
                $titleCat = $collaborationCat->name;
                $slugCat = get_term_link($collaborationCat);
                $idCat = $collaborationCat->term_id;
                $desc = $collaborationCat->description;
                $displayType = carbon_get_term_meta($idCat, 'co_display_type');

                if ( $displayType == "partner-cat" ) :
                    $postsPerPage = 4;
                elseif ( $displayType == "customer-cat" ) :
                    $postsPerPage = 2;
                else:
                    $postsPerPage = 1;
                endif;

                $post_query = new WP_Query([
                    'post_type' => 'collaboration',
                    'posts_per_page' => $postsPerPage,
                    'post_status' => 'publish',
                    'tax_query'      => [
                        [
                            'taxonomy'         => 'collaboration_cat',
                            'field'            => 'term_id',
                            'terms'            => $idCat,
                            'include_children' => true,
                        ],
                    ],
                ]);

            if ( $displayType == "partner-cat" ) :

                $template_path = 'template-parts/collaboration/loop-partner.php';
                if ( file_exists(get_template_directory() . '/' . $template_path) ) :
                    include(get_template_directory() . '/' . $template_path);
                endif;

            elseif ( $displayType == "customer-cat" ) :

                $template_path = 'template-parts/collaboration/loop-customer.php';
                if ( file_exists(get_template_directory() . '/' . $template_path) ) :
                    include(get_template_directory() . '/' . $template_path);
                endif;

            else :

                $template_path = 'template-parts/collaboration/loop-colleague.php';
                if ( file_exists(get_template_directory() . '/' . $template_path) ) :
                    include(get_template_directory() . '/' . $template_path);
                endif;

            endif;

        endforeach;
        ?>
    </div>
</div>



