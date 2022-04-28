<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Thêm mới Bill Provider Service Match</h3>
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
                        <!--begin::Form-->
                        <div class="kt-form">
                            <div class="kt-portlet__body">

                              {{--   <div class="form-group row">
                                    <label for="providerServiceCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner Code:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                       {{--  <span>{{$message}}</span> --}}
                                       {{--  <input list="partnerCodeList" class="form-control" type="text" value="" id="partnerCode" name="partnerCode" required="required"> --}}
                                        {{-- @dd($partnerCodelist) --}}
                                        {{-- <datalist id="partnerCodeList">
                                            @if(isset($partnerCodelist))
                                            @foreach($partnerCodelist as $list)
                                            <option value="{{$list->partner_code}}"></option>
                                            @endforeach
                                            @endif
                                        </datalist>
                                    </div>
                                </div> --}}

                                {{-- <div class="form-group row">
                                    <label for="providerServiceCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider Code:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input list="providerCodeList" class="form-control" type="text" value="" id="providerCode" name="providerCode" required="required">
                                        <datalist id="providerCodeList">
                                            @if(isset($providerCodeList))
                                            @foreach($providerCodeList as $listProvider)
                                            <option value="{{$listProvider->providerCode}}"></option>
                                            @endforeach
                                            @endif
                                        </datalist>
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <label for="providerServiceCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Nhà Cung Cấp Dịch Vụ:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" value="" id="providerServiceCode" name="providerServiceCode" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="providerPublisherCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Nhà Cung Cấp Publisher:  <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <input class="form-control" type="text" value="" id="providerPublisherCode" name="providerPublisherCode" required="required">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="serviceCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Mã Dịch Vụ:</label>
                                    <div class="col-12 col-lg-12 col-xl-9">
                                        <select required="required" class="form-control" id="serviceCode" name="serviceCode">
                                        </select>
                                    </div>
                                </div>

                                @if(isset($data['listBillProvider']))
                                @forelse ($data['listBillProvider'] as $provider)
                                <div class="form-group row">
                                    <label for="categoryCode" class="col-2 col-lg-2 col-xl-3 col-form-label">{{ $provider->providerName }}:</label>
                                    <div class="col-6 col-lg-6 col-xl-4">
                                        <input class="form-control" type="text" value="" id="{{ $provider->providerCode }}" name="{{ $provider->providerCode }}">
                                    </div>
                                    <div class="col-4 col-lg-4 col-xl-5 row">
                                        <label for="public" class="col-9 col-lg-9 col-xl-3 col-form-label">Public:</label>
                                        <div class="col-3">
                                            <span class="kt-switch kt-switch-outline kt-switch-icon kt-switch-success">
                                                <label>
                                                    <input type="checkbox" name="public_{{ $provider->providerCode }}">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3">
                    <div class="kt-portlet">
                        <div class="kt-portlet__foot kt-align-right p-3">
                            <div>
                                {{csrf_field()}}
                                <button type="button" class="btn btn-primary" id="btn_add"><i class="la la-save"></i> Lưu dữ liệu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- end:: Content -->
</div>
</div>
