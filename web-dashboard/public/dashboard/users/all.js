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
            url: "/users/get-all",
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
        columns: colUser,
        language: {
            emptyTable: "Empty",
        },
        drawCallback: function (settings) {
            // update user data
            $(document).on("click", ".update-account", function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                var url = "/users/" + id + "/edit";
                $.ajax({
                    type: "GET",
                    url: url,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        $("#userId").val(response.data.id);
                        $("#userName").val(response.data.name);
                        $("#userEmail").val(response.data.email);

                        validator.updateFieldStatus("password", "NotValidated");
                        validator.disableValidator("password", "notEmpty");

                        $("#submitAddUser").addClass("update-user");
                        $("#kt_modal_new_user").modal("show");
                    },
                    error: function () {
                        showErrorFunction();
                    },
                });
            });

            // delete user
            $(document).on("click", ".delete-account", function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                var url = "/users/" + id;
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
                validator.enableValidator("password", "notEmpty");
                validator.updateFieldStatus("password", "NotValidated");
                $("#submitAddUser").removeClass("update-user");
                $("#userId").val("");
                $("#userName").val("");
                $("#userEmail").val("");
                $("#password").val("");
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
