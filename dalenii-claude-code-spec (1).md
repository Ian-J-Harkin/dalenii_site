# Dalenii Digital — Claude Code Build Specification
## Machine-Readable Engineering Specification
## Version 1.0 — May 2026

---

## ENVIRONMENT

- **Local environment:** WordPress Studio (Automattic desktop app)
- **WordPress version:** 7.0
- **PHP version:** 8.1
- **Deployment target:** Blacknight shared hosting, cPanel File Manager upload
- **No build pipeline:** No npm, no webpack, no git push-to-deploy
- **Parent theme:** Twenty Twenty-Four (twentytwentyfour) — installed, do not modify
- **Child theme folder:** `twentytwentyfour-dalenii`
- **Helper plugin folder:** `dalenii-core-helper`

---

## OUTPUT DIRECTORY STRUCTURE

Build the following file tree. Every file listed must be created.

```
dalenii-migration-package/
├── themes/
│   └── twentytwentyfour-dalenii/
│       ├── style.css
│       ├── theme.json
│       ├── functions.php
│       ├── templates/
│       │   ├── single-book-wwii.html
│       │   ├── single-book-crime.html
│       │   ├── single-book-spy.html
│       │   └── archive-book.html
│       ├── parts/
│       │   ├── header.html
│       │   ├── footer.html
│       │   └── navigation.html
│       └── acf-json/
│           └── group_dalenii_books.json
└── plugins/
    └── dalenii-core-helper/
        └── dalenii-core-helper.php
```

---

## FILE 1 — `themes/twentytwentyfour-dalenii/style.css`

Minimal theme declaration only. No CSS rules.

```css
/*
Theme Name:   Dalenii Digital
Description:  Child theme of Twenty Twenty-Four for daleniidigital.com
Author:       Dalenii Digital
Template:     twentytwentyfour
Version:      1.0.0
*/
```

---

## FILE 2 — `themes/twentytwentyfour-dalenii/theme.json`

Schema version 3. Defines the global design system.

### Exact colour palette — use these hex values verbatim:

```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 3,
  "settings": {
    "color": {
      "palette": [
        { "slug": "dd-ink",          "color": "#1C1814", "name": "Dalenii Ink" },
        { "slug": "dd-ink-mid",      "color": "#3A342C", "name": "Dalenii Ink Mid" },
        { "slug": "dd-ink-muted",    "color": "#6B5F52", "name": "Dalenii Ink Muted" },
        { "slug": "dd-cream",        "color": "#F4F0E8", "name": "Dalenii Cream" },
        { "slug": "dd-warm-white",   "color": "#FAF8F4", "name": "Dalenii Warm White" },
        { "slug": "dd-parchment",    "color": "#E8E0CC", "name": "Dalenii Parchment" },
        { "slug": "dd-rule",         "color": "#C4B49A", "name": "Dalenii Rule" },
        { "slug": "soe-bg",          "color": "#3D3426", "name": "SOE Background" },
        { "slug": "soe-paper",       "color": "#D9CDB4", "name": "SOE Paper" },
        { "slug": "soe-sepia",       "color": "#8B6F47", "name": "SOE Sepia" },
        { "slug": "soe-border",      "color": "#4A3E2A", "name": "SOE Border" },
        { "slug": "adv-bg",          "color": "#1E2830", "name": "Adversaries Background" },
        { "slug": "adv-text",        "color": "#D8E4EC", "name": "Adversaries Text" },
        { "slug": "adv-body",        "color": "#5A7080", "name": "Adversaries Body" },
        { "slug": "adv-red",         "color": "#C8374A", "name": "Adversaries Red" },
        { "slug": "adv-red-hover",   "color": "#A02030", "name": "Adversaries Red Hover" },
        { "slug": "adv-muted",       "color": "#8899AA", "name": "Adversaries Muted" },
        { "slug": "adv-border",      "color": "#2A3840", "name": "Adversaries Border" },
        { "slug": "murray-bg",       "color": "#1A2535", "name": "Murray Background" },
        { "slug": "murray-text",     "color": "#C8D8E8", "name": "Murray Text" },
        { "slug": "murray-body",     "color": "#3A5A7A", "name": "Murray Body" },
        { "slug": "murray-blue",     "color": "#5B8DB8", "name": "Murray Blue" },
        { "slug": "murray-border",   "color": "#2A3A4A", "name": "Murray Border" }
      ]
    },
    "typography": {
      "fontFamilies": [
        {
          "fontFamily": "'Inter', system-ui, -apple-system, sans-serif",
          "slug": "inter",
          "name": "Inter",
          "fontFace": [
            {
              "src": "https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap",
              "fontWeight": "400 600",
              "fontStyle": "normal"
            }
          ]
        }
      ],
      "defaultFontSizes": false,
      "fontSizes": [
        { "slug": "small",   "size": "0.875rem", "name": "Small"   },
        { "slug": "medium",  "size": "1rem",     "name": "Medium"  },
        { "slug": "large",   "size": "1.25rem",  "name": "Large"   },
        { "slug": "x-large", "size": "1.75rem",  "name": "X Large" },
        { "slug": "xx-large","size": "2.5rem",   "name": "XX Large"}
      ]
    },
    "layout": {
      "contentSize": "680px",
      "wideSize": "1100px"
    },
    "spacing": {
      "spacingScale": {
        "operator": "*",
        "increment": 1.5,
        "steps": 7,
        "mediumStep": 1.5,
        "unit": "rem"
      }
    }
  },
  "styles": {
    "color": {
      "background": "#FAF8F4",
      "text": "#1C1814"
    },
    "typography": {
      "fontFamily": "var(--wp--preset--font-family--inter)",
      "fontSize": "var(--wp--preset--font-size--medium)",
      "lineHeight": "1.75"
    },
    "elements": {
      "link": {
        "color": { "text": "#3A342C" },
        ":hover": { "color": { "text": "#8B6F47" } }
      },
      "h1": { "typography": { "fontSize": "var(--wp--preset--font-size--xx-large)", "fontWeight": "700", "lineHeight": "1.1" } },
      "h2": { "typography": { "fontSize": "var(--wp--preset--font-size--x-large)",  "fontWeight": "700", "lineHeight": "1.2" } },
      "h3": { "typography": { "fontSize": "var(--wp--preset--font-size--large)",    "fontWeight": "700", "lineHeight": "1.3" } }
    }
  },
  "customTemplates": [
    { "name": "single-book-wwii",  "title": "Single Book — SOE WWII",         "postTypes": ["book"] },
    { "name": "single-book-crime", "title": "Single Book — Adversaries Crime", "postTypes": ["book"] },
    { "name": "single-book-spy",   "title": "Single Book — Murray Spy",        "postTypes": ["book"] },
    { "name": "archive-book",      "title": "Book Archive",                    "postTypes": ["book"] }
  ]
}
```

