@extends('index')
@section('page-header', 'Nạp game')
@section('page-sub-header', 'Danh sách game')
@section('style')
    <style>
        .gameImageWrap {
            position: relative;
            width: 70px;
            height: 70px;
            border-radius: 10px;
            border: 1px solid #CCCCCC;
            box-shadow: 0px 0px 5px 0px #ccc;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            overflow: hidden;
        }
        .gameImage {
            height: 100%;
        }
    </style>
@endsection
@section('content')
    @include('elements.loading', ['loading_position' => 'absolute'])
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách game
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">

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
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label
                                            class="form-label">Partner {{request()->input('partner_code') ? '['.request()->input('partner_code').']' : ''}}</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <select class="form-control" id="partnerCode" name="partner_code">
                                                @if(request()->input('partner_code'))
                                                    <option value="{{request()->input('partner_code')}}">{{request()->input('partner_code')}}</option>
                                                @else
                                                    <option value=""></option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày bắt đầu:</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_1" name="startTime"
                                                   readonly placeholder="Chọn thời gian bắt đầu" type="text"
                                                   value="{{ request()->input('startTime')}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày kết thúc:</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_2" name="endTime"
                                                   readonly placeholder="Chọn thời gian kết thúc" type="text"
                                                   value="{{ request()->input('endTime')}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label
                                            class="form-label">Kênh bán</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <select class="form-control" id="applicationId" name="application_id">
                                                @if(request()->input('application_id'))
                                                    <option
                                                        value="{{request()->input('application_id')}}">{{request()->input('application_id')}}</option>
                                                @else
                                                    <option value=""></option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Hoạt động</label>
                                        <div class="kt-input-icon">
                                            <select type="text" class="form-control select2_default" name="active"
                                                    value="{{ request()->input('active')}}">
                                                @foreach($actives as $value => $method)
                                                    <option
                                                        value="{{$value}}" {{(string)$filter['active'] === (string)$value ? 'selected' : ''}}>{{$method}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Trạng thái duyệt</label>
                                        <div class="kt-input-icon">
                                            <select type="text" class="form-control select2_default" name="status">
                                                @foreach($statuses as $value => $status)
                                                    <option
                                                        value="{{$value}}" {{request()->input('status') == $value ? 'selected' : ''}}>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Tên game</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="game_name"
                                                   value="{{request()->input('game_name')}}" placeholder="Tên game">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                            <button class="btn btn-success btn-export-flash-chart">Export</button>
                                            <a href="{{route('game.setting')}}" class="btn btn-default float-right">Xoá bộ lọc</a>
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

    @include('game.partials.setting_modal_detail')
    @include('game.partials.setting_modal_update')
@endsection

@section('script')
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="/admin/js/pages/game/game-setting.js?v={{time()}}" type="text/javascript" defer></script>

@endsection
