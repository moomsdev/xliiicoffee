<?php
/**
 * App Layout: layouts/app.php
 *
 * The main template file.
 *
 * This is the template that is used for displaying:
 * - posts
 * - single posts
 * - archive pages
 * - search results pages
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPEmergeTheme
 */
if ($template_file == 'page_templates/homepage_template.php') { // the filename of the page template
    get_template_part('page_templates/homepage_template');
}

?>


