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
});
