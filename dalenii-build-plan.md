# Dalenii Digital — Build Alignment Plan
## Compiled from live site comparison · June 2026 · **UPDATED: All Phase 1 & 2 complete**

Source of truth for the live design: `C:\My Web Sites\dalenii-digital\daleniidigital.com\wp-content\themes\dalenii-child\styleedfb.css` (v1.3.8)

---

## STATUS SUMMARY (updated end of session)

| File | Status |
|------|--------|
| `theme.json` | ✅ COMPLETE |
| `parts/header.html` | ✅ COMPLETE |
| `parts/navigation.html` | ✅ COMPLETE — resilient flex parameters added, hardcoded refs purged |
| `acf-json/group_dalenii_books.json` | ✅ COMPLETE |
| `plugins/dalenii-core-helper/dalenii-core-helper.php` | ✅ COMPLETE — strict `.html` evaluation enforced |
| `templates/single-book-wwii.html` | ✅ COMPLETE — rewritten 70/30, trailing duplication purged |
| `templates/single-book-crime.html` | ✅ COMPLETE — rewritten 70/30, trailing duplication purged |
| `templates/single-book-spy.html` | ✅ COMPLETE — rewritten 70/30, trailing duplication purged |
| `templates/single-book-default.html` | ✅ COMPLETE — new file created |
| `templates/page-adversaries.html` | ✅ COMPLETE — new file created |
| `templates/page-series.html` | ✅ COMPLETE — new file created |

### Remaining manual tasks (WordPress Studio / Editor)
- **page-adversaries query filter**: After creating the `adversaries-crime` book_series term in WordPress, open the Adversaries landing page in the Editor and configure the Query block's taxonomy filter to show only that term's books.
- **Assign templates to pages**: In the Editor, assign `page-adversaries` to the Adversaries landing page and `page-series` to the Series Hub page.
- **Assign single-book-default to Low Season**: Edit the Low Season book post, open the template selector, and choose "Book — Default".

---

## RESOLVED DECISIONS

| Question | Decision |
|----------|----------|
| `book_blurb` ACF field | **REMOVED** — use native WordPress excerpt |
| `book_cover_image` ACF field | **REMOVED** — use native Featured Image |
| Low Season standalone book | **single-book-default.html created** |
| Header branded box (border) | **KEPT** — confirmed in spec as "Brand Box" |
| Meta Field Block plugin | **DEPRECATED** — core Block Bindings API only |
| 70/30 column layout | **CONFIRMED** — applied to all single-book templates |
| Crime template fonts | **Barlow Condensed + Barlow + EB Garamond** (not Special Elite) |

---


    {
      "src": "https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap",
      "fontWeight": "400 600",
      "fontStyle": "normal"
    }
  ]
}
```
2. Change `styles.typography.fontFamily` from:
```json
"fontFamily": "var(--wp--preset--font-family--inter)"
```
to:
```json
"fontFamily": "var(--wp--preset--font-family--eb-garamond)"
```
3. Change `styles.typography.lineHeight` from `"1.75"` to `"1.85"` (matches live site `line-height: 1.85` on `.entry-content p`).

---

### P1-B · Register and apply the heading font (Playfair Display)
**Problem:** Playfair Display is not registered anywhere in the new theme. Headings inherit the body font (currently Inter, soon to be EB Garamond after P1-A). The live site uses Playfair Display for all h1–h3. Without it, the editorial character of every page is wrong.
**File:** `wp-content/themes/twentytwentyfour-dalenii/theme.json`

Changes needed:
1. In `settings.typography.fontFamilies`, add Playfair Display:
```json
{
  "fontFamily": "'Playfair Display', Georgia, serif",
  "slug": "playfair-display",
  "name": "Playfair Display",
  "fontFace": [
    {
      "src": "https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&display=swap",
      "fontWeight": "700 900",
      "fontStyle": "normal"
    }
  ]
}
```
2. In `styles.elements`, update the heading entries to include the font family:
```json
"h1": { "typography": { "fontFamily": "var(--wp--preset--font-family--playfair-display)", "fontSize": "var(--wp--preset--font-size--xx-large)", "fontWeight": "700", "lineHeight": "1.1" } },
"h2": { "typography": { "fontFamily": "var(--wp--preset--font-family--playfair-display)", "fontSize": "var(--wp--preset--font-size--x-large)",  "fontWeight": "700", "lineHeight": "1.2" } },
"h3": { "typography": { "fontFamily": "var(--wp--preset--font-family--playfair-display)", "fontSize": "var(--wp--preset--font-size--large)",    "fontWeight": "700", "lineHeight": "1.3" } }
```

---

### P1-C · Register Barlow Condensed and Barlow
**Problem:** The Adversaries Series page, the Series Hub page, and Adversaries book templates use Barlow Condensed as their primary display font. It is not registered anywhere in the new theme and is not loaded by the plugin. It will fall through to Arial Narrow or Impact on any machine.
**File:** `wp-content/themes/twentytwentyfour-dalenii/theme.json`

Add to `settings.typography.fontFamilies`:
```json
{
  "fontFamily": "'Barlow Condensed', 'Arial Narrow', sans-serif",
  "slug": "barlow-condensed",
  "name": "Barlow Condensed",
  "fontFace": [
    {
      "src": "https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&display=swap",
      "fontWeight": "400 900",
      "fontStyle": "normal"
    }
  ]
},
{
  "fontFamily": "'Barlow', system-ui, sans-serif",
  "slug": "barlow",
  "name": "Barlow",
  "fontFace": [
    {
      "src": "https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&display=swap",
      "fontWeight": "400 600",
      "fontStyle": "normal"
    }
  ]
}
```

---

### P1-D · Fix the Adversaries colour palette
**Problem:** The live Adversaries Series uses near-black (`#0D0D0F`) as its background — a dark noir aesthetic. The spec and theme.json use `#1E2830` (a blue-grey), which is a completely different mood.

