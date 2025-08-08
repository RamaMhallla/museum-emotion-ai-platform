<div class="row gy-5 g-xl-10">
    <div class="col-6 col-xl-3 mb-xl-10">
        <a href="javascript:;" class="card h-lg-100" title="orders">
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <div class="m-0">
                    <i class="ki-duotone ki-compass fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <div class="d-flex flex-column my-7">
                    <div>
                        <span id="total_bookings"
                            class="fw-semibold fs-2x text-gray-800 lh-1 ls-n2">{{ $today_visitors }}</span>
                    </div>
                    <div class="m-0">
                        <span class="fw-semibold fs-7 text-gray-500">Today Visitors</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-xl-3 mb-xl-10">
        <a href="javascript:;">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                    <div class="m-0">
                        <i class="ki-duotone ki-chart-simple fs-2hx text-gray-600">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </div>
                    <div class="d-flex flex-column my-7">
                        <span id="tickets_count"
                            class="fw-semibold fs-2x text-gray-800 lh-1 ls-n2">{{ $today_viewed_artworks }}</span>
                        <div class="m-0">
                            <span class="fw-semibold fs-7 text-gray-500">Today Viewed Artworks</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-xl-3 mb-xl-10">
        <a href="javascript:;">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                    <div class="m-0">
                        <i class="ki-duotone ki-abstract-39 fs-2hx text-gray-600">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <div class="d-flex flex-column my-7">
                        <span id="tickets_count"
                            class="fw-semibold fs-2x text-gray-800 lh-1 ls-n2">{{ $today_common_emotion }}</span>
                        <div class="m-0">
                            <span class="fw-semibold fs-7 text-gray-500">Today Common Emotions</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-xl-3 mb-xl-10">
        <a href="javascript:;">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                    <div class="m-0">
                        <i class="ki-duotone ki-map fs-2hx text-gray-600">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <div class="d-flex flex-column my-7">
                        <span id="tickets_count"
                            class="fw-semibold fs-2x text-gray-800 lh-1 ls-n2">{{ $today_common_artwork }}</span>
                        <div class="m-0">
                            <span class="fw-semibold fs-7 text-gray-500">Today Common Artwork</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
