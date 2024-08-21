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

    console.log(customer);
}

function generateTransactionDetails(
    cashGiven,
    grandTotal,
    customerId,
    transactionDateTime,
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
        quantity: product.qtys,
    }));

    if (grandTotal <= cashGiven) {
        console.log(grandTotal);

        console.log(cashGiven);
        return {
            customerId: customerId,
            transactionDateTime: transactionDateTime,
            totalDiscount: `${totalDiscount}%`,
            subtotal: subtotal,
            productIdsAndPrices: productIdsAndPrices,
        };
    } else {
        alert("Insufficient cash given.");
        return null; // Return null or throw an error if cash given is less than grand total
    }
}

function handlePayment() {
    event.preventDefault();

    const cashGivenInput = document.getElementById("cashGivenInput");
    const grandTotal = grand_total;
    const customerId = customerID;
    const transactionDateTime = new Date().toISOString();
    const totalDiscount = discount;
    const subtotal = document.querySelector(".sub-total").textContent;
    const products = Items;
    const transactionDetails = generateTransactionDetails(
        cashGivenInput.value,
        grandTotal,
        customerId,
        transactionDateTime,
        totalDiscount,
        subtotal,
        products
    );

    if (transactionDetails !== null) {
        // document.getElementById("paymentForm").submit();

        console.log(transactionDetails);
    }
}
function addItem(item) {
    Items.push({
        sku: item.sku,
        name: item.name,
        price: item.price,
        qty: qty,
    });

    qty = 1;
    initItems();
    calculateTotal();
    calculateGrandTotal();
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

    // console.log(grand_total);
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
