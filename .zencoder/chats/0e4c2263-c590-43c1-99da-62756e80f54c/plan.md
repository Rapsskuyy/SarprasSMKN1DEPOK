# Plan - Sarpras SMKN 1 Depok Redesign & Enhancement

## Workflow Steps

### [x] Step: Technical Specification
Assess the task's difficulty and create a technical specification.

### [/] Step: Implementation
Implement the task according to the technical specification.

#### Phase 1: Color Palette & Layout (Redesign)
- [x] Update `resources/views/layouts/app.blade.php` with new color scheme (Zinc/Indigo).
- [x] Enhance the Footer with school profile information.
- [x] Add the scrolling marquee to the User Dashboard (`resources/views/siswa/index.blade.php`).

#### Phase 2: Image Management
- [x] Update `AdminController@store` and `AdminController@update` to handle file uploads.
- [x] Add image upload inputs to Add and Edit modals in `resources/views/admin/dashboard.blade.php`.
- [x] Update `resources/views/siswa/index.blade.php` and `resources/views/admin/dashboard.blade.php` to display item images.

#### Phase 3: Stock Management Enhancement
- [x] Refine the stock update UI in the Admin Dashboard for better usability.

#### Phase 4: Verification & Cleanup
- [x] Verify all features (image upload, stock update, marquee, footer).
- [x] Run final linting and cleanup.
- [x] Write the final report.

#### Phase 5: Revert Color Scheme to Slate/Blue
- [x] Revert `resources/views/layouts/app.blade.php` colors to Slate/Blue.
- [x] Revert `resources/views/siswa/index.blade.php` colors to Slate/Blue.
- [x] Revert `resources/views/admin/dashboard.blade.php` colors to Slate/Blue.

#### Phase 6: Header and Marquee Refinement
- [x] Fix header layout in `resources/views/layouts/app.blade.php`.
- [x] Ensure marquee text is exactly 1 line and clean in `resources/views/siswa/index.blade.php`.

#### Phase 7: Borrowing History Report
- [x] Restore and enhance the Borrowing History table in `resources/views/admin/dashboard.blade.php`.
- [x] Ensure pagination and styling match the new design.

#### Phase 8: Dedicated Admin History Page
- [x] Create a new route for the admin history page in `routes/web.php`.
- [x] Implement the `history` method in `AdminController.php`.
- [x] Create a new view `resources/views/admin/history.blade.php` based on the design.
- [x] Update the Admin Dashboard to link to the History page and remove the history table.
- [x] Remove the "Total Selesai" card and resize other stats for better UI balance.
48→
49→#### Phase 9: Image Asset Synchronization
50→- [x] Restore `gambar` column to `barang` table.
51→- [x] Map existing items to images in `public/img`.
52→- [x] Update views to use direct asset paths for images.
53→- [x] Update `AdminController` to handle combined storage and public image paths.
