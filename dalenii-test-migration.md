# Dalenii Digital — Test Migration Guide
## Clone the live site into WordPress Studio for local testing · June 2026

The purpose of this process is to get a complete copy of the live site running locally in WordPress Studio so you can test the new theme deployment without any risk to the live site.

---

## What this does

- Copies all live site content (pages, posts, media, menus, ACF data, settings) into Studio
- Rewrites all URLs from `daleniidigital.com` to your local Studio address automatically
- Leaves the live site completely untouched

---

## Part 1 — Export from the live site

1. Log in to the live site WordPress admin
2. **Plugins → Add New** → search **All-in-One WP Migration** → Install → Activate
3. In the left sidebar: **All-in-One WP Migration → Export**
4. Click **Export To → File**
5. Wait for the export to complete, then click the download link
6. Save the `.wpress` file somewhere on your computer

> The free version supports exports up to 512MB. A small publisher site will be well under this limit.

---

## Part 2 — Import into WordPress Studio

1. Open WordPress Studio and make sure the Dalenii site is running
2. Open the Studio site's WordPress admin
3. **Plugins → Add New** → search **All-in-One WP Migration** → Install → Activate
4. In the left sidebar: **All-in-One WP Migration → Import**
5. Drag the `.wpress` file onto the import area (or click to browse)
6. When prompted with the overwrite warning → click **Proceed**
7. Wait for the import to complete — this may take a minute or two

> After the import, WordPress will log you out. Log back in using your **live site** credentials (the import replaced the local database including users).

---

## Part 3 — Post-import fixes

**Flush rewrite rules:**
Settings → Permalinks → Save Changes (no changes needed, just click Save)

**Verify the site looks correct:**
Open the Studio site in a browser — it should look identical to the live site, including navigation, pages, and posts.

---

## Part 4 — Now test the deployment

With a working clone of the live site in Studio, manually copy the new theme and plugin folders over to your test environment's `wp-content` folders, mimicking Steps 1 and 2 of [dalenii-deploy-instructions.md](dalenii-deploy-instructions.md) (but copying to your local test site instead of the live server). Then work through the deployment instructions from Step 3 onwards.

The test sequence is:
1. **Activate Dalenii Core Helper** plugin (Plugins → Installed Plugins)
2. **Activate Dalenii Digital** theme (Appearance → Themes)
3. **Flush permalinks** (Settings → Permalinks → Save)
4. **Set homepage** (Settings → Reading → Posts page → News)
5. **Build navigation** in Editor and update `parts/navigation.html` ref
6. **Assign templates** to Adversaries Series and Series Hub pages
7. **Configure Adversaries query block** taxonomy filter
8. **Verify ACF sync** (Custom Fields → Field Groups)

If anything looks wrong, fix it in the theme files, refresh, and check again — all without touching the live site.

---

## Part 5 — When you're happy, deploy to live

Follow [dalenii-deploy-instructions.md](dalenii-deploy-instructions.md) in full, this time on the live server.

---

## Notes

- You can repeat Parts 1–2 at any time to refresh the local clone with fresh live content
- The `.wpress` file is also a backup of your live site — keep a copy somewhere safe
- If the free All-in-One WP Migration plugin blocks the import due to file size, use **Duplicator** (also free) as a drop-in alternative with the same workflow

---

*Test migration guide compiled June 2026*
