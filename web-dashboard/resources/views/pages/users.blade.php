@extends('admin')
@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl px-0">
        @php $var1 = "user" @endphp
        <input id="secJs" type="hidden" data-pv="{{ $var1 }}">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Users</h4>
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
                    <div class="col-sm-1 col-12 d-none">
                        <select id="dtLength{{ $var1 }}" data-control="select2" data-hide-search="true"
                            class="form-select form-select-solid form-select-lg">
                            <option value="5">05</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>

                        </select>
                    </div>
                    <div class="col-sm-3 col-12">
                        <input type="search" id="dtSearch{{ $var1 }}" class="form-control" data-loc="Search"
                            placeholder="Search By Name" />
                    </div>
                    <div class="col-sm-2 col-12 ms-auto d-none">
                        <button type="button" class="btn btn-light-primary d-block w-100" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-exit-down fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Export Report
                        </button>
                        <div id="kt_datatable_example_export_menu"
                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                            data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:;" class="menu-link px-3" data-kt-export="excel">Export as Excel</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:;" class="menu-link px-3" data-kt-export="csv">Export as CSV</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:;" class="menu-link px-3" data-kt-export="pdf">Export as PDF</a>
                            </div>
                        </div>
                        <div id="kt_datatable_example_buttons" class="d-none"></div>
                    </div>
                    <div class="col-sm-2 col-12 d-none">
                        <div class="d-flex" data-kt-user-table-toolbar="base">
                            <button type="button" class="btn btn-light-primary d-block w-100 me-3"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <div class="px-7 py-5" data-kt-user-table-filter="form">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Status Filter:</label>
                                        <select id="dtfilter" data-loc="Search" data-placeholder="Status Filter"
                                            data-control="select2" data-hide-search="true"
                                            class="form-select form-select-solid form-select-lg mb-2">
                                            <option></option>
                                            <option value="Active">Active</option>
                                            <option value="DeActive">DeActive</option>
                                            <option value="ALL">ALL</option>
                                        </select>
                                    </div>
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Type Filter:</label>
                                        <select id="dtTypefilter" data-loc="Search" data-placeholder="Type Filter"
                                            data-control="select2" data-hide-search="true"
                                            class="form-select form-select-solid form-select-lg ">
                                            <option></option>
                                            <option value="Car">Car</option>
                                            <option value="Bike">Bike</option>
                                            <option value="Fridge">Fridge</option>
                                            <option value="Van">Van</option>
                                            <option value="ALL">All</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="reset"
                                            class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                            data-kt-menu-dismiss="true" data-kt-user-table-filter="reset"
                                            id="users_reset_filter">Reset</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6"
                                            data-kt-menu-dismiss="true" data-kt-user-table-filter="filter"
                                            id="users_apply_filter">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="dt{{ $var1 }}" class="table table-striped border rounded dataTable no-footer"
                    style="margin:5px 0!important">
                    <thead>
                        <tr class="text-center text-muted fw-bold fs-5 gs-0">
                            <th class="text-center text-black">#ID</th>
                            <th class="text-center text-black">Name</th>
                            <th class="text-center text-black">Email</th>
                            <th class="text-center text-black">Created At</th>
                            <th class="text-center text-black">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold fs-5"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!--begin::Modal - Add User-->
    <div class="modal fade" id="kt_modal_new_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form class="form" action="" id="kt_modal_new_address_form" enctype="multipart/form-data"
                    method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="userId">
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h2>User Modal</h2>
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
                                <div class="col-sm-4 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">User name</label>
                                    <input type="text" id="userName"
                                        class="form-control form-control-solid @error('user_name') is-invalid @enderror"
                                        placeholder="" name="user_name" required autocomplete="off" readonly
                                        onfocus="this.removeAttribute('readonly');" />
                                    <div class="invalid-feedback user_name_error"></div>
                                    @error('user_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Email</label>
                                    <input type="email" id="userEmail"
                                        class="form-control form-control-solid @error('email') is-invalid @enderror"
                                        placeholder="" name="email" required />
                                    <div class="invalid-feedback user_name_error"></div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                                <div class="col-sm-4 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Password</label>
                                    <input type="password" id="password"
                                        class="form-control form-control-solid @error('password') is-invalid @enderror"
                                        name="password" required />
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
    <!--end::Modal -  Add User-->

    <script src="{{ asset('dashboard/users/all.js') }}"></script>
    <script src="{{ asset('dashboard/users/validation.js') }}"></script>
@endsection