---

## FILE 3 — `themes/twentytwentyfour-dalenii/functions.php`

Empty — all functional logic lives in the helper plugin. Child theme `functions.php` only enqueues the parent stylesheet.

```php
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
```

---

## FILE 4 — `plugins/dalenii-core-helper/dalenii-core-helper.php`

Single plugin file. Handles CPT registration, taxonomy registration, and conditional font enqueuing. No frontend CSS or JS output beyond the font conditionals.

```php
<?php
/**
 * Plugin Name: Dalenii Core Helper
 * Description: CPT registration, book taxonomy, and series font isolation for daleniidigital.com
 * Version:     1.0.0
 * Author:      Dalenii Digital
 */

defined( 'ABSPATH' ) || exit;


// ============================================================
// 1. CUSTOM POST TYPE — book
//    URL structure: /book/[slug]/
// ============================================================

add_action( 'init', 'dalenii_register_book_cpt' );

function dalenii_register_book_cpt() {
    register_post_type( 'book', array(
        'labels' => array(
            'name'               => 'Books',
            'singular_name'      => 'Book',
            'add_new_item'       => 'Add New Book',
            'edit_item'          => 'Edit Book',
            'view_item'          => 'View Book',
            'all_items'          => 'All Books',
            'search_items'       => 'Search Books',
            'not_found'          => 'No books found.',
            'not_found_in_trash' => 'No books found in Trash.',
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'page-attributes',   // enables Template dropdown in sidebar
        ),
        'has_archive'        => true,
        'rewrite'            => array(
            'slug'       => 'book',
            'with_front' => false,
        ),
        'taxonomies'         => array( 'book_series' ),
    ) );
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

add_action( 'init', 'dalenii_register_book_series_taxonomy' );

function dalenii_register_book_series_taxonomy() {
    register_taxonomy( 'book_series', array( 'book' ), array(
        'labels' => array(
            'name'              => 'Series',
            'singular_name'     => 'Series',
            'search_items'      => 'Search Series',
            'all_items'         => 'All Series',
            'edit_item'         => 'Edit Series',
            'update_item'       => 'Update Series',
            'add_new_item'      => 'Add New Series',
            'new_item_name'     => 'New Series Name',
            'menu_name'         => 'Series',
        ),
        'hierarchical'      => true,   // behaves like categories, not tags
        'public'            => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'book-series' ),
    ) );
}


// ============================================================
// 3. FLUSH REWRITE RULES ON ACTIVATION
//    Prevents 404s on first load after CPT registration.
// ============================================================

register_activation_hook( __FILE__, 'dalenii_flush_rewrites' );
function dalenii_flush_rewrites() {
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

add_action( 'wp_enqueue_scripts', 'dalenii_conditional_fonts' );

function dalenii_conditional_fonts() {

    if ( ! is_singular( 'book' ) ) return;

    $template = get_page_template_slug( get_the_ID() );

    if ( $template === 'single-book-wwii' ) {
        wp_enqueue_style(
            'dalenii-fonts-wwii',
            'https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,600;1,400&family=Special+Elite&display=swap',
            array(),
            null
        );
    }

    if ( $template === 'single-book-crime' ) {
        wp_enqueue_style(
            'dalenii-fonts-crime',
            'https://fonts.googleapis.com/css2?family=Special+Elite&display=swap',
            array(),
            null
        );
    }

    if ( $template === 'single-book-spy' ) {
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

add_action( 'wp_head', 'dalenii_soe_nav_accent' );

function dalenii_soe_nav_accent() {
    echo '<style>
    .wp-block-navigation a[href*="soe-fiction-series"] {
        color: #C8A96A !important;
    }
    .wp-block-navigation a[href*="soe-fiction-series"]:hover {
        color: #FAF8F4 !important;
    }
    </style>' . "\n";
}
```

