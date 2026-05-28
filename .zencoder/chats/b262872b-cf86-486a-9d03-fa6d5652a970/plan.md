# Spec and build

## Agent Instructions

Ask the user questions when anything is unclear or needs their input. This includes:

- Ambiguous or incomplete requirements
- Technical decisions that affect architecture or user experience
- Trade-offs that require business context

Do not make assumptions on important decisions — get clarification first.

---

## Workflow Steps

### [x] Step: Technical Specification

Assess the task's difficulty, as underestimating it leads to poor outcomes.

- hard: Complex logic, many caveats, architectural considerations, or high-risk changes

Create a technical specification for the task that is appropriate for the complexity level:
- Save to `c:\laragon\www\smkn1depok\.zencoder\chats\b262872b-cf86-486a-9d03-fa6d5652a970/spec.md`

### [ ] Step: Implementation

Implement the task according to the technical specification and general engineering best practices.

#### Database & Models
1. [x] Create/Update migrations for `users`, `barang`, and `peminjaman`.
2. [x] Update `User`, `Barang`, and `Peminjaman` models with proper relationships and fillable fields.
3. [x] Update `Barang` migration and seeder to include `gambar` column and local paths.

#### Authentication (Simplified)
4. [x] Remove separate Login view and routes.
5. [x] Refactor Registration view to be the primary "Akses Web Sarpras" page.
6. [x] Implement "Smart Access" logic: if username already exists, attempt login; otherwise, register.
7. [x] Ensure Logout redirects back to the unified entry page.
8. [x] Fix "Route [login] not defined" by naming the redirect route.

#### Admin Functionality (Monitoring & History)
8. [x] Refactor Admin Dashboard to separate "Active Monitoring" and "Borrowing History" into dedicated sections.
9. [x] Implement "Daily History" view for better tracking.
10. [x] Implement CRUD for items (Barang).

#### Student Functionality
11. [x] Create Student Dashboard/Item List view.
12. [x] Implement Borrowing form with required fields.
13. [x] Implement Returning functionality with return time update.

#### UI Layout & Assets (Theme Revert)
14. [x] Create a master layout with Navbar and Header.
15. [x] Revert theme from Light back to **Dark Theme** (slate-950/900 palette).
16. [x] Synchronize and display local images from `public/img` (Logo, Background, Item images).

#### Finalization
17. [x] Run linting and basic manual verification.
18. [x] Write final report to `c:\laragon\www\smkn1depok\.zencoder\chats\b262872b-cf86-486a-9d03-fa6d5652a970/report.md`.
