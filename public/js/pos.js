Items = [];
discount = 0;
qty = 1;
customer = "Walk-In";
customerID = 0;
grand_total = 0;
currentProductStock = 0;
let currentEditIndex = -1;

// Object to track the quantity added for each product (by SKU or id)
let addedQuantities = {};

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

function toggleProceedPaymentButton() {
    const proceedBtn = document.getElementById("proceedPaymentContainer");
    if (Items.length > 0) {
        proceedBtn.style.display = "block";
    } else {
        proceedBtn.style.display = "none";
    }
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

function setDiscount(d) {
    discount = d;
    discountText = document.querySelectorAll(".discount");
    discountText.forEach((element) => {
        element.textContent = `${discount}%`;
    });
}

function initTransaction() {
    discountText = document.querySelectorAll(".discount");
    discountText.forEach((element) => {
        element.textContent = discount === 0 ? "--" : `${discount}%`;
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

    const editButtons = document.querySelectorAll(".btn-edit");
    editButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            openEditModal(index);
        });
    });
}

function removeItem(index) {
    // Get the item being removed from the Items array
    const item = Items[index];
    const sku = item.sku;
    const quantityToRemove = item.qty;

    // Remove the item from the Items array
    Items.splice(index, 1);

    // Adjust the added quantity in the addedQuantities object
    if (addedQuantities[sku]) {
        addedQuantities[sku] -= quantityToRemove;

        // Ensure that the added quantity doesn't go below zero
        if (addedQuantities[sku] < 0) {
            addedQuantities[sku] = 0;
        }
    }

    // Recalculate totals after removal
    initItems();
    calculateTotal();
    calculateGrandTotal();
    toggleProceedPaymentButton();

    // Optional: Log added quantities to ensure tracking is correct
    console.log('Added Quantities:', addedQuantities);
}

function openEditModal(index) {
    currentEditIndex = index;

    const item = Items[index];
    document.getElementById("newquantityInput").value = item.qty;
    document.getElementById("productName").textContent = item.name;
    document.getElementById("productIdInput").value = item.sku;

    // Get stock data for this product from the hidden input
    const stockElement = document.querySelector(`[data-product-stock="${item.sku}"]`);
    if (stockElement) {
        currentProductStock = parseInt(stockElement.value);
        console.log(`Stock for product ${item.sku}: ${currentProductStock}`);
    } else {
        console.log(`No stock data found for product ${item.sku}`);
    }

    const modal = new bootstrap.Modal(document.getElementById("editQtyModal"));
    modal.show();
}

const generateTableRows = (items) => {
    let tableRows = "";
    items.forEach((item, index) => {
        tableRows += `
            <tr>
                <td class="align-middle">${item.name}</td>
                <td class="align-middle">₱${parseFloat(
            item.price
        ).toFixed(2)}</td>
                <td class="align-middle">x ${item.qty}</td>
                <td class="align-middle">₱${new Intl.NumberFormat('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(
            item.price * item.qty
        )}</td>
                <td class="align-middle">
                    <button class="btn btn-remove btn-datatable" title="Remove Item" onmouseover="this.style.backgroundColor='#f8d7da';" onmouseout="this.style.backgroundColor='';">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                     <button class="btn btn-edit btn-datatable" title="Edit Item" onmouseover="this.style.backgroundColor='#d1ecf1';" onmouseout="this.style.backgroundColor='';">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                </td>
            </tr>`;
    });
    return tableRows;
};

// Update the setQuantity function to consider the quantity already added
function setQuantity(quantity, stock, productId) {
    let inputQ = document.getElementById('quantityInputs' + productId);
    let errorMessage = document.getElementById('qty-error-message' + productId);

    // Check if the SKU already exists in the addedQuantities object
    if (!addedQuantities[productId]) {
        addedQuantities[productId] = 0;
    }

    // Calculate the remaining stock
    let remainingStock = stock - addedQuantities[productId];

    // Prevent negative or zero quantity
    if (quantity <= 0) {
        inputQ.value = '';
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'Quantity must be greater than zero';
        inputQ.classList.add('is-invalid');
        return;
    }

    // Prevent quantity exceeding the remaining stock
    if (quantity > remainingStock) {
        inputQ.value = '';
        errorMessage.style.display = 'block';
        errorMessage.textContent = `Quantity exceeds remaining stock. Only ${remainingStock} left.`;
        inputQ.classList.add('is-invalid');
        return;
    }

    // If valid, update the quantity and hide error messages
    qty = quantity;
    errorMessage.style.display = 'none';
    inputQ.classList.remove('is-invalid');
}

