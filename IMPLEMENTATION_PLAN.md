# Smart Institute Management System Implementation Plan

## User Review Required
The proposed plan creates a complete, functional Institute Management System within the existing Laravel project. Please review the database tables and proposed paths before I begin development.

## Proposed Changes

---

### MODULE 1 — ROLES & USERS
This module introduces Role-Based Access Control (RBAC).
- Create `roles` migration and model:
  - id, name, created_at, updated_at
- Create `role_user` intermediate table for many-to-many relationship.
- Update `User` model to have `roles()` relationship.
- Create `CheckRole` middleware to restrict routes.
- Assign existing users the correct roles or attach `super_admin`.

---

### MODULE 2 — STUDENT MANAGEMENT
Create the master student table and CRUD operations.
- Create `students` migration with columns: `admission_no`, `first_name`, `last_name`, `gender`, `dob`, `photo`, `guardian_name`, `guardian_phone`, `address`, `class_id`, `batch_id`, `status`.
- Create `Student` model with relationship to `ClassModel` and `Batch`.
- Create `StudentController` (resource) for listing, adding, editing, and viewing students.
- Create Blade templates using the admin layout (`layouts.master`):
  - `students/index.blade.php`
  - `students/create.blade.php`
  - `students/edit.blade.php`
  - `students/show.blade.php`

---

### MODULE 3 — CLASS MANAGEMENT
Manage classes (e.g., "10th Grade", "JEE Advanced").
- Create `classes` migration with `class_name` and `description`.
- Create `ClassModel` and `ClassController`.
- Create views:
  - `classes/index.blade.php`
  - `classes/create.blade.php`
  - `classes/edit.blade.php`

---

### MODULE 4 — BATCH MANAGEMENT
Manage time-based batches for classes.
- Create `batches` migration with `class_id`, `batch_name`, `teacher_id`, `start_time`, `end_time`.
- Create `Batch` model with relationship to `ClassModel` and `User` (teacher).
- Create `BatchController` and views:
  - `batches/index.blade.php`
  - `batches/create.blade.php`
  - `batches/edit.blade.php`

---

### MODULE 5 — ATTENDANCE SYSTEM
Track daily student attendance.
- Create `attendance` migration with `student_id`, `batch_id`, `date`, `status` (present/absent).
- Create `Attendance` model and `AttendanceController`.
- Create views:
  - `attendance/mark.blade.php` (Grid to mark presence)
  - `attendance/report.blade.php` (Filterable report)

---

### MODULE 6 — FEE MANAGEMENT
Record-keeping for student fees (no payment gateway).
- Create `fee_structures` migration (`class_id`, `monthly_fee`).
- Create `student_fees` migration (`student_id`, `month`, `amount`, `status`, `paid_date`).
- Create related models and `FeeController`.
- Create views:
  - `fees/index.blade.php`
  - `fees/collect.blade.php`
  - `fees/report.blade.php`

---

### MODULE 7 — ANNOUNCEMENTS
Global messages for students/staff.
- Create `announcements` migration (`title`, `message`, `created_by`).
- Create `Announcement` model and `AnnouncementController`.
- Create views:
  - `announcements/index.blade.php`
  - `announcements/create.blade.php`

---

### MODULE 8 — STUDENT PORTAL
A dedicated, mobile-responsive dashboard for students to view their info.
- Student login integration.
- Create views:
  - `student/dashboard.blade.php`
  - `student/profile.blade.php`
  - `student/attendance.blade.php`
  - `student/fees.blade.php`

---

### MODULE 9 — REPORTS
Consolidated printable reports.
- Create `ReportController`.
- Create views with standard Excel/PDF export capabilities (using DataTables or Laravel Excel):
  - `reports/students.blade.php`
  - `reports/attendance.blade.php`
  - `reports/fees.blade.php`

---

### MODULE 10 — ACTIVITY LOGS
System audit trail.
- Create `activity_logs` migration (`user_id`, `action`, `module`, `record_id`).
- Create `ActivityLog` model and implement a helper/trait to log events from other controllers.
- Create view `logs/index.blade.php` for admins to audit system changes.

---

## Verification Plan

### Automated Tests
Not applicable as per current constraints, but Laravel validation rules will act as safeguards during HTTP requests.

### Manual Verification
1. Access the application on `http://127.0.0.1:8000`.
2. Login as super_admin.
3. Test RBAC by creating a "reception" user and verifying restricted access.
4. Test Student Module: Verify adding, editing, and paginated listing.
5. Create Classes and associated Batches, assign students to them.
6. Test Attendance Module: Ensure presence/absence saves and retrieves correctly.
7. Test Fee Module: Create a fee structure, assign to a student, and mark fee as paid. Verify receipt generation.
8. Log out, then login as a Student. Check dashboard, attendance, and fee history views (ensure mobile responsiveness).
9. Test Activity Logs by viewing the admin log grid and checking for new entries when records are modified.
