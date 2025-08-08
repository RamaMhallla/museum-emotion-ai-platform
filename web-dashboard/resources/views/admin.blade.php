<!DOCTYPE html>
@if (app()->getLocale() == 'ar')
    <html lang="en" direction="rtl" dir="rtl" style="direction: rtl">
@else
    <html lang="en">
@endif
<!--begin::Head-->

<head>
    <base href="../" />
    <title>Emotion Recognition</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
    {{-- Scripts --}}
    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('dashboard/ore.dt.js') }}"></script>
    <script src="{{ asset('dashboard/app.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/widgets.bundle.js') }}"></script>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('layout.header')
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('layout.sidebar')
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script>
        function showError(input, message) {
            const parent = input.parentElement;
            const error = parent.querySelector(".error-message");

            if (!error) {
                const errorMessage = document.createElement("div");
                errorMessage.className = "error-message";
                errorMessage.innerText = message;
                parent.appendChild(errorMessage);
            }
        }

        function hideError(input) {
            const parent = input.parentElement;
            const error = parent.querySelector(".error-message");

            if (error) {
                parent.removeChild(error);
            }
        }

        $(document).ready(function() {
            $('.alert-danger').delay(5000).fadeOut();
            $('.alert-success').delay(5000).fadeOut();
        });
    </script>

</body>
