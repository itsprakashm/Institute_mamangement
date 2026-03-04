@extends('layouts.master')

@section('title', 'New Admission - Manpreet Bhatia Classes')

@section('content')
<div class="dashboard-main-body">
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0 d-flex align-items-center gap-2">
      <iconify-icon icon="solar:user-plus-bold" class="icon text-primary-600 text-xl"></iconify-icon>
      New Student Admission
    </h6>
    <ul class="d-flex align-items-center gap-2">
      <li class="fw-medium"><a href="{{ url('/') }}" class="d-flex align-items-center gap-1 hover-text-primary"><iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon> Dashboard</a></li>
      <li>-</li>
      <li class="fw-medium">New Admission</li>
    </ul>
  </div>

  {{-- Flash Messages --}}
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <iconify-icon icon="solar:check-circle-bold" class="me-2"></iconify-icon>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif
  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <iconify-icon icon="solar:danger-circle-bold" class="me-2"></iconify-icon>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif
  @if($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif

  <form action="{{ route('students.admission.store') }}" method="POST" enctype="multipart/form-data" id="admissionForm">
    @csrf

    <div class="row gy-4">

      {{-- LEFT: Photo + Quick Info --}}
      <div class="col-xxl-3 col-lg-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="mb-20">
              <div id="photoPreview" class="mx-auto rounded-16 overflow-hidden border border-neutral-300"
                style="width:200px; height:200px; display:flex; align-items:center; justify-content:center; background:var(--neutral-50);">
                <iconify-icon icon="solar:camera-bold-duotone" class="text-neutral-400" style="font-size:3rem;"></iconify-icon>
              </div>
            </div>
            <label class="btn btn-primary-600 btn-sm w-100 mb-12 cursor-pointer" for="photoInput">
              <iconify-icon icon="solar:upload-bold" class="me-1"></iconify-icon> Upload Photo
            </label>
            <input type="file" id="photoInput" name="photo" accept="image/*" class="d-none" onchange="previewPhoto(this)">
            <p class="text-xs text-neutral-500 mb-20">JPG, PNG — Max 2MB</p>

            <div class="text-start border-top pt-16">
              <div class="mb-12">
                <span class="text-neutral-500 text-xs d-block mb-1">ADMISSION NO</span>
                <span class="fw-bold text-primary-600 text-lg">{{ $admissionNo }}</span>
              </div>
              <div class="mb-12">
                <span class="text-neutral-500 text-xs d-block mb-1">STATUS</span>
                <span class="badge bg-success-600 bg-opacity-10 text-success-600">Active</span>
              </div>
              <div>
                <span class="text-neutral-500 text-xs d-block mb-1">ACADEMIC SESSION</span>
                <span class="fw-semibold">{{ date('Y') }}-{{ date('Y')+1 }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- RIGHT: Form --}}
      <div class="col-xxl-9 col-lg-8">

        {{-- Section 1: Admission Details --}}
        <div class="card mb-24">
          <div class="card-header border-bottom">
            <h6 class="text-md fw-semibold mb-0 d-flex align-items-center gap-2">
              <iconify-icon icon="solar:graduation-cap-bold" class="text-primary-600"></iconify-icon>
              Admission Details
            </h6>
          </div>
          <div class="card-body">
            <div class="row gy-3">
              <div class="col-md-4">
                <label class="form-label fw-semibold text-primary-light">Admission Seeking In <span class="text-danger">*</span></label>
                <select name="class" class="form-select" required>
                  <option value="">Select Class</option>
                  @foreach(['JAC+1','JAC+2','ISC+1','ISC+2','CBSE+1','CBSE+2','B.COM PART1','B.COM PART2','B.COM PART3','B.COM SEM 1','B.COM SEM 2','B.COM SEM 3','B.COM SEM 4','B.COM SEM 5','B.COM SEM 6','B.COM SEM 7','B.COM SEM 8','M.COM SEM 1','M.COM SEM 2','M.COM SEM 3','M.COM SEM 4','BBA SEM 1','BBA SEM 2','BBA SEM 3','BBA SEM 4','BBA SEM 5','BBA SEM 6','BBA SEM 7','BBA SEM 8','CA','CS','CMA','NIOS','OTHERS'] as $cls)
                    <option value="{{ $cls }}" {{ old('class') == $cls ? 'selected' : '' }}>{{ $cls }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold text-primary-light">Registration Date <span class="text-danger">*</span></label>
                <input type="date" name="registration_date" class="form-control" value="{{ old('registration_date', date('Y-m-d')) }}" required>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold text-primary-light">Gender <span class="text-danger">*</span></label>
                <select name="gender" class="form-select" required>
                  <option value="male" {{ old('gender')=='male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ old('gender')=='female' ? 'selected' : '' }}>Female</option>
                  <option value="other" {{ old('gender')=='other' ? 'selected' : '' }}>Other</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        {{-- Section 2: Personal Information --}}
        <div class="card mb-24">
          <div class="card-header border-bottom">
            <h6 class="text-md fw-semibold mb-0 d-flex align-items-center gap-2">
              <iconify-icon icon="solar:user-id-bold" class="text-warning-600"></iconify-icon>
              Personal Information
            </h6>
          </div>
          <div class="card-body">
            <div class="row gy-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold text-primary-light">Student Name <span class="text-danger">*</span></label>
                <input type="text" name="student_name" class="form-control" placeholder="Full name of student" value="{{ old('student_name') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold text-primary-light">Date of Birth <span class="text-danger">*</span></label>
                <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold text-primary-light">Father's Name <span class="text-danger">*</span></label>
                <input type="text" name="father_name" class="form-control" placeholder="Father's full name" value="{{ old('father_name') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold text-primary-light">Father's Designation</label>
                <input type="text" name="father_designation" class="form-control" placeholder="Occupation" value="{{ old('father_designation') }}">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold text-primary-light">Mother's Name <span class="text-danger">*</span></label>
                <input type="text" name="mother_name" class="form-control" placeholder="Mother's full name" value="{{ old('mother_name') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold text-primary-light">Mother's Designation</label>
                <input type="text" name="mother_designation" class="form-control" placeholder="Occupation" value="{{ old('mother_designation') }}">
              </div>
            </div>
          </div>
        </div>

        {{-- Section 3: Address & Contact --}}
        <div class="card mb-24">
          <div class="card-header border-bottom">
            <h6 class="text-md fw-semibold mb-0 d-flex align-items-center gap-2">
              <iconify-icon icon="solar:map-point-bold" class="text-info-600"></iconify-icon>
              Address & Contact
            </h6>
          </div>
          <div class="card-body">
            <div class="row gy-3">
              <div class="col-12">
                <label class="form-label fw-semibold text-primary-light">Permanent Address <span class="text-danger">*</span></label>
                <textarea name="permanent_address" class="form-control" rows="2" placeholder="Full address" required>{{ old('permanent_address') }}</textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold text-primary-light">City</label>
                <input type="text" name="city" class="form-control" placeholder="City" value="{{ old('city') }}">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold text-primary-light">Pincode</label>
                <input type="text" name="pincode" class="form-control" placeholder="Pincode" maxlength="6" value="{{ old('pincode') }}">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold text-primary-light">Student Phone <span class="text-danger">*</span></label>
                <input type="tel" name="student_phone" class="form-control" placeholder="10-digit number" maxlength="10" value="{{ old('student_phone') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold text-primary-light">Student WhatsApp</label>
                <input type="tel" name="student_whatsapp" class="form-control" placeholder="WhatsApp number" maxlength="10" value="{{ old('student_whatsapp') }}">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold text-primary-light">Father's Phone</label>
                <input type="tel" name="father_phone" class="form-control" placeholder="Father's number" maxlength="10" value="{{ old('father_phone') }}">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold text-primary-light">Mother's Phone</label>
                <input type="tel" name="mother_phone" class="form-control" placeholder="Mother's number" maxlength="10" value="{{ old('mother_phone') }}">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold text-primary-light">Email (Optional)</label>
                <input type="email" name="email" class="form-control" placeholder="student@email.com" value="{{ old('email') }}">
              </div>
            </div>
          </div>
        </div>

        {{-- Section 4: Qualification --}}
        <div class="card mb-24">
          <div class="card-header border-bottom">
            <h6 class="text-md fw-semibold mb-0 d-flex align-items-center gap-2">
              <iconify-icon icon="solar:diploma-bold" class="text-success-600"></iconify-icon>
              Academic Qualification
            </h6>
          </div>
          <div class="card-body">
            <p class="text-neutral-500 text-sm mb-16">Fill in applicable academic details. Leave blank if not applicable.</p>

            @foreach(['10th', '12th', 'Graduation', 'Others'] as $index => $degree)
            <div class="bg-neutral-50 rounded-12 p-16 mb-12 border border-neutral-200">
              <h6 class="text-sm fw-bold text-primary-light mb-12">
                <iconify-icon icon="solar:document-text-bold" class="me-1"></iconify-icon> {{ $degree }}
              </h6>
              <div class="row gy-2">
                <input type="hidden" name="degree[]" value="{{ $degree }}">
                <div class="col-md-3">
                  <input type="text" name="stream[]" class="form-control form-control-sm" placeholder="Stream" value="{{ old('stream.'.$index) }}">
                </div>
                <div class="col-md-3">
                  <input type="text" name="board[]" class="form-control form-control-sm" placeholder="Board / University" value="{{ old('board.'.$index) }}">
                </div>
                <div class="col-md-3">
                  <input type="text" name="passing_year[]" class="form-control form-control-sm" placeholder="Year" value="{{ old('passing_year.'.$index) }}">
                </div>
                <div class="col-md-3">
                  <input type="text" name="marks_percentage[]" class="form-control form-control-sm" placeholder="Marks %" value="{{ old('marks_percentage.'.$index) }}">
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        {{-- Submit --}}
        <div class="d-flex justify-content-end gap-3">
          <button type="reset" class="btn btn-outline-danger-600 radius-8 px-20 py-11">
            <iconify-icon icon="solar:restart-bold" class="me-1"></iconify-icon> Reset
          </button>
          <button type="submit" class="btn btn-primary-600 radius-8 px-20 py-11" onclick="return confirm('Are you sure you want to submit this admission form?')">
            <iconify-icon icon="solar:check-circle-bold" class="me-1"></iconify-icon> Submit Admission
          </button>
        </div>

      </div>
    </div>
  </form>
</div>

<script>
function previewPhoto(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('photoPreview').innerHTML =
        '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection
