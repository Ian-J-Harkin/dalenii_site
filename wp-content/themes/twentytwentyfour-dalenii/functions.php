<?php
/**
 * Dalenii Digital Child Theme — functions.php
 * All CPT, taxonomy, and font logic is in the dalenii-core-helper plugin.
 */

add_action( 'wp_enqueue_scripts', 'dalenii_child_enqueue' );
function dalenii_child_enqueue() {
    wp_enqueue_style(
        'dalenii-child-style',
        get_stylesheet_uri(),
        array( 'twenty-twenty-four-style' ),
        wp_get_theme()->get( 'Version' )
    );
}
