<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách item thẻ
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="d-flex">
                        @can('shopcard-card-item-add')
                            <a href="/shopcard-card-items/export-card" class="btn btn-brand btn-icon-sm" style="margin-right: 15px"><i class="flaticon2-plus"></i>
                                Xuất card</a>
                        @endcan
                        @can('shopcard-card-item-add')
                            <a href="/shopcard-card-items/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i>
                                Thêm card</a>
                        @endcan
                        @can('shopcard-card-item-edit')
                            <a href="/shopcard-card-items/extend" class="btn btn-danger btn-icon-sm ml-3"><i
                                    class="flaticon2-time"></i> Gia hạn card</a>
                        @endcan
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
                                        <label>Serial:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="shopcarditem_serial" type="text" class="form-control" name="serial"
                                                value="{{ request()->input('serial') }}">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                                <label>Vendor:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" class="form-control" name="vendor" value="{{ request()->input('vendor') }}">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-search"></i></span>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                                <label>Value:</label>
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" class="form-control" name="value" value="{{ request()->input('value') }}">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-search"></i></span>
                                                </span>
                                                </div>
                                            </div>
                                             -->
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Value:</label>
                                        <div class="kt-input-icon">
                                            <select id="shopcarditem_value" type="text" class="form-control" name="value"
                                                value="{{ request()->input('value') }}">
                                                <option value="all" @if (request()->input('value') === 'All') selected @endif>All</option>
                                                <option value="10000" @if (request()->input('value') === '10000') selected @endif>10000</option>
                                                <option value="20000" @if (request()->input('value') === '20000') selected @endif>20000</option>
                                                <option value="30000" @if (request()->input('value') === '30000') selected @endif>30000</option>
                                                <option value="50000" @if (request()->input('value') === '50000') selected @endif>50000</option>
                                                <option value="100000" @if (request()->input('value') === '100000') selected @endif>100000</option>
                                                <option value="200000" @if (request()->input('value') === '200000') selected @endif>20000</option>
                                                <option value="300000" @if (request()->input('value') === '300000') selected @endif>300000</option>
                                                <option value="500000" @if (request()->input('value') === '500000') selected @endif>500000</option>
                                                <option value="1000000" @if (request()->input('value') === '1000000') selected @endif>1000000</option>
                                                <option value="2000000" @if (request()->input('value') === '2000000') selected @endif>2000000</option>
                                                <option value="3000000" @if (request()->input('value') === '3000000') selected @endif>3000000</option>
                                                <option value="5000000" @if (request()->input('value') === '5000000') selected @endif>5000000</option>
                                            </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Vendor:</label>
                                        <div class="kt-input-icon">
                                            <select id="shopcarditem_vendor" type="text" class="form-control" name="vendor"
                                                value="{{ request()->input('vendor') }}">
                                                <option value="all" @if (request()->input('vendor') === 'all') selected="true" @endif>All</option>
                                                <option value="appota" @if (request()->input('vendor') === 'appota') selected="true" @endif>Appota</option>
                                                <option value="viettel" @if (request()->input('vendor') === 'viettel') selected="true" @endif>Viettel</option>
                                                <option value="mobifone" @if (request()->input('vendor') === 'mobifone') selected="true" @endif>Mobifone
                                                </option>
                                                <option value="vinaphone" @if (request()->input('vendor') === 'vinaphone') selected="true" @endif>Vinaphone
                                                </option>
                                                <option value="vnmobile" @if (request()->input('vendor') === 'vnmobile') selected="true" @endif>VNMobile
                                                </option>
                                                <option value="beeline" @if (request()->input('vendor') === 'beeline') selected="true" @endif>Beeline</option>
                                                <option value="zing" @if (request()->input('vendor') === 'zing') selected="true" @endif>Zing</option>
                                                <option value="vcoin" @if (request()->input('vendor') === 'vcoin') selected="true" @endif>VCoin</option>
                                                <option value="gate" @if (request()->input('vendor') === 'gate') selected="true" @endif>Gate</option>
                                                <option value="garena" @if (request()->input('vendor') === 'garena') selected="true" @endif>Garena</option>
                                                <option value="megacard" @if (request()->input('vendor') === 'megacard') selected="true" @endif>MegaCard
                                                </option>
                                                <option value="scoin" @if (request()->input('vendor') === 'scoin') selected="true" @endif>SCoin</option>
                                                <option value="oncash" @if (request()->input('vendor') === 'oncash') selected="true" @endif>OnCash</option>
                                                <option value="soha" @if (request()->input('vendor') === 'soha') selected="true" @endif>Soha</option>
                                                <option value="funtap" @if (request()->input('vendor') === 'funtap') selected="true" @endif>Funtap</option>
                                                <option value="viettel_data" @if (request()->input('vendor') === 'viettel_data') selected="true" @endif>Viettel Data
                                                </option>
                                                <option value="mobifone_data" @if (request()->input('vendor') === 'mobifone_data') selected="true" @endif>Mobifone Data
                                                </option>
                                                <option value="vinaphone_data" @if (request()->input('vendor') === 'vinaphone_data') selected="true" @endif>Vinaphone Data
                                                </option>
                                            </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Provider:</label>
                                        <div class="kt-input-icon">
                                            <select class="form-control" id="provider_code" name="provider_code">
                                                <option value="all" @if (request()->input('provider_code') === 'all') selected="true" @endif>All</option>
                                                <option value="APPOTACARD" @if (request()->input('provider_code') === 'APPOTACARD') selected="true" @endif>APPOTACARD
                                                </option>
                                                <option value="GATE" @if (request()->input('provider_code') === 'GATE') selected="true" @endif>GATE</option>
                                                <option value="VTC" @if (request()->input('provider_code') === 'VTC') selected="true" @endif>VTC</option>
                                                <option value="VTCMOBILE" @if (request()->input('provider_code') === 'VTCMOBILE') selected="true" @endif>VTCMOBILE
                                                </option>
                                                <option value="IMEDIA" @if (request()->input('provider_code') === 'IMEDIA') selected="true" @endif>IMEDIA</option>
                                                <option value="OCTA" @if (request()->input('provider_code') === 'OCTA') selected="true" @endif>OCTA</option>
                                                <option value="EPAY" @if (request()->input('provider_code') === 'EPAY') selected="true" @endif>EPAY</option>
                                                <option value="ZOTA" @if (request()->input('provider_code') === 'ZOTA') selected="true" @endif>ZOTA</option>
                                            </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Public:</label>
                                        <div class="kt-input-icon">
                                            <select id="shopcarditem_public" type="text" class="form-control" name="public"
                                                value="{{ request()->input('public') }}">
                                                <option value="all" @if (request()->input('public') === 'all') selected="true" @endif>All</option>
                                                <option value="yes" @if (request()->input('public') === 'yes') selected="true" @endif>Yes</option>
                                                <option value="no" @if (request()->input('public') === 'no') selected="true" @endif>No</option>
                                            </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Sold:</label>
                                        <div class="kt-input-icon">
                                            <select id="shopcarditem_sold" type="text" class="form-control" name="sold"
                                                value="{{ request()->input('sold') }}">
                                                <option value="all" @if (request()->input('sold') === 'all') selected="true" @endif>All</option>
                                                <option value="yes" @if (request()->input('sold') === 'yes') selected="true" @endif>Yes</option>
                                                <option value="no" @if (request()->input('sold') === 'no') selected="true" @endif>No</option>
                                            </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày hết hạn- bắt đầu:(Tháng/Ngày/Năm)</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_1" name="startTime"
                                                readonly placeholder="Chọn thời gian bắt đầu" type="text"
                                                value="{{ request()->input('startTime') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày hết hạn kết thúc:(Tháng/Ngày/Năm)</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_2" name="endTime"
                                                readonly placeholder="Chọn thời gian kết thúc" type="text"
                                                value="{{ request()->input('endTime') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày tạo item- bắt đầu:(Tháng/Ngày/Năm)</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_3"
                                                name="createStartTime" readonly placeholder="Chọn thời gian bắt đầu"
                                                type="text" value="{{ request()->input('createStartTime') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày tạo item- kết thúc:(Tháng/Ngày/Năm)</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_1"
                                                name="createEndTime" readonly placeholder="Chọn thời gian kết thúc"
                                                type="text" value="{{ request()->input('createEndTime') }}" />
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <button class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                           {{--  <button id="exportTransaction" class="btn btn-success"
                                                method="submit">Export</button> --}}
                                                <button wire:click.prevent = "$emit('ExportShopCardItemScript')" class="btn btn-success">Export</button>
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
