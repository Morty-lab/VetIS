<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Report</title>
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

        @media print {
            .table-bordered {
                border: 1px solid #000;
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
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="mb-0">Pruderich Veterinary Clinic</h1>
                <p class="mb-1">Purok - 3, Dologon, Maramag, Bukidnon, Philippines</p>
                <h2 class="mb-1">Financial Report</h2>
                <h4 class="mb-1">Month 2000</h4>
            </div>
        </div>
        <hr class="mb-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Total Transactions</th>
                    <th>Total Income</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Services</td>
                     <td>100</td>
                    <td>&#x20B1; 30,000.00</td>
                </tr>
                <tr>
                    <td>Medicines</td>
                    <td>50</td>
                    <td>&#x20B1; 10,000.00</td>
                </tr>
                <tr>
                    <td>Product Sales</td>
                    <td>150</td>
                    <td>&#x20B1; 20,000.00</td>
                </tr>
            </tbody>
        </table>

        <h2 class="mt-5 mb-2">Most Requested Services</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Frequency</th>
                    <th>Income Generated</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>General Check-Up</td>
                    <td>40</td>
                    <td>&#x20B1; 12,000.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Vaccination</td>
                    <td>35</td>
                    <td>&#x20B1; 10,500.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Deworming</td>
                    <td>15</td>
                    <td>&#x20B1; 4,500.00</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Grooming</td>
                    <td>10</td>
                    <td>&#x20B1; 3,000.00</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Other</td>
                    <td>5</td>
                    <td>&#x20B1; 1,500.00</td>
                </tr>
            </tbody>
        </table>

        <h2 class="mt-5 mb-2">Top-Selling Products</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-grid">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Units Sold</th>
                        <th>Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 5; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>Product {{ $i }}</td>
                            <td>{{ rand(1, 12345) }}</td>
                            <td>&#x20B1; {{ number_format(rand(100, 10000), 2) }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <div class="row mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center text-lg text-dark">Total Income: ₱ 60,000.00</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Primary Income Source</strong></td>
                        <td>Services (50% of total income)</td>
                    </tr>
                    <tr>
                        <td><strong>Top Service</strong></td>
                        <td>General Check-Up</td>
                    </tr>
                    <tr>
                        <td><strong>Top Product</strong></td>
                        <td>Pet Food (Small Pack)</td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
</body>


</html>
