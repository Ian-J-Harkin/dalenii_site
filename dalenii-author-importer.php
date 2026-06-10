<?php
/**
 * DALENII AUTHOR BIO IMPORTER
 * Extracts bios for Dennis Drayton and Christopher Nugent.
 */

define('WP_USE_THEMES', false);
require_once('wp-load.php');

$source_dir = 'C:/My Web Sites/dalenii-digital/daleniidigital.com/';
$authors = [
    'dennis-drayton' => 'dennis-drayton',
    'christopher-nugent' => 'christopher-nugent'
];

echo "<h1>Author Content Migration</h1><pre>";

foreach ($authors as $folder => $slug) {
    $file = $source_dir . $folder . '/index.html';

    if (!file_exists($file)) {
        echo "[!] Missing: $file\n";
        continue;
    }

    $html = file_get_contents($file);

    // Extract content from entry-content div
    if (preg_match('/<div class="post-content entry-content">(.*?)<\/div><!-- .post-content -->/s', $html, $matches)) {
        $content = $matches[1];

        // Clean HTTrack mirror artifacts
        $content = preg_replace('/<!-- Mirrored.*?-->/s', '', $content);
        // Fix internal links
        $content = str_replace('.html', '/', $content);

        // Update WordPress
        $page = get_page_by_path($slug);
        if ($page) {
            wp_update_post([
                'ID' => $page->ID,
                'post_content' => trim($content)
            ]);
            echo "[✓] Updated Bio for: $slug\n";
        } else {
            echo "[!] WP Page not found for: $slug\n";
        }
    } else {
        echo "[X] Extraction failed for: $folder\n";
    }
}

echo "\nDone. You can now delete this script.</pre>";
