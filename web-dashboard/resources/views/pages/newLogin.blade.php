<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>Emotion Recognition</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script>
        //
    </script>
</head>

<body id="kt_body">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url('{{ asset('images/Detect1.jpg') }}');
            }

            [data-bs-theme="dark"] body {
                background-image: url('assets/media/auth/bg10-dark.jpeg');
            }
        </style>
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">

            </div>
            <div
                class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-starts p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 b-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <!-- Login form moved here -->
                            <form class="form w-100" method="POST" id="kt_sign_in_form" action="{{ route('login') }}">
                                @csrf
                                <div class="text-center mb-11">
                                    <h1 class="fw-bolder mb-3" style="color:#1a3130">Sign In</h1>
                                    <div class="text-gray-500 fw-semibold fs-6">Emotion Recognition for Museums </div>
                                </div>

                                @if (session('error'))
                                    <div class="alert alert-danger" id="alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Email" name="email" autocomplete="off"
                                        class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-3">
                                    <input type="password" placeholder="Password" name="password" autocomplete="off"
                                        class="form-control bg-transparent" />
                                </div>
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <a href="../../demo1/dist/authentication/layouts/overlay/reset-password.html"
                                        class="link" style="color:#4A7C7A">Forgot Password ?</a>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn"
                                        style="background-color:#4A7C7A">
                                        <span class="indicator-label" style="color:#EAE7E0">Sign In</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </form>
                            <!-- End login form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <script src="assets/js/custom/authentication/sign-in/general.js"></script>
    <script>
        $(document).ready(function() {
            $('.alert-danger').delay(5000).fadeOut();
            $('.alert-success').delay(5000).fadeOut();
        });
    </script>
</body>

</html>
