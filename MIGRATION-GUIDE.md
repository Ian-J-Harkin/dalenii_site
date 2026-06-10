# Dalenii Digital Theme Migration Guide

Welcome to the Dalenii site management guide! This theme has been fully optimized for WordPress 7.0 Full Site Editing (FSE). This document explains how to manage your custom Book titles, assign them to their appropriate series, and ensure they are indexed correctly by search engines.

---

## 1. Registering a New Book Title

To add a new book to the website, follow these steps in your WordPress Admin dashboard:

1. In the left-hand WP-Admin sidebar, click on **Books** > **Add New**.
2. **Title:** Enter the title of the book in the main title block.
3. **Content:** Add your book description or synopsis into the main content editor area.
4. **Custom Fields / Post Meta:** Scroll down (or look in the right sidebar panels) to locate your custom fields. Fill in the data for:
   - `buy_link_primary`
   - `buy_link_universal`
   - `book_series_position`
   *(Note: These will automatically render on the frontend using native Gutenberg block bindings!)*
5. **Featured Image:** Set the book cover as the Featured Image in the right-hand document settings panel.

---

## 2. Mapping to the Book Series Taxonomy

Once your book details are entered, you need to assign it to the correct series so it shows up in the right archives:

1. On the same editing screen, look at the right-hand **Document Settings** sidebar.
2. Locate the **Book Series** taxonomy panel.
3. Check the box for the appropriate series (e.g., *Crime*, *Spy*, *WWII*), or click **Add New Book Series** if it doesn't exist yet.

---

## 3. Applying Layout Variants (Page Attributes)

This theme includes custom, block-native layouts specifically designed for different genres. To apply the correct visual layout to your new book:

1. In the right-hand **Document Settings** sidebar, scroll down to the **Template** (or **Page Attributes**) section.
2. Click on the Template dropdown. You will see your specialized variants:
   - **Single Book Crime** (`single-book-crime.html`)
   - **Single Book Spy** (`single-book-spy.html`)
   - **Single Book WWII** (`single-book-wwii.html`)
3. Select the template that matches the book's genre. 
4. Click **Publish** or **Update**. Your custom fonts and layouts will automatically enqueue.

---

## 4. Yoast SEO Sitemap Parameters

To ensure your custom `book` post type is automatically indexed and submitted to search engines via XML sitemaps, configure Yoast SEO as follows:

1. In WP-Admin, go to **Yoast SEO** > **Settings**.
2. Under the **Content Types** section in the left menu, select **Books** (or `book`).
3. Set the following parameters:
   - **Show Books in search results:** Toggle to **Yes** *(This is the critical switch that includes them in the sitemap)*.
   - **SEO title:** `%%title%% %%page%% %%sep%% %%sitename%%` (or your preferred structure).
   - **Meta description:** `%%excerpt%%` (or write a custom one).
4. **Save Changes**. Yoast will now automatically generate and update `post_type-book-sitemap.xml` within your main `sitemap_index.xml`.

---

## System Status
* **Architecture:** Full Site Editing (FSE) native block mechanics layered over Twenty Twenty-Four.
* **Layouts:** Clean, purged of trailing duplicate code, closing elegantly with native footer elements.
* **Navigation:** Resilient flex parameters active. Hardcoded database reference IDs removed.
* **PHP Logic:** Strict `.html` extension evaluations in place for template font enqueuing.
* **Hosting:** Verified ready for deployment to Blacknight cPanel hosting parameters.
