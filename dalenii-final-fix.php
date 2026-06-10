<?php
/**
 * DALENII ULTIMATE SYNC & FIX
 * Corrects site text, flushes the cover image block, and connects the local asset.
 */

define('WP_USE_THEMES', false);
require_once('wp-load.php');
require_once('wp-admin/includes/image.php');
require_once('wp-admin/includes/file.php');
require_once('wp-admin/includes/media.php');

echo "<h1>Dalenii Polishing Script</h1><pre>";

// 1. Fix the Core Branding so dynamic blocks look right without hardcoding HTML
update_option('blogname', 'Dalenii Digital');
update_option('blogdescription', 'Independent Fiction Imprint');
echo "[✓] Site Title updated to 'Dalenii Digital'\n";
echo "[✓] Tagline updated to 'Independent Fiction Imprint'\n";

// 2. Safely acquire the woodland image as a local server asset
$source_file = 'C:/My Web Sites/dalenii-digital/daleniidigital.com/wp-content/uploads/2016/07/cropped-Depositphotos_2592435_m-2015-2.jpg';
$filename = basename($source_file);
$attachment_id = 0;
$local_url = '';

// Check if we uploaded it already
$existing = get_page_by_title($filename, OBJECT, 'attachment');
if ($existing) {
    $attachment_id = $existing->ID;
    $local_url = wp_get_attachment_url($attachment_id);
    echo "[✓] Local image located in library: $attachment_id\n";
} else if (file_exists($source_file)) {
    // Fresh upload
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
        $local_url = $upload['url'];
        echo "[✓] Hand-imported woodland image to library.\n";
    }
}

// 3. Force the header.html to use the correct Block markup for the image
if ($local_url && $attachment_id) {
    $header_file = __DIR__ . '/wp-content/themes/twentytwentyfour-dalenii/parts/header.html';

    // Using the exact structure that WordPress expects for a media library cover block
    $new_header = '<!-- wp:group {"tagName":"header","align":"full","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"color":{"background":"#1C1814"}},"layout":{"type":"constrained"}} -->
<header class="wp-block-group alignfull has-background" style="background-color:#1C1814;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

    <!-- wp:cover {"url":"' . esc_url($local_url) . '","id":' . $attachment_id . ',"dimRatio":0,"minHeight":420,"minHeightUnit":"px","contentPosition":"center center","align":"full","style":{"color":{"background":"#3d3426"}}} -->
    <div class="wp-block-cover alignfull has-background" style="background-color:#3d3426;min-height:420px">
        <span aria-hidden="true" class="wp-block-cover__background has-background-dim-0"></span>
        <img class="wp-block-cover__image-background wp-image-' . $attachment_id . '" alt="" src="' . esc_url($local_url) . '" data-object-fit="cover"/>
        <div class="wp-block-cover__inner-container">

            <!-- wp:group {"align":"center","style":{"color":{"background":"#1C1814","text":"#FAF8F4"},"spacing":{"padding":{"top":"40px","right":"60px","bottom":"40px","left":"60px"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group aligncenter has-text-color has-background" style="background-color:#1C1814;color:#FAF8F4;margin-top:0;margin-bottom:0;padding-top:40px;padding-right:60px;padding-bottom:40px;padding-left:60px">
                
                <!-- wp:site-title {"textAlign":"center","level":1,"style":{"typography":{"fontFamily":"var:preset|font-family|inter","fontWeight":"700","letterSpacing":"0.12em","textTransform":"uppercase"},"spacing":{"margin":{"bottom":"5px"}}}} /-->
                
                <!-- wp:site-tagline {"textAlign":"center","style":{"typography":{"fontFamily":"var:preset|font-family|inter","fontStyle":"italic","fontSize":"0.9rem"},"color":{"text":"#C4B49A"}}} /-->

            </div>
            <!-- /wp:group -->

        </div>
    </div>
    <!-- /wp:cover -->

</header>
<!-- /wp:group -->';

    file_put_contents($header_file, $new_header);
    echo "[✓] Theme Header updated with exact local image ID ($attachment_id) and block markup.\n";
} else {
    echo "[X] Image local fetch failed. Cannot complete header block.\n";
}

echo "Done. Refresh Christopher Nugent now.</pre>";
