window.addEventListener("DOMContentLoaded", (event) => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById("datatablesSimple");
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
    const myScheduleTable = document.getElementById("myScheduleTable");
    if (myScheduleTable) {
        new simpleDatatables.DataTable(myScheduleTable, {
            searchable: false, // Disable the search box
            perPage: 5, // Show only 5 rows per page
            pagination: true, // Enable pagination
            perPageSelect: false,
        });
    }
    const petPrescriptionTable = document.getElementById(
        "petPrescriptionTable"
    );
    if (petPrescriptionTable) {
        new simpleDatatables.DataTable(petPrescriptionTable, {
            searchable: false, // Disable the search box
            perPage: 5, // Show only 5 rows per page
            pagination: true, // Enable pagination
            perPageSelect: false,
        });
    }
    const petInfoTable = document.getElementById(
        "petInfoTable"
    );
    if (petInfoTable) {
        new simpleDatatables.DataTable(petInfoTable, {
            searchable: false, // Disable the search box
            perPage: 5, // Show only 5 rows per page
            pagination: true, // Enable pagination
            perPageSelect: false,
            labels: {
                info: "" // hides the "Showing X to X of X entries" text
            }
        });
    }

    const petScheduledAppointmentsTable = document.getElementById(
        "petScheduledAppointmentsTable"
    );
    if (petScheduledAppointmentsTable) {
        new simpleDatatables.DataTable(petScheduledAppointmentsTable, {
            searchable: false, // Disable the search box
            perPage: 5, // Show only 5 rows per page
            pagination: true, // Enable pagination
            perPageSelect: false,
        });
    }
    const petAppointmentsHistoryTable = document.getElementById(
        "petAppointmentsHistoryTable"
    );
    if (petAppointmentsHistoryTable) {
        new simpleDatatables.DataTable(petAppointmentsHistoryTable, {
            searchable: false, // Disable the search box
            perPage: 5, // Show only 5 rows per page
            pagination: true, // Enable pagination
            perPageSelect: false,
        });
    }
    const scheduledAppointmentsTable = document.getElementById(
        "scheduledAppointmentsTable"
    );
    if (scheduledAppointmentsTable) {
        new simpleDatatables.DataTable(scheduledAppointmentsTable, {
            searchable: true, // Disable the search box
            perPage: 5, // Show only 5 rows per page
            pagination: true, // Enable pagination
            labels: {
                noRows: "No scheduled appointments at the moment",
            },
        });
    }
    const appointmentsRequestsTable = document.getElementById(
        "appointmentsRequestsTable"
    );
    if (appointmentsRequestsTable) {
        new simpleDatatables.DataTable(appointmentsRequestsTable, {
            searchable: true, // Disable the search box
            perPage: 5, // Show only 5 rows per page
            pagination: true, // Enable pagination
            labels: {
                noRows: "You have no pending appointment requests at the moment",
            },
        });
    }
    if (appointmentsHistoryTable) {
        new simpleDatatables.DataTable(appointmentsHistoryTable, {
            searchable: true, // Disable the search box
            perPage: 5, // Show only 5 rows per page
            pagination: true, // Enable pagination
            labels: {
                noRows: "You have no previous appointments in your history",
            },
        });
    }
    if (todaysAppointmentsTable) {
        new simpleDatatables.DataTable(todaysAppointmentsTable, {
            searchable: true, // Disable the search box
            perPage: 5, // Show only 5 rows per page
            pagination: true, // Enable pagination
            labels: {
                noRows: "You have no appointments for today",
            },
        });
    }
});
