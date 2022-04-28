<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Cập nhật vai trò
                </h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <div class="kt-subheader__group" id="kt_subheader_search">
                    <span class="kt-subheader__desc" id="kt_subheader_total">
                        {{ $role->name }}
                    </span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <a href="{{ route('roles.index') }}" class="btn btn-default btn-bold">
                    {{ __('Back') }}
                </a>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin:: Portlet-->
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_2" role="tab">
                                <i class="flaticon2-calendar-3"></i> Thông tin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#kt_apps_contacts_view_tab_3" role="tab">
                                <i class="flaticon2-user-outline-symbol"></i> Tài khoản
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#kt_apps_contacts_view_tab_4" role="tab">
                                <i class="flaticon2-user-outline-symbol"></i> Quyền hạn
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content  kt-margin-t-20">

                    <!--Begin:: Tab Content-->
                    <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                        <livewire:role.edit-info :role="$role" />
                    </div>

                    <!--End:: Tab Content-->

                    <!--Begin:: Tab Content-->
                    <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                        <livewire:role.edit-user :role="$role" />
                    </div>

                    <!--End:: Tab Content-->

                    <!--Begin:: Tab Content-->
                    <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                        <livewire:role.edit-permission :role="$role" />
                    </div>

                    <!--End:: Tab Content-->
                </div>
            </div>
        </div>

        <!--End:: Portlet-->
    </div>

    <!-- end:: Content -->
</div>
