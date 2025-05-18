<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Receipt - Pruderich Vet Clinic</title>
    <style>
        @media print {
            body {
                width: 80mm;
            }
        }

        body {
            font-family: 'Courier New', monospace;
            width: 80mm;
            margin: auto;
            padding: 10px;
            font-size: 12px;
        }

        h2,
        p {
            text-align: center;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            text-align: left;
            padding: 2px 0;
        }

        th {
            font-weight: bold;
        }

        .totals {
            margin-top: 10px;
        }

        .totals td {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
    </style>
</head>

<body onload="window.print();">

    <h2>Pruderich Veterinary Clinic</h2>
    <p>Purok - 3, Dologon, Maramag, Bukidnon, Philippines, 8714</p>
    <p># 09176200620</p>
    <hr>
    <table>
        <tbody>
            <tr>
                <td style="text-align: left">Date:<br><strong id="date">-</strong></td>
                <td style="text-align: right;">Receipt #:<br><strong id="receiptNo">#000000</strong></td>
            </tr>
            <tr>
                <td style="text-align: left">
                    Customer:<br>
                    <strong id="customer">-</strong>
                </td>
                <td style="text-align: right">
                    Cashier:<br>
                    <strong id="cashier">-</strong>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <p style="text-align: left">--= SALE TRANSACTION =--</p>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>Item</th>
                <th style="text-align:right; padding: 0px 1rem 0px 0px">Price</th>
                <th style="text-align:right;">Total</th>
            </tr>
        </thead>
        <tbody id="itemsTable">
            <!-- JavaScript will insert rows here -->
        </tbody>
    </table>

    <hr>

    <table class="totals" id="totalsTable">
        <!-- JavaScript will insert totals here -->
    </table>

    <div class="footer">
        <p>Thank you for your purchase!</p>
        <p>🐾 Come Again 🐾</p>
    </div>

    <script>
        const receiptData = JSON.parse(localStorage.getItem('receiptData'));
        console.log(receiptData)

        if (receiptData) {
            document.getElementById("date").textContent = new Date().toLocaleString();
            document.getElementById("customer").textContent = receiptData.customer_id === 0 ? "Walk-In" : "Customer #" +
                receiptData.customer_id;
            document.getElementById("receiptNo").textContent = receiptData.receipt_no ? '#' + receiptData.receipt_no :
                '#000000';
            document.getElementById("cashier").textContent = receiptData.cashier || "No cashier";


            const itemsTable = document.getElementById("itemsTable");
            const rows = receiptData.products.map(item => `
            <tr>
                <td>${item.qty}</td>
                <td style="padding: 0px 1rem">${item.name}</td>
                <td style="text-align:right; padding: 0px 1rem 0px 0px">₱${parseFloat(item.price).toFixed(2)}</td>
                <td style="text-align:right;">₱${(item.qty * item.price).toFixed(2)}</td>
            </tr>
        `).join("");
            itemsTable.innerHTML = rows;

            const totalsTable = document.getElementById("totalsTable");
            // <tr><td>Discount</td><td style="text-align:right;">%${parseFloat(receiptData.discount).toFixed(2)}</td></tr>

            totalsTable.innerHTML = `
            <tr><td>Sub Total</td><td style="text-align:right;">${(receiptData.subtotal)}</td></tr>
            <tr><td>Total</td><td style="text-align:right; font-size: 1rem">₱${parseFloat(receiptData.total).toFixed(2)}</td></tr>
            <tr><td>Cash</td><td style="text-align:right;">₱${parseFloat(receiptData.cash).toFixed(2)}</td></tr>
            <tr><td>Change</td><td style="text-align:right;">₱${parseFloat(receiptData.change).toFixed(2)}</td></tr>
        `;
        } else {
            document.body.innerHTML = "<p style='text-align:center;'>No receipt data found.</p>";
        }
    </script>

</body>

</html>
