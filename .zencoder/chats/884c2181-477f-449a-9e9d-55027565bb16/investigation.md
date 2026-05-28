# Bug Investigation - SMKN 1 Depok Sarpras

## Bug Summary
1.  **Authentication Logic Confusion**: The `AuthController::access` method determines whether to login or register based solely on the existence of the username. If a user tries to log in with a typo or a non-existent username, they are treated as a registration attempt and receive validation errors for fields (name, email, role) that are hidden in the login form.
2.  **Unauthorized Admin Registration**: The registration form allows users to select the `admin` role, which is a significant security risk.
3.  **UI Redundancy**: The `layouts.app` header is displayed on the login/register page, creating redundant headings.
4.  **Missing Student Borrowing Status**: Students can borrow items but cannot see their current borrowing status or history in their dashboard.

## Root Cause Analysis
1.  **Auth Logic**: The server-side doesn't know the user's intent (login vs register) because the form doesn't send an action indicator. It assumes any non-existent username is a new registration.
2.  **Admin Role**: The `role` field is directly accepted from the request during registration without any restriction or verification.
3.  **UI**: The `layouts.app` file contains a large header that is always rendered regardless of the current view.
4.  **Siswa Dashboard**: The `SiswaController::index` method only retrieves the list of items (`Barang`) and does not query the `Peminjaman` table for the authenticated user's records.

## Affected Components
- `AuthController.php`
- `SiswaController.php`
- `AppServiceProvider.php` (potentially for gates/roles)
- `resources/views/auth/register.blade.php`
- `resources/views/siswa/index.blade.php`
- `resources/views/layouts/app.blade.php`

## Proposed Solution
1.  **Auth Fix**:
    - Add a hidden `mode` input (value: `login` or `register`) to the auth form.
    - Update `AuthController::access` to use this `mode` to determine the logic path.
    - Provide a "User not found" error if login mode is used with a non-existent username.
2.  **Security Fix**:
    - Remove the `role` selection from the registration form.
    - Default all new registrations to the `siswa` role.
    - Admins should be created via seeders or an existing admin panel (if available).
3.  **UI Fix**:
    - Wrap the header in `layouts.app` with an `@if(!Route::is('register') && !Route::is('login'))` check (or similar).
4.  **Siswa Dashboard Enhancement**:
    - Update `SiswaController::index` to fetch `activePeminjaman` for the current user.
    - Display the active borrowings in the student's dashboard.
