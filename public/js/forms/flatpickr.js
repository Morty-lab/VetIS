flatpickr("#inputBirthdate", {
    dateFormat: "Y-m-d", // format like 2025-03-13
    maxDate: "today",     // Restrict selection to today or earlier
    disableMobile: "true"
});

flatpickr("#UMInputBirthdate", {
    dateFormat: "Y-m-d", // format like 2025-03-13
    maxDate: "today",     // Restrict selection to today or earlier
    disableMobile: "true"
});

flatpickr("#inputAntiRabiesDate", {
    dateFormat: "Y-m",    // year and month only
    maxDate: "today",     // restrict future dates
    disableMobile: "true",
    plugins: [
        new monthSelectPlugin({
            shorthand: true,    // optional: show shorthand months (e.g., "Jan", "Feb")
            dateFormat: "Y-m",  // display format
            altFormat: "F Y",   // human-friendly format (optional)
        })
    ]
});

flatpickr("#inputLastGroom", {
    dateFormat: "Y-m",    // year and month only
    maxDate: "today",     // restrict future dates
    disableMobile: "true",
    plugins: [
        new monthSelectPlugin({
            shorthand: true,    // optional: show shorthand months (e.g., "Jan", "Feb")
            dateFormat: "Y-m",  // display format
            altFormat: "F Y",   // human-friendly format (optional)
        })
    ]
});

document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#select-schedule", {
        dateFormat: "Y-m-d", // Format for the selected date (equivalent to Litepicker's 'YYYY-MM-DD')
        minDate: "today", // Disallow past dates
        maxDate: new Date().fp_incr(60), // Limit to 2 months ahead (60 days)
    });
});
