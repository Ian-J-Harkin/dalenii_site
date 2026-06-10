# Dalenii Digital — Deployment Instructions
## How to push the new theme to local and live environments · June 2026

This document covers two scenarios: 
1. **Local Testing:** Copying the source code to your local test site (`dalenii-test`).
2. **Live Deployment:** Pushing the finalized theme to the live production server.

The live site database and content are **never touched**. You are only copying theme and plugin files, then activating the theme.

---

## Step 1 — Copy the theme files

Copy the entire child theme folder from your source directory to the target environment's theme directory.

**Source (always local codebase):**
```
C:\Users\ijhar\Studio\dalenii\wp-content\themes\twentytwentyfour-dalenii\
```

**Local Testing Destination:**
```
C:\Users\ijhar\Studio\dalenii-test\wp-content\themes\twentytwentyfour-dalenii\
```

**Live Server Destination:**
```
/wp-content/themes/twentytwentyfour-dalenii/
```

*Note: Confirm the parent theme `twentytwentyfour` is present in both environments. If not, install it from Appearance → Themes first.*

---

## Step 2 — Copy the plugin files

**Source (always local codebase):**
```
C:\Users\ijhar\Studio\dalenii\wp-content\plugins\dalenii-core-helper\
```

**Local Testing Destination:**
```
C:\Users\ijhar\Studio\dalenii-test\wp-content\plugins\dalenii-core-helper\
```

**Live Server Destination:**
```
/wp-content/plugins/dalenii-core-helper/
```

---

## Step 3 — Activate the theme and plugin

Log into the WordPress admin of the target environment (Local or Live):
1. **Plugins → Installed Plugins** → activate **Dalenii Core Helper**
2. **Appearance → Themes** → activate **Dalenii Digital**

> ⚠️ *Live Server Note:* The site will briefly look unstyled between theme activation and completing Step 4. Do this during a low-traffic period or in maintenance mode.

---

## Step 4 — Flush rewrite rules

In the target environment: **Settings → Permalinks → Save Changes** (no changes needed, just click Save).
This registers the `/book/[slug]/` URL structure from the plugin's CPT registration.

---

## Step 5 — Set the homepage and blog

In the target environment: **Settings → Reading:**
- Your homepage displays → **A static page**
- Homepage → **News** (the existing News page)
- Posts page → **Blog**

---

## Step 6 — Build the Navigation

The navigation block is now completely block-native and uses portable structural flex parameters, so the menu won't break when migrated. There are **no hardcoded IDs** to update.

1. In the target environment: **Appearance → Editor → Navigation → Create new navigation** (or edit existing).
2. Build your desired structure visually (e.g. Blog, Series Dropdowns, Books).
3. The theme will natively handle the rendering without requiring any manual file edits to `parts/navigation.html`.

---

## Step 7 — Assign custom templates to pages

In the target environment's WordPress admin, edit each page and set its template:

| Page | Template to assign |
|------|--------------------|
| Adversaries Series (`/adversaries-series/`) | **Page — Adversaries Series** |
| Series Hub (`/series/`) | **Page — Series Hub** |

**How:** Edit page → in the right sidebar → **Page** tab → **Template** dropdown → select → Update.

---

## Step 8 — Configure the Adversaries Series query block

The `page-adversaries` template has a Query block that needs its taxonomy filter set manually in the target environment:

1. Edit the Adversaries Series page in the Block Editor.
2. Click the Query Loop block.
3. In the sidebar → **Filters** → add taxonomy filter: **Series = Adversaries Crime**
4. Update the page.

*(Note: This requires the `adversaries-crime` book_series term to exist. Check **Books → Series** — if it's not there, create it with slug: `adversaries-crime`).*

---

## Step 9 — Verify ACF field groups are synced

In the target environment: **Custom Fields → Field Groups** — check that `Dalenii Books` is listed and **Active**.
If it shows as needing sync, click **Sync** to update from the JSON file.

---

## What you do NOT need to do

- ❌ Touch any existing pages, posts, or media
- ❌ Re-enter any existing content
- ❌ Migrate the database
- ❌ Change any URLs or permalinks
- ❌ Reinstall WordPress or plugins other than Dalenii Core Helper

---

*Deployment instructions compiled June 2026*
