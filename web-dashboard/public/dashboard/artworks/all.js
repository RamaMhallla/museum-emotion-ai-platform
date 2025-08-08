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
            url: "/artworks/get-all",
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
        columns: colArtwork,
        language: {
            emptyTable: "Empty",
        },
        drawCallback: function (settings) {
            // update artwork data
            $(document).on("click", ".update-account", function (event) {
                event.preventDefault();
                var id = $(this).data("id");
                var url = "/artworks/" + id + "/edit";
                $.ajax({
                    type: "GET",
                    url: url,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                        $("#artworkId").val(response.data.id);
                        $("#title").val(response.data.title);
                        $("#title_it").val(response.data.title_it);
                        $("#description").val(response.data.description);
                        $("#description_it").val(response.data.description_it);
                        $("input[name='image']").val("");
                        $("#artist_name").val(response.data.artist_name);
                        $("#year_created").val(response.data.year_created);
                        $("#category_id").val(response.data.category_id);
                        if (response.data.image_path) {
                            $("#previewArtworkImage").attr(
                                "src",
                                response.data.image_path
                            );
                            $("#imagePreviewWrapper").show();
                        } else {
                            $("#imagePreviewWrapper").hide();
                        }
                        validator.disableValidator("image", "notEmpty");
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
                var url = "/artworks/" + id;
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
                validator.enableValidator("image", "notEmpty");
                $("#artworkId").val("");
                $("#title").val("");
                $("#title_it").val("");
                $("#description").val("");
                $("#description_it").val("");
                $("input[name='image']").val("");
                $("#artist_name").val("");
                $("#year_created").val("");
                $("#category_id").val("");
                // Hide image preview
                $("#imagePreviewWrapper").hide();
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
