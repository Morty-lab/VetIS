Items = [];
discount = 0;
qty = 1;
customer = "Walk-In";
customerID = 0;
grand_total = 0;
const posProdListTable = document.getElementById("posProdListTable");
const customSearchInput = document.getElementById("customSearchInput");
const modalElement = document.getElementById("exampleModalXl");

// Listen for the modal 'hidden' event, which is triggered when the modal is fully closed
modalElement.addEventListener("hidden.bs.modal", function () {
    // Clear the input field when the modal is closed
    if (customSearchInput) {
        customSearchInput.value = "";
    }
});



document.addEventListener("hidden.bs.modal", function (event) {
    const modal = event.target; // The modal that was closed
    const quantityInput = modal.querySelector('input[type="number"]');
    if (quantityInput) {
        quantityInput.value = ""; // Clear the input field
    }
});

const posStockListTable = document.getElementById("posStockListTable");
if (posStockListTable) {
    new simpleDatatables.DataTable(posStockListTable, {});
}

const posCustListTable = document.getElementById("posCustListTable");
if (posCustListTable) {
    new simpleDatatables.DataTable(posCustListTable, {
        perPage: 5,
    });
}

if (posProdListTable) {
    let dataTable = new simpleDatatables.DataTable(posProdListTable, {
        searchable: false,
        layout: {
            top: "", // This will hide the entire top section (search bar, per page dropdown)
        },
    });

    const dataTableWrapper = posProdListTable.closest(".datatable-wrapper");
    if (dataTableWrapper) {
        const topSection = dataTableWrapper.querySelector(".datatable-top");
        if (topSection) {
            topSection.style.display = "none"; // Hides the top section (search bar, per page dropdown)
        }
    }

    // Listen to the input event and call the DataTable search method
    customSearchInput.addEventListener("input", function () {
        const searchValue = customSearchInput.value;
        dataTable.search(searchValue);
    });
}

function setDiscount(d){
    discount = d
    discountText = document.querySelectorAll(".discount");
    discountText.forEach((element) => {
        element.textContent = `${discount}%`;
    });


}

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

function enforceMaxValue(input) {
    const max = parseInt(input.max, 10); // Get the max value from the attribute
    const value = parseInt(input.value, 10); // Get the current input value

    if (value > max) {
        input.value = max; // Set the value to the maximum allowed value
    }
}

function initItems() {
    const itemsContainer = document.getElementById("ItemContainer");
    const tableRowsHTML = generateTableRows(Items);
    itemsContainer.innerHTML = tableRowsHTML;

    const removeButtons = document.querySelectorAll(".btn-remove");
    removeButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            removeItem(index);
        });
    });
}

function removeItem(index) {
    // Remove the item from the Items array
    Items.splice(index, 1);

    // Re-render the table and recalculate totals
    initItems();
    calculateTotal();
    calculateGrandTotal();
}
const generateTableRows = (items) => {
    let tableRows = "";
    items.forEach((item, index) => {
        tableRows += `
            <tr>
                <td class="align-middle">${item.name}</td>
                <td class="align-middle">${item.sku}</td>
                <td class="align-middle">${item.qty} x ${parseFloat(
            item.price
        ).toFixed(2)}</td>
                <td class="align-middle">₱${parseFloat(
                    item.price * item.qty
                ).toFixed(2)}</td>
                <td class="align-middle">
                    <button class="btn btn-remove">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });
    return tableRows;
};

function setQuantity(quantity, stock) {
    inputQ = document.getElementById('quantityInput');
    if(quantity <= stock){
        qty = quantity;

    }else{
        alert('Not Enough Stocks')
        inputQ.value = null;
    }
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

    if (CASH_GIVEN_CENTS < GRAND_TOTAL_CENTS) {
        console.log(grandTotal, cashGiven);
        alert("Insufficient cash given.");
        return null;
    }

    const customerID = document.getElementById("customer_id");
    customerID.value = customerId;
    const sub_total = document.getElementById("sub_total");
    sub_total.value = calculateTotal();
    const discount = document.getElementById("discountInput");
    discount.value = totalDiscount;

    const productsInput = document.getElementById("products");
    productsInput.value = JSON.stringify(productIdsAndPrices);

    return true;
}

function handlePayment() {
    event.preventDefault();

    const cashGivenInput = document.getElementById("cashGivenInput");
    const grandTotal = Number(grand_total.replace(/,/g, ''));
    const customerId = customerID;
    const subtotal = document.querySelector(".sub-total").textContent;
    const products = Items;
    const transactionDetails = generateTransactionDetails(
        cashGivenInput.value,
        grandTotal,
        customerId,
        discount,
        subtotal,
        products
    );

    if (transactionDetails !== null) {
        var change = document.getElementById("change");
        var cash = document.getElementById("cash");
        var change_cash = document.getElementById("change-cash");
        var cashgivvendiv = document.getElementById('cashGivenDiv');
        cash.textContent = cashGivenInput.value;
        change.style.display = "block";
        cashgivvendiv.style.display = 'none';
        change_cash.textContent =  (cashGivenInput.value - grandTotal).toFixed(2);

        console.log(cashGivenInput.value)
        console.log(grandTotal)


        setTimeout(() => {
            document.getElementById("paymentForm").submit();
        }, 5000);
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

// function search() {
//     // Get the search input value
//     var searchValue = document
//         .querySelector(".form-control.mb-4")
//         .value.toLowerCase();

//     // Get all table rows
//     var rows = document.querySelectorAll(".table tbody tr");

//     // Loop through each row
//     for (var i = 0; i < rows.length; i++) {
//         var row = rows[i];

//         // Get the text content of each cell in the row
//         var sku = row
//             .querySelector("td:nth-child(1)")
//             .textContent.toLowerCase();
//         var itemName = row
//             .querySelector("td:nth-child(2)")
//             .textContent.toLowerCase();
//         var category = row
//             .querySelector("td:nth-child(3)")
//             .textContent.toLowerCase();

//         // Check if any cell's text matches the search value
//         if (
//             sku.includes(searchValue) ||
//             itemName.includes(searchValue) ||
//             category.includes(searchValue)
//         ) {
//             // Show the row if it matches the search criteria
//             row.style.display = "";
//         } else {
//             // Hide the row if it doesn't match
//             row.style.display = "none";
//         }
//     }
// }

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
