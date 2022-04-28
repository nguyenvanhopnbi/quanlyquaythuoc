<div>
    <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Danh sách lịch sử nạp tiền/ trừ tiền partner
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="dropdown dropdown-inline">
                    <a href="/partner-balance/add" class="btn btn-success btn-icon-sm"><i class="fas fa-plus"></i> Cộng
                        tiền</a>
                    <a href="/partner-balance/sub" class="btn btn-brand btn-icon-sm"><i class="fas fa-minus"></i> Trừ
                        tiền</a>
                </div>
            </div>
        </div>

    </div>
    <div class="kt-portlet__body">

        <!--begin: Search Form -->
        <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET" x-data="{
            formData: {
                partner_code: '{{ request()->get('partner_code') }}',
                type: '{{ request()->get('type') }}',
            }
        }">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="row align-items-center">

                                <div wire:ignore class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Partner code:</label>
                                    <select wire:ignore class="form-control" name="partner_code" id="partner_code"
                                        x-model="formData.partner_code">
                                        <option wire:ignore></option>
                                    </select>
                                </div>



                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Type:</label>
                                    <div class="kt-input-icon">
                                        <select id="Partner_Balance_Type" type="text" class="form-control" name="type"
                                            value="{{ request()->input('type')}}" x-model="formData.type">
                                            <option value="all">All</option>
                                            <option value="credited">Cộng tiền</option>
                                            <option value="debited">Trừ tiền</option>
                                        </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày bắt đầu:</label>
                                        </div>
                                        <input type='text' class="form-control" id="kt_datepicker_1" name="startTime"
                                            readonly placeholder="Chọn thời gian bắt đầu" type="text"
                                            value="{{ request()->input('startTime')}}" />
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày kết thúc:</label>
                                        </div>
                                        <input type='text' class="form-control" id="kt_datepicker_2" name="endTime"
                                            readonly placeholder="Chọn thời gian kết thúc" type="text"
                                            value="{{ request()->input('endTime')}}" />
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile  input-search-second">
                                    <label>Amount:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="partner_balance_amount" type="text" class="form-control" name="amount"
                                            value="{{ request()->input('amount')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile  input-search-second">
                                    <label>Admin email:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="partner_balance_admin_email" type="text" class="form-control" name="admin_email"
                                            value="{{ request()->input('admin_email')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile  input-search-second">
                                    <label>Reason:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="partner_balance_reason" type="text" class="form-control" name="reason"
                                            value="{{ request()->input('reason')}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>&nbsp;</label>
                                        </div>
                                        <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                        @can('partner-balance-export')

                                        {{-- <button class="btn btn-success" method="" x-on:click.prevent="
                                            formData = new FormData($el)
                                            formData.append('_token', '{{ csrf_token()}}')
                                            axios({
                                                method: 'post',
                                                url: '{{ route('gate.partner-balance.report.storeReport') }}',
                                                data: formData,
                                                headers: { 'Content-Type': 'multipart/form-data' }
                                            })
                                                .then(response => {
                                                    location.href = response.data.path;
                                                    swal.fire('Thành công', 'Đã export', 'success')
                                                })
                                                .catch(() => swal.fire('Thất bại', 'Xin thử lại sau', 'error'))
                                        ">Export</button> --}}

                                        {{-- <a wire:click.prevent="$emit('ExportPartnerBalanceScript')" class="btn btn-success text-white">Export</a> --}}

                                        <button wire:click.prevent = "$emit('downloadCSV')" class="btn btn-success text-white">Export</button>


                                        @endcan
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
        <div wire:ignore class="kt-datatable" id="ajax_data"></div>

        <!--end: Datatable -->
    </div>
</div>
</div>
