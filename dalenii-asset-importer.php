<?php
/**
 * DALENII ASSET IMPORTER
 * Imports the local header image from the HTTrack dump into the Media Library.
 */

define('WP_USE_THEMES', false);
require_once('wp-load.php');
require_once('wp-admin/includes/image.php');
require_once('wp-admin/includes/file.php');
require_once('wp-admin/includes/media.php');

$source_file = 'C:/My Web Sites/dalenii-digital/daleniidigital.com/wp-content/uploads/2016/07/cropped-Depositphotos_2592435_m-2015-2.jpg';

echo "<h1>Dalenii Asset Importer</h1><pre>";

if (file_exists($source_file)) {
    // 1. Check if it's already in the library
    $filename = basename($source_file);
    $existing = get_page_by_title($filename, OBJECT, 'attachment');

    if (!$existing) {
        // Upload the file to the media library
        $upload = wp_upload_bits($filename, null, file_get_contents($source_file));

        if (!$upload['error']) {
            $attachment_id = wp_insert_attachment([
                'post_mime_type' => 'image/jpeg',
                'post_title' => $filename,
                'post_content' => '',
                'post_status' => 'inherit'
            ], $upload['file']);

            $attach_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
            wp_update_attachment_metadata($attachment_id, $attach_data);

            echo "[✓] Local Asset Imported. ID: $attachment_id\n";
            echo "[✓] Local Path: {$upload['url']}\n";

            // 2. Update Header Template with Local URL
            $local_url = $upload['url'];
            $header_file = 'wp-content/themes/twentytwentyfour-dalenii/parts/header.html';
            $header_content = file_get_contents($header_file);
            $header_content = str_replace('https://daleniidigital.com/wp-content/uploads/2016/07/cropped-Depositphotos_2592435_m-2015-2.jpg', $local_url, $header_content);
            file_put_contents($header_file, $header_content);

            echo "[✓] Header template updated to use local asset.\n";
        } else {
            echo "[X] Upload error: " . $upload['error'] . "\n";
        }
    } else {
        echo "[.] Asset already exists in library.\n";
    }
} else {
    echo "[X] Local source file not found at: $source_file\n";
}

echo "\nDone. Refresh your site to see the local banner image.</pre>";
