$(document).ready(function () {
    $("#inputOwnerName").on("change", function () {
        fetchOwnedPets($(this).val());
    });

    $(".select-pet-type").select2({
        theme: "bootstrap-5",
        tags: true, // Allow users to add new values
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });
    $(".edit-select-pet-type").select2({
        theme: "bootstrap-5",
        tags: true, // Allow users to add new values
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });
    $(".select-pet-gender").select2({
        theme: "bootstrap-5",
        minimumResultsForSearch: Infinity,
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });
    $(".edit-select-pet-gender").select2({
        theme: "bootstrap-5",
        minimumResultsForSearch: Infinity,
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });
    $(".select-pet-owner").select2({
        theme: "bootstrap-5",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });
    $(".select-pet-vaccination-record").select2({
        theme: "bootstrap-5",
        minimumResultsForSearch: Infinity,
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });
    $(".edit-select-pet-vaccination-record").select2({
        theme: "bootstrap-5",
        minimumResultsForSearch: Infinity,
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    // Schedule Appointment Admin Side

    $(".select-appointment-time-admin").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#appointmentSchedModal"),
        minimumResultsForSearch: Infinity,
        width: function () {
            return $(this).data("width")
                ? $(this).data("width")
                : $(this).hasClass("w-100")
                ? "100%"
                : "style";
        },
        placeholder: function () {
            return $(this).data("placeholder");
        },
    });

    setTimeout(function () {
        $(".select-appointment-time-admin").each(function () {
            let $select = $(this);
            let select2Container = $select.next(
                ".select2-container--bootstrap-5"
            );

            // Find the selection element (where the background image is set)
            let selectionSingle = select2Container.find(
                ".select2-selection--single"
            );

            if (selectionSingle.length) {
                selectionSingle.css({
                    "background-image":
                        "url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2724%27 height=%2724%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%2369707a%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3E%3Ccircle cx=%2712%27 cy=%2712%27 r=%2710%27/%3E%3Cpolyline points=%2712 6 12 12 16 14%27/%3E%3C/svg%3E')",
                    "background-size": "16px 16px",
                    "background-position": "right 0.75rem center",
                    "background-repeat": "no-repeat",
                    color: "#69707a !important",
                });
            }
        });
    }, 100);

    $(".select-appointment-time-edit").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#editAppointmentModal"),
        minimumResultsForSearch: Infinity,
        width: function () {
            return $(this).data("width")
                ? $(this).data("width")
                : $(this).hasClass("w-100")
                ? "100%"
                : "style";
        },
        placeholder: function () {
            return $(this).data("placeholder");
        },
    });
    setTimeout(function () {
        $(".select-appointment-time-edit").each(function () {
            let $select = $(this);
            let select2Container = $select.next(
                ".select2-container--bootstrap-5"
            );

            // Find the selection element (where the background image is set)
            let selectionSingle = select2Container.find(
                ".select2-selection--single"
            );

            if (selectionSingle.length) {
                selectionSingle.css({
                    "background-image":
                        "url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2724%27 height=%2724%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%2369707a%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3E%3Ccircle cx=%2712%27 cy=%2712%27 r=%2710%27/%3E%3Cpolyline points=%2712 6 12 12 16 14%27/%3E%3C/svg%3E')",
                    "background-size": "16px 16px",
                    "background-position": "right 0.75rem center",
                    "background-repeat": "no-repeat",
                    color: "#69707a !important",
                });
            }
        });
    }, 100);

    $(".select-attending-vet-edit").select2({
        theme: "bootstrap-5",
        dropdownParent: "#editAppointmentModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    $(".select-attending-vet").select2({
        theme: "bootstrap-5",
        dropdownParent: "#appointmentSchedModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    $(".select-owner-name").select2({
        theme: "bootstrap-5",
        dropdownParent: "#appointmentSchedModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    $(".select-pet-name").select2({
        theme: "bootstrap-5",
        dropdownParent: "#appointmentSchedModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
        disabled: true,
    });


    // $(".select-pet-name").select2({
    //     theme: "bootstrap-5",
    //     dropdownParent: "#appointmentSchedModal",
    //     width: $(this).data("width")
    //         ? $(this).data("width")
    //         : $(this).hasClass("w-100")
    //         ? "100%"
    //         : "style",
    //     placeholder: $(this).data("placeholder"),
    // });


    $(".select-reason-of-visit").select2({
        theme: "bootstrap-5",
        dropdownParent: "#appointmentSchedModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    //     Portal

    $(".select-pet-portal").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#appointmentRequestModal"),
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    $(".select-reason-of-visit-portal").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#appointmentRequestModal"),
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    $(".select-appointment-time").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#appointmentRequestModal"),
        minimumResultsForSearch: Infinity,
        width: function () {
            return $(this).data("width")
                ? $(this).data("width")
                : $(this).hasClass("w-100")
                ? "100%"
                : "style";
        },
        placeholder: function () {
            return $(this).data("placeholder");
        },
    });
    setTimeout(function () {
        $(".select-appointment-time").each(function () {
            let $select = $(this);
            let select2Container = $select.next(
                ".select2-container--bootstrap-5"
            );

            // Find the selection element (where the background image is set)
            let selectionSingle = select2Container.find(
                ".select2-selection--single"
            );

            if (selectionSingle.length) {
                selectionSingle.css({
                    "background-image":
                        "url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2724%27 height=%2724%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%2369707a%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3E%3Ccircle cx=%2712%27 cy=%2712%27 r=%2710%27/%3E%3Cpolyline points=%2712 6 12 12 16 14%27/%3E%3C/svg%3E')",
                    "background-size": "16px 16px",
                    "background-position": "right 0.75rem center",
                    "background-repeat": "no-repeat",
                    color: "#69707a !important",
                });
            }
        });
    }, 100);

    $(".select-appointment-time-edit-portal").select2({
        theme: "bootstrap-5",
        dropdownParent: $("#editAppointmentRequestModal"),
        minimumResultsForSearch: Infinity,
        width: function () {
            return $(this).data("width")
                ? $(this).data("width")
                : $(this).hasClass("w-100")
                ? "100%"
                : "style";
        },
        placeholder: function () {
            return $(this).data("placeholder");
        },
    });
    setTimeout(function () {
        $(".select-appointment-time-edit-portal").each(function () {
            let $select = $(this);
            let select2Container = $select.next(
                ".select2-container--bootstrap-5"
            );

            // Find the selection element (where the background image is set)
            let selectionSingle = select2Container.find(
                ".select2-selection--single"
            );

            if (selectionSingle.length) {
                selectionSingle.css({
                    "background-image":
                        "url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2724%27 height=%2724%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%2369707a%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3E%3Ccircle cx=%2712%27 cy=%2712%27 r=%2710%27/%3E%3Cpolyline points=%2712 6 12 12 16 14%27/%3E%3C/svg%3E')",
                    "background-size": "16px 16px",
                    "background-position": "right 0.75rem center",
                    "background-repeat": "no-repeat",
                    color: "#69707a !important",
                });
            }
        });
    }, 100);
    $(".select-veterinarian").select2({
        theme: "bootstrap-5",
        dropdownParent: "#appointmentRequestModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    $(".select-pet").select2({
        theme: "bootstrap-5",
        dropdownParent: "#editAppointmentRequestModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    $(".edit-rov").select2({
        theme: "bootstrap-5",
        dropdownParent: "#editAppointmentRequestModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    $(".select-vet").select2({
        theme: "bootstrap-5",
        dropdownParent: "#editAppointmentRequestModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });

    //     Medical Record
    $(".select-med").select2({
        theme: "bootstrap-5",
        tags: true, // Allow users to add new values
        placeholder: "Select or type medication",
        allowClear: true,
    });
    $(".select-proc").select2({
        theme: "bootstrap-5",
        tags: true, // Allow users to add new values
        placeholder: "Select or type procedure",
        allowClear: true,
    });
    $(".med-type").select2({
        theme: "bootstrap-5",
        minimumResultsForSearch: -1,
        placeholder: "Medication Type",
    });
    $(".vac-type").select2({
        theme: "bootstrap-5",
        minimumResultsForSearch: -1,
        placeholder: "Select Vaccination Type",
    });

    $(".select-pet-owner-billing").select2({
        theme: "bootstrap-5",
        dropdownParent: "#addBilling",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
                ? "100%"
                : "style",
        placeholder: $(this).data("placeholder"),
    });
    $(".select-veterinarian-billing").select2({
        theme: "bootstrap-5",
        dropdownParent: "#addBilling",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
                ? "100%"
                : "style",
        placeholder: $(this).data("placeholder"),
    });


    // Billing Form Payment
    $(".billing-payment-type").select2({
        theme: "bootstrap-5",
        dropdownParent: "#paymentModal",
        minimumResultsForSearch: -1,
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
                ? "100%"
                : "style",
        placeholder: $(this).data("placeholder"),
    });
    $(".billing-discount-type").select2({
        theme: "bootstrap-5",
        dropdownParent: "#paymentModal",
        allowClear: true,
        minimumResultsForSearch: -1,
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
                ? "100%"
                : "style",
        placeholder: $(this).data("placeholder"),
    });

    // Vac
    $(".vac-select-vet-name").select2({
        theme: "bootstrap-5",
        dropdownParent: "#addDoseModal",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
    });
});

function fetchOwnedPets(ownerID) {
    let petSelect = $("#inputPetName");
    petSelect.empty(); // Clear all options from the select

    $.ajax({
        url: "/api/pets",
        type: "GET",
        success: function (data) {
            let pets = JSON.parse(data);
            console.log(pets);
            pets.forEach(function (pet) {
                if (pet.owner_ID === Number(ownerID)) {
                    let petName = pet.pet_name;
                    let petID = pet.id;
                    petSelect.append(new Option(petName, petID, false, false));
                }
            });

            let seen = {};
            petSelect.find('option').each(function() {
                let txt = $(this).text();
                if (seen[txt]) {
                    $(this).remove();
                } else {
                    seen[txt] = true;
                }
            });
            petSelect.prop("disabled", false);
            petSelect.trigger("change.select2");
        },
    });


}
