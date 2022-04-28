<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách partner
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="/partner-partners/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm partner</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Search Form -->
            <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Name:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="partner_Name" type="text" class="form-control" name="name" value="{{ request()->input('name')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <select type="text" class="form-control" name="partner_code" id="partner_code">
                                                <option></option>
                                            </select>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Email:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="partner_Email" type="text" class="form-control" name="email" value="{{ request()->input('email')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Email Reconciliation:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="emailReconciliation" type="email" class="form-control" name="emailReconciliation" value="{{ request()->input('emailReconciliation')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Phone number:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="partner_phoneNumber" type="text" class="form-control" name="phone_number" value="{{ request()->input('phone_number')}}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Status:</label>
                                        <div class="kt-input-icon">
                                            <select id="partner_status" type="text" class="form-control" name="status" value="{{ request()->input('status')}}">
                                                <option value="all" @if(request()->input('status') === 'all') selected @endif>All</option>
                                                <option value="inactive" @if(request()->input('status') === 'inactive') selected @endif>Inactive</option>
                                                <option value="active" @if(request()->input('status') === 'active') selected @endif>Active</option>
                                                <option value="blocked" @if(request()->input('status') === 'blocked') selected @endif>Blocked</option>
                                            </select>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Account type:</label>
                                        <div class="kt-input-icon">
                                            <select id="partner_accountType" type="text" class="form-control" name="account_type" value="{{ request()->input('account_type')}}">
                                                <option value="all" @if(request()->input('account_type') === 'All') selected @endif>All</option>
                                                <option value="personal" @if(request()->input('account_type') === 'personal') selected @endif>Personal</option>
                                                <option value="business" @if(request()->input('account_type') === 'business') selected @endif>Business</option>
                                            </select>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                            <a style="color: #FFF;" wire:click.prevent="$emit('exportPartnerCSVScript')" class="btn btn-primary" method="submit">Export</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
        @include('elements.alert_flash')
        <!--begin: Datatable -->
            <div class="kt-datatable" id="ajax_data"></div>

            <!--end: Datatable -->
        </div>
    </div>
</div>