**File:** `wp-content/themes/twentytwentyfour-dalenii/theme.json`

Change the Adversaries palette entries. Current vs correct:

| Slug | Current (wrong) | Should be |
|---|---|---|
| `adv-bg` | `#1E2830` | `#0D0D0F` |
| `adv-text` | `#D8E4EC` | `#F0F0F8` |
| `adv-body` | `#5A7080` | `#8888A0` |
| `adv-muted` | `#8899AA` | `#52525E` |
| `adv-border` | `#2A3840` | `#2E2E3A` |

Also add these missing palette entries from the live CSS:
```json
{ "slug": "adv-dark",    "color": "#141418", "name": "Adversaries Dark" },
{ "slug": "adv-surface", "color": "#252530", "name": "Adversaries Surface" },
{ "slug": "adv-red-hot", "color": "#E04558", "name": "Adversaries Red Hot" }
```

---

### P1-E · Fix `single-book-crime.html` to match the Adversaries visual identity
**Problem:** The template uses wrong background colour and Inter for the title instead of Barlow Condensed.
**File:** `wp-content/themes/twentytwentyfour-dalenii/templates/single-book-crime.html`

Changes needed:
1. Change outer group `background-color:#1E2830` → `#0D0D0F`
2. Change outer group `color:#D8E4EC` → `#F0F0F8`
3. Change `wp:post-title` fontFamily from `var(--wp--preset--font-family--inter)` to `'Barlow Condensed', 'Arial Narrow', sans-serif`
4. Change `wp:post-title` `fontWeight:"700"` → `"900"` and add `"textTransform":"uppercase"`, `"letterSpacing":"-0.01em"`
5. Change `wp:post-title` `color:#D8E4EC` → `#F0F0F8`
6. Change `wp:post-excerpt` color from `#5A7080` → `#8888A0`
7. Change the series label paragraph `color:#C8374A` stays correct ✓
8. Change separator `background-color:#2A3840` → `#2E2E3A`
9. Change `wp:post-content` color from `#5A7080` → `#8888A0`
10. Change "back" link color from `#8899AA` → `#52525E`

---

### P1-F · Fix the Adversaries font enqueue in the plugin
**Problem:** The plugin loads only Special Elite for `single-book-crime`. The live Adversaries design uses Barlow Condensed + Barlow as its primary fonts. Special Elite is an SOE font only.
**File:** `wp-content/plugins/dalenii-core-helper/dalenii-core-helper.php`

