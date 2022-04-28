@extends('index')
@section('page-header', 'Danh sách thẻ')
@section('page-sub-header', 'Danh sách thẻ')
@section('style')
    <style>
        .btn-show {
            display: none;
        }
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
                    Config auto import card
                </h3>
            </div>
        </div>
        <form action="">
            <table class="table table-borderless">
                <tr>
                    <th>Mệnh giá</th>
                    <th>Số lượng</th>
                    <th>Min card</th>
                    <th>Provider</th>
                </tr>
                @foreach($cardByVendors as $k => $v)
                    <tr>
                        <td><b>{{ $k }}</b> <button type="button" class="btn btn-success btn-show" vendor="{{ $k }}">Hiện</button><button type="button" class="btn btn-danger btn-hidden" vendor="{{ $k }}">Ẩn</button></td>
                    </tr>
                    @foreach($v as $k_card => $v_card)
                        <tr class="{{ $k }}">
                            <td width="25%" class="text-center">{{ $k_card }}</td>
                            <td width="25%"><input type="number" name="{{$k}}[{{ $k_card }}][quantity]" class="form-control" value="{{ $v_card['quantity'] }}"></td>
                            <td width="25%"><input type="number" name="{{$k}}[{{ $k_card }}][min_card]" class="form-control" value="{{ $v_card['min_card'] }}"></td>
                            <td width="25%">
                                <select name="{{$k}}[{{ $k_card }}][provider_id]" class="form-control" id="" style="margin: .4rem 0;">
                                    @foreach($providers as $k_provider => $provider)
                                        <option value="{{ $provider->providerId }}" {{  @$v_card['provider_id'] == $provider->providerId ? 'selected' : '' }}>{{ $provider->providerCode }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
            <button type="button" class="btn btn-success btn-submit-save-config-auto-import-card">Cập nhật</button>
            <button type="button" class="btn btn-success export">Export</button>
        </form>
    </div>
@endsection
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/shop-card-auto-import-card/index.js?v={{ time() }}" type="text/javascript" defer></script>
@endsection
