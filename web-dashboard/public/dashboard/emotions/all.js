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
            url: "/emotions/get-all",
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
        columns: colEmotion,
        language: {
            emptyTable: "Empty",
        },
        drawCallback: function (settings) {},
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
