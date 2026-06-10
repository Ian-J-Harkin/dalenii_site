<?php
/**
 * DALENII BOOK MIGRATION SCRIPT
 * Creates the first 3 book entries and populates their structured ACF data.
 */

define('WP_USE_THEMES', false);
require_once('wp-load.php');

// Data Map
$books = [
    [
        'title' => 'Low Season',
        'slug' => 'low-season',
        'series' => 'adversaries-crime',
        'fields' => [
            'buy_url' => 'https://dennisdraytonbooks.com/b/Igfk8',
            'secondary_buy_label' => 'Books2Read',
            'secondary_buy_url' => 'https://books2read.com/u/mg0vlv',
        ]
    ],
    [
        'title' => 'The Adversary',
        'slug' => 'the-adversary',
        'series' => 'adversaries-crime',
        'fields' => [
            'buy_url' => 'https://dennisdraytonbooks.com/b/Jm7rK',
            'secondary_buy_label' => 'Books2Read',
            'secondary_buy_url' => 'https://books2read.com/u/49EPKd',
        ]
    ],
    [
        'title' => 'Every Six Feet',
        'slug' => 'every-six-feet',
        'series' => '', // Standalone/Unassigned for now
        'fields' => [
            'buy_url' => 'https://www.amazon.com/Every-Six-Feet-Mulcahy-Story-ebook/dp/B00MNV9JXS',
            'secondary_buy_label' => '',
            'secondary_buy_url' => '',
        ]
    ]
];

echo "<h1>Book Migration (Initial 3 Titles)</h1><pre>";

foreach ($books as $data) {
    // 1. Create or Update Post
    $existing = get_page_by_path($data['slug'], OBJECT, 'book');
    $post_id = wp_insert_post([
        'ID' => ($existing ? $existing->ID : 0),
        'post_title' => $data['title'],
        'post_name' => $data['slug'],
        'post_type' => 'book',
        'post_status' => 'publish',
    ]);

    if ($post_id) {
        echo "[✓] Post created/updated: {$data['title']}\n";

        // 2. Assign Series Taxonomy
        if ($data['series']) {
            wp_set_object_terms($post_id, $data['series'], 'book_series');
            echo "    - Assigned to series: {$data['series']}\n";
        }

        // 3. Update ACF Fields
        // We use update_post_meta for compatibility if ACF function isn't loaded
        foreach ($data['fields'] as $key => $val) {
            update_post_meta($post_id, $key, $val);
            echo "    - Field '$key' set.\n";
        }
    } else {
        echo "[X] Failed to create: {$data['title']}\n";
    }
}

echo "\nMigration complete. View 'Books' in your WP Admin.</pre>";