---

## FILE 5 — `themes/twentytwentyfour-dalenii/acf-json/group_dalenii_books.json`

ACF Local JSON field group definition. When this file is present in the `acf-json` directory and ACF Free is active, the field group is automatically imported. ACF must have Local JSON enabled (it is by default in ACF Free).

```json
{
  "key": "group_dalenii_books",
  "title": "Book Details",
  "fields": [
    {
      "key": "field_book_cover_image",
      "label": "Cover Image",
      "name": "book_cover_image",
      "type": "image",
      "return_format": "id",
      "preview_size": "medium",
      "instructions": "Upload the book cover. Minimum 400px wide. JPG or PNG.",
      "required": 0
    },
    {
      "key": "field_book_blurb",
      "label": "Blurb",
      "name": "book_blurb",
      "type": "textarea",
      "rows": 4,
      "instructions": "2–3 sentence description of the book.",
      "required": 1,
      "allow_in_bindings": true
    },
    {
      "key": "field_book_isbn",
      "label": "ISBN",
      "name": "book_isbn",
      "type": "text",
      "instructions": "13-digit ISBN. Leave blank until confirmed.",
      "required": 0,
      "allow_in_bindings": true
    },
    {
      "key": "field_book_series_position",
      "label": "Series Position",
      "name": "book_series_position",
      "type": "number",
      "min": 1,
      "instructions": "Order within the series. Book One = 1, Book Two = 2, etc.",
      "required": 1,
      "allow_in_bindings": true
    },
    {
      "key": "field_book_publication_date",
      "label": "Publication Date",
      "name": "book_publication_date",
      "type": "date_picker",
      "display_format": "d/m/Y",
      "return_format": "Y-m-d",
      "instructions": "Leave blank if not yet confirmed.",
      "required": 0
    },
    {
      "key": "field_buy_link_primary",
      "label": "Buy Link — Direct (Payhip)",
      "name": "buy_link_primary",
      "type": "url",
      "instructions": "dennisdraytonbooks.com/b/[code] — the Payhip direct purchase link.",
      "required": 0,
      "allow_in_bindings": true
    },
    {
      "key": "field_buy_link_universal",
      "label": "Buy Link — Universal (Books2Read)",
      "name": "buy_link_universal",
      "type": "url",
      "instructions": "books2read.com/u/[code] — routes to all retailers.",
      "required": 0,
      "allow_in_bindings": true
    },
    {
      "key": "field_buy_link_amazon",
      "label": "Buy Link — Amazon",
      "name": "buy_link_amazon",
      "type": "url",
      "instructions": "Full Amazon product URL.",
      "required": 0,
      "allow_in_bindings": true
    }
  ],
  "location": [
    [
      {
        "param": "post_type",
        "operator": "==",
        "value": "book"
      }
    ]
  ],
  "menu_order": 0,
  "position": "normal",
  "style": "default",
  "label_placement": "top",
  "instruction_placement": "label",
  "active": true
}
```

---

## FILE 6 — `themes/twentytwentyfour-dalenii/parts/header.html`

Global site header. Uses the woodland photograph already uploaded to the media library at:
`https://daleniidigital.com/wp-content/uploads/2016/07/cropped-Depositphotos_2592435_m-2015-2.jpg`

Replace `WOODLAND_IMAGE_ID` with the actual WordPress media library attachment ID after import.

