<?php
define('WP_USE_THEMES', false);
require_once('wp-load.php');

$page = get_page_by_title('Christopher Nugent');
if ($page) {
    $content = '<!-- wp:paragraph -->
<p>Christopher Nugent is a fiction author published by Dalenii Digital. Christopher is a keen amateur historian who lives in County Meath, Ireland, not too far from the River Boyne, where many of the historical Nugent family fell at the battle of that name. He is becoming an enthusiast for out-of-print Irish pulp fiction, and his own dabblings are being slowly published by Dalenii Digital.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"align":"center"} -->
<figure class="wp-block-image aligncenter"><img src="' . get_stylesheet_directory_uri() . '/assets/images/nugent.jpg" alt="Christopher Nugent"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Every Six Feet</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Published in 2014. <em>Every Six Feet</em> is Christopher Nugent\'s current listed title on the site.</p>
<!-- /wp:paragraph -->';

    wp_update_post([
        'ID' => $page->ID,
        'post_content' => $content
    ]);
    echo "Content injected!";
} else {
    echo "Page not found!";
}
