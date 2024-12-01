<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Monthly Sales Report</title>
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
                <h2 class="mb-0">POS Monthly Sales Report</h2>
                <p>December 2024</p>
            </div>
        </div>
        <hr class="mb-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Transaction No.</th>
                    <th>Date</th>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Stock ID</th>
                    <th>Supplier</th>
                    <th>Supplier Price</th>
                    <th>Retail Price</th>
                    <th>QTY</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>TRX001</td>
                    <td>December 1, 2024</td>
                    <td>001</td>
                    <td>Canine Dewormer</td>
                    <td>STK001</td>
                    <td>Vet Supplies Co.</td>
                    <td>₱150</td>
                    <td>₱300</td>
                    <td>5</td>
                    <td>₱1,500</td>
                </tr>
                <tr>
                    <td>TRX002</td>
                    <td>December 1, 2024</td>
                    <td>002</td>
                    <td>Feline Multivitamins</td>
                    <td>STK002</td>
                    <td>PetCare Distributors</td>
                    <td>₱200</td>
                    <td>₱400</td>
                    <td>3</td>
                    <td>₱1,200</td>
                </tr>
                <tr>
                    <td>TRX003</td>
                    <td>December 1, 2024</td>
                    <td>003</td>
                    <td>Tick and Flea Shampoo</td>
                    <td>STK003</td>
                    <td>Animal Health Inc.</td>
                    <td>₱100</td>
                    <td>₱250</td>
                    <td>7</td>
                    <td>₱1,750</td>
                </tr>
                <tr>
                    <td>TRX004</td>
                    <td>December 2, 2024</td>
                    <td>004</td>
                    <td>Rabbit Food Pellets</td>
                    <td>STK004</td>
                    <td>GreenFarm Supplies</td>
                    <td>₱120</td>
                    <td>₱240</td>
                    <td>10</td>
                    <td>₱2,400</td>
                </tr>
                <tr>
                    <td>TRX005</td>
                    <td>December 2, 2024</td>
                    <td>005</td>
                    <td>Pet Bandages</td>
                    <td>STK005</td>
                    <td>Vet Essentials</td>
                    <td>₱50</td>
                    <td>₱100</td>
                    <td>20</td>
                    <td>₱2,000</td>
                </tr>
                <tr>
                    <td>TRX006</td>
                    <td>December 2, 2024</td>
                    <td>006</td>
                    <td>Equine Hoof Cleaner</td>
                    <td>STK006</td>
                    <td>HorseCare Pro</td>
                    <td>₱500</td>
                    <td>₱800</td>
                    <td>2</td>
                    <td>₱1,600</td>
                </tr>
                <tr>
                    <td>TRX007</td>
                    <td>December 2, 2024</td>
                    <td>007</td>
                    <td>Bird Vitamins</td>
                    <td>STK007</td>
                    <td>AvianHealth Plus</td>
                    <td>₱180</td>
                    <td>₱360</td>
                    <td>8</td>
                    <td>₱2,880</td>
                </tr>
                <tr>
                    <td>TRX008</td>
                    <td>December 2, 2024</td>
                    <td>008</td>
                    <td>Veterinary Gloves</td>
                    <td>STK008</td>
                    <td>Medical Vet Tools</td>
                    <td>₱300</td>
                    <td>₱600</td>
                    <td>15</td>
                    <td>₱9,000</td>
                </tr>
                <tr>
                    <td>TRX009</td>
                    <td>December 2, 2024</td>
                    <td>009</td>
                    <td>Pet Nail Clippers</td>
                    <td>STK009</td>
                    <td>PawCare Supplies</td>
                    <td>₱250</td>
                    <td>₱500</td>
                    <td>6</td>
                    <td>₱3,000</td>
                </tr>
                <tr>
                    <td>TRX010</td>
                    <td>December 2, 2024</td>
                    <td>010</td>
                    <td>Dog Chew Toys</td>
                    <td>STK010</td>
                    <td>Pet Toys World</td>
                    <td>₱150</td>
                    <td>₱300</td>
                    <td>12</td>
                    <td>₱3,600</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-9 text-end">
                <h3 class="mb-0">Total Sales</h3>
                <h3 class="text-primary">₱28,930.00</h3>
            </div>
            <div class="col-md-3 text-end">
                <h3 class="mb-0">Revenue</h3>
                <h3 class="text-primary">₱13,840.00</h3>
            </div>
        </div>
    </div>
</body>

</html>