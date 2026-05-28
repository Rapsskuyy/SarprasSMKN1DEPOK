# Technical Specification - Sarpras SMKN 1 Depok

## Technical Context
- **Language**: PHP (Laravel)
- **Frontend**: Blade templates, Tailwind CSS (likely, based on Laravel standards), Vite
- **Database**: SQLite (as seen in `database/database.sqlite`)

## Implementation Approach
1. **Database Schema Update**:
    - Modify `users` table to include `username` and `role` (enum: 'admin', 'siswa').
    - Modify `peminjaman` table to include `jam_pinjam`, `guru_pembimbing`, and `jam_kembali`.
2. **Authentication Flow (Simplified)**:
    - **Unified Entry**: Remove separate Login page. Use a single Registration page that serves as the entry point.
    - **Auto-Login**: After successful registration, the user is automatically logged in and redirected to their role-specific dashboard.
    - **Login Fallback**: Provide a small "Already have an account?" toggle or simple login form on the same page if strictly needed, but prioritize the "Register & Enter" flow.
    - Implement middleware to protect routes based on `role`.
3. **Admin Features**:
    - **Active Monitoring Dashboard**: Dedicated section to view students who are currently borrowing items (status: 'dipinjam').
    - **Borrowing History Dashboard**: Dedicated section to view all-time borrowing records (status: 'kembali'), with daily updates and clear data presentation.
    - CRUD for `Barang` (items) and stock management.
4. **Student (Siswa) Features**:
    - Browse available items.
    - Borrowing form with the requested fields.
    - Return functionality.
5. **UI/UX Enhancement**:
    - **Dark Theme Implementation**: Use a dark-colored palette (e.g., slate-950 background, slate-900 cards) throughout the application.
    - Create a layout with a shared Navbar/Header.
    - Navbar: SMKN 1 Depok logo + text.
    - Header: School image background.
    - Use a modern CSS framework (Tailwind) for better styling.
    - Seed initial data for items (HDMI, VGA, etc.).

## Source Code Structure Changes
- **Models**:
    - `User.php`: Add `role` and `username` to fillable.
    - `Peminjaman.php`: Add new fields to fillable.
- **Controllers**:
    - `AuthController.php`: Handle role-based registration and username-based login.
    - `AdminController.php`: Manage items and monitor borrowing.
    - `SiswaController.php` (New): Handle borrowing requests.
- **Views**:
    - `resources/views/layouts/app.blade.php`: Global layout.
    - `resources/views/auth/register.blade.php`: Updated registration.
    - `resources/views/auth/login.blade.php`: Updated login.
    - `resources/views/siswa/index.blade.php`: Item list for students.
    - `resources/views/siswa/pinjam.blade.php`: Borrowing form.
    - `resources/views/admin/dashboard.blade.php`: Admin overview.

## Data Model Changes
### `users` table
- `id`
- `name`
- `username` (unique)
- `email` (unique)
- `password`
- `role` ('admin', 'siswa')

### `barang` table
- `id`
- `nama`
- `keterangan`
- `stock`
- `lokasi`
- `gambar` (Local path to image in `public/img`)

### `peminjaman` table
- `id`
- `barang_id`
- `user_id` (link to student)
- `nama_peminjam`
- `jam_pinjam`
- `jam_kembali`
- `guru_pembimbing`
- `status` ('dipinjam', 'kembali')

## Verification Approach
- **Manual Testing**:
    - Test registration for both roles.
    - Test login with username.
    - Test item creation by admin.
    - Test borrowing flow by student.
    - Test returning flow.
- **Commands**:
    - `php artisan migrate:fresh --seed` (to reset and apply changes)
    - `npm run build` (for frontend assets)
