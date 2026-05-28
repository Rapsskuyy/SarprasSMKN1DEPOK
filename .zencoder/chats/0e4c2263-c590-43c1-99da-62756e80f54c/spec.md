# Technical Specification - Sarpras SMKN 1 Depok Redesign & Enhancement

## Technical Context
- **Framework**: Laravel 11
- **Frontend**: Tailwind CSS, Blade Templates, Vite
- **Database**: SQLite (as seen in `database.sqlite`)
- **Assets**: Images stored in `public/img` or `storage/app/public`

## Implementation Approach

### 1. Color Palette Refinement
- Transition from `slate` to a more modern `zinc` or `neutral` base for the dark theme.
- Use `indigo` or a custom primary color for better harmony.
- Ensure high contrast and accessibility.

### 2. User Dashboard Enhancements
- Implement a scrolling marquee text "SARPRAS, SMKN 1 DEPOK" using CSS animations (instead of the obsolete `<marquee>` tag).
- Display item images in the borrowing catalog.

### 3. Admin Dashboard Enhancements
- **Image Management**: Add `input[type="file"]` to the create and edit modals. Implement image upload logic in `AdminController`.
- **Stock Management**: Improve the UI for updating stock to make it more intuitive.
- **Display**: Show uploaded images in the admin list.

### 4. Footer Enhancement
- Update `layouts.app` footer to include:
    - Email: smkn1depok@gmail.com
    - IG: officialsmkn1depok
    - YouTube: OfficialSMKN1Depok
    - Phone: 021-8790-7233 (Call)
    - Address: Gang Bhakti Suci No.100, Cimpaeun, Tapos, Kota Depok, Jawa Barat, 16459

## Source Code Structure Changes

### Modified Files:
- `resources/views/layouts/app.blade.php`: Redesign, Footer update.
- `resources/views/siswa/index.blade.php`: Marquee, Image display.
- `resources/views/admin/dashboard.blade.php`: Image upload fields, Stock edit UI.
- `app/Http/Controllers/AdminController.php`: Handle image uploads in `store` and `update`.
- `app/Models/Barang.php`: Ensure `gambar` is in `$fillable`.

### New Assets:
- Uploaded images will be stored in `storage/app/public/barang`.

## Data Model / API / Interface Changes
- `Barang` model already has `gambar` column.
- Controller logic to handle file uploads:
    - Validate image file.
    - Store file in public disk.
    - Save path in database.

## Verification Approach
- **Manual Verification**: Check UI responsiveness and aesthetics on different screen sizes.
- **Functional Testing**: Test image upload, stock update, and borrowing flow.
- **Code Quality**: Run `npm run lint` if available (need to check `package.json`).
