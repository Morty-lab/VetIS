<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Receipt</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }

        .header,
        .footer {
            text-align: center;
        }

        .header h1,
        .footer p {
            margin: 0;
        }

        .details,
        .services,
        .payment-info,
        .billing-history {
            margin-bottom: 20px;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }

        .text-primary {
            color: #007bff;
        }

        .badge {
            padding: 5px 10px;
            background-color: #d9f7ff;
            border-radius: 20px;
            font-size: 12px;
        }

        .print-btn {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 100%;
            }

            .container {
                margin: 0;
                padding: 0;
                width: 100%;
                box-shadow: none;
            }

            .print-btn {
                display: none;
            }

            table {
                width: 100%;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: none;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .services-table td {
            border-top: 1px solid #ddd;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 100%;
            }

            .container {
                margin: 0;
                padding: 0;
                width: 100%;
                max-width: 100%;
                box-shadow: none;
            }

            .print-btn {
                display: none;
            }

            table {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header mb-4">
            <h2>Pruderich Veterinary Clinic</h2>
            <p>Purok - 3, Dologon, Maramag, Bukidnon</p>
        </div>
        <hr>
        <!-- Billing Info Section -->
        <div class="details mb-3">
            <div><strong>Billing Number:</strong> #VETISBILL-00012</div>
            <div><strong>Date:</strong> 11/23/2024</div>
        </div>

        <!-- Owner and Pet Info Section -->
        <div class="details row mb-4">
            <div class="col-md-6">
                <strong>Owner Details</strong>
                <div><strong>Name:</strong> John Doe</div>
                <div><strong>Address:</strong> 123 Maple Street, Maramag, Bukidnon</div>
                <div><strong>Phone:</strong> (0917) 123-4567</div>
            </div>
            <div class="col-md-6">
                <strong>Pet Details</strong>
                <div><strong>Name:</strong> Buddy</div>
                <div><strong>Breed:</strong> Labrador Retriever</div>
                <div><strong>Age:</strong> 3 years</div>
            </div>
        </div>

        <!-- Services Availed Section as Table -->
        <div class="services mb-4">
            <h3>Services Availed</h3>
            <table class="services-table">
                <tbody>
                    <tr>
                        <td>Deworming</td>
                        <td>x1</td>
                        <td class="text-primary">₱500.00</td>
                    </tr>
                    <tr>
                        <td>Grooming</td>
                        <td>x1</td>
                        <td class="text-primary">₱300.00</td>
                    </tr>
                    <tr>
                        <td>Vaccination</td>
                        <td>x1</td>
                        <td class="text-primary">₱200.00</td>
                    </tr>
                    <tr class="total">
                        <td colspan="2" class="text-end"><strong>Total:</strong></td>
                        <td class="text-primary">₱1,000.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Billing History Section -->
        <div class="billing-history mb-4">
            <h3>Billing History</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Billing Number</th>
                        <th>Date</th>
                        <th>Amount Paid</th>
                        <th>Remaining Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#VETISBILL-00012</td>
                        <td>11/23/2024</td>
                        <td class="text-primary">₱500.00</td>
                        <td class="text-primary">₱500.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Payment Info Section -->
        <div class="payment-info mb-4">
            <div><strong>Payment Type:</strong> Partial Payment</div>
            <div><strong>Due Date:</strong> 12/01/2024</div>
            <div><strong>Remaining Balance:</strong> <span class="text-danger">₱500.00</span></div>
        </div>

        <!-- Footer Section -->
        <div class="footer mb-4">
            <button class="print-btn" onclick="window.print()">Print Receipt</button>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>