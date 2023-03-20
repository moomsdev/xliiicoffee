<?php
/**
 * Register custom taxonomies.
 *
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 *
 * @hook    init
 * @package WPEmergeTheme
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Custom hierarchical taxonomy (like categories).
// phpcs:disable

add_action('init', function () {
    register_taxonomy(
        'journal_tags',
        array( 'journal' ),
        array(
            'hierarchical'  => false,
            'label'         => __( 'Tags', 'app' ),
            'singular_name' => __( 'Tags', 'app' ),
            'rewrite'       => true,
            'query_var'     => true
        )
    );
});

// phpcs:enable

