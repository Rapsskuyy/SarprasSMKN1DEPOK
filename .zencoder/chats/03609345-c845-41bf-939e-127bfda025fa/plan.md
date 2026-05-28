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

- easy: Straightforward implementation, trivial bug fix or feature
- medium: Moderate complexity, some edge cases or caveats to consider
- hard: Complex logic, many caveats, architectural considerations, or high-risk changes

Create a technical specification for the task that is appropriate for the complexity level:

- Review the existing codebase architecture and identify reusable components.
- Define the implementation approach based on established patterns in the project.
- Identify all source code files that will be created or modified.
- Define any necessary data model, API, or interface changes.
- Describe verification steps using the project's test and lint commands.

Save the output to `c:\laragon\www\smkn1depok\.zencoder\chats\03609345-c845-41bf-939e-127bfda025fa/spec.md`

---

### [x] Step: Implementation

Implement the task according to the technical specification and general engineering best practices.

1. **[x] Migration**: Create and run migration to remove `gambar` from `barang` table.
2. **[x] Model**: Update `Barang` model fillable attributes.
3. **[x] Controller**: Update `AdminController` validation and logic.
4. **[x] Views (Siswa)**: Remove image display logic in `siswa/index.blade.php`.
5. **[x] Views (Admin)**: Remove image display and form fields in `admin/dashboard.blade.php`.
6. **[x] Layout**: Increase hero section height in `layouts/app.blade.php`. (Superseded by step 9)
7. **[x] Verification**: Verify that item images are gone but logo/background remain.
8. **[x] Report**: Write report to `c:\laragon\www\smkn1depok\.zencoder\chats\03609345-c845-41bf-939e-127bfda025fa/report.md`.
9. **[x] Hero Background Removal**: Remove background image from `layouts/app.blade.php` and adjust height.
10. **[x] Verification**: Verify background is gone but logo remains.
11. **[x] Report Update**: Update report with background removal.
12. **[x] Stock Quick Edit**: Make stock display clickable to trigger edit modal in `admin/dashboard.blade.php`.
13. **[ ] Verification**: Verify stock can be easily edited.
