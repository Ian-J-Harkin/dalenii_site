<?php
/**
 * DALENII SOE SYNC & AUTOMATION
 * 1. Pulls SOE content from HTML dump.
 * 2. Forces Page Template to SOE/WWII style.
 * 3. Finalizes link automation for the series.
 */

define('WP_USE_THEMES', false);
require_once('wp-load.php');

$source_dir = 'C:/My Web Sites/dalenii-digital/daleniidigital.com/';
$soe_slug = 'soe-fiction-series';

echo "<h1>SOE Fiction Series Setup</h1><pre>";

// 1. EXTRACTION
$file = $source_dir . $soe_slug . '/index.html';
if (file_exists($file)) {
    $html = file_get_contents($file);
    if (preg_match('/<div class="post-content entry-content">(.*?)<\/div><!-- .post-content -->/s', $html, $matches)) {
        $content = trim($matches[1]);
        $content = preg_replace('/<!-- Mirrored.*?-->/s', '', $content);
        $content = str_replace('.html', '/', $content);

        // Update the page
        $page = get_page_by_path($soe_slug);
        if ($page) {
            wp_update_post([
                'ID' => $page->ID,
                'post_content' => $content
            ]);
            update_post_meta($page->ID, '_wp_page_template', 'single-book-wwii'); // Force SOE-WWII template
            echo "[✓] SOE Content Migrated.\n";
            echo "[✓] SOE Template (single-book-wwii) Forced.\n";
        } else {
            echo "[!] Page 'soe-fiction-series' not found in WP.\n";
        }
    } else {
        echo "[X] Extraction failed for SOE Page content.\n";
    }
} else {
    echo "[!] Source HTML for SOE missing at: $file\n";
}

// 2. SERIES LINK AUTOMATION (PERMALINK CHECK)
echo "\nChecking Permalinks...\n";
flush_rewrite_rules();
echo "[✓] Rewrite rules flushed.\n";

echo "\nSet up complete. Refresh your /soe-fiction-series/ page now.</pre>";
