var secJs = $("#secJs");
var pv = secJs.data("pv");
var LangPv = {
    optLang: {
        name: `dt${pv}`,
        processing: true,
        serverSide: true,
        paginate: false,
        deferRender: true,
        ajax: {
            url: "/categories/get-all",
            type: "get",
            datatype: "json",
        },
        pvId: pv,
        pageLength: 4,
        dom: "tp",
        statSave: true,
        destroy: false,
        columnDefs: [
            {
                targets: "_all",
                orderable: false,
            },
        ],
        columns: colCategory,
        language: {
            emptyTable: "Empty",
        },
        drawCallback: function (settings) {
            // update category data
            $(document).on("click", ".update-account", function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                var url = "/categories/" + id + "/edit";
                $.ajax({
                    type: "GET",
                    url: url,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        $("#catId").val(response.data.id);
                        $("#catName").val(response.data.name);
                        $("#catName_it").val(response.data.name_it);

                        $("#submitAddUser").addClass("update-user");
                        $("#kt_modal_new_user").modal("show");
                    },
                    error: function () {
                        showErrorFunction();
                    },
                });
            });

            // delete category
            $(document).on("click", ".delete-account", function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                var url = "/categories/" + id;
                sweetConfirm(function (confirmed) {
                    if (confirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                showSuccesFunction();
                                $(".swal2-confirm").on("click", function () {
                                    location.reload();
                                });
                            },
                            error: function (data) {
                                showErrorFunction();
                            },
                        });
                    }
                });
            });

            $("#openAddModal").on("click", function () {
                $("#submitAddUser").removeClass("update-user");
                $("#catId").val("");
                $("#catName").val("");
                $("#catName_it").val("");
            });
        },
    },
    Update: function () {
        OreDT.DTBind(LangPv.optLang);
    },
    init: function () {
        this.Update();

        KTApp.init();
    },
};
KTUtil.onDOMContentLoaded(function () {
    LangPv.init();
});
