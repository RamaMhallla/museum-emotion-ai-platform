<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../../" />
    <title>Dashboard Login</title>
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="app-blank">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px p-10" style="text-align: center">
                        <img src="" alt="">
                        </br></br></br>
                        <form class="form w-100" method="POST" id="kt_sign_in_form" action="{{ route('login') }}">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                                <div class="text-gray-500 fw-semibold fs-6">Sign In To Dashboard</div>
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
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn "
                                    style="background-color: #ECA641">
                                    <span class="indicator-label">Sign In</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.alert-danger').delay(5000).fadeOut();
            $('.alert-success').delay(5000).fadeOut();
        });
    </script>
</body>

</html>
