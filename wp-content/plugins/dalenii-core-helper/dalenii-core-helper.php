<?php
/**
 * Plugin Name: Dalenii Core Helper
 * Description: CPT registration, book taxonomy, and series font isolation for daleniidigital.com
 * Version:     1.0.0
 * Author:      Dalenii Digital
 */

defined('ABSPATH') || exit;


// ============================================================
// 1. CUSTOM POST TYPE — book
//    URL structure: /book/[slug]/
// ============================================================

add_action('init', 'dalenii_register_book_cpt');

function dalenii_register_book_cpt()
{
    register_post_type('book', array(
        'labels' => array(
            'name' => 'Books',
            'singular_name' => 'Book',
            'add_new_item' => 'Add New Book',
            'edit_item' => 'Edit Book',
            'view_item' => 'View Book',
            'all_items' => 'All Books',
            'search_items' => 'Search Books',
            'not_found' => 'No books found.',
            'not_found_in_trash' => 'No books found in Trash.',
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-book-alt',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'page-attributes',   // enables Template dropdown in sidebar
        ),
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'book',
            'with_front' => false,
        ),
        'taxonomies' => array('book_series'),
    ));
}


// ============================================================
// 2. CUSTOM TAXONOMY — book_series
//    Drives template selection context.
//    Archive URLs: /book-series/soe-wwii/ etc.
//    Terms to create manually after activation:
//      - Name: SOE WWII      | Slug: soe-wwii
//      - Name: Crime         | Slug: adversaries-crime
//      - Name: Spy           | Slug: murray-spy
// ============================================================

add_action('init', 'dalenii_register_book_series_taxonomy');

function dalenii_register_book_series_taxonomy()
{
    register_taxonomy('book_series', array('book'), array(
        'labels' => array(
            'name' => 'Series',
            'singular_name' => 'Series',
            'search_items' => 'Search Series',
            'all_items' => 'All Series',
            'edit_item' => 'Edit Series',
            'update_item' => 'Update Series',
            'add_new_item' => 'Add New Series',
            'new_item_name' => 'New Series Name',
            'menu_name' => 'Series',
        ),
        'hierarchical' => true,   // behaves like categories, not tags
        'public' => true,
        'show_in_rest' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'book-series'),
    ));
}


// ============================================================
// 3. FLUSH REWRITE RULES ON ACTIVATION
//    Prevents 404s on first load after CPT registration.
// ============================================================

register_activation_hook(__FILE__, 'dalenii_flush_rewrites');
function dalenii_flush_rewrites()
{
    dalenii_register_book_cpt();
    dalenii_register_book_series_taxonomy();
    flush_rewrite_rules();
}


// ============================================================
// 4. CONDITIONAL FONT ENQUEUE — series-specific fonts
//    Loads editorial fonts ONLY on single book pages.
//    Inter is handled globally by theme.json.
//    Fonts loaded per template:
//      single-book-wwii  → EB Garamond + Special Elite
//      single-book-crime → Special Elite
//      single-book-spy   → Zilla Slab + EB Garamond
// ============================================================

add_action('wp_enqueue_scripts', 'dalenii_conditional_fonts');

function dalenii_conditional_fonts()
{

    if (!is_singular('book'))
        return;

    $template = get_page_template_slug(get_the_ID());

    if ($template === 'single-book-wwii') {
        wp_enqueue_style(
            'dalenii-fonts-wwii',
            'https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,600;1,400&family=Special+Elite&display=swap',
            array(),
            null
        );
    }

    if ($template === 'single-book-crime') {
        wp_enqueue_style(
            'dalenii-fonts-crime',
            'https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Barlow:wght@400;500;600&family=EB+Garamond:ital,wght@0,400;0,600;1,400&display=swap',
            array(),
            null
        );
    }

    if ($template === 'single-book-spy') {
        wp_enqueue_style(
            'dalenii-fonts-spy',
            'https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@400;600;700&family=EB+Garamond:ital,wght@0,400;0,600;1,400&display=swap',
            array(),
            null
        );
    }
}


// ============================================================
// 5. SOE NAV ITEM AMBER ACCENT
//    Adds amber colour to SOE Fiction Series nav item.
//    Targets the Navigation block's generated anchor by href.
// ============================================================

add_action('wp_head', 'dalenii_soe_nav_accent');

function dalenii_soe_nav_accent()
{
    echo '<style>
    .wp-block-navigation a[href*="soe-fiction-series"] {
        color: #C8A96A !important;
    }
    .wp-block-navigation a[href*="soe-fiction-series"]:hover {
        color: #FAF8F4 !important;
    }
    </style>' . "\n";
}
