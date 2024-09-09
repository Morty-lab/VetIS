Items = [];
discount = 5;
qty = 1;
customer = "";
customerID = 0;
grand_total = 0;

function initTransaction() {
    discountText = document.querySelectorAll(".discount");
    discountText.forEach((element) => {
        element.textContent = `${discount}%`;
    });

    var customerElements = document.querySelectorAll(".customer");

    customerElements.forEach(function (element) {
        element.textContent = customer;
    });
}

function initItems() {
    const itemsContainer = document.getElementById("ItemContainer");
    const tableRowsHTML = generateTableRows(Items);
    itemsContainer.innerHTML = tableRowsHTML;
}

const generateTableRows = (items) => {
    let tableRows = "";
    items.forEach((item) => {
        tableRows += `
            <tr>
                <td>${item.name}</td>
                <td>${item.sku}</td>
                <td>${item.qty}</td>
                <td>${parseFloat(item.price * item.qty).toFixed(2)}</td>
            </tr>
        `;
    });
    return tableRows;
};

function setQuantity(q) {
    qty = q;
}

function setCustomer(c, cid) {
    customer = c;
    customerID = cid;

    initTransaction();


}

function generateTransactionDetails(
    cashGiven,
    grandTotal,
    customerId,
    totalDiscount,
    subtotal,
    products
) {
    if (products.length === 0) {
        alert("No items in cart.");
        return null;
    }
    // Assuming products is an array of objects where each object contains productId and currentPrice
    const productIdsAndPrices = products.map((product) => ({
        productId: product.sku,
        currentPrice: product.price,
        quantity: product.qty,
    }));

    const GRAND_TOTAL_CENTS = Math.round(grandTotal * 100);
    const CASH_GIVEN_CENTS = Math.round(cashGiven * 100);


    if ( CASH_GIVEN_CENTS < GRAND_TOTAL_CENTS) {
        console.log(grandTotal,cashGiven);
        alert("Insufficient cash given.");
        return null;
    }

    const customerID = document.getElementById("customer_id");
    customerID.value = customerId;
    const sub_total = document.getElementById("sub_total");
    sub_total.value = calculateTotal();
    const discount = document.getElementById("discount");
    discount.value = totalDiscount;
    const productsInput = document.getElementById("products");
    productsInput.value = JSON.stringify(productIdsAndPrices);

    return true;
}

function handlePayment() {
    event.preventDefault();

    const cashGivenInput = document.getElementById("cashGivenInput");
    const grandTotal = grand_total;
    const customerId = customerID;
    const totalDiscount = discount;
    const subtotal = document.querySelector(".sub-total").textContent;
    const products = Items;
    const transactionDetails = generateTransactionDetails(
        cashGivenInput.value,
        grandTotal,
        customerId,
        totalDiscount,
        subtotal,
        products
    );





    if (transactionDetails !== null) {
        var change = document.getElementById("change");
        var cash = document.getElementById("cash");
        var change_cash = document.getElementById("change-cash");
        cash.textContent = cashGivenInput.value
        change.style.display = "block"
        change_cash.textContent = cashGivenInput.value  - grand_total;


        setTimeout(()=>{
            document.getElementById("paymentForm").submit();
        },5000);



    }
}
function addItem(item) {
    Items.push({
        sku: item.sku,
        name: item.name,
        price: item.price,
        qty: parseInt(qty),
    });

    qty = 1;
    initItems();
    calculateTotal();
    calculateGrandTotal();
}

function search() {
    // Get the search input value
    var searchValue = document.querySelector('.form-control.mb-4').value.toLowerCase();

    // Get all table rows
    var rows = document.querySelectorAll('.table tbody tr');

    // Loop through each row
    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];

        // Get the text content of each cell in the row
        var sku = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
        var itemName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        var category = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

        // Check if any cell's text matches the search value
        if (sku.includes(searchValue) || itemName.includes(searchValue) || category.includes(searchValue)) {
            // Show the row if it matches the search criteria
            row.style.display = '';
        } else {
            // Hide the row if it doesn't match
            row.style.display = 'none';
        }
    }
}



function calculateTotal() {
    let total = 0;
    Items.forEach((item) => {
        total += item.price * item.qty;
    });

    subTotal = document.querySelectorAll(".sub-total");

    subTotal.forEach((element) => {
        element.textContent = new Intl.NumberFormat().format(total);
    });

    return total;
}

function calculateGrandTotal() {
    let total = 0;
    Items.forEach((item) => {
        total += item.price * item.qty;
    });
    total = total - total * (discount / 100);
    grand_total = new Intl.NumberFormat().format(total);
    grandTotal = document.querySelectorAll(".grand-total");
    grandTotal.forEach((element) => {
        element.textContent = new Intl.NumberFormat().format(total);
    });


}

document.addEventListener("DOMContentLoaded", () => {
    initTransaction();
    initItems();
});

function newTransaction() {
    Items.length = 0;
    initItems();
    calculateTotal();
}

// document
//     .getElementById("paymentForm")
//     .addEventListener("submit", handlePayment);