```html
<!-- wp:group {"tagName":"header","style":{"color":{"background":"#1C1814"}},"layout":{"type":"constrained"}} -->
<header class="wp-block-group" style="background-color:#1C1814">

  <!-- wp:cover {"url":"https://daleniidigital.com/wp-content/uploads/2016/07/cropped-Depositphotos_2592435_m-2015-2.jpg","dimRatio":30,"minHeight":280,"minHeightUnit":"px","contentPosition":"center center","align":"full"} -->
  <div class="wp-block-cover alignfull" style="min-height:280px">
    <span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 wp-block-cover__gradient-background"></span>
    <div class="wp-block-cover__inner-container">

      <!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group" style="padding-top:2rem;padding-bottom:2rem">

        <!-- wp:site-title {"level":1,"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--inter)","fontWeight":"700","letterSpacing":"0.04em","textTransform":"none"},"color":{"text":"#FAF8F4"}}} /-->

        <!-- wp:site-tagline {"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--inter)","fontStyle":"italic","fontSize":"0.95rem"},"color":{"text":"#C4B49A"}}} /-->

      </div>
      <!-- /wp:group -->

    </div>
  </div>
  <!-- /wp:cover -->

</header>
<!-- /wp:group -->
```

---

## FILE 7 — `themes/twentytwentyfour-dalenii/parts/navigation.html`

Six-item navigation with Series dropdown. The Navigation block references a saved navigation by name. After theme activation, build this navigation manually in Appearance → Editor → Navigation with the following structure:

```
Blog                          → /blog/
Series (parent)               → /series/
  ├── SOE Fiction Series      → /soe-fiction-series/
  ├── The Adversaries Series  → /adversaries-series/
  └── The Murray Books        → /murray-books/
Dennis Drayton                → /dennis-drayton/
Books                         → /books/
Christopher Nugent            → /christopher-nugent/
Even More                     → /even-more/
```

Placeholder block referencing the navigation by name (update `ref` with actual navigation post ID after creation):

```html
<!-- wp:group {"style":{"color":{"background":"#1C1814"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="background-color:#1C1814">

  <!-- wp:navigation {"ref":null,"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--inter)","fontSize":"0.72rem","fontWeight":"500","letterSpacing":"0.06em","textTransform":"uppercase"},"color":{"text":"#C4B49A","background":"#1C1814"}},"layout":{"type":"flex","justifyContent":"left","flexWrap":"nowrap"}} /-->

</div>
<!-- /wp:group -->
```

---

## FILE 8 — `themes/twentytwentyfour-dalenii/parts/footer.html`

```html
<!-- wp:group {"tagName":"footer","style":{"color":{"background":"#1A1612"},"spacing":{"padding":{"top":"3rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
<footer class="wp-block-group" style="background-color:#1A1612;padding-top:3rem;padding-bottom:2rem">

  <!-- wp:columns {"style":{"spacing":{"blockGap":"3rem"}}} -->
  <div class="wp-block-columns">

    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.62rem","letterSpacing":"0.12em","textTransform":"uppercase"},"color":{"text":"#6B5F52"}}} -->
      <h4 class="wp-block-heading" style="color:#6B5F52;font-size:0.62rem;letter-spacing:0.12em;text-transform:uppercase">Dennis Drayton</h4>
      <!-- /wp:heading -->
      <!-- wp:list {"style":{"typography":{"fontSize":"0.75rem"}}} -->
      <ul class="wp-block-list"><li><a href="/soe-fiction-series/" style="color:#C4B49A">SOE Fiction Series</a></li><li><a href="/dennis-drayton/" style="color:#C4B49A">Author page</a></li><li><a href="https://dennisdraytonbooks.com" style="color:#C4B49A">dennisdraytonbooks.com ↗</a></li></ul>
      <!-- /wp:list -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.62rem","letterSpacing":"0.12em","textTransform":"uppercase"},"color":{"text":"#6B5F52"}}} -->
      <h4 class="wp-block-heading" style="color:#6B5F52;font-size:0.62rem;letter-spacing:0.12em;text-transform:uppercase">The Blog</h4>
      <!-- /wp:heading -->
      <!-- wp:list {"style":{"typography":{"fontSize":"0.75rem"}}} -->
      <ul class="wp-block-list"><li><a href="/category/soe-series/" style="color:#C4B49A">SOE Series articles</a></li><li><a href="/category/writers-we-like/" style="color:#C4B49A">Writers We Like</a></li></ul>
      <!-- /wp:list -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"0.62rem","letterSpacing":"0.12em","textTransform":"uppercase"},"color":{"text":"#6B5F52"}}} -->
      <h4 class="wp-block-heading" style="color:#6B5F52;font-size:0.62rem;letter-spacing:0.12em;text-transform:uppercase">Christopher Nugent</h4>
      <!-- /wp:heading -->
      <!-- wp:list {"style":{"typography":{"fontSize":"0.75rem"}}} -->
      <ul class="wp-block-list"><li><a href="/christopher-nugent/" style="color:#C4B49A">Author page</a></li><li><a href="#" style="color:#C4B49A">Every Six Feet</a></li></ul>
      <!-- /wp:list -->
    </div>
    <!-- /wp:column -->

  </div>
  <!-- /wp:columns -->

  <!-- wp:separator {"style":{"color":{"background":"#2A2520"}}} -->
  <hr class="wp-block-separator" style="background-color:#2A2520;border-color:#2A2520"/>
  <!-- /wp:separator -->

  <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"}} -->
  <div class="wp-block-group">
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.65rem"},"color":{"text":"#3A342C"}}} -->
    <p style="color:#3A342C;font-size:0.65rem">© 2026 Dalenii Digital</p>
    <!-- /wp:paragraph -->
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.65rem"},"color":{"text":"#3A342C"}}} -->
    <p style="color:#3A342C;font-size:0.65rem">daleniidigital.com</p>
    <!-- /wp:paragraph -->
  </div>
  <!-- /wp:group -->

</footer>
<!-- /wp:group -->
```

