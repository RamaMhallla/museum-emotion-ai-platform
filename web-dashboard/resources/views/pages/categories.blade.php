@extends('admin')
@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl px-0">
        @php $var1 = "category" @endphp
        <input id="secJs" type="hidden" data-pv="{{ $var1 }}">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Categories</h4>
                <div class="col-sm-2 col-12">
                    <button type="button" id="openAddModal"
                        class="btn btn-primary btn-active-primary fs-6 d-block w-100 fw-bold" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_new_user" data-bs-toggle="tooltip" title="Create new user">
                        Add<i class="ki-duotone ki-plus fs-2"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="kt_datatable_users_buttons" class="d-none"></div>
                <div class="row mb-5 g-2">
                    <div class="col-sm-3 col-12">
                        <input type="search" id="dtSearch{{ $var1 }}" class="form-control" data-loc="Search"
                            placeholder="Search By Name" />
                    </div>
                </div>
                <table id="dt{{ $var1 }}" class="table table-striped border rounded dataTable no-footer"
                    style="margin:5px 0!important">
                    <thead>
                        <tr class="text-center text-muted fw-bold fs-5 gs-0">
                            <th class="text-center text-black">#ID</th>
                            <th class="text-center text-black">Name</th>
                            <th class="text-center text-black">Name IT</th>
                            <th class="text-center text-black">Created At</th>
                            <th class="text-center text-black">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold fs-5"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!--begin::Modal - Add Category-->
    <div class="modal fade" id="kt_modal_new_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-l">
            <div class="modal-content">
                <form class="form" action="" id="kt_modal_new_address_form" enctype="multipart/form-data"
                    method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="catId">
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h2>Category Modal</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="alert alert-danger" id="errorContainer" style="display: none;"></div>
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_new_address_header"
                            data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
                            <div class="row mb-5">
                                <div class="col-sm-12 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Name</label>
                                    <input type="text" id="catName"
                                        class="form-control form-control-solid @error('name') is-invalid @enderror"
                                        placeholder="" name="name" required autocomplete="off" readonly
                                        onfocus="this.removeAttribute('readonly');" />
                                    <div class="invalid-feedback name_error"></div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-12 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Name IT</label>
                                    <input type="text" id="catName_it"
                                        class="form-control form-control-solid @error('name_it') is-invalid @enderror"
                                        placeholder="" name="name_it" required autocomplete="off" readonly
                                        onfocus="this.removeAttribute('readonly');" />
                                    <div class="invalid-feedback name_it_error"></div>
                                    @error('name_it')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-center">
                        <button type="button" class="btn btn-light btn-lg" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" id="submitAddUser" class="btn btn-primary btn-lg">
                            <span class="indicator-label">Save</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal -  Add Category-->

    <script src="{{ asset('dashboard/categories/all.js') }}"></script>
    <script src="{{ asset('dashboard/categories/validation.js') }}"></script>
@endsection
