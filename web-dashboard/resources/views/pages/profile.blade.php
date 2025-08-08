@extends('admin')

@section('content')
    <div class="card mb-5 mb-xl-10 mx-6" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Info</h3>
            </div>
        </div>
        <div class="card-body p-9">
            <div class="row mb-10">
                <label class="col-lg-4 fw-semibold text-muted">Name:</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $user->name }}</span>
                </div>
            </div>
            <div class="row mb-10">
                <label class="col-lg-4 fw-semibold text-muted">Email:</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $user->email }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- reset password card -->
    <div class="card mb-5 mb-xxl-8 mx-6">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Reset Password</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="alert alert-success" id="successContainer1" style="display: none;"></div>
            <div class="alert alert-danger" id="errorContainer1" style="display: none;"></div>
            <form id="kt_modal_reset_password_form" class="form" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="user_id" name="user_id" class="form-control form-control-solid mb-3 mb-lg-0"
                    value="{{ $user->id }}" />
                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_modal_add_user_header"
                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                    <div class="fv-row mb-7">
                        <label class="required fw-semibold fs-6 mb-2">New Password</label>
                        <input type="text" id="password" name="password"
                            class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="New Password" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Confirm Password</label>
                        <input type="text" name="password_confirmation" id="password_confirmation"
                            class="form-control form-control-solid mb-3 mb-lg-0"
                            placeholder="Confirm Password" required />
                    </div>
                </div>
                <div class="text-center pt-10">
                    <button id="submitBtn" class="btn btn-primary submitBtn reset-password" data-id="{{ $user->id }}"
                        data-kt-users-modal-action="submit">
                        <span class="indicator-label">Save</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- end reset password card -->

    <!-- update profile card -->
    <div class="card mb-5 mb-xxl-8 mx-6">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Edit Profile</span>
            </h3>
        </div>
        <div class="card-body">
            <div class="alert alert-success" id="successContainer" style="display: none;"></div>
            <div class="alert alert-danger" id="errorContainer" style="display: none;"></div>
            <form id="kt_modal_add_user_form" class="form" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="type" name="type" class="form-control form-control-solid mb-3 mb-lg-0"
                    value="4" />
                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_modal_add_user_header"
                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                    <div class="fv-row mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Name</label>
                        <input type="text" id="name" name="name"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name"
                            value="{{ $user->name }}" required />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Email</label>
                        <input type="text" name="email" id="email"
                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Email"
                            value="{{ $user->email }}" required />
                    </div>
                </div>
                <div class="text-center pt-10">
                    <button id="submitBtn" class="btn btn-primary submitBtn edit-action" data-id="{{ $user->id }}"
                        data-kt-users-modal-action="submit">
                        <span class="indicator-label">Save</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- end update profile card -->
    <script type="text/javascript">
        $(document).ready(function() {

            // click on submit in reset password modal
            $(document).on('click', '.reset-password', function(event) {
                event.preventDefault();
                var url = "/admin/reset-password";
                var formData = new FormData($('#kt_modal_reset_password_form')[0]);
                console.log(formData);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            $('#successContainer1').text(data.success).show();
                            setTimeout(function() {
                                $('#successContainer1').fadeOut('slow', function() {
                                    $('#successContainer1').empty();
                                });
                            }, 5000);
                        } else {
                            $('#errorContainer1').text(data.errors).show();
                            setTimeout(function() {
                                $('#errorContainer1').fadeOut('slow', function() {
                                    $('#errorContainer1').empty();
                                });
                            }, 5000);
                        }
                        if (data.errors) {
                            displayErrors(data.errors);
                        }
                    },
                });
            });

            // click on submit in edit modal
            $(document).on('click', '.edit-action', function(event) {
                event.preventDefault();
                var id = $('#submitBtn').attr('data-id');
                var url = "/admin/update/" + id;
                var formData = new FormData($('#kt_modal_add_user_form')[0])
                console.log(formData);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            $('#successContainer').text(data.success).show();
                            setTimeout(function() {
                                $('#successContainer').fadeOut('slow', function() {
                                    $('#successContainer').empty();
                                });
                            }, 5000);
                        }
                        if (data.errors) {
                            displayErrors(data.errors);
                        }
                    },
                });
            });

            function displayErrors(errors) {
                var errorContainer = $('#errorContainer');
                errorContainer.empty();

                if (!$.isEmptyObject(errors)) {
                    errorContainer.show();
                    $.each(errors, function(key, value) {
                        errorContainer.append('<li>' + value + '</li>');
                    });
                } else {
                    errorContainer.hide();
                }
                // Hide the error container after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    errorContainer.fadeOut('slow', function() {
                        errorContainer.empty();
                        errorContainer.css('display', 'none');
                    });
                }, 5000);
            }
        });
    </script>
@endsection
