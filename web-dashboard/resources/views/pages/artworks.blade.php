@extends('admin')
@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl px-0">
        @php $var1 = "artwork" @endphp
        <input id="secJs" type="hidden" data-pv="{{ $var1 }}">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Artworks</h4>
                <div class="col-sm-2 col-12">
                    <button type="button" id="openAddModal"
                        class="btn btn-primary btn-active-primary fs-6 d-block w-100 fw-bold" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_new_user" data-bs-toggle="tooltip" title="Create new artwork">
                        Add<i class="ki-duotone ki-plus fs-2"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="kt_datatable_users_buttons" class="d-none"></div>
                <div class="row mb-5 g-2">
                    <div class="col-sm-3 col-12">
                        <input type="search" id="dtSearch{{ $var1 }}" class="form-control" data-loc="Search"
                            placeholder="Search By Title" />
                    </div>
                </div>
                <table id="dt{{ $var1 }}" class="table table-striped border rounded dataTable no-footer"
                    style="margin:5px 0!important">
                    <thead>
                        <tr class="text-center text-muted fw-bold fs-5 gs-0">
                            <th class="text-center text-black">#ID</th>
                            <th class="text-center text-black">Title</th>
                            <th class="text-center text-black">Title IT</th>
                            <th class="text-center text-black">Category</th>
                            <th class="text-center text-black">Artist Name</th>
                            <th class="text-center text-black">Created Year</th>
                            <th class="text-center text-black">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold fs-5"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!--begin::Modal - Add Artwork-->
    <div class="modal fade" id="kt_modal_new_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form class="form" action="" id="kt_modal_new_address_form" enctype="multipart/form-data"
                    method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="artworkId">
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h2>Artwork Modal</h2>
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
                                {{-- Title --}}
                                <div class="col-sm-6 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Title</label>
                                    <input type="text" id="title"
                                        class="form-control form-control-solid @error('title') is-invalid @enderror"
                                        placeholder="Enter a title" name="title" required autocomplete="off" readonly
                                        onfocus="this.removeAttribute('readonly');" />
                                    <div class="invalid-feedback title_error"></div>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Title IT --}}
                                <div class="col-sm-6 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Title IT</label>
                                    <input type="text" id="title_it"
                                        class="form-control form-control-solid @error('title_it') is-invalid @enderror"
                                        placeholder="Enter a title" name="title_it" required autocomplete="off" readonly
                                        onfocus="this.removeAttribute('readonly');" />
                                    <div class="invalid-feedback title_it_error"></div>
                                    @error('title_it')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Description --}}
                                <div class="col-sm-6 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Description</label>
                                    <textarea type="text" id="description"
                                        class="form-control form-control-solid @error('description') is-invalid @enderror"
                                        placeholder="Write the description.." name="description" required autocomplete="off" readonly
                                        onfocus="this.removeAttribute('readonly');"></textarea>
                                    <div class="invalid-feedback description_error"></div>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Description IT --}}
                                <div class="col-sm-6 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Description IT</label>
                                    <textarea type="text" id="description_it"
                                        class="form-control form-control-solid @error('description_it') is-invalid @enderror"
                                        placeholder="Write the description.." name="description_it" required autocomplete="off" readonly
                                        onfocus="this.removeAttribute('readonly');"></textarea>
                                    <div class="invalid-feedback description_it_error"></div>
                                    @error('description_it')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Artist Name --}}
                                <div class="col-sm-6 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Artist Name</label>
                                    <input type="text" id="artist_name"
                                        class="form-control form-control-solid @error('artist_name') is-invalid @enderror"
                                        placeholder="Enter a name" name="artist_name" required autocomplete="off"
                                        readonly onfocus="this.removeAttribute('readonly');" />
                                    <div class="invalid-feedback artist_name_error"></div>
                                    @error('artist_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Year Created --}}
                                <div class="col-sm-6 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Year Created</label>
                                    <input type="text" id="year_created"
                                        class="form-control form-control-solid @error('year_created') is-invalid @enderror"
                                        placeholder="e.g. 2025" name="year_created" required autocomplete="off" readonly
                                        onfocus="this.removeAttribute('readonly');" />
                                    <div class="invalid-feedback year_created_error"></div>
                                    @error('year_created')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Category --}}
                                <div class="col-sm-6 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Category</label>
                                    <div class="form-group" style="margin-bottom:12px">
                                        <select
                                            class="form-control form-control-solid @error('category_id') is-invalid @enderror"
                                            id="category_id" name="category_id" required>
                                            <option value="">Select a category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="invalid-feedback category_id_error"></div>
                                </div>

                                {{-- Image --}}
                                <div class="col-sm-6 fv-row" style="margin-bottom:12px">
                                    <label class="required fs-5 fw-semibold mb-2">Image</label>
                                    <input type="file"
                                        class="form-control form-control-solid 
                                    @error('image') is-invalid @enderror"
                                        placeholder="" name="image" required />
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Preview Existing Image --}}
                                <div class="mb-5" id="imagePreviewWrapper" style="display: none;">
                                    <label class="fs-5 fw-semibold mb-2">Current Image</label>
                                    <div>
                                        <img id="previewArtworkImage" src="" alt="Artwork Image"
                                            class="img-fluid rounded" style="max-height: 200px;" />
                                    </div>
                                </div>


                                {{-- Hidden Uploaded By --}}
                                <input type="hidden" name="uploaded_by" value="{{ auth()->id() }}" />

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
    <!--end::Modal -  Add Artwork-->

    <script src="{{ asset('dashboard/artworks/all.js') }}"></script>
    <script src="{{ asset('dashboard/artworks/validation.js') }}"></script>
@endsection
