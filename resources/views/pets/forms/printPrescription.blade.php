<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Pet Medical Record - Prescription</title>
<style>
    @page {
        size: A4;
        margin: 25mm 20mm;
    }
    * {
        box-sizing: border-box;
    }
    body {
        font-family: 'Arial', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 13px;
        margin: 0;
        padding: 0;
        color: #000;
        background: #fff;
        line-height: 1.4;
    }
    .container {
        max-width: 780px;
        margin: 0 auto;
        padding: 20px 15px;
    }
    .container::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;   /* adjust size */
        height: 200px;  /* adjust size */
        background: url('data:image/svg+xml;utf8,<svg fill="rgba(0,0,0,0.05)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><path d="M12 48c-6-6 4-24 12-20 6 3 6 18 0 22-6 4-10 4-12-2zM26 12c-2-8 8-10 10-4 2 8-8 10-10 4zM40 14c0-10 10-10 10 0 0 10-10 10-10 0zM16 28c-8 0-8-12 0-12 8 0 8 12 0 12zM48 44c-6 4-12-6-6-10 6-4 12 6 6 10z"/></svg>') no-repeat center center;
        background-size: contain;
        opacity: 0.05; /* faint */
        transform: translate(-50%, -50%);
        pointer-events: none; /* so clicks pass through */
        z-index: 0;
    }

    /* Header */
    header {
        text-align: center;
        margin-bottom: 20px;
        border-bottom: 2px solid #000;
        padding-bottom: 8px;
    }
    header h1 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        letter-spacing: 1.5px;
    }
    header p {
        margin: 3px 0 0;
        font-size: 11px;
        font-weight: 600;
        color: #333;
    }
    .header-subinfo {
        margin-top: 6px;
        font-size: 11px;
        font-weight: 600;
        color: #222;
        display: flex;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
    }
    .header-subinfo span {
        border-left: 1px solid #999;
        padding-left: 10px;
    }
    .header-subinfo span:first-child {
        border-left: none;
        padding-left: 0;
    }
    
    /* Section Titles */
    h2 {
        font-size: 16px;
        font-weight: 700;
        margin: 30px 0 10px;
        border-bottom: 1.5px solid #444;
        padding-bottom: 4px;
    }

    /* Info Section */
    .info-grid {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }
    .info-block {
        flex: 1 1 48%;
        border: 1px solid #666;
        padding: 15px 20px;
        font-size: 13px;
        background: #f9f9f9;
        border-radius: 4px;
    }
    .info-row {
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
    }
    .info-label {
        font-weight: 600;
        color: #444;
    }
    .info-value {
        font-weight: 500;
        color: #111;
        max-width: 60%;
        text-align: right;
        word-break: break-word;
    }

    /* Prescription Section */
    .prescription-list {
        border: 1px solid #666;
        border-radius: 4px;
        overflow: hidden;
        font-size: 13px;
    }
    .prescription-row {
        display: flex;
        background: #fff;
        border-bottom: 1px solid #ddd;
        padding: 10px 15px;
        align-items: center;
    }
    .prescription-row.header {
        background: #222;
        color: #fff;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
    }
    .prescription-col {
        flex: 1 1 25%;
        padding: 0 8px;
        word-break: break-word;
    }
    .prescription-row:last-child {
        border-bottom: none;
    }
    .no-record {
        padding: 25px;
        text-align: center;
        font-style: italic;
        color: #666;
    }

    /* Footer */
    footer {
        margin-top: 50px;
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        border-top: 2px solid #000;
        padding-top: 20px;
    }
    .signature-line {
        border-top: 1px solid #000;
        width: 280px;
        text-align: center;
        padding-top: 6px;
        font-weight: 600;
    }
