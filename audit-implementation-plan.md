# Architectural Audit & Core Restructuring Plan

Following the mandatory system command, I have completed a repository-wide architectural audit of the `templates/` directory, `parts/navigation.html`, and `dalenii-core-helper.php` against WordPress 7.0 FSE architecture standards. 

Here is the plan to execute the zero-variance engineering rules.

## User Review Required

> [!WARNING]
> **Reverting Navigation Fix:** Rule 3 explicitly mandates the removal of hardcoded navigation pointers. This means I will delete the `"ref": 293` attribute we just added to `parts/navigation.html`. While this complies with strict FSE standards for seamless cross-tier deployment, it means the navigation menu will once again fall back to the dynamic database connection. Please confirm you want to proceed with this rollback.

## Proposed Changes

### 1. Purge Trailing Text Duplication

My audit revealed severe End-of-File duplication in the single book templates. An entire unclosed legacy block structure was appended after the `footer` template part. 

#### [MODIFY] [single-book-wwii.html](file:///C:/Github/wp_sites/dalenii/wp-content/themes/twentytwentyfour-dalenii/templates/single-book-wwii.html)
- Delete lines 74–136 (residual appended layout blocks).

#### [MODIFY] [single-book-spy.html](file:///C:/Github/wp_sites/dalenii/wp-content/themes/twentytwentyfour-dalenii/templates/single-book-spy.html)
- Delete lines 74–134.

#### [MODIFY] [single-book-crime.html](file:///C:/Github/wp_sites/dalenii/wp-content/themes/twentytwentyfour-dalenii/templates/single-book-crime.html)
- Delete lines 74–135.

---

### 2. Enforce Native Block Bindings API Only

**Audit Status: PASS.** 
I have verified that all buttons and metadata fields (like `buy_link_primary` and `book_series_position`) across all templates are successfully using the native WordPress Block Bindings API (`"source":"core/post-meta"`). No raw HTML placeholders were found. No changes required.

---

### 3. Strip Hardcoded Navigation Pointers

#### [MODIFY] [navigation.html](file:///C:/Github/wp_sites/dalenii/wp-content/themes/twentytwentyfour-dalenii/parts/navigation.html)
- Remove `"ref": 293` from the `wp:navigation` block.
- Verify the structural flex layouts remain intact.

---

### 4. Correct Template Check String Runtimes

#### [MODIFY] [dalenii-core-helper.php](file:///C:/Github/wp_sites/dalenii/wp-content/plugins/dalenii-core-helper/dalenii-core-helper.php)
- Update strict `===` validations in `dalenii_conditional_fonts()` to explicitly check for the `.html` extensions.
- `single-book-wwii` → `single-book-wwii.html`
- `single-book-crime` → `single-book-crime.html`
- `single-book-spy` → `single-book-spy.html`

## Verification Plan
After executing these changes, I will:
1. Stage and commit the corrected files to the git repository (`C:\Github\wp_sites\dalenii`).
2. Verify all syntax is valid and no trailing duplication remains.
