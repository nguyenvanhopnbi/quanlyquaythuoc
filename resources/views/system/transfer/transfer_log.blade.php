@extends('index')
@section('page-header', 'Quản lý hệ thống')
@section('page-sub-header', 'Tool chuyển tiền nội bộ')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Lệnh chuyển tiền
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        @can('transfer-transaction-view')
                            <a href="{{route('system.transfer.log.index')}}" class="btn btn-brand btn-icon-sm"><i class="flaticon2-list-1"></i> Danh
                                sách
                                giao dịch</a>
                        @endcan
                        @can('transfer-transaction-create')
                            <a href="{{route('system.transfer.make')}}" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Tạo lệnh
                                chuyển
                                tiền</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @can('transfer-transaction-log')
            <div class="kt-portlet__body">
                <!--begin: Search Form -->
                <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-xl-12 order-2 order-xl-1">
                                    <div class="row align-items-center">
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <label>Tài khoản chuyển tiền</label>
                                            <div class="kt-input-icon kt-input-icon--left">
                                                <select class="form-control" id="accFromInput" name="account_no_from"></select>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <label>Tài khoản nhận tiền</label>
                                            <div class="kt-input-icon kt-input-icon--left">
                                                <select class="form-control" id="accToInput" name="account_no_to"></select>
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
                                                       value="{{ request()->input('startTime')}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <div class="form__group kt-form__group--inline">
                                                <div class="kt-form__label">
                                                    <label>Ngày kết thúc:</label>
                                                </div>
                                                <input type='text' class="form-control" id="kt_datepicker_2" name="endTime"
                                                       readonly placeholder="Chọn thời gian kết thúc" type="text"
                                                       value="{{ request()->input('endTime')}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <label>Trạng thái</label>
                                            <div class="kt-input-icon">
                                                <select type="text" class="form-control select2_default" name="status">
                                                    @foreach($statuses as $value => $status)
                                                        <option
                                                            value="{{$value}}" {{$filter['status'] == $value ? 'selected': ''}}>{{$status}}</option>
                                                    @endforeach
                                                </select>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <label>Tần suất chuyển</label>
                                            <div class="kt-input-icon">
                                                <select type="text" class="form-control select2_default" name="schedule_type">
                                                    @foreach($scheduleTypes as $value => $type)
                                                        <option
                                                            value="{{$value}}" {{$filter['schedule_type'] == $value ? 'selected': ''}}>{{$type}}</option>
                                                    @endforeach
                                                </select>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <div class="form__group kt-form__group--inline">
                                                <div class="kt-form__label">
                                                    <label>&nbsp;</label>
                                                </div>
                                                <button class="btn btn-primary" method="submit"><i class="fa fa-search"></i>Tìm Kiếm</button>
                                                <button class="btn btn-success" id="export"><i class="fa fa-cloud-download-alt"></i>Export</button>
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
        @endcan

    </div>

    <div class="modal fade" id="modal-log" tabindex="-1" aria-labelledby="select-column-modal-label"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="select-column-modal-label">Chi tiết lệnh chuyển</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="md-content"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-list" tabindex="-1" aria-labelledby="select-column-modal-label"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="select-column-modal-label">Chi tiết giao dịch đã chuyển</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="md-content-list"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-schedule" tabindex="-2">
        {{--    <div class="modal fade in show" style="display: initial" id="modal-schedule" tabindex="-1">--}}
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex" style="align-items: center">
                        <h5 class="modal-title pr-3">Danh sách lịch đã chạy</h5>
                        <button class="btn btn-primary" id="btnSetState" data-status="" schedule-type="" data-id=""></button>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="md-schedule-list">
                    <div class="kt-datatable" id="tblScheduleLog"></div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="modal-reschedule-once" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex" style="align-items: center">
                        <h5 class="modal-title pr-3">Bật hẹn lại lịch chạy</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label class="mt-2 col-form-label">
                                Thời gian chuyển
                                <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <div class="">
                                <input type='text' class="form-control col-md-2" id="datetime_schedule" name="schedule_at"
                                       readonly placeholder="Chọn thời gian chuyển" type="text"
                                       value="{{old('schedule_at', now()->addHours(2)->startOfHour()->format('H:i'))}}"/>
                            </div>
                            <div class="text-danger mt-1" data-name="schedule_at"></div>
                        </div>
                    </div>

                    <div class="form-group row {{(!old('schedule_type') || old('schedule_type') === 'once') ? '':'sr-only'}}">
                        <div class="col-md-3">
                            <label class="mt-2 col-form-label">
                                Ngày chuyển
                                <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                            </label>
                        </div>
                        <div class="col-md-9">
                            <div class="">
                                <input type='text' class="form-control col-md-6" id="date_schedule" name="scheduled_date"
                                       readonly placeholder="Chọn ngày chuyển" type="text"
                                       value="{{old('scheduled_date', now()->addDay()->format('d/m/Y'))}}"/>
                                <div class="help-block">Định dạng ngày/tháng/năm</div>
                            </div>
                            <div class="text-danger mt-1" data-name="scheduled_date"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary" id="onceConfirm">Xác nhận & bật lại lịch chạy</button>
                </div>
            </div>
        </div>
    </div>

    @include('elements.loading')
@endsection
@can('transfer-transaction-log')

@section('script')
    <script>
        var selectedAccountFrom = @json($accountFrom);
        var selectedAccountTo = @json($accountTo);
        var statuses = {
            schedule: '{{\App\Models\TransferLog::STATUS_SCHEDULE}}',
            paused: '{{\App\Models\TransferLog::STATUS_PAUSED}}',
            done: '{{\App\Models\TransferLog::STATUS_DONE}}'
        }
        var csrf = '{{csrf_token()}}';
        var canViewTransaction = parseInt('{{Auth::user()->can('transfer-transaction-view') ? 1 : 0}}');
    </script>
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="/admin/js/pages/system/transfer/transfer-log.js?v={{time()}}" type="text/javascript" defer></script>

@endsection
@endcan
