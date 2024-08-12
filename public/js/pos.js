Items = [];

const generateTableRows = (items) => {
    let tableRows = "";
    items.forEach((item) => {
        tableRows += `
            <tr>
                <td>${item.name}</td>
                <td>${item.sku}</td>
                <td>${item.qty}</td>
                <td>${item.price * item.qty}</td>
            </tr>
        `;
    });
    return tableRows;
};

function addItem(item) {
    Items.push({
        sku: item.sku,
        name: item.name,
        price: item.price,
        qty: item.qty,
    });


    initItems();
    calculateTotal();

}


function calculateTotal() {
    let total = 0;
    Items.forEach((item) => {
        total += item.price * item.qty;
    });

    subTotal = document.getElementById("subTotal");
    subTotal.textContent = total;
}

function initItems(){
    const itemsContainer = document.getElementById("ItemContainer");
    const tableRowsHTML = generateTableRows(Items);
    itemsContainer.innerHTML = tableRowsHTML;
}

document.addEventListener("DOMContentLoaded", () => {
    initItems();
});

function newTransaction() {
    Items.length = 0;
    initItems();
    calculateTotal();
}
