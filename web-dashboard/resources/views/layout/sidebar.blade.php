<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo" style="justify-content:center">
        <a href="{{ route('dashboard') }}">
            <img alt="Logo" src="{{ asset('images/logo.svg') }}" class="h-50px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('images/logo.svg') }}" class="h-50px app-sidebar-logo-minimize" />
        </a>
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">
                    <div class="menu-item menu-accordion {{ request()->is('dashboard') ? 'here show' : '' }}">
                        <a class="menu-link" href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">@lang('translate.dashboard')</span>
                            <span class="menu-arrow"></span>
                        </a>
                    </div>
                    <div class="menu-item pt-5">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                        </div>
                    </div>
                    @can('Manage Users')
                    <a href='{{ route('users.index') }}' class="menu-item">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Users Management</span>
                        </span>
                    </a>
                     @endcan

                    @can('Manage Artworks')
                    <a href='{{ url('artworks') }}' class="menu-item">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-bank fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Artworks Management</span>
                            </span>

                     </a>
                    @endcan
                    @can('Manage Emotions')
                    <a href='{{ route('emotions') }}' class="menu-item">
                        <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-abstract-39 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Emotions Management</span>

                         </span>

                    </a>
                    @endcan
                    @can('Manage Category')
                    <a href='{{ route('categories') }}' class="menu-item">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-color-swatch fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                        <span class="path11"></span>
                                        <span class="path12"></span>
                                        <span class="path13"></span>
                                        <span class="path14"></span>
                                        <span class="path15"></span>
                                        <span class="path16"></span>
                                        <span class="path17"></span>
                                        <span class="path18"></span>
                                        <span class="path19"></span>
                                        <span class="path20"></span>
                                        <span class="path21"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Category Management</span>

                            </span>
                    @endcan
                    @can('Manage Reports')
                    <a  href="{{ route('emotions.report') }}" class="menu-item">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-file fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Reports Management</span>
                            </span>

                     </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