Change the `single-book-crime` enqueue block from:
```php
if ($template === 'single-book-crime') {
    wp_enqueue_style(
        'dalenii-fonts-crime',
        'https://fonts.googleapis.com/css2?family=Special+Elite&display=swap',
        array(),
        null
    );
}
```
To:
```php
if ($template === 'single-book-crime') {
    wp_enqueue_style(
        'dalenii-fonts-crime',
        'https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Barlow:wght@400;500;600&family=EB+Garamond:ital,wght@0,400;0,600;1,400&display=swap',
        array(),
        null
    );
}
```

---

### P1-G · Fix `parts/header.html` — remove the bordered box
**Problem:** The live site header has the site title and tagline overlaid directly on the woodland photograph as plain text. The current `header.html` wraps them in a bordered white-outlined box (`border: 1px solid #FAF8F4`) that does not exist in the live design. The `dimRatio` is `0` (no darkening) but should be `30`.
**File:** `wp-content/themes/twentytwentyfour-dalenii/parts/header.html`

Replace the entire file with a clean header matching the live site's direct-overlay approach, using the spec's correct `dimRatio:30` and `minHeight:280px`, and Inter font for the title (the live site's actual font on the title):

```html
<!-- wp:group {"tagName":"header","align":"full","style":{"color":{"background":"#1C1814"},"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"layout":{"type":"constrained"}} -->
<header class="wp-block-group alignfull" style="background-color:#1C1814;padding:0">

  <!-- wp:cover {"url":"/wp-content/themes/twentytwentyfour-dalenii/assets/images/woodland.jpg","dimRatio":30,"minHeight":280,"minHeightUnit":"px","contentPosition":"center center","align":"full"} -->
  <div class="wp-block-cover alignfull" style="min-height:280px">
    <span aria-hidden="true" class="wp-block-cover__background has-background-dim-30"></span>
    <img class="wp-block-cover__image-background" alt="" src="/wp-content/themes/twentytwentyfour-dalenii/assets/images/woodland.jpg" data-object-fit="cover" />
    <div class="wp-block-cover__inner-container">

      <!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem"}}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group" style="padding-top:2rem;padding-bottom:2rem">

        <!-- wp:site-title {"level":1,"style":{"typography":{"fontFamily":"'Playfair Display', Georgia, serif","fontWeight":"700","letterSpacing":"0.04em","textTransform":"none"},"color":{"text":"#FAF8F4"}}} /-->

        <!-- wp:site-tagline {"style":{"typography":{"fontFamily":"'EB Garamond', Georgia, serif","fontStyle":"italic","fontSize":"0.95rem"},"color":{"text":"rgba(255,255,255,0.7)"}}} /-->

      </div>
      <!-- /wp:group -->

    </div>
  </div>
  <!-- /wp:cover -->

</header>
<!-- /wp:group -->
```

Note: The site title uses Playfair Display (matching the live site exactly). The tagline uses EB Garamond italic at 70% white opacity (matching the live CSS `rgba(255,255,255,0.7)`).

---

---

# PRIORITY 2 — Fix before deployment
## (Design missing or functionally broken)

---

### P2-A · Rebuild the Adversaries Series landing page as an FSE template
**Problem:** The live `/adversaries-series/` page uses bespoke CSS classes (`adv-hero`, `adv-page-wrap`, `adv-book-entry` grid, etc.) defined in the old child theme. After the theme switch these classes will have no CSS. The page will render as unstyled text.

**Approach:** Create a custom FSE page template that approximates the live design using Gutenberg blocks and the theme palette.

**[NEW]** Create `wp-content/themes/twentytwentyfour-dalenii/templates/page-adversaries.html`

This template needs to reproduce:
- Dark `#0D0D0F` full-width hero with large Barlow Condensed heading ("The Adversaries Series"), eyebrow label, description, and stats
- A ghost watermark text effect (can be approximated with a large muted heading)
- A book list section: each entry shows book number, cover (if available), title, status badge, blurb, and buy button
- A footer strip with back link

Register the template in `theme.json` `customTemplates`:
```json
{ "name": "page-adversaries", "title": "Page — Adversaries Series", "postTypes": ["page"] }
```

Then in WordPress Studio: assign this template to the Adversaries Series page.

**Effort:** Medium. This is a significant Gutenberg block construction task. The grid layout (`grid-template-columns: 80px 100px 1fr auto`) will need to be approximated using Columns blocks.

---

### P2-B · Rebuild the Series Hub page as an FSE template
**Problem:** The live `/series/` page uses `.page-series-hub` CSS classes (full-width dark `#111114` background, Barlow Condensed hero, 2-column series card grid with hover effects). These will be unstyled after the switch.

**Approach:** Create a custom FSE page template.

**[NEW]** Create `wp-content/themes/twentytwentyfour-dalenii/templates/page-series.html`

This template needs:
- Full-width dark `#111114` background (add `series-bg: #111114` to theme.json palette)
- Barlow Condensed display heading, amber eyebrow label
- 2-column grid of series cards (use Gutenberg Columns block, 2-column)
- Each card links to the respective series page with number, title, description, and meta

Register in `theme.json` `customTemplates`:
```json
{ "name": "page-series", "title": "Page — Series Hub", "postTypes": ["page"] }
```

**Effort:** Medium.

---

### P2-C · Resolve the `book_blurb` field conflict
**Problem:** Templates use `wp:post-excerpt` for the blurb display. The ACF `book_blurb` field is wired to nothing and will confuse the user (two places to enter blurb text, only one shows up).

**[DECIDE]** Choose one of:

**Option A — Use WordPress Excerpt (remove ACF field)**
- Delete `book_blurb` from `acf-json/group_dalenii_books.json`
- Keep `wp:post-excerpt` in all templates as-is
- Tell the user: enter the book blurb in the native Excerpt field on the post edit screen
- Simpler, no extra plugin needed

**Option B — Use ACF field (replace `wp:post-excerpt`)**
- Keep the ACF `book_blurb` field
- In each template, replace `<!-- wp:post-excerpt ... /-->` with a `<!-- wp:mf/field {"fieldName":"book_blurb"} /-->` Meta Field Block
- Requires the "Display a Meta Field as Block" plugin already installed ✓
- More structured — the blurb lives alongside other book data in ACF

Recommendation: **Option A** is simpler and less fragile. The native excerpt serves the same purpose.

---

### P2-D · Remove the redundant `book_cover_image` ACF field
**Problem:** Templates use `wp:post-featured-image` for the book cover. ACF `book_cover_image` stores a separate image ID that is never displayed. Users will set the Featured Image and also (confusingly) see an unused Cover Image field in ACF.
**File:** `wp-content/themes/twentytwentyfour-dalenii/acf-json/group_dalenii_books.json`

Delete the entire `book_cover_image` field object (the first entry in the `fields` array) from the JSON. The Featured Image is sufficient.

---

### P2-E · Decide what to do with Low Season
**Problem:** Low Season is a published book with buy links on the live site. It has no series (it's standalone crime fiction, not part of Adversaries). It does not fit any of the three series templates.

**[DECIDE]** Choose one of:

**Option A — Assign it to Adversaries Crime template as a standalone**
- Create it as a `book` CPT post
- Assign the `single-book-crime` template
- Leave the `book_series` taxonomy unset (or create a standalone "Standalone" term)
- The series label paragraph ("The Adversaries Series") will show the wrong text → needs a fix or omission

**Option B — Create a generic `single-book-default.html` template**
- A neutral book template using the site's base cream/ink palette
- Used for books that don't belong to a named series
- Register it in theme.json

**Option C — Keep Low Season as a regular page**
- Don't migrate it to the CPT
- It stays at its current URL with its current content
- Least work

Recommendation: **Option C** for now — it already exists as a page with buy links. Migrate to CPT in a second pass after the other series books are done.

---

### P2-F · Add `soe-series` blog category page styling
**Problem:** The live `/category/soe-series/` archive uses body class `.category-soe-series` to apply SOE-specific styles: dark `#3D3426` outer wrappers, warm paper card treatment on posts, sepia-filter on featured images, Special Elite for metadata.

The new theme has no `category/` archive template. TwentyTwentyFour will render category archives with its default template. There is no equivalent in the new theme.

**[NEW]** Create `wp-content/themes/twentytwentyfour-dalenii/templates/taxonomy-book_series-soe-wwii.html`

This gives the SOE book_series taxonomy term its own styled archive template. However, the blog category (`/category/soe-series/`) is a different thing — it's a WordPress post category for articles, not a book series taxonomy term.

**Immediate action:** Create a `taxonomy-book_series.html` template for book series archives. For the blog category SOE articles — this is a blog category archive and the styling will need to be added separately. For now, it will fall back to TwentyTwentyFour's default category archive.

---

---

# PRIORITY 3 — Content migration and manual steps
## (Before go-live, can happen in parallel)

---

### P3-A · Create book series taxonomy terms
**[MANUAL]** In WordPress Studio → Books → Series → Add New:
- Name: `SOE WWII` | Slug: `soe-wwii`
- Name: `Adversaries Crime` | Slug: `adversaries-crime`
- Name: `Murray Spy` | Slug: `murray-spy`

---

### P3-B · Create book CPT posts and fill ACF fields

**[CONTENT]** For each book: Books → Add New → fill fields → assign series → select template → publish.

| Book | Template | Series Term | Buy Link Primary | Buy Link Universal | Notes |
|---|---|---|---|---|---|
| Lazarus Bridge | `single-book-wwii` | `soe-wwii` | — | — | No buy links yet |
| The Last Resistant | `single-book-wwii` | `soe-wwii` | — | — | No buy links yet |
| Edge of Endurance | `single-book-wwii` | `soe-wwii` | — | — | No buy links yet |
| The Adversary | `single-book-crime` | `adversaries-crime` | `https://dennisdraytonbooks.com/b/Jm7rK` | `https://books2read.com/u/49EPKd` | Cover image: `uploads/2017/05/Remnantsm-200x300.jpg` |
| Every Six Feet | TBD | TBD | — | — | Wait for P2-E decision |

Also fill in:
- `book_series_position` (1, 2, 3…) for each book within its series
- Featured Image for The Adversary (the existing cover art from media library)

---

### P3-C · Set book_series_position field for archive ordering
The archive template orders books by `meta_value_num` on `book_series_position`. Make sure every book has a number set. Without it they will appear in default date order.

---

### P3-D · Build the Navigation block in the Editor
**[MANUAL]** Per spec Post-Installation Step 4:
- Appearance → Editor → Navigation
- Build the 7-item structure: Blog / Series (dropdown) / Dennis Drayton / Books / Christopher Nugent / Even More
- *Note: Hardcoded IDs have been purged from `parts/navigation.html`. No file edits are required.*

---

### P3-E · Flush rewrite rules
**[MANUAL]** Settings → Permalinks → Save Changes after activating the theme and plugin. This registers the `/book/[slug]/` URL structure.

---

### P3-F · Assign custom templates to existing pages
**[MANUAL]** After P2-A and P2-B templates are created:
- Edit the Adversaries Series page → Page Attributes → Template → `Page — Adversaries Series`
- Edit the Series Hub page → Page Attributes → Template → `Page — Series Hub`

---

---

# APPENDIX: Full list of files to be changed

| File | Change | Priority |
|---|---|---|
| `themes/twentytwentyfour-dalenii/theme.json` | Add EB Garamond, Playfair Display, Barlow Condensed, Barlow fonts; fix global body font; fix Adversaries palette | P1-A/B/C/D |
| `themes/twentytwentyfour-dalenii/templates/single-book-crime.html` | Fix background colour, post-title font to Barlow Condensed | P1-E |
| `plugins/dalenii-core-helper/dalenii-core-helper.php` | Fix crime template font enqueue (Barlow Condensed + Barlow, not Special Elite) | P1-F |
| `themes/twentytwentyfour-dalenii/parts/header.html` | Remove bordered box, fix dimRatio to 30, use Playfair Display for title | P1-G |
| `themes/twentytwentyfour-dalenii/acf-json/group_dalenii_books.json` | Remove `book_cover_image` field; remove `book_blurb` field (if Option A chosen) | P2-C/D |
| `themes/twentytwentyfour-dalenii/templates/single-book-crime.html` | Also update excerpt/blurb block if Option B chosen | P2-C |
| `themes/twentytwentyfour-dalenii/templates/single-book-wwii.html` | Also update excerpt/blurb block if Option B chosen | P2-C |
| `themes/twentytwentyfour-dalenii/templates/single-book-spy.html` | Also update excerpt/blurb block if Option B chosen | P2-C |
| **NEW** `themes/twentytwentyfour-dalenii/templates/page-adversaries.html` | Full Adversaries landing page FSE template | P2-A |
| **NEW** `themes/twentytwentyfour-dalenii/templates/page-series.html` | Series Hub FSE template | P2-B |

---

*Plan compiled June 2026 · Based on live site snapshot + spec comparison*
