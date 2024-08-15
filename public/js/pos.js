Items = [];
discount = 0;
qty = 1;

customer = "";


function initTransaction() {
    discountText = document.getElementById("discount");
    discountText.textContent = `${discount}%`;

    customerText = document.getElementById("customer");
    customerText.textContent = customer;

}

function initItems(){
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

function setCustomer(c) {
    customer = c;

    initTransaction();

    console.log(customer);
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

}


function calculateTotal() {
    let total = 0;
    Items.forEach((item) => {
        total += item.price * item.qty;
    });

    subTotal = document.getElementById("subTotal");
    subTotal.textContent = parseFloat(total.toFixed(2));
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
