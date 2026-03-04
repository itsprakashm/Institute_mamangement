<aside class="sidebar">
  <button type="button" class="sidebar-close-btn">
    <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
  </button>
  <div class="">
    <div class="sidebar-logo d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none">
        <img src="{{ asset('assets/images/logo-mbc.jpg') }}" alt="Manpreet Bhatia Classes" class="light-logo" style="height:36px; width:auto; border-radius:6px;">
        <img src="{{ asset('assets/images/logo-mbc.jpg') }}" alt="Manpreet Bhatia Classes" class="dark-logo" style="height:36px; width:auto; border-radius:6px;">
        <img src="{{ asset('assets/images/logo-mbc.jpg') }}" alt="MBC" class="logo-icon" style="height:36px; width:auto; border-radius:6px;">
      </a>
      <button type="button" class="text-xxl d-xl-flex d-none line-height-1 sidebar-toggle text-neutral-500"
        aria-label="Collapse Sidebar">
        <i class="ri-contract-left-line"></i>
      </button>
    </div>
  </div>
  <!-- User Info start -->
  <div class="mx-16 py-12">
    <div class="dropdown profile-dropdown">
      <button type="button"
        class="profile-dropdown__button d-flex align-items-center justify-content-between p-10 w-100 overflow-hidden bg-neutral-50 radius-12 "
        data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
        <span class="d-flex align-items-start gap-10">
          <img src="{{ asset('assets/images/thumbs/leave-request-img2.png') }}" alt="Thumbnail"
            class="w-40-px h-40-px rounded-circle object-fit-cover flex-shrink-0">
          <span class="profile-dropdown__contents">
            <span class="h6 mb-0 text-md d-block text-primary-light">Admin User</span>
            <span class="text-secondary-light text-sm mb-0 d-block">Admin</span>
          </span>
        </span>
        <span class="profile-dropdown__icon pe-8 text-xl d-flex line-height-1">
          <i class="ri-arrow-right-s-line"></i>
        </span>
      </button>
      <ul class="dropdown-menu dropdown-menu-lg-end border p-12">
        <li>
          <a href="{{ url('/student-details') }}"
            class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
            <i class="ri-user-3-line"></i>
            My Profile
          </a>
        </li>
        <li>
          <a href="{{ url('/settings/general') }}"
            class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
            <i class="ri-settings-3-line"></i>
            Setting
          </a>
        </li>
        <li>
          <a href="{{ url('/login') }}"
            class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2 py-6">
            <i class="ri-shut-down-line"></i>
            Log Out
          </a>
        </li>
      </ul>
    </div>
  </div>
  <!-- User Info end -->
  <div class="sidebar-menu-area">
    <ul class="sidebar-menu" id="sidebar-menu">
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-home-4-line"></i>
          <span>Dashboard </span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              School Dashboard
            </a>
          </li>
          {{-- 
          <li>
            <a href="{{ url('/dashboard-2') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Student
            </a>
          </li>
          <li>
            <a href="{{ url('/dashboard-3') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Teacher
            </a>
          </li>
          <li>
            <a href="{{ url('/dashboard-4') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Parent
            </a>
          </li>
          <li>
            <a href="{{ url('/dashboard-5') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              LMS
            </a>
          </li>
          --}}
        </ul>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-graduation-cap-line"></i>
          <span>Students</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ route('students.create') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Add New Student
            </a>
          </li>
          <li>
            <a href="{{ route('students.index') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Student List
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Suspend Student
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Student Categories
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Edit Student
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Student Details
            </a>
          </li>
        </ul>
      </li>
      {{-- 
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-user-follow-line"></i>
          <span>Teachers</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/teachers/add') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Add New Teacher
            </a>
          </li>
          <li>
            <a href="{{ url('/teachers/list') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Teacher List
            </a>
          </li>
          <li>
            <a href="{{ url('/teachers/edit') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Edit Teacher
            </a>
          </li>
          <li>
            <a href="{{ url('/teachers/details') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Teacher Details
            </a>
          </li>
          <li>
            <a href="{{ url('/teachers/timetable') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Teacher Timetable
            </a>
          </li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-account-circle-line"></i>
          <span>Guardian</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/guardians/add') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Add New Guardians
            </a>
          </li>
          <li>
            <a href="{{ url('/guardians/list') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Guardians List
            </a>
          </li>
          <li>
            <a href="{{ url('/guardians/edit') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Edit Guardian
            </a>
          </li>
          <li>
            <a href="{{ url('/guardians/details') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Guardian Details
            </a>
          </li>
        </ul>
      </li>
      --}}
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-calendar-check-line"></i>
          <span>Attendance</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ route('attendance.mark') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Mark Attendance
            </a>
          </li>
          <li>
            <a href="{{ route('attendance.report') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Attendance Report
            </a>
          </li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-list-view"></i>
          <span>Classes</span>
        </a>
        <ul class="sidebar-submenu">
          {{-- 
          <li>
            <a href="{{ url('/classes/section') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Section
            </a>
          </li>
          <li>
            <a href="{{ url('/classes/subject') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Subjects
            </a>
          </li>
          --}}
          <li>
            <a href="{{ route('classes.create') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Add New Class
            </a>
          </li>
          <li>
            <a href="{{ route('classes.index') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Class List
            </a>
          </li>
          {{-- 
          <li>
            <a href="{{ url('/classes/room') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Class Room
            </a>
          </li>
          --}}
        </ul>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-stack-line"></i>
          <span>Batches</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ route('batches.create') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Add New Batch
            </a>
          </li>
          <li>
            <a href="{{ route('batches.index') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Batch List
            </a>
          </li>
        </ul>
      </li>
      {{-- 
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-file-edit-line"></i>
          <span>Examinations</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/exams/exam') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Exam
            </a>
          </li>
          <li>
            <a href="{{ url('/exams/schedule') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Exam Schedule
            </a>
          </li>
          <li>
            <a href="{{ url('/exams/result') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Exam Result
            </a>
          </li>
        </ul>
      </li>
      --}}
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-money-dollar-circle-line"></i>
          <span>Fees Management</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ route('fees.index') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Fee Structures
            </a>
          </li>
          <li>
            <a href="{{ route('fees.collect') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Collect Fees
            </a>
          </li>
          <li>
            <a href="{{ route('fees.report') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Fee Report
            </a>
          </li>
        </ul>
      </li>
      {{-- 
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-calendar-check-line"></i>
          <span>Attendance</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/attendance/student') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Student Attendance
            </a>
          </li>
          <li>
            <a href="{{ url('/attendance/teacher') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Teacher Attendance
            </a>
          </li>
          <li>
            <a href="{{ url('/attendance/employee') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Employee Attendance
            </a>
          </li>
        </ul>
      </li>
      --}}
      {{-- 
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-time-line"></i>
          <span>Leaves</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/leaves/types') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Leave Types
            </a>
          </li>
          <li>
            <a href="{{ url('/leaves/request') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Leave Request
            </a>
          </li>
        </ul>
      </li>
      --}}
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-user-star-line"></i>
          <span>Student Portal</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ route('student-portal.dashboard') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              My Dashboard
            </a>
          </li>
          <li>
            <a href="{{ route('student-portal.profile') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              My Profile
            </a>
          </li>
          <li>
            <a href="{{ route('student-portal.attendance') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              My Attendance
            </a>
          </li>
          <li>
            <a href="{{ route('student-portal.fees') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              My Fees
            </a>
          </li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-pie-chart-line"></i>
          <span>Reports</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ route('reports.students') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Student Report
            </a>
          </li>
          <li>
            <a href="{{ route('reports.attendance') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Attendance Report
            </a>
          </li>
          <li>
            <a href="{{ route('reports.fees') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Fee Summary
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="{{ route('announcements.index') }}">
          <i class="ri-megaphone-line"></i>
          <span>Announcements</span>
        </a>
      </li>
      <li>
        <a href="{{ route('logs.index') }}">
          <i class="ri-file-list-3-line"></i>
          <span>Activity Logs</span>
        </a>
      </li>
      {{-- 
      <li>
        <a href="{{ url('/certificate') }}">
          <i class="ri-home-4-line"></i>
          <span>Certificate </span>
        </a>
      </li>
      --}}
      {{-- 
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-book-2-line"></i>
          <span>Library</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/library/books') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Books List
            </a>
          </li>
          <li>
            <a href="{{ url('/library/members') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Members List
            </a>
          </li>
          <li>
            <a href="{{ url('/library/member-details') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Members Details
            </a>
          </li>
          <li>
            <a href="{{ url('/library/issue-return') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Issue Return
            </a>
          </li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-money-dollar-circle-line"></i>
          <span>Accounts</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/accounts/income-head') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Income Head
            </a>
          </li>
          <li>
            <a href="{{ url('/accounts/income-list') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Income List
            </a>
          </li>
          <li>
            <a href="{{ url('/accounts/expense-head') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Expense Head
            </a>
          </li>
          <li>
            <a href="{{ url('/accounts/expense-list') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Expense List
            </a>
          </li>
          <li>
            <a href="{{ url('/accounts/transaction') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Transaction
            </a>
          </li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-user-settings-line"></i>
          <span>HRM</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/hrm/employee-list') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Employee List
            </a>
          </li>
          <li>
            <a href="{{ url('/hrm/employee-details') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Employee Details
            </a>
          </li>
          <li>
            <a href="{{ url('/hrm/add-employee') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Add New Employee
            </a>
          </li>
          <li>
            <a href="{{ url('/hrm/payroll') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Payroll
            </a>
          </li>
          <li>
            <a href="{{ url('/hrm/designation') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Designation
            </a>
          </li>
          <li>
            <a href="{{ url('/hrm/department') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Department
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="{{ url('/notice-board') }}">
          <i class="ri-booklet-line"></i>
          <span>Notice Board </span>
        </a>
      </li>
      <li>
        <a href="{{ url('/event') }}">
          <i class="ri-calendar-event-line"></i>
          <span>Event </span>
        </a>
      </li>
      <li>
        <a href="{{ url('/message') }}">
          <i class="ri-message-2-line"></i>
          <span>Message </span>
        </a>
      </li>
      <li>
        <a href="{{ url('/subscription-plan') }}">
          <i class="ri-price-tag-3-line"></i>
          <span>Subscription Plan </span>
        </a>
      </li>
      <li>
        <a href="{{ url('/role-access') }}">
          <i class="ri-macbook-line"></i>
          <span>Role & Access</span>
        </a>
      </li>
       <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-shield-check-line"></i>
          <span>Authentication</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/login') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Login</a>
          </li>
          <li>
            <a href="{{ url('/register') }}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Register</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="{{ url('/assign-role') }}">
          <i class="ri-user-follow-line"></i>
          <span>Assign Role</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="javascript:void(0)">
          <i class="ri-user-settings-line"></i>
          <span>Settings</span>
        </a>
        <ul class="sidebar-submenu">
          <li>
            <a href="{{ url('/settings/general') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              General
            </a>
          </li>
          <li>
            <a href="{{ url('/settings/notification') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Notification
            </a>
          </li>
          <li>
            <a href="{{ url('/settings/currencies') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Currencies
            </a>
          </li>
          <li>
            <a href="{{ url('/settings/languages') }}">
              <i class="ri-circle-fill circle-icon w-auto"></i>
              Languages
            </a>
          </li>
        </ul>
      </li>
      --}}
    </ul>
  </div>
</aside>
