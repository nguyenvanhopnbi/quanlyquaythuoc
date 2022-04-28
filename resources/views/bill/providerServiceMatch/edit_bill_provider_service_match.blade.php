@extends('index')
@section('page-header', 'Bill Provider Service Match')
@section('page-sub_header', 'Cập nhật bill provider Service Match')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Cập nhật Bill Provider Service Match</h3>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <form id="kt_add_form">
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head kt-portlet__head--right">
                            <div class="kt-portlet__head-label ">
                                <span class="kt-font-danger"><i class="fa fa-star"></i> Bắt buộc phải nhập / chọn nội dung</span>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <div class="kt-form">
                            <div class="kt-portlet__body">

                                {{-- @dd($partnerCodelist) --}}
                                {{-- <div class="form-group row">

                                    <label for="providerServiceCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner Code:</label>

                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input list="partnerCodeListID" class="form-control" type="text" value="{{$data['billProviderServiceMatch']->partnerCode}}" id="partnerCode" name="partnerCode" required="required">
                                        <datalist id="partnerCodeListID">
                                            @if(isset($partnerCodelist))
                                            @foreach($partnerCodelist as $list)
                                            <option value="{{$list->partner_code}}"></option>
                                            @endforeach
                                            @endif
                                        </datalist>
                                    </div>

                                </div> --}}

                                <div class="form-group row">
                                    <label for="providerServiceCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Nhà Cung Cấp Dịch Vụ:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" value="{{$data['billProviderServiceMatch']->providerServiceCode}}" id="providerServiceCode" name="providerServiceCode" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="providerPublisherCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Nhà Cung Cấp Publisher:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" value="{{$data['billProviderServiceMatch']->providerPublisherCode}}" id="providerPublisherCode" name="providerPublisherCode" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="providerPublisherCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Nhà Cung Cấp:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">

                                        <select class="form-control" id="providerCode" name="providerCode">
                                            @forelse ($data['listBillProvider'] as $provider)
                                            <option value="{{ $provider->providerCode }}" {{($data['billProviderServiceMatch']->providerCode == $provider->providerCode) ? 'selected' : ''}}>{{ $provider->providerName }}</option>
                                            @empty
                                            <option value="">Không tìm thấy danh sách Provider</option>
                                            @endforelse
                                        </select>

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="providerPublisherCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Dịch Vụ:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">

                                        <select class="form-control" id="serviceCode" name="serviceCode">
                                            @forelse ($data['listBillService'] as $service)
                                            <option value="{{ $service->serviceCode }}" {{($data['billProviderServiceMatch']->serviceCode == $service->serviceCode) ? 'selected' : ''}}>{{ $service->serviceName }}</option>
                                            @empty
                                            <option value="">Không tìm thấy danh sách Service</option>
                                            @endforelse
                                        </select>

                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <label for="providerPublisherCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Public:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">

                                        <select class="form-control" id="public" name="public">
                                            <option value="yes" {{($data['billProviderServiceMatch']->public == 'yes') ? 'selected' : ''}}>Yes</option>
                                            <option value="no" {{($data['billProviderServiceMatch']->public == 'no') ? 'selected' : ''}}>No</option>
                                        </select>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3">
                    <div class="kt-portlet">
                        <div class="kt-portlet__foot kt-align-right p-3">

                           {{--  <div class="form-group row mb-3">
                                <label for="categoryCode" class="col-4 col-form-label">Mã Nhà Cung Cấp:</label>
                                <div class="col-8">
                                    <select class="form-control" id="providerCode" name="providerCode">
                                            @forelse ($data['listBillProvider'] as $provider)
                                            <option value="{{ $provider->providerCode }}" {{($data['billProviderServiceMatch']->providerCode == $provider->providerCode) ? 'selected' : ''}}>{{ $provider->providerName }}</option>
                                            @empty
                                            <option value="">Không tìm thấy danh sách Provider</option>
                                            @endforelse
                                        </select>
                                </div>
                            </div> --}}

                           {{--  <div class="form-group row mb-3">
                                <label for="serviceCode" class="col-4 col-form-label">Mã Dịch Vụ:</label>
                                <div class="col-8">
                                    <select class="form-control" id="serviceCode" name="serviceCode">
                                            @forelse ($data['listBillService'] as $service)
                                            <option value="{{ $service->serviceCode }}" {{($data['billProviderServiceMatch']->serviceCode == $service->serviceCode) ? 'selected' : ''}}>{{ $service->serviceName }}</option>
                                            @empty
                                            <option value="">Không tìm thấy danh sách Service</option>
                                            @endforelse
                                        </select>
                                </div>
                            </div> --}}
{{--
                            <div class="form-group row mb-3">
                                <label for="public" class="col-4 col-form-label">Public:</label>
                                <div class="col-8">
                                    <select class="form-control" id="public" name="public">
                                            <option value="yes" {{($data['billProviderServiceMatch']->public == 'yes') ? 'selected' : ''}}>Yes</option>
                                            <option value="no" {{($data['billProviderServiceMatch']->public == 'no') ? 'selected' : ''}}>No</option>
                                        </select>
                                </div>
                            </div>
 --}}
                            <div>
                                {{csrf_field()}}
                                <input type="hidden" id="_id" name="_id" value="{{$data['billProviderServiceMatch']->id}}">
                                <button type="button" class="btn btn-primary" id="btn_edit"><i class="la la-save"></i> Lưu dữ liệu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- end:: Content -->
</div>
@endsection
@section('script')
<script src="admin/js/pages/bill/providerServiceMatch/edit_provider_service_match.js" type="text/javascript" defer></script>
@endsection
