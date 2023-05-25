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
<div class="page-listing journal">
    <div class="container-fluid">
        <?php
        $journalCats = get_terms('journal_cat', [
            'hide_empty' => true,
            'parent'     => 0,
        ]);

        foreach ($journalCats as $journalCat) :

            $displayType = carbon_get_term_meta($journalCat->term_id, 'display_type');
            $titleCat    = $journalCat->name;
            $slugCat     = $journalCat->slug;
            $idCat       = $journalCat->term_id;
            $desc        = $journalCat->description;

            if ($displayType == "partner-cat") :
                $postsPerPage = 4;
            elseif ($displayType == "customer-cat") :
                $postsPerPage = 2;
            else:
                $postsPerPage = 1;
            endif;

            $post_query = new WP_Query([
                'post_type'      => 'journal',
                'posts_per_page' => $postsPerPage,
                'post_status'    => 'publish',
                'tax_query'      => [
                    [
                        'taxonomy'         => 'journal_cat',
                        'field'            => 'term_id',
                        'terms'            => $idCat,
                        'include_children' => true,
                    ],
                ],
            ]);

            if ($displayType == "find") :

                $template_path = 'template-parts/journal/loop-find.php';
                if (file_exists(get_template_directory() . '/' . $template_path)) :
                    include(get_template_directory() . '/' . $template_path);
                endif;

            elseif ($displayType == "protect") :

                $template_path = 'template-parts/journal/loop-protect.php';
                if (file_exists(get_template_directory() . '/' . $template_path)) :
                    include(get_template_directory() . '/' . $template_path);
                endif;

            elseif ($displayType == "describe") :

                $template_path = 'template-parts/journal/loop-describe.php';
                if (file_exists(get_template_directory() . '/' . $template_path)) :
                    include(get_template_directory() . '/' . $template_path);
                endif;

            else :

                $template_path = 'template-parts/loop-taste.php';
                if (file_exists(get_template_directory() . '/' . $template_path)) :
                    include(get_template_directory() . '/' . $template_path);
                endif;

            endif;

        endforeach;
        ?>
    </div>
</div>