</style>
</head>
<body>
<div class="container">
    @php
        $doctor = null;
        if (!is_null($record->doctorID)) {
            $doctor = \App\Models\Doctor::find($record->doctorID);
        }
    @endphp

    <!-- Header -->
    <header>
        <h1>Pruderich Veterinary Clinic</h1>
        <p>Purok - 3, Dologon, Maramag, Bukidnon | +63 917 620 0620</p>
        <div class="header-subinfo">
            <span><strong>License No:</strong> {{ $doctor->license_number ?? '------' }}</span>
            <span><strong>PTR No:</strong> {{ $doctor->ptr_number ?? '------' }}</span>
            <span><strong>Veterinarian:</strong> Dr.    {{ 
                $doctor 
                    ? $doctor->firstname . ' ' .
                      ($doctor->middlename ? strtoupper(substr($doctor->middlename, 0, 1)) . '. ' : '') .
                      $doctor->lastname .
                      ($doctor->extname ? ' ' . $doctor->extname : '')
                    : ''
            }}</span>
        </div>
    </header>

    <!-- Owner & Record Info -->
    <div style="display: flex; gap: 50px; font-size: 13px;">
        <!-- Left column -->
        <div style="flex: 1;">
          <div style="margin-bottom: 6px;">
            <strong>Client Name:</strong> {{ $owner->client_name }}
          </div>
          <div style="margin-bottom: 6px;">
            <strong>Address:</strong> {{ $owner->client_address }}
          </div>
        </div>
      
        <!-- Right column -->
        <div style="flex: 1;">
            <div>
                <strong>Contact No.:</strong> {{ $owner->client_no }}
            </div>
        </div>
      </div>      

      <h2>Pet Information</h2>
      <div style="display: flex; gap: 40px; max-width: 100%;">
        <!-- Left column -->
        <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #666; padding-bottom: 4px;">
            <div><strong>Pet Name</strong></div>
            <div>{{ $pet->pet_name }}</div>
          </div>
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #666; padding-bottom: 4px;">
            <div><strong>Pet Type</strong></div>
            <div>{{ $pet->pet_type }}</div>
          </div>
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #666; padding-bottom: 4px;">
            <div><strong>Breed</strong></div>
            <div>{{ $pet->pet_breed }}</div>
          </div>
        </div>
      
        <!-- Right column -->
        <div style="flex: 1; display: flex; flex-direction: column; gap: 8px;">
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #666; padding-bottom: 4px;">
            <div><strong>Birthdate</strong></div>
            <div>{{ \Carbon\Carbon::parse($pet->pet_birthdate)->format('F d, Y') }}</div>
          </div>
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #666; padding-bottom: 4px;">
            <div><strong>Spayed/Neutered</strong></div>
            <div>{{ $pet->neutered === null ? 'No Record' : ($pet->neutered == 1 ? 'Yes' : 'No') }}</div>
          </div>
        </div>
      </div>
      
    

    <!-- Prescriptions -->
    <h2 style="display: flex; align-items: center; gap: 8px;">
        <!-- Rx symbol SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M32 0C14.3 0 0 14.3 0 32L0 192l0 96c0 17.7 14.3 32 32 32s32-14.3 32-32l0-64 50.7 0 128 128L137.4 457.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L288 397.3 393.4 502.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L333.3 352 438.6 246.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 306.7l-85.8-85.8C251.4 209.1 288 164.8 288 112C288 50.1 237.9 0 176 0L32 0zM176 160L64 160l0-96 112 0c26.5 0 48 21.5 48 48s-21.5 48-48 48z"/></svg>
        Prescriptions
    </h2>
    <div class="prescription-list">
        <div class="prescription-row header">
            <div class="prescription-col">Medication</div>
            <div class="prescription-col">Dosage</div>
            <div class="prescription-col">Frequency</div>
            <div class="prescription-col">Duration</div>
        </div>

        @if (isset($prescriptions) && count($prescriptions) > 0)
            @foreach ($prescriptions as $prescription)
                <div class="prescription-row">
                    <div class="prescription-col">{{ $prescription->medication }}</div>
                    <div class="prescription-col">{{ $prescription->dosage }}</div>
                    <div class="prescription-col">{{ $prescription->frequency }}</div>
                    <div class="prescription-col">{{ $prescription->duration }}</div>
                </div>
            @endforeach
        @else
            <div class="no-record">No prescriptions recorded.</div>
        @endif
    </div>
    <div class="prescription-notes" style="margin-top: 20px;">
        <strong>Prescription Notes:</strong>
        <p>{{ $record->prescription_notes ?? '--' }}</p>
    </div>

    <!-- Footer -->
    <footer>
        <div>Date: {{ \Carbon\Carbon::now()->format('F d, Y') }}</div>
        <div>
            <div style="text-align: center;">Dr. {{ 
                $doctor 
                    ? $doctor->firstname . ' ' .
                      ($doctor->middlename ? strtoupper(substr($doctor->middlename, 0, 1)) . '. ' : '') .
                      $doctor->lastname .
                      ($doctor->extname ? ' ' . $doctor->extname : '')
                    : ''
            }}</div>
            <div class="signature-line">Signature</div>
        </div>
    </footer>

</div>
</body>
</html>
