var OreDT = {
    Columns: function (clmns) {
        return new Promise((resolve, reject) => {
            setTimeout(async () => {
                resolve(clmns);
            }, 300);
        });
    },
    Search: function (a, b) {
        $("#dtSearch" + a).keyup(function () {
            b.search($(this).val()).draw();
        });
        // $("#dtSearch" + a).on("click", function (e) {
        //     //b.search($(this).val("")).draw();
        //     $("#dtSearch" + a).trigger("keyup");
        // });
    },
    PageLength: function (a, b) {
        $("#dtLength" + a).on("change", function () {
            var $this = $(this);

            b.page.len($this.val()).draw();
        });
        $("#dtLength" + a).select2({ minimumResultsForSearch: -1 });
    },
    DTBind: function (optTable) {
        if ($.fn.DataTable.isDataTable("#" + optTable.name)) {
            $("#" + optTable.name)
                .DataTable()
                .destroy();
        }
        var able = $("#" + optTable.name).DataTable(optTable);
        OreDT.Search(optTable.pvId, able);
        OreDT.PageLength(optTable.pvId, able);
        $("#dtLength" + optTable.pvId)
            .val(optTable.pageLength)
            .trigger("change");
        $("#dtSearch" + optTable.pvId).trigger("keyup");
    },
};

var colUser = [
    {
        data: "id",
        class: "text-center p-5 align-middle min-w-30px",
        render: function (data, type, row, meta) {
            data = `<span>${data}</span>`;
            return data;
        },
    },
    {
        data: "name",
        class: "text-center p-5 align-middle min-w-150px",
        render: function (data, type, row, meta) {
            if (row.image == null) {
                row.image = "assets/media/avatars/blank.png";
            }
            data = `<span>${data}</span>`;
            return data;
        },
    },
    {
        data: "email",
        class: "text-center p-5 align-middle min-w-100px",
        render: function (data, type, row, meta) {
            data = `<span>${data}</span>`;
            return data;
        },
    },
    {
        data: "created_at",
        class: "text-center p-5 align-middle min-w-50px",
        render: function (data, type, row, meta) {
            data = `<span class="badge badge-light">${data}</span>`;
            return data;
        },
    },
    {
        data: "action",
        class: "text-center p-5 align-middle min-w-100px",
    },
];

var colEmotion = [
    {
        data: "id",
        class: "text-center p-5 align-middle min-w-30px",
        render: function (data, type, row, meta) {
            data = `<span>${data}</span>`;
            return data;
        },
    },
    {
        data: "name",
        class: "text-center p-5 align-middle min-w-150px",
        render: function (data, type, row, meta) {
            data = `<span>${data}</span>`;
            return data;
        },
    },
    {
        data: "name_it",
        class: "text-center p-5 align-middle min-w-150px",
        render: function (data, type, row, meta) {
            data = `<span>${data}</span>`;
            return data;
        },
    },
    {
        data: "created_at",
        class: "text-center p-5 align-middle min-w-50px",
        render: function (data, type, row, meta) {
            data = `<span class="badge badge-light">${data}</span>`;
            return data;
        },
    },
];

var colCategory = [
    {
        data: "id",
        class: "text-center p-5 align-middle min-w-30px",
        render: function (data, type, row, meta) {
            data = `<span>${data}</span>`;
            return data;
        },
    },
    {
        data: "name",
        class: "text-center p-5 align-middle min-w-150px",
        render: function (data, type, row, meta) {
            if (row.image == null) {
                row.image = "assets/media/avatars/blank.png";
            }
            data = `<span>${data}</span>`;
            return data;
        },
    },
    {
        data: "name_it",
        class: "text-center p-5 align-middle min-w-150px",
        render: function (data, type, row, meta) {
            data = `<span>${data}</span>`;
            return data;
        },
    },
    {
        data: "created_at",
        class: "text-center p-5 align-middle min-w-50px",
        render: function (data, type, row, meta) {
            data = `<span class="badge badge-light">${data}</span>`;
            return data;
        },
    },
    {
        data: "action",
        class: "text-center p-5 align-middle min-w-100px",
    },
];

var colArtwork = [
    {
        data: "id",
        class: "text-center p-5 align-middle min-w-30px",
        render: function (data, type, row, meta) {
            data = `<span>${data}</span>`;
            return data;
        },
    },
    {
        data: "title",
        class: "text-center p-5 align-middle min-w-150px",
        render: function (data, type, row, meta) {
            data = `<div class="d-flex justify-content-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="/ViewUserProfile/${row.id}">
                                <div class="symbol-label">
                                    <img src="${row.image_path}" alt="Artwork Image" class="w-100">
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href="/ViewUserProfile/${row.id}" class="text-gray-800 fs-4 text-hover-primary fw-bolder mb-1">${data}</a>
                        </div>

                    </div>`;
            return data;
        },
    },
    {
        data: "title_it",
        class: "text-center p-5 align-middle min-w-50px",
        render: function (data, type, row, meta) {
            data = `<span class="text-gray-800 fs-4 fw-bolder mb-1">${data}</span>`;
            return data;
        },
    },
    {
        data: "category_name",
        class: "text-center p-5 align-middle min-w-50px",
        render: function (data, type, row, meta) {
            data = `<span class="badge badge-light">${data}</span>`;
            return data;
        },
    },
    {
        data: "artist_name",
        class: "text-center p-5 align-middle min-w-50px",
        render: function (data, type, row, meta) {
            data = `<span class="badge badge-light">${data}</span>`;
            return data;
        },
    },
    {
        data: "year_created",
        class: "text-center p-5 align-middle min-w-50px",
        render: function (data, type, row, meta) {
            data = `<span class="badge badge-light">${data}</span>`;
            return data;
        },
    },
    {
        data: "action",
        class: "text-center p-5 align-middle min-w-100px",
    },
];
