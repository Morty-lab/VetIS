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
            perPage: 10, // Show only 5 rows per page
            pagination: true, // Enable pagination
        });
    }
    const appointmentsRequestsTable = document.getElementById(
        "appointmentsRequestsTable"
    );
    if (appointmentsRequestsTable) {
        new simpleDatatables.DataTable(appointmentsRequestsTable, {
            searchable: true, // Disable the search box
            perPage: 10, // Show only 5 rows per page
            pagination: true, // Enable pagination
        });
    }
});
