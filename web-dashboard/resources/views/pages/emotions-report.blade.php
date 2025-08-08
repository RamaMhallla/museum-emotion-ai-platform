@extends('admin')

@section('content')
    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack mb-5">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Reports
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="javascript:;" class="text-muted text-hover-primary">
                                Reports
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            Emotions Report
                        </li>
                    </ul>
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="card card-flush" style="padding: 25px; margin: 10px">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                    <input type="text" data-wallet-report-filter="search"
                                        class="form-control form-control-solid w-250px ps-12" placeholder="Search" />
                                </div>
                            </div>
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-1">
                                <div id="booking_views_export" class="d-none"></div>
                                <div class="input-group w-250px">
                                    <input name="date_filter" class="form-control form-control-solid rounded rounded-end-0"
                                        placeholder="Pick date range" id="kt_booking_flatpickr" />
                                    <button class="btn btn-icon btn-light" id="kt_booking_flatpickr_clear">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-outline ki-exit-up fs-2"></i>Export</button>
                                <div id="booking_export_menu"
                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                    data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="javascript:;" class="menu-link px-3" data-booking-export="excel">Export as
                                            Excel</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="javascript:;" class="menu-link px-3" data-booking-export="csv">Export as
                                            CSV</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table  align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_booking">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-5 gs-0">
                                        <th class="text-center min-w-100px">#ID</th>
                                        <th class="text-center min-w-100px">User Name</th>
                                        <th class="text-center min-w-100px">Artwork Name</th>
                                        <th class="text-center min-w-100px">Artwork Image</th>
                                        <th class="text-center min-w-100px">Emotion</th>
                                        <th class="text-center min-w-100px">Detect at</th>
                                        <th class="text-center min-w-100px">Waiting Time</th>
                                    </tr>
                                </thead>

                                <tbody class="fw-semibold text-gray-600">
                                    @if ($artworkEmotions->isNotEmpty())
                                        @foreach ($artworkEmotions as $art_emotion)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="">
                                                            <a href="javascript:;"
                                                                class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                                data-booking-filter="booking_id">{{ $art_emotion->id }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center pe-0 text-black">{{ $art_emotion->user->name }}</td>
                                                <td class="text-center pe-0 text-black">{{ $art_emotion->artwork->title }}
                                                </td>
                                                <td class="text-center pe-0 text-black">
                                                    <img src={{ $art_emotion->artwork->image_path }} width="150px">
                                                </td>
                                                <td class="text-center pe-0 text-gray-800">
                                                    <span
                                                        class="badge badge-light-primary fw-bold fs-7">{{ $art_emotion->emotion->name }}</span>
                                                </td>
                                                <td class="text-center pe-0 text-gray-800">
                                                    <span
                                                        class="badge badge-light">{{ \Carbon\Carbon::parse($art_emotion->detected_at)->format('d/m/Y, h:i A') }}</span>
                                                </td>
                                                <td class="text-center pe-0 text-gray-800">{{ $art_emotion->waiting_time }} Sec</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('dashboard/reports/emotions.js') }}"></script>

@endsection
