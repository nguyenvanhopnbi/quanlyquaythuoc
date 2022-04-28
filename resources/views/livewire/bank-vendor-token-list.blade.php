<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
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
                                            <input type='text' class="form-control" id="kt_datepicker_1" name="fd"
                                                   readonly placeholder="Chọn thời gian bắt đầu" type="text"
                                                   value="{{$filter['fd']}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày kết thúc:</label>
                                            </div>
                                            <input type='text' class="form-control" id="kt_datepicker_2" name="td"
                                                   readonly placeholder="Chọn thời gian kết thúc" type="text"
                                                   value="{{$filter['td']}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Status</label>
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
                                        <label>Status 3ds</label>
                                        <div class="kt-input-icon">
                                            <select type="text" class="form-control select2_default" name="status_3ds">
                                                @foreach($statuses3ds as $value => $status)
                                                    <option
                                                        value="{{$value}}" {{request()->input('status_3ds') == $value ? 'selected' : ''}}>{{$status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Card number</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="card_number"
                                                   value="{{request()->input('card_number')}}" placeholder="Card number">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Card name</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="card_name"
                                                   value="{{request()->input('card_name')}}"
                                                   placeholder="Card name">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Bank code</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="bank_code" value="{{request()->input('bank_code')}}"
                                                   placeholder="Bank code">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Card type</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="card_type" value="{{request()->input('card_type')}}"
                                                   placeholder="Card type">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile form-group mb-0">
                                        <label>Vendor code</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="vendor_code" value="{{request()->input('vendor_code')}}"
                                                   placeholder="Vendor code">
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
                                            <a href="{{route('gate.bank_vendor.token.list')}}" class="btn btn-default float-right">Xoá bộ lọc</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
</div>
