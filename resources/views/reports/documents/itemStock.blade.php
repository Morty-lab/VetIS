<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Stock Report</title>
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
            <h1>VetIS</h1>
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
                <h2 class="mb-0">Item Stock Report</h2>
                <p class="text-primary">Turtle Tank Filter</p>
            </div>
        </div>
        <hr class="mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Stock ID</th>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Expiry Date</th>
                    <th>Supplier</th>
                    <th>Supplier Price</th>
                    <th>SRP</th>
                    <th>Stocks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>STK-0001</td>
                    <td>4342984</td>
                    <td>Turtle Tank Filter</td>
                    <td>2025-09-12</td>
                    <td>Schinner, Becker and Schmeler</td>
                    <td>Php 85.37</td>
                    <td>Php 61.93</td>
                    <td>22 Capsules</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>