function setNewQuantity(quantity) {
    const inputQ = document.getElementById('newquantityInput');
    const errorMessage = document.getElementById('error-message');
    const productId = document.getElementById('productIdInput').value;

    // Ensure that quantity is a number (parse it as an integer)
    quantity = parseInt(quantity, 10);

    // Prevent zero or negative quantity
    if (quantity <= 0 || isNaN(quantity)) {
        inputQ.value = '';
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'Quantity must be greater than zero';
        inputQ.classList.add('is-invalid');
        return false;
    }

    // Get the current item being edited
    const currentItem = Items[currentEditIndex];

    // Calculate total quantity of this product in Items array, excluding the current item
    const otherQuantities = Items.reduce((sum, item, index) => {
        return (item.sku == productId && index !== currentEditIndex) ? sum + parseInt(item.qty) : sum;
    }, 0);

    console.log(`Current stock: ${currentProductStock}, Other quantities: ${otherQuantities}, New quantity: ${quantity}`);

    // Check if the new quantity exceeds available stock
    if (quantity > (currentProductStock - otherQuantities)) {
        inputQ.value = '';
        errorMessage.style.display = 'block';
        errorMessage.textContent = `Not enough stock. Only ${currentProductStock - otherQuantities} available.`;
        inputQ.classList.add('is-invalid');
        return false;
    }

    // Valid quantity
    errorMessage.style.display = 'none';
    inputQ.classList.remove('is-invalid');
    return true;
}

function setCustomer(c, cid) {
    customer = c;
    customerID = cid;

    initTransaction();
}

document.getElementById("cashGivenInput").addEventListener("input", function () {
    const input = this.value;
    const errorElement = document.getElementById("cashError");

    // Allow only digits and an optional single decimal point
    const valid = /^\d*\.?\d*$/.test(input);

    if (!valid) {
        this.classList.add("is-invalid");
        errorElement.textContent = "Please enter a valid number.";
        errorElement.classList.remove("d-none");
    } else {
        this.classList.remove("is-invalid");
        errorElement.classList.add("d-none");
    }
});

const cashInput = document.getElementById("cashGivenInput");
const cashError = document.getElementById("cashError");

// Prevent typing invalid characters
cashInput.addEventListener("keypress", function (e) {
    const char = String.fromCharCode(e.which);
    const isValid = /^[0-9.]$/.test(char);

    // Block if not a digit or a period
    if (!isValid) {
        e.preventDefault();
    }

    // Only allow one decimal point
    if (char === "." && this.value.includes(".")) {
        e.preventDefault();
    }
});

// Prevent pasting invalid characters
cashInput.addEventListener("paste", function (e) {
    const pasted = e.clipboardData.getData("text");
    if (!/^\d*\.?\d*$/.test(pasted)) {
        e.preventDefault();
    }
});

// Handle input errors
cashInput.addEventListener("input", function () {
    const valid = /^\d*\.?\d*$/.test(this.value);

    if (!valid) {
        this.classList.add("is-invalid");
        cashError.classList.remove("d-none");
    } else {
        this.classList.remove("is-invalid");
        cashError.classList.add("d-none");
    }
});

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
        const cashInput = document.getElementById("cashGivenInput");
        const errorElement = document.getElementById("cashError");
        cashInput.classList.add("is-invalid");
        errorElement.textContent = "Insufficient cash given.";
        errorElement.classList.remove("d-none");
        return null;
    } else {
        // Clear error if cash is sufficient
        document.getElementById("cashGivenInput").classList.remove("is-invalid");
        document.getElementById("cashError").classList.add("d-none");
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
    const grandTotal = parseFloat(grand_total.replace(/,/g, '')).toFixed(2);
    const customerId = customerID;
    const subtotal = document.querySelector(".sub-total").textContent;
    const products = Items;
    const cashier = document.getElementById('authUserName').textContent || "Unknown User";
    const transaction = document.getElementById('receiptNumber').textContent || "00";
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
        var progressBar = document.getElementById('progressBar');

        cash.textContent = '₱' + cashGivenInput.value;
        change.style.display = "block";
        cashgivvendiv.style.display = 'none';
        change_cash.textContent = '₱' + (cashGivenInput.value - grandTotal).toFixed(2);
        console.log(cashGivenInput.value);
        console.log(grandTotal);

        // Animate progress bar for 5 seconds
        let start = null;
        const duration = 20000;

        function animateProgress(timestamp) {
            if (!start) start = timestamp;
            const elapsed = timestamp - start;
            const progress = Math.min((elapsed / duration) * 100, 100);

            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress.toFixed(0));

            if (progress < 100) {
                requestAnimationFrame(animateProgress);
            }
        }

        // Disable escape key during the timeout period
        function disableEscapeKey(event) {
            if (event.key === "Escape") {
                event.preventDefault(); // Disable escape key press
            }
        }

        // Add event listener to disable escape key
        document.addEventListener('keydown', disableEscapeKey);

        // Hide the payment close modal for 20 seconds
        const paymentCloseModal = document.getElementById("paymentCloseModal");
        paymentCloseModal.style.display = 'none'; // Hide the modal

        // Show modal again after 20 seconds
        setTimeout(() => {
            paymentCloseModal.style.display = 'block'; // Show the modal again
            document.removeEventListener('keydown', disableEscapeKey); // Re-enable escape key
        }, 20000);


        requestAnimationFrame(animateProgress);

        const printReceiptButton = document.getElementById('printReceiptButton'); // Assuming this is the button's ID
        printReceiptButton.addEventListener('click', () => {
            // Save to localStorage
            localStorage.setItem("receiptData", JSON.stringify({
                customer_id: customerId,
                products: products, // [{ name: "Item", price: 100, quantity: 2 }]
                subtotal: subtotal,
                discount: discount,
                total: grandTotal,
                cash: cashGivenInput.value,
                cashier: cashier,
                change: (cashGivenInput.value - grandTotal).toFixed(2),
                receipt_no: transaction // optional
            }));

            // Open receipt page
            const newTab = window.open('/pos/receipt', '_blank');

            document.getElementById("paymentForm").submit();
        });

        const newTransactionButton = document.getElementById('newTransactionButton'); // Assuming this is the button's ID
        newTransactionButton.addEventListener('click', () => {
            document.getElementById("paymentForm").submit();
        });

        setTimeout(() => {
            document.getElementById("paymentForm").submit();
        }, 20000);
    }
}

