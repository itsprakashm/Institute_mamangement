<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admission Form — {{ $student->student_name }} ({{ $student->admission_no }})</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: #fff; color: #1a1a1a; font-size: 13px; }

    .print-page {
      width: 210mm; min-height: 297mm;
      margin: 0 auto; padding: 18mm 16mm;
      position: relative;
    }

    /* Header */
    .print-header {
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 3px solid #d32f2f;
      padding-bottom: 12px; margin-bottom: 16px;
    }
    .print-header .logo { width: 70px; height: 70px; object-fit: contain; }
    .print-header .center { text-align: center; flex: 1; padding: 0 16px; }
    .print-header .center h1 {
      font-size: 22px; font-weight: 800; color: #d32f2f;
      margin-bottom: 2px; letter-spacing: 1px;
    }
    .print-header .center p { font-size: 11px; color: #555; }
    .print-header .admission-badge {
      text-align: center; padding: 8px 12px;
      border: 2px solid #d32f2f; border-radius: 6px;
      min-width: 120px;
    }
    .print-header .admission-badge .label { font-size: 9px; color: #888; text-transform: uppercase; letter-spacing: 1px; }
    .print-header .admission-badge .value { font-size: 14px; font-weight: 800; color: #d32f2f; }

    .form-title {
      text-align: center; font-size: 14px; font-weight: 700;
      background: #d32f2f; color: #fff; padding: 6px;
      border-radius: 4px; margin-bottom: 14px;
      letter-spacing: 1px; text-transform: uppercase;
    }

    /* Content Layout */
    .info-row {
      display: flex; gap: 10px; margin-bottom: 10px;
    }
    .info-block {
      flex: 1; display: flex; border-bottom: 1px dotted #ccc;
      padding-bottom: 4px;
    }
    .info-block .lbl {
      font-weight: 600; color: #555; white-space: nowrap;
      min-width: 110px; font-size: 11px; text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .info-block .val {
      font-weight: 600; color: #1a1a1a; padding-left: 6px;
    }

    .section-title {
      font-size: 12px; font-weight: 700; color: #fff;
      background: #333; padding: 4px 10px;
      border-radius: 3px; margin: 14px 0 10px 0;
      text-transform: uppercase; letter-spacing: 0.5px;
    }

    /* Photo box */
    .photo-box {
      width: 100px; height: 120px;
      border: 2px solid #333; border-radius: 4px;
      display: flex; align-items: center; justify-content: center;
      overflow: hidden; float: right; margin-left: 14px;
    }
    .photo-box img { width: 100%; height: 100%; object-fit: cover; }
    .photo-box .placeholder { color: #aaa; font-size: 10px; text-align: center; }

    /* Qualification table */
    .qual-table { width: 100%; border-collapse: collapse; margin-top: 6px; }
    .qual-table th, .qual-table td {
      border: 1px solid #333; padding: 5px 8px;
      text-align: left; font-size: 12px;
    }
    .qual-table th {
      background: #f5f5f5; font-weight: 700;
      text-transform: uppercase; font-size: 10px;
      letter-spacing: 0.5px;
    }

    /* Signatures */
    .signatures {
      display: flex; justify-content: space-between;
      margin-top: 40px; padding-top: 12px;
    }
    .sig-block {
      text-align: center; width: 30%;
    }
    .sig-line {
      border-top: 1px solid #333;
      margin-top: 50px; padding-top: 4px;
      font-size: 11px; font-weight: 600;
    }

    /* Declaration */
    .declaration {
      margin-top: 20px; padding: 10px;
      border: 1px solid #ccc; border-radius: 4px;
      font-size: 11px; color: #555; line-height: 1.6;
    }
    .declaration strong { color: #333; }

    /* Print button */
    .no-print { text-align: center; margin: 20px 0; }
    .no-print button {
      background: #d32f2f; color: #fff; border: none;
      padding: 10px 30px; border-radius: 6px;
      font-size: 14px; font-weight: 600; cursor: pointer;
    }
    .no-print button:hover { background: #b71c1c; }
    .no-print .btn-back {
      background: #555; margin-left: 10px;
    }

    @media print {
      .no-print { display: none !important; }
      body { background: #fff; }
      .print-page { padding: 10mm 12mm; margin: 0; width: 100%; }
      @page { size: A4; margin: 0; }
    }
  </style>
</head>
<body>

  <div class="no-print">
    @if(session('success'))
    <div style="background:#e8f5e9; color:#2e7d32; padding:12px 20px; text-align:center; font-weight:600; font-size:14px;">
      ✅ {{ session('success') }}
    </div>
    @endif
    <button onclick="window.print()">🖨️ Print Form</button>
    <button class="btn-back" onclick="window.location='{{ url("/students/admission") }}'">← New Admission</button>
    <button class="btn-back" onclick="window.location='{{ url("/") }}'">🏠 Dashboard</button>
  </div>

  <div class="print-page">

    {{-- HEADER --}}
    <div class="print-header">
      <img src="{{ asset('assets/images/logo-mbc.jpg') }}" alt="MBC" class="logo">
      <div class="center">
        <h1>Manpreet Bhatia Classes</h1>
        <p>Excellence in Education — Since 2005</p>
        <p style="font-size:10px; color:#888;">Contact: 9931148498 | manpreetbhatiaclasses.co.in</p>
      </div>
      <div class="admission-badge">
        <div class="label">Admission No</div>
        <div class="value">{{ $student->admission_no }}</div>
        <div class="label" style="margin-top:4px;">{{ $student->registration_date->format('d/m/Y') }}</div>
      </div>
    </div>

    <div class="form-title">Student Admission Form</div>

    {{-- PHOTO --}}
    <div class="photo-box">
      @if($student->photo)
        <img src="{{ asset($student->photo) }}" alt="Photo">
      @else
        <div class="placeholder">Paste<br>Photo<br>Here</div>
      @endif
    </div>

    {{-- ADMISSION DETAILS --}}
    <div class="section-title">Admission Details</div>
    <div class="info-row">
      <div class="info-block"><span class="lbl">Class:</span><span class="val">{{ $student->class }}</span></div>
      <div class="info-block"><span class="lbl">Session:</span><span class="val">{{ $student->registration_date->format('Y') }}-{{ $student->registration_date->format('Y')+1 }}</span></div>
    </div>

    {{-- PERSONAL INFORMATION --}}
    <div class="section-title">Personal Information</div>
    <div class="info-row">
      <div class="info-block"><span class="lbl">Student Name:</span><span class="val">{{ $student->student_name }}</span></div>
      <div class="info-block"><span class="lbl">Gender:</span><span class="val">{{ ucfirst($student->gender) }}</span></div>
    </div>
    <div class="info-row">
      <div class="info-block"><span class="lbl">Date of Birth:</span><span class="val">{{ $student->date_of_birth->format('d/m/Y') }}</span></div>
    </div>
    <div class="info-row">
      <div class="info-block"><span class="lbl">Father's Name:</span><span class="val">{{ $student->father_name }}</span></div>
      <div class="info-block"><span class="lbl">Designation:</span><span class="val">{{ $student->father_designation ?? '—' }}</span></div>
    </div>
    <div class="info-row">
      <div class="info-block"><span class="lbl">Mother's Name:</span><span class="val">{{ $student->mother_name }}</span></div>
      <div class="info-block"><span class="lbl">Designation:</span><span class="val">{{ $student->mother_designation ?? '—' }}</span></div>
    </div>

    {{-- ADDRESS & CONTACT --}}
    <div class="section-title">Address & Contact</div>
    <div class="info-row">
      <div class="info-block" style="flex:2;"><span class="lbl">Address:</span><span class="val">{{ $student->permanent_address }}</span></div>
    </div>
    <div class="info-row">
      <div class="info-block"><span class="lbl">City:</span><span class="val">{{ $student->city ?? '—' }}</span></div>
      <div class="info-block"><span class="lbl">Pincode:</span><span class="val">{{ $student->pincode ?? '—' }}</span></div>
    </div>
    <div class="info-row">
      <div class="info-block"><span class="lbl">Student Phone:</span><span class="val">{{ $student->student_phone }}</span></div>
      <div class="info-block"><span class="lbl">WhatsApp:</span><span class="val">{{ $student->student_whatsapp ?? '—' }}</span></div>
    </div>
    <div class="info-row">
      <div class="info-block"><span class="lbl">Father Phone:</span><span class="val">{{ $student->father_phone ?? '—' }}</span></div>
      <div class="info-block"><span class="lbl">Mother Phone:</span><span class="val">{{ $student->mother_phone ?? '—' }}</span></div>
    </div>

    {{-- QUALIFICATION --}}
    <div class="section-title">Academic Qualification</div>
    <table class="qual-table">
      <thead>
        <tr>
          <th>Degree/Board</th>
          <th>Stream</th>
          <th>Board/University</th>
          <th>Passing Year</th>
          <th>Marks %</th>
        </tr>
      </thead>
      <tbody>
        @forelse($student->qualifications as $q)
        <tr>
          <td>{{ $q->degree }}</td>
          <td>{{ $q->stream ?? '—' }}</td>
          <td>{{ $q->board ?? '—' }}</td>
          <td>{{ $q->passing_year ?? '—' }}</td>
          <td>{{ $q->marks_percentage ?? '—' }}</td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center; color:#999;">No qualification records</td></tr>
        @endforelse
      </tbody>
    </table>

    {{-- DECLARATION --}}
    <div class="declaration">
      <strong>Declaration:</strong> I hereby declare that all the information provided above is true and correct to the best of my knowledge.
      I understand that any false information may result in cancellation of admission.
    </div>

    {{-- SIGNATURES --}}
    <div class="signatures">
      <div class="sig-block">
        <div class="sig-line">Student's Signature</div>
      </div>
      <div class="sig-block">
        <div class="sig-line">Guardian's Signature</div>
      </div>
      <div class="sig-block">
        <div class="sig-line">Authority Signature</div>
      </div>
    </div>

  </div>

</body>
</html>