---

## FILE 9 — `themes/twentytwentyfour-dalenii/templates/single-book-wwii.html`

SOE WWII series book template. Background `#3D3426`, text `#D9CDB4`, accent `#8B6F47`. Fonts: EB Garamond (body), Special Elite (labels/subheadings) — loaded conditionally by helper plugin.

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->
<!-- wp:template-part {"slug":"navigation"} /-->

<!-- wp:group {"style":{"color":{"background":"#3D3426","text":"#D9CDB4"},"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-text-color" style="background-color:#3D3426;color:#D9CDB4;padding-top:4rem;padding-bottom:4rem">

  <!-- wp:group {"style":{"spacing":{"blockGap":"2rem"}},"layout":{"type":"default"}} -->
  <div class="wp-block-group">

    <!-- wp:post-title {"level":1,"style":{"typography":{"fontFamily":"'EB Garamond', Georgia, serif","fontWeight":"700","fontStyle":"italic","fontSize":"3rem"},"color":{"text":"#D9CDB4"},"spacing":{"margin":{"bottom":"1.5rem"}}}} /-->

    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"},"style":{"spacing":{"blockGap":"3rem"}}} -->
    <div class="wp-block-group">

      <!-- wp:post-featured-image {"width":"180px","height":"270px","style":{"border":{"color":"#4A3E2A","width":"1px"}}} /-->

      <!-- wp:group {"layout":{"type":"default"}} -->
      <div class="wp-block-group">

        <!-- wp:paragraph {"style":{"typography":{"fontFamily":"'Special Elite', monospace","fontSize":"0.62rem","letterSpacing":"0.18em","textTransform":"uppercase"},"color":{"text":"#8B6F47"}}} -->
        <p style="font-family:'Special Elite',monospace;font-size:0.62rem;letter-spacing:0.18em;text-transform:uppercase;color:#8B6F47">SOE Fiction Series</p>
        <!-- /wp:paragraph -->

        <!-- wp:post-excerpt {"style":{"typography":{"fontFamily":"'EB Garamond', Georgia, serif","fontStyle":"italic","fontSize":"1.05rem","lineHeight":"1.8"},"color":{"text":"#D9CDB4"}}} /-->

        <!-- wp:buttons {"style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
        <div class="wp-block-buttons">

          <!-- wp:button {"metadata":{"bindings":{"url":{"source":"core/post-meta","args":{"key":"buy_link_primary"}}}},"style":{"color":{"background":"#8B6F47","text":"#D9CDB4"},"typography":{"fontSize":"0.65rem","fontWeight":"500","letterSpacing":"0.06em","textTransform":"uppercase"},"border":{"radius":"0px"}}} -->
          <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" style="background-color:#8B6F47;color:#D9CDB4;border-radius:0px">Buy Direct ↗</a></div>
          <!-- /wp:button -->

          <!-- wp:button {"metadata":{"bindings":{"url":{"source":"core/post-meta","args":{"key":"buy_link_universal"}}}},"style":{"color":{"background":"transparent","text":"#8B6F47"},"typography":{"fontSize":"0.65rem","fontWeight":"500","letterSpacing":"0.06em","textTransform":"uppercase"},"border":{"radius":"0px","color":"#8B6F47","width":"1px"}},"className":"is-style-outline"} -->
          <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" style="color:#8B6F47;border-radius:0px;border:1px solid #8B6F47">All retailers ↗</a></div>
          <!-- /wp:button -->

        </div>
        <!-- /wp:buttons -->

      </div>
      <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:separator {"style":{"color":{"background":"#4A3E2A"}}} -->
    <hr class="wp-block-separator" style="background-color:#4A3E2A;border-color:#4A3E2A"/>
    <!-- /wp:separator -->

    <!-- wp:post-content {"style":{"typography":{"fontFamily":"'EB Garamond', Georgia, serif","fontSize":"1.05rem","lineHeight":"1.85"},"color":{"text":"#D9CDB4"}}} /-->

    <!-- wp:paragraph {"style":{"typography":{"fontFamily":"'Special Elite', monospace","fontSize":"0.62rem","letterSpacing":"0.12em","textTransform":"uppercase"},"color":{"text":"#6B5F52"}}} -->
    <p style="font-family:'Special Elite',monospace;font-size:0.62rem;letter-spacing:0.12em;text-transform:uppercase;color:#6B5F52"><a href="/soe-fiction-series/" style="color:#8B6F47;text-decoration:none;">← Back to SOE Fiction Series</a></p>
    <!-- /wp:paragraph -->

  </div>
  <!-- /wp:group -->

</div>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

---

## FILE 10 — `themes/twentytwentyfour-dalenii/templates/single-book-crime.html`

Adversaries Series book template. Background `#1E2830`, text `#D8E4EC`, body `#5A7080`, accent `#C8374A`. Font: Special Elite (labels) loaded conditionally.

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->
<!-- wp:template-part {"slug":"navigation"} /-->

<!-- wp:group {"style":{"color":{"background":"#1E2830","text":"#D8E4EC"},"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-text-color" style="background-color:#1E2830;color:#D8E4EC;padding-top:4rem;padding-bottom:4rem">

  <!-- wp:group {"layout":{"type":"default"},"style":{"spacing":{"blockGap":"2rem"}}} -->
  <div class="wp-block-group">

    <!-- wp:post-title {"level":1,"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--inter)","fontWeight":"700","fontSize":"3rem","letterSpacing":"-0.01em","textTransform":"uppercase"},"color":{"text":"#D8E4EC"}}} /-->

    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"},"style":{"spacing":{"blockGap":"3rem"}}} -->
    <div class="wp-block-group">

      <!-- wp:post-featured-image {"width":"180px","height":"270px","style":{"border":{"color":"#2A3840","width":"1px"}}} /-->

      <!-- wp:group {"layout":{"type":"default"}} -->
      <div class="wp-block-group">

        <!-- wp:paragraph {"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--inter)","fontSize":"0.62rem","fontWeight":"600","letterSpacing":"0.18em","textTransform":"uppercase"},"color":{"text":"#C8374A"}}} -->
        <p style="font-family:var(--wp--preset--font-family--inter);font-size:0.62rem;font-weight:600;letter-spacing:0.18em;text-transform:uppercase;color:#C8374A">The Adversaries Series</p>
        <!-- /wp:paragraph -->

        <!-- wp:post-excerpt {"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--inter)","fontSize":"1rem","lineHeight":"1.75"},"color":{"text":"#5A7080"}}} /-->

        <!-- wp:buttons {"style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
        <div class="wp-block-buttons">

          <!-- wp:button {"metadata":{"bindings":{"url":{"source":"core/post-meta","args":{"key":"buy_link_primary"}}}},"style":{"color":{"background":"#C8374A","text":"#F0F4F8"},"typography":{"fontSize":"0.65rem","fontWeight":"600","letterSpacing":"0.08em","textTransform":"uppercase"},"border":{"radius":"0px"}}} -->
          <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" style="background-color:#C8374A;color:#F0F4F8;border-radius:0px">Buy now ↗</a></div>
          <!-- /wp:button -->

          <!-- wp:button {"metadata":{"bindings":{"url":{"source":"core/post-meta","args":{"key":"buy_link_universal"}}}},"style":{"color":{"background":"transparent","text":"#8899AA"},"typography":{"fontSize":"0.65rem","fontWeight":"500","letterSpacing":"0.06em","textTransform":"uppercase"},"border":{"radius":"0px","color":"#2A3840","width":"1px"}},"className":"is-style-outline"} -->
          <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" style="color:#8899AA;border-radius:0px;border:1px solid #2A3840">All retailers ↗</a></div>
          <!-- /wp:button -->

        </div>
        <!-- /wp:buttons -->

      </div>
      <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:separator {"style":{"color":{"background":"#2A3840"}}} -->
    <hr class="wp-block-separator" style="background-color:#2A3840;border-color:#2A3840"/>
    <!-- /wp:separator -->

    <!-- wp:post-content {"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--inter)","fontSize":"1rem","lineHeight":"1.75"},"color":{"text":"#5A7080"}}} /-->

    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.62rem","fontWeight":"500","letterSpacing":"0.1em","textTransform":"uppercase"}}} -->
    <p style="font-size:0.62rem;font-weight:500;letter-spacing:0.1em;text-transform:uppercase"><a href="/adversaries-series/" style="color:#8899AA;text-decoration:none;">← Back to The Adversaries Series</a></p>
    <!-- /wp:paragraph -->

  </div>
  <!-- /wp:group -->