function addItem(item) {
    // Check if the SKU already exists in the Items array
    let existingItem = Items.find(i => i.sku === item.sku);
    if (existingItem) {
        // Update the quantity of the existing item
        const remainingStock = item.stock - addedQuantities[item.sku] + existingItem.qty;
        if (qty > remainingStock) {
            alert("Quantity exceeds remaining stock.");
            return;
        }
        existingItem.qty += parseInt(qty);  // Increase the quantity of the existing item in the cart
    } else {
        // If item doesn't exist in the cart, add it as a new entry
        if (qty > item.stock) {
            alert("Quantity exceeds available stock.");
            return;
        }
        Items.push({
            sku: item.sku,
            barcode: item.barcode,
            name: item.name,
            price: item.price,
            qty: parseInt(qty),
        });
    }

    // Update the added quantity for this product (whether new or updated)
    addedQuantities[item.sku] = Items.reduce((sum, i) => i.sku === item.sku ? sum + i.qty : sum, 0);

    // Reset quantity after adding the item
    qty = 1;

    // Recalculate totals
    initItems();
    calculateTotal();
    calculateGrandTotal();
    toggleProceedPaymentButton();

    console.log("Items:", Items);
    console.log("Added Quantities:", addedQuantities);
}

function calculateTotal() {
    let total = 0;
    Items.forEach((item) => {
        total += item.price * item.qty;
    });

    subTotal = document.querySelectorAll(".sub-total");

    subTotal.forEach((element) => {
        element.textContent = `₱${new Intl.NumberFormat('en-PH', { minimumFractionDigits: 2 }).format(total)}`;
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

function clearTransaction() {
    // Clear items
    Items.length = 0;

    // Reset values
    discount = 0;
    qty = 1;
    customer = "Walk-In";
    customerID = 0;
    grand_total = 0;

    // Reset input fields
    const cashGivenInput = document.getElementById("cashGivenInput");
    if (cashGivenInput) cashGivenInput.value = "";

    const change = document.getElementById("change");
    const changeCash = document.getElementById("change-cash");
    const cashText = document.getElementById("cash");
    const cashGivenDiv = document.getElementById("cashGivenDiv");

    if (change) change.style.display = "none";
    if (cashGivenDiv) cashGivenDiv.style.display = "block";
    if (changeCash) changeCash.textContent = "";
    if (cashText) cashText.textContent = "";

    // Reset progress bar
    const progressBar = document.getElementById("progressBar");
    if (progressBar) {
        progressBar.style.width = "0%";
        progressBar.setAttribute("aria-valuenow", "0");
    }

    // Reinitialize everything
    initTransaction();
    initItems();
    calculateTotal();
    calculateGrandTotal();
}

function confirmEdit() {
    const newQty = parseInt(document.getElementById("newquantityInput").value);

    if (!newQty || isNaN(newQty) || newQty < 1) {
        alert("Invalid quantity");
        return;
    }

    // Validate the quantity using our validation function
    if (!setNewQuantity(newQty)) {
        return; // Exit if validation fails
    }

    // If validation passes, update the item
    const item = Items[currentEditIndex];
    const productId = item.sku;

    // Calculate the change in quantity for tracking purposes
    const oldQty = item.qty;
    const qtyDifference = newQty - oldQty;

    // Update the item quantity
    item.qty = newQty;

    // Update the addedQuantities to reflect this change
    addedQuantities[productId] = (addedQuantities[productId] || 0) + qtyDifference;

    console.log(`Updated item: ${item.name}, New quantity: ${newQty}, Added quantities: ${addedQuantities[productId]}`);

    // Update display and calculations
    initItems();
    calculateTotal();
    calculateGrandTotal();
    toggleProceedPaymentButton();

    // Close the modal
    bootstrap.Modal.getInstance(document.getElementById("editQtyModal")).hide();
}


