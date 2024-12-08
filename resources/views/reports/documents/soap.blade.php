<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOAP Note</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <style>
        body {
            margin: 30px;
        }

        /* Add margin for preview (on screen) */
        .document {
            border: 1px solid gray;
            padding: 30px;
        }

        /* Remove margin when printing */
        @media print {
            body {
                margin: 0;
            }

            .document {
                border: 0px solid gray;
                padding: 0;
            }

            .printable {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-white">
    <div class="printable mt-3 mb-3">
        <div class="d-flex justify-content-between">
            <h1>PetHub</h1>
            <button class="btn btn-primary" onclick="window.print()">Print Report</button>
        </div>
    </div>
    <div class="document bg-white">
        <div class="d-flex justify-content-between">
            <div class="text-start">
                <h1 class="mb-0">Pruderich Veterinary Clinic</h1>
                <p>Purok - 3, Dologon, Maramag, Bukidnon, Philippines</p>
            </div>
            <div class=" text-end">
                <h2 class="mb-0">SOAP Note</h2>
                <p>{{\Carbon\Carbon::now()->format('F d, Y')}}</p>
            </div>
        </div>
        <div class="row border mx-1">
            <div class="col-12 text-center bg-dark text-white py-2">Information</div>
            <div class="col-12 border py-2"><span class="fw-bold">Attending Veterinarian:</span></div>
            <div class="col-6 border py-2"><span class="fw-bold">Pet Name:</span></div>
            <div class="col-6 border py-2"><span class="fw-bold">Sex:</span></div>
            <div class="col-6 border py-2"><span class="fw-bold">Species:</span></div>
            <div class="col-6 border py-2"><span class="fw-bold">Breed:</span></div>
            <div class="col-6 border py-2"><span class="fw-bold">Age:</span></div>
            <div class="col-6 border py-2"><span class="fw-bold">Color:</span></div>
            <div class="col-6 border py-2"><span class="fw-bold">Pet Owner:</span></div>
            <div class="col-6 border py-2"><span class="fw-bold">Address:</span></div>
            <div class="col-12 text-center bg-dark text-white py-2"><span class="text-lg">S</span>ubjective</div>
            <div class="col-12 border py-2"><span class="fw-bold">Primary Complaint/History:</span></div>
            <div class="col-12 border py-2" style="min-height: 100px;"></div>
            <div class="col-12 text-center bg-dark text-white py-2"><span class="text-lg">O</span>bjective</div>
            <div class="col-4 border py-2"><span class="fw-bold">Examination:</span></div>
            <div class="col-8 border py-2" style="min-height: 100px; white-space: pre-wrap;">
            </div>
            <div class="col-4 border py-2"><span class="fw-bold">Laboratory:</span></div>
            <div class="col-8 border">
                <div class="row">
                    <div class="col-6 text-center py-2 bg-dark text-white"><span class="fw-bold">Image</span></div>
                    <div class="col-6 text-center py-2 bg-dark text-white"><span class="fw-bold">Remark</span></div>
                    <div class="col-6 py-2 border-top border-end text-center">
                        <img src="" alt="" style="max-width:500px">
                    </div>
                    <div class="col-6 py-2 border-top border-start">
                    </div>
                </div>
            </div>
            <div class="col-12 text-center bg-dark text-white py-2"><span class="text-lg">A</span>ssessment</div>
            <div class="col-6 border py-2"><span class="fw-bold">Interpretation:</span></div>
            <div class="col-6 border py-2" style="min-height: 100px;">
                <span class="fw-bold">Diagnosis:</span>
            </div>
            <div class="col-12 text-center bg-dark text-white py-2"><span class="text-lg">P</span>lan</div>

            <div class="col-6 border py-2" style="min-height: 100px;">
                <span class="fw-bold">Plan:</span>
            </div>
            <div class="col-6 border py-2" style="min-height: 100px;">
                <span class="fw-bold">Treatment:</span>
            </div>
            <div class="col-12 border py-2" style="min-height: 100px;">
                <span class="fw-bold">Prescription:</span>
            </div>
            <div class="col-12 text-center bg-dark text-white py-2">Client Communication</div>
            <div class="col-12 border py-2" style="min-height: 100px;">

            </div>
        </div>
    </div>
</body>

</html>