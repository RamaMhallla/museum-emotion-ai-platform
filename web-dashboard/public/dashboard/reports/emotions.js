"use strict";
var KTAppBooking = (function () {
    var t,
        e,
        flat,
        a = (ee, t, n) => {
            var r = ee[0] ? new Date(ee[0]) : null,
                o = ee[1] ? new Date(ee[1]) : null;

            $.fn.dataTable.ext.search.push(function (e, t, n) {
                var a = r,
                    c = o,
                    l = new Date(t[4]);

                return (
                    (null === a && null === c) ||
                    (null === a && c >= l) ||
                    (a <= l && null === c) ||
                    (a <= l && c >= l)
                );
            }),
                e.draw();
        },
        // Define the 'a' function here
        aa = (selectedDates, dateStr, instance) => {
            var startDate = selectedDates[0]
                    ? new Date(selectedDates[0])
                    : null,
                endDate = selectedDates[1] ? new Date(selectedDates[1]) : null;

            // Clear any previous custom filters
            $.fn.dataTable.ext.search = [];

            $.fn.dataTable.ext.search.push(function (
                settings,
                data,
                dataIndex
            ) {
                var startDateTime = startDate,
                    endDateTime = endDate,
                    recordDate = new Date(data[3]); // Assuming the date is in the 15th column (index 14)

                return (
                    (startDateTime === null && endDateTime === null) ||
                    (startDateTime === null && endDateTime >= recordDate) ||
                    (startDateTime <= recordDate && endDateTime === null) ||
                    (startDateTime <= recordDate && endDateTime >= recordDate)
                );
            });

            e.draw(); // Redraw the DataTable with the new filter applied
        },
        n = () => {
            t.querySelectorAll('[data-booking-filter="delete_row"]').forEach(
                (t) => {
                    t.addEventListener("click", function (t) {
                        t.preventDefault();
                        const n = t.target.closest("tr"),
                            r = n.querySelector(
                                '[data-booking-filter="booking_id"]'
                            ).innerText;
                        Swal.fire({
                            text: "Are you sure you want to delete " + r + "?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, delete!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton:
                                    "btn fw-bold btn-active-light-primary",
                            },
                        }).then(function (t) {
                            t.value
                                ? $.ajax({
                                      url: `/admin/students/destroy/${r}`,
                                      type: "GET",
                                      processData: false,
                                      contentType: false,

                                      success: function (response) {
                                          Swal.fire({
                                              text:
                                                  "You have deleted " +
                                                  r +
                                                  "!.",
                                              icon: "success",
                                              buttonsStyling: !1,
                                              confirmButtonText: "Ok, got it!",
                                              customClass: {
                                                  confirmButton:
                                                      "btn fw-bold btn-primary",
                                              },
                                          }).then(function () {
                                              e.row($(n)).remove().draw();
                                          });
                                      },

                                      error: function (xhr, status, error) {
                                          console.log(error);
                                          Swal.fire({
                                              text: r + " was not deleted.",
                                              icon: "error",
                                              buttonsStyling: !1,
                                              confirmButtonText: "Ok, got it!",
                                              customClass: {
                                                  confirmButton:
                                                      "btn fw-bold btn-primary",
                                              },
                                          });
                                      },
                                  })
                                : "cancel" === t.dismiss &&
                                  Swal.fire({
                                      text: r + " was not deleted.",
                                      icon: "error",
                                      buttonsStyling: !1,
                                      confirmButtonText: "Ok, got it!",
                                      customClass: {
                                          confirmButton:
                                              "btn fw-bold btn-primary",
                                      },
                                  });
                        });
                    });
                }
            );
        };
    return {
        init: function () {
            (t = document.querySelector("#kt_datatable_booking")) &&
                ((e = $(t).DataTable({
                    info: !1,
                    order: [],
                    pageLength: 10,
                    columnDefs: [
                        {
                            // orderable: !1,
                            targets: 0,
                        },
                        {
                            // orderable: !1,
                            targets: 4,
                        },
                    ],
                })).on("draw", function () {
                    n();
                }),
                (() => {
                    const e = "Emotions_report";
                    new $.fn.dataTable.Buttons(t, {
                        buttons: [
                            { extend: "copyHtml5", title: e, exportOptions: {columns: ":not(:eq(3))"}},
                            { extend: "excelHtml5", title: e, exportOptions: {columns: ":not(:eq(3))"} },
                            { extend: "csvHtml5", title: e, exportOptions: {columns: ":not(:eq(3))"} },
                            { extend: "pdfHtml5", title: e, exportOptions: {columns: ":not(:eq(3))"} },
                        ],
                    })
                        .container()
                        .appendTo($("#booking_views_export")),
                        document
                            .querySelectorAll(
                                "#booking_export_menu [data-booking-export]"
                            )
                            .forEach((t) => {
                                t.addEventListener("click", (t) => {
                                    t.preventDefault();
                                    const e = t.target.getAttribute(
                                        "data-booking-export"
                                    );
                                    document
                                        .querySelector(
                                            ".dt-buttons .buttons-" + e
                                        )
                                        .click();
                                });
                            });
                })(),
                document
                    .querySelector('[data-wallet-report-filter="search"]')
                    .addEventListener("keyup", function (t) {
                        // alert(1);
                        e.search(t.target.value).draw();
                    }),
                (() => {
                    const t = document.querySelector(
                        '[data-booking-filter="status"]'
                    );
                    $(t).on("change", (t) => {
                        let n = t.target.value;
                        "all" === n && (n = ""), e.column(13).search(n).draw();
                    });
                })(),
                n(),
                (() => {
                    const e = document.querySelector("#kt_booking_flatpickr");
                    flat = $(e).flatpickr({
                        altInput: !0,
                        altFormat: "d/m/Y",
                        dateFormat: "d/m/Y",
                        mode: "range",
                        onChange: aa,
                    });
                })(),
                document
                    .querySelector("#kt_booking_flatpickr_clear")
                    .addEventListener("click", (ee) => {
                        flat.clear();
                        $.fn.dataTable.ext.search = []; // Clear any custom search functions
                        e.draw(); // Redraw the DataTable
                    }));
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTAppBooking.init();
});
