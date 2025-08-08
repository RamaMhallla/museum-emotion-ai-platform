@extends('admin')
@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl px-0">
        @php $var1 = "emotion" @endphp
        <input id="secJs" type="hidden" data-pv="{{ $var1 }}">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Emotions</h4>
            </div>
            <div class="card-body">
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
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold fs-5"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('dashboard/emotions/all.js') }}"></script>
@endsection
