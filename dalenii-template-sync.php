<?php
/**
 * DALENII TEMPLATE SYNC
 * Resets customized templates in the DB to match the theme's physical files.
 */

define('WP_USE_THEMES', false);
require_once('wp-load.php');

echo "<h1>Dalenii Template Sync</h1><pre>";

$templates = [
    'header' => 'wp_template_part',
    'footer' => 'wp_template_part',
    'navigation' => 'wp_template_part',
    'sidebar-discovery' => 'wp_template_part',
    'page' => 'wp_template',
    'single-book-wwii' => 'wp_template',
    'single-book-crime' => 'wp_template',
    'single-book-spy' => 'wp_template',
    'archive-book' => 'wp_template',
];

foreach ($templates as $slug => $type) {
    // We look for posts with this slug and type in the wp_posts table.
    // These are the database overrides we want to remove.
    $query = new WP_Query([
        'post_type' => $type,
        'name' => $slug,
        'posts_per_page' => 1,
        'post_status' => ['publish', 'inherit'],
    ]);

    if ($query->have_posts()) {
        foreach ($query->posts as $post) {
            wp_delete_post($post->ID, true); // true = force delete
            echo "[✓] Resetting '$slug': Database override removed. Now using theme file.\n";
        }
    } else {
        echo "[.] '$slug' is already using the theme file. No override found.\n";
    }
}

echo "\nSync complete. Refresh your site to see the new layout.</pre>";
