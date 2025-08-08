@extends('admin')
@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Dashboard</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="Javascript:;" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="kt_app_content" class="app-content flex-column-fluid">

                  </div class="row">
                    <div id="kt_app_content_container" class="app-container container-fluid">
                            <div class="row">
                                <div class="col-xl-12 mb-5 mb-xl-10">
                                     @include('partials.newRama')
                                </div>
                            </div>
                    </div>

                        </div>
                    <div id="kt_app_content_container" class="app-container container-fluid">

                        <div>
                            @include('partials.cards')
                        </div>
                        <!-- END Cards -->


                        <div class="row">
                            <div class="col-xl-12 mb-5 mb-xl-10">
                                <!--begin::Chart widget 8-->
                                @include('partials.widget_8')
                                <!--end::Chart widget 8-->
                            </div>
                        </div>
                        <div class="row gx-5 gx-xl-10">
                            <div class="col-xxl-12 mb-5 mb-xl-10">
                                @include('partials.cards_2')
                            </div>
                            <div class="col-xl-12">
                                <!--begin::Chart widget 11-->
                                @include('partials.widget_11')
                                <!--end::Chart widget 11-->
                            </div>
                            <div class="col-xl-12 mt-8 mb-8">
                                <!--begin::Table widget 17-->

                                <!--end::Table widget 17-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // update chart when choose a date from date picker dropdown
                $('.datePicker .ranges li').click(function() {
                    var parent = $(this).closest('.datePicker');
                    var parentId = parent.attr('id');
                    var idParts = parentId.split('_');
                    var chartId = idParts[1];
                    var val = $(this).data("range-key");

                    if (val == 'Today') {
                        start = moment().format('YYYY-MM-DD');
                        end = moment().format('YYYY-MM-DD');
                        updateChartData(start, end, chartId);

                    } else if (val == 'Yesterday') {
                        start = moment().subtract(1, 'day').format('YYYY-MM-DD');
                        end = moment().subtract(1, 'day').format('YYYY-MM-DD');
                        updateChartData(start, end, chartId);

                    } else if (val == 'Last 7 Days') {
                        start = moment().subtract(6, 'days').format('YYYY-MM-DD');
                        end = moment().format('YYYY-MM-DD');
                        updateChartData(start, end, chartId);

                    } else if (val == 'Last 30 Days') {
                        start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                        end = moment().format('YYYY-MM-DD');
                        updateChartData(start, end, chartId);

                    } else if (val == 'This Month') {
                        start = moment().startOf('month').format('YYYY-MM-DD');
                        end = moment().endOf('month').format('YYYY-MM-DD');
                        updateChartData(start, end, chartId);

                    } else if (val == 'Last Month') {
                        start = moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD');
                        end = moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD');
                        updateChartData(start, end, chartId);
                    }
                });
                // update chart when choose a date from date picker custom range
                $('.datePicker .applyBtn').click(function() {
                    var parent = $(this).closest('.datePicker');
                    var parentId = parent.attr('id');
                    var idParts = parentId.split('_');
                    var chartId = idParts[1];

                    var selected = $('.drp-buttons .drp-selected').text();
                    const [startDateText, endDateText] = selected.split(" - ");
                    const startDate = moment(startDateText, 'MM/DD/YYYY').format('YYYY-MM-DD');
                    const endDate = moment(endDateText, 'MM/DD/YYYY').format('YYYY-MM-DD');
                    start = startDate;
                    end = endDate;
                    console.log(start);
                    console.log(end);
                    updateChartData(start, end, chartId);
                });

                var updateChartData = function(start, end, chartId) {
                    // Send an AJAX request to the Laravel route
                    $.ajax({
                        url: '/update-widget-' + chartId,
                        type: 'GET',
                        data: {
                            start: start,
                            end: end,
                        },
                        success: function(response) {
                            if (chartId == 32) {
                                var newSeries = response.YData;
                                var newCategories = response.XData;
                                var chart = KTChartsWidget32;
                                ydata_32 = newSeries;
                                xdata_32 = newCategories;
                            }
                            if (chartId == 36) {

                                var chart = KTChartsWidget36;
                                ydata_36_1 = response.YData_1;
                                ydata_36_2 = response.YData_2;
                                xdata_36 = response.XData;
                            }
                            chart.getOptions().destroy();
                            "undefined" != typeof module && (module.exports = chart), KTUtil
                                .onDOMContentLoaded((function() {
                                    chart.init()
                                }));

                        },
                        error: function(xhr, status, error) {
                            // Handle the error if needed
                            console.log(error);
                        }
                    });
                }
            });
        </script>
    @endsection
