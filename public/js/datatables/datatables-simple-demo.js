window.addEventListener("DOMContentLoaded", (event) => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById("datatablesSimple");
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }

    const billingTable = document.getElementById("billingTable");
    if (billingTable) {
        new simpleDatatables.DataTable(billingTable);
    }
    const petScheduleTable = document.getElementById("petSchedTable");
    if (petScheduleTable) {
        new simpleDatatables.DataTable(petScheduleTable, {});
    }
    const petHistoryTable = document.getElementById("petHistoryTable");
    if (petHistoryTable) {
        new simpleDatatables.DataTable(petHistoryTable, {});
    }
    const vaccinationTable = document.getElementById("vaccinationTable");
    if (vaccinationTable) {
        new simpleDatatables.DataTable(vaccinationTable, {});
    }
    const servicesListTable = document.getElementById("servicesListTable");
    if (servicesListTable) {
        new simpleDatatables.DataTable(servicesListTable, {});
    }
    const soapRecordTable = document.getElementById("soapRecordTable");
    if (soapRecordTable) {
        new simpleDatatables.DataTable(soapRecordTable, {
            perPage: 5,
            columns: [
                // Sort the second column (index 1) in ascending order
                { select: 0, sort: "desc" },
            ],
        });
    }
    const soapVetListTable = document.getElementById("soapVetListTable");
    if (soapVetListTable) {
        new simpleDatatables.DataTable(soapVetListTable, {
            perPage: 5,
        });

        // Add a click event listener to the table body using event delegation
        soapVetListTable
            .querySelector("tbody")
            .addEventListener("click", function (event) {
                const row = event.target.closest("tr"); // Get the clicked row
                if (row) {
                    // Get the data from the clicked row
                    const vet = {
                        id: row.cells[0].textContent.replace("VETIS-", ""), // Extract the ID without the prefix
                        firstname: row.cells[1].textContent.split(" ")[0], // Get the first name
                        lastname: row.cells[1].textContent.split(" ")[1], // Get the last name
                    };
                    selectVeterinarian(vet);
                }
            });
    }

    const treatmentPlanTable = document.getElementById("treatmentPlanTable");
    if (treatmentPlanTable) {
        new simpleDatatables.DataTable(treatmentPlanTable, {
            searchable: false, // Disables the search bar
            paging: false, // Disables pagination
            perPage: -1, // Shows all entries on a single page
            labels: {
                // Customize or remove label messages
                placeholder: "", // Search bar placeholder
                perPage: "{select} entries per page", // Label for perPage dropdown
                noRows: "------", // Message when no rows are available
                info: "", // Remove the "Showing X to Y of Z entries" message
            },
        });
    }

    const dailySalesReportsTable = document.getElementById(
        "dailySalesReportsTable"
    );
    if (dailySalesReportsTable) {
        new simpleDatatables.DataTable(dailySalesReportsTable);
    }

    const monthlySalesReportsTable = document.getElementById(
        "monthlySalesReportsTable"
    );
    if (monthlySalesReportsTable) {
        new simpleDatatables.DataTable(monthlySalesReportsTable);
    }

    const inventoryProductsTable = document.getElementById(
        "inventoryProductsTable"
    );
    if (inventoryProductsTable) {
        new simpleDatatables.DataTable(inventoryProductsTable);
    }
    const tablesWithDuplicateId = document.querySelectorAll("#inventoryStocksTable");
    tablesWithDuplicateId.forEach((table) => {
        new simpleDatatables.DataTable(table);
    });

    const inventorySuppliersTable = document.getElementById(
        "inventorySuppliersTable"
    );
    if (inventorySuppliersTable) {
        new simpleDatatables.DataTable(inventorySuppliersTable);
    }

    const inventoryCategoryTable = document.getElementById(
        "inventoryCategoryTable"
    );
    if (inventoryCategoryTable) {
        new simpleDatatables.DataTable(inventoryCategoryTable);
    }

    const inventoryUnitsTable = document.getElementById("inventoryUnitsTable");
    if (inventoryUnitsTable) {
        new simpleDatatables.DataTable(inventoryUnitsTable);
    }
});
