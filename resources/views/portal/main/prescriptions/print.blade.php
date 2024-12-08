<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <style>
        /* Remove margins and paddings during printing */
        @media print {
            body {
                margin: 0 !important;
                padding: 0 !important;
            }

            .container {
                margin: 0;
                padding: 0;
                max-width: 100%;
            }

            .card {
                box-shadow: none !important;
                border: none;
            }

            .printable {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-white">
    <div class="container">
        <div class="printable mt-3 mb-3">
            <div class="d-flex justify-content-between">
                <h1>PetHub</h1>
                <button class="btn btn-primary" onclick="window.print()">Print Prescription</button>
            </div>
        </div>
        <div class="card mx-auto shadow-none p-4">
            <div class="text-center mb-4">
                <h1 class="mb-1">Pruderich Veterinary Clinic</h1>
                <p class="mb-0">Purok - 3, Dologon, Maramag, Bukidnon</p>
                <p class="mb-0">Phone: (123) 456-7890</p>
            </div>

            <div class="d-flex justify-content-between">
                <div class="">
                    <label class="form-label fw-bold">Pet Name:</label>
                    <p>[Pet's Name]</p>
                </div>
                <div class="text-end">
                    <label class="form-label fw-bold">Date:</label>
                    <p>December 2, 2024</p>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Owner's Name:</label>
                <p>[Owner's Name]</p>
            </div>

            <div class="mb-3">
                <div class="mb-3">
                    <img src="{{asset('assets/img/illustrations/rx.png')}}" alt="RX"
                        style="height: 40px; width: auto; margin-right: 10px; vertical-align: middle;">
                </div>
                <label class="form-label fw-bold">Prescription Details:</label>
                <p class="form-control fs-6 lh-lg">
                    Amoxicillin x3 3 Times a Day
                    <br>
                    Loperamide Keneme x3 2 times a day
                </p>
            </div>

            <div class="d-flex justify-content-end">
                <div class="align-items-end mt-4">
                    <p class="mb-1 text-lg">Prince Zeljay Kent A. Invento</p>
                    <p class="mt-n4 mb-0">__________________________</p>
                    <p class="fw-bold">Veterinarian Signature</p>
                    <p class="mb-1 text-lg">123456789011121314</p>
                    <p class="mt-n4 mb-0">__________________________</p>
                    <p class="fw-bold">License No.</p>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted">Thank you for trusting Pruderich Veterinary Clinic!</p>
            </div>
        </div>
    </div>
</body>

</html>