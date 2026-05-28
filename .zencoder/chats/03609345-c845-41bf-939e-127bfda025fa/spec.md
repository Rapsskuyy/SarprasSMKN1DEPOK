# Technical Specification - Remove Item Images

The objective is to remove the image functionality for borrowable items while keeping the logo and background images.

## Technical Context
- **Language**: PHP (Laravel)
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: SQLite (based on `database.sqlite` in root)

## Implementation Approach

1. **Database Schema**:
   - Create a migration to drop the `gambar` column from the `barang` table.
   - This ensures the database is clean and doesn't store unnecessary data.

2. **Model Update**:
   - Update `app/Models/Barang.php` to remove `gambar` from the `$fillable` array.

3. **Controller Updates**:
   - **AdminController**:
     - Remove `gambar` from validation rules in `store` and `update` methods.
     - Remove `gambar` from the data array being saved.

4. **View Updates**:
   - **siswa/index.blade.php**:
     - Remove the conditional check for `$b->gambar`.
     - Always display the placeholder SVG icon for every item.
   - **admin/dashboard.blade.php**:
     - Remove the `<img>` tag that displays the item image in the stock management grid.
     - Remove the "Filename Gambar" input field from the "Add Barang" modal.
     - Remove the "Filename Gambar" input field from the "Edit Barang" modal.
     - Update the `editBarang` JavaScript function to remove logic related to the `gambar` field.

5. **Layout & Hero Background**:
   - `resources/views/layouts/app.blade.php` handles the logo (`img/smkn1depoklogo.jpg`) and background.
   - **Removal**: The background image (`img/background.jpg`) will be removed entirely from the hero section as per the latest request.
   - The logo will be kept in the navbar.
   - The hero section height will be adjusted to a smaller, cleaner size since the background image is gone.

6. **Stock Quick Edit**:
   - Improve the UX for editing stock in the Admin Dashboard.
   - Make the stock display area on each item card clickable to trigger the "Edit Barang" modal.
   - Add a "cursor-pointer" style and a hover effect to indicate that the stock can be edited.
   - When clicked, focus the "stock" input field in the modal automatically.
- New migration file: `database/migrations/YYYY_MM_DD_HHMMSS_remove_gambar_from_barang_table.php`
- Modified: `app/Models/Barang.php`
- Modified: `app/Http/Controllers/AdminController.php`
- Modified: `resources/views/siswa/index.blade.php`
- Modified: `resources/views/admin/dashboard.blade.php`
- Modified: `resources/views/layouts/app.blade.php`

## Verification Approach
- **Manual Verification**:
  - Visit the Admin Dashboard and verify that the "Add/Edit Barang" forms no longer have the "Gambar" field.
  - Add a new item and ensure it saves correctly without an image.
  - Visit the Student (Siswa) page and verify that all items show the default SVG icon and no item images are displayed.
  - Verify that the school logo and hero background image are still visible.
- **Automated Tests**:
  - Run `php artisan test` if any tests exist.