</div>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

---

## FILE 11 — `themes/twentytwentyfour-dalenii/templates/single-book-spy.html`

Murray Books spy series template. Background `#1A2535`, text `#C8D8E8`, body `#3A5A7A`, accent `#5B8DB8`. Fonts: Zilla Slab (headings) + EB Garamond (body) loaded conditionally.

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->
<!-- wp:template-part {"slug":"navigation"} /-->

<!-- wp:group {"style":{"color":{"background":"#1A2535","text":"#C8D8E8"},"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-text-color" style="background-color:#1A2535;color:#C8D8E8;padding-top:4rem;padding-bottom:4rem">

  <!-- wp:group {"layout":{"type":"default"},"style":{"spacing":{"blockGap":"2rem"}}} -->
  <div class="wp-block-group">

    <!-- wp:post-title {"level":1,"style":{"typography":{"fontFamily":"'Zilla Slab', Georgia, serif","fontWeight":"700","fontSize":"3rem","lineHeight":"1"},"color":{"text":"#C8D8E8"}}} /-->

    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"},"style":{"spacing":{"blockGap":"3rem"}}} -->
    <div class="wp-block-group">

      <!-- wp:post-featured-image {"width":"180px","height":"270px","style":{"border":{"color":"#2A3A4A","width":"1px"}}} /-->

      <!-- wp:group {"layout":{"type":"default"}} -->
      <div class="wp-block-group">

        <!-- wp:paragraph {"style":{"typography":{"fontFamily":"var(--wp--preset--font-family--inter)","fontSize":"0.62rem","fontWeight":"600","letterSpacing":"0.2em","textTransform":"uppercase"},"color":{"text":"#5B8DB8"}}} -->
        <p style="font-family:var(--wp--preset--font-family--inter);font-size:0.62rem;font-weight:600;letter-spacing:0.2em;text-transform:uppercase;color:#5B8DB8">The Murray Books</p>
        <!-- /wp:paragraph -->

        <!-- wp:post-excerpt {"style":{"typography":{"fontFamily":"'EB Garamond', Georgia, serif","fontStyle":"italic","fontSize":"1.05rem","lineHeight":"1.8"},"color":{"text":"#7AAFD4"}}} /-->

        <!-- wp:buttons {"style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
        <div class="wp-block-buttons">

          <!-- wp:button {"metadata":{"bindings":{"url":{"source":"core/post-meta","args":{"key":"buy_link_primary"}}}},"style":{"color":{"background":"#4A7FA5","text":"#F0F8FF"},"typography":{"fontSize":"0.65rem","fontWeight":"600","letterSpacing":"0.1em","textTransform":"uppercase"},"border":{"radius":"0px"}}} -->
          <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" style="background-color:#4A7FA5;color:#F0F8FF;border-radius:0px">Buy now ↗</a></div>
          <!-- /wp:button -->

          <!-- wp:button {"metadata":{"bindings":{"url":{"source":"core/post-meta","args":{"key":"buy_link_universal"}}}},"style":{"color":{"background":"transparent","text":"#5B8DB8"},"typography":{"fontSize":"0.65rem","fontWeight":"500","letterSpacing":"0.06em","textTransform":"uppercase"},"border":{"radius":"0px","color":"#2A3A4A","width":"1px"}},"className":"is-style-outline"} -->
          <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" style="color:#5B8DB8;border-radius:0px;border:1px solid #2A3A4A">All retailers ↗</a></div>
          <!-- /wp:button -->

        </div>
        <!-- /wp:buttons -->

      </div>
      <!-- /wp:group -->

    </div>
    <!-- /wp:group -->

    <!-- wp:separator {"style":{"color":{"background":"#2A3A4A"}}} -->
    <hr class="wp-block-separator" style="background-color:#2A3A4A;border-color:#2A3A4A"/>
    <!-- /wp:separator -->

    <!-- wp:post-content {"style":{"typography":{"fontFamily":"'EB Garamond', Georgia, serif","fontSize":"1.05rem","lineHeight":"1.85"},"color":{"text":"#B8D4E8"}}} /-->

    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.62rem","fontWeight":"500","letterSpacing":"0.1em","textTransform":"uppercase"}}} -->
    <p style="font-size:0.62rem;font-weight:500;letter-spacing:0.1em;text-transform:uppercase"><a href="/murray-books/" style="color:#3A5A7A;text-decoration:none;">← Back to The Murray Books</a></p>
    <!-- /wp:paragraph -->

  </div>
  <!-- /wp:group -->

</div>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

---

## FILE 12 — `themes/twentytwentyfour-dalenii/templates/archive-book.html`

Book archive — lists all books across all series. Standard light background.

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->
<!-- wp:template-part {"slug":"navigation"} /-->

<!-- wp:group {"style":{"color":{"background":"#1C1814"},"spacing":{"padding":{"top":"3rem","bottom":"2.5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="background-color:#1C1814;padding-top:3rem;padding-bottom:2.5rem">
  <!-- wp:query-title {"type":"archive","style":{"typography":{"fontSize":"2.2rem","fontWeight":"700"},"color":{"text":"#F4F0E8"}}} /-->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:3rem;padding-bottom:4rem">

  <!-- wp:query {"query":{"postType":"book","perPage":20,"orderBy":"meta_value_num","order":"ASC","metaKey":"book_series_position"},"layout":{"type":"default"}} -->
  <div class="wp-block-query">

    <!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->

      <!-- wp:group {"style":{"border":{"color":"#DDD4C0","width":"1px"},"spacing":{"padding":{"top":"1.5rem","right":"1.5rem","bottom":"1.5rem","left":"1.5rem"}}},"layout":{"type":"default"}} -->
      <div class="wp-block-group" style="border:1px solid #DDD4C0;padding:1.5rem">
        <!-- wp:post-featured-image {"isLink":true,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
        <!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontSize":"1.1rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"0.5rem"}}}} /-->
        <!-- wp:post-excerpt {"moreText":"","style":{"typography":{"fontSize":"0.875rem"},"color":{"text":"#6B5F52"}}} /-->
      </div>
      <!-- /wp:group -->

    <!-- /wp:post-template -->

    <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
      <!-- wp:query-pagination-previous /-->
      <!-- wp:query-pagination-numbers /-->
      <!-- wp:query-pagination-next /-->
    <!-- /wp:query-pagination -->

    <!-- wp:query-no-results -->
      <!-- wp:paragraph -->
      <p>No books found.</p>
      <!-- /wp:paragraph -->
    <!-- /wp:query-no-results -->

  </div>
  <!-- /wp:query -->

</div>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

---

## POST-INSTALLATION MANUAL STEPS

These cannot be automated and must be completed in WordPress Studio after activating the theme and plugin:

### Step 1 — Flush rewrite rules
Go to Settings → Permalinks → click Save Changes (no changes needed — just saving flushes the rules and registers the `/book/` CPT URLs).

### Step 2 — Create book_series taxonomy terms
Go to Books → Series → Add New. Create three terms:
- Name: `SOE WWII` | Slug: `soe-wwii`
- Name: `Adversaries Crime` | Slug: `adversaries-crime`
- Name: `Murray Spy` | Slug: `murray-spy`

### Step 3 — Verify ACF field group import
Go to Custom Fields → Field Groups. Confirm `Book Details` appears. If not: go to Custom Fields → Tools → Import and upload `group_dalenii_books.json` manually.

### Step 4 — Build the Navigation block
Go to Appearance → Editor → Navigation. Build the six-item structure with Series dropdown as specified in File 7. Update the `ref` value in `navigation.html` with the navigation post ID shown in the URL.

### Step 5 — Install Meta Field Block plugin
Plugins → Add New → search "Meta Field Block" → Install → Activate. This enables cover image and buy link array rendering inside the book templates.

### Step 6 — Add books and assign templates
For each book: Books → Add New → fill ACF fields → select `book_series` term → select template from Page Attributes dropdown → Publish.

---

## DEPLOYMENT TO LIVE SITE (BLACKNIGHT CPANEL)

1. In WordPress Studio: export the theme folder as a ZIP
2. Export the plugin folder as a separate ZIP
3. Log into Blacknight cPanel → File Manager → navigate to `public_html/wp-content/themes/` → upload and extract `twentytwentyfour-dalenii.zip`
4. Navigate to `public_html/wp-content/plugins/` → upload and extract `dalenii-core-helper.zip`
5. In live WordPress admin: Appearance → Themes → activate `Dalenii Digital`
6. Plugins → activate `Dalenii Core Helper`
7. Repeat Post-Installation Manual Steps on the live site
8. Settings → Permalinks → Save Changes (flush rewrites)
9. Verify `/book/lazarus-bridge/` and existing URLs `/soe-fiction-series/` and `/blog/` all resolve correctly

---

*Specification complete — May 2026*
*All decision gates closed. Ready for Claude Code execution.*
