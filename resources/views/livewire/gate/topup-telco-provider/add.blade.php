<div>
     {{-- @dump() --}}
    {{-- The whole world belongs to you. --}}
{{--     @dump($providerCodeData)
    @foreach($providerCodeData as $d)
    @dump($d)
    @endforeach --}}

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Thêm mới topup telco provider</h3>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->





        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
            <button class="nav-link active" id="config1-tab" data-bs-toggle="tab" data-bs-target="#config1" type="button" role="tab" aria-controls="config1" aria-selected="true">Config 1</button>
          </li>


          <li class="nav-item" role="presentation">
            <button class="nav-link" id="config2-tab" data-bs-toggle="tab" data-bs-target="#config2" type="button" role="tab" aria-controls="config2" aria-selected="false">Config 2</button>
          </li>


          <li class="nav-item" role="presentation">
            <button class="nav-link" id="config3-tab" data-bs-toggle="tab" data-bs-target="#config3" type="button" role="tab" aria-controls="config3" aria-selected="false">Config 3</button>
          </li>


          <li class="nav-item" role="presentation">
            <button class="nav-link" id="config4-tab" data-bs-toggle="tab" data-bs-target="#config4" type="button" role="tab" aria-controls="config4" aria-selected="false">Config 4</button>
          </li>

        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="config1" role="tabpanel" aria-labelledby="config1-tab">
            <h3>Config 1</h3>

            @if($message1)
                <div style="margin: 10px; width: 70%;" class="alert alert-primary" role="alert">
                  {{$message1}}
                </div>
            @endif


            {{-- begin content config 1--}}
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <form id="kt_add_form">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="kt-portlet">
                            <!--begin::Form-->
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <select
                                            class="form-control"
                                            id="telco"
                                            name="telco"
                                            wire:model.prevent="telcoValue"
                                            wire:change="$emit('getTelcoValueScript')"
                                            >
                                                <option selected="selected" value="viettel">Viettel</option>
                                                <option value="mobifone">Mobifone</option>
                                                <option value="vinaphone">Vinaphone</option>
                                                <option value="vnmobile">VNMobile</option>
                                                <option value="beeline">Beeline</option>
                                                <option value="viettel_data">Viettel Data</option>
                                                <option value="mobifone_data">Mobifone Data</option>
                                                <option value="vinaphone_data">Vinaphone Data</option>
                                                <option value="vnmobile_data">VNMobile Data</option>
                                                <option value="beeline_data">Beeline Data</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code
                                            <span class="kt-font-danger">
                                                <i class="fa fa-xs fa-star"></i>
                                            </span>
                                        </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{-- <select style="width:100%" class="form-control" id="providerCode" name="providerCode"></select> --}}

                                      {{--   <input class="form-control" type="text" id="input-providerCodeLivewire" name="providerCode"> --}}

                                        <select class="form-control" id="input-providerCodeLivewire" name="providerCode">
                                            @foreach($providerCodeData as $providerCodeData1)
                                            <option value="{{$providerCodeData1}}">{{$providerCodeData1}}</option>
                                            @endforeach
                                        </select>

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Value <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select
                                            class="form-control"
                                            id="telcoValue"
                                            name="telcoValue"

                                            >
                                                @foreach($telcoValueData2 as $telData)
                                                <option value="{{$telData}}">{{$telData}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="telcoServiceType" name="telcoServiceType" >
                                                <option value="prepaid">prepaid</option>
                                                <option value="postpaid">postpaid</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner Code<span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input required type="text" class="form-control" name="parner_code_value" id="parner_code_value">
                                        </div>
                                    </div>





                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="kt-portlet">
                            <div class="kt-portlet__foot kt-align-right p-2">
                                <div>
                                    {{-- <button type="button" class="btn btn-primary" id="btn_add"><i class="la la-save"></i> Lưu dữ liệu</button> --}}
                                    <a href="#" wire:click.prevent="$emit('SaveConfig1Script')" class="btn btn-primary"><i class="la la-save"></i>Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- end:: Content config 1 -->

        </div>


          <div class="tab-pane fade show active" id="config2" role="tabpanel" aria-labelledby="config2-tab">
            <h3>Config 2</h3>
            @if($message2)
                <div style="margin: 10px; width: 70%;" class="alert alert-primary" role="alert">
                  {{$message2}}
                </div>
            @endif
            {{-- begin content config 2--}}
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <form id="kt_add_form">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="kt-portlet">
                            <!--begin::Form-->
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <select
                                            class="form-control"
                                            id="telco-config2"
                                            name="telco"
                                            >
                                                <option selected="selected" value="viettel">Viettel</option>
                                                <option value="mobifone">Mobifone</option>
                                                <option value="vinaphone">Vinaphone</option>
                                                <option value="vnmobile">VNMobile</option>
                                                <option value="beeline">Beeline</option>
                                                <option value="viettel_data">Viettel Data</option>
                                                <option value="mobifone_data">Mobifone Data</option>
                                                <option value="vinaphone_data">Vinaphone Data</option>
                                                <option value="vnmobile_data">VNMobile Data</option>
                                                <option value="beeline_data">Beeline Data</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code
                                            <span class="kt-font-danger">
                                                <i class="fa fa-xs fa-star"></i>
                                            </span>
                                        </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                      <select class="form-control" id="input-providerCodeLivewire-config2" name="providerCode">
                                            @foreach($providerCodeData as $providerCodeData2)
                                            <option value="{{$providerCodeData2}}">{{$providerCodeData2}}</option>
                                            @endforeach
                                        </select>

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="telcoServiceTypeConfig2" name="telcoServiceType" >
                                                <option value="prepaid">prepaid</option>
                                                <option value="postpaid">postpaid</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner Code<span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <input type="text" class="form-control" name="parner_code_value_config2" id="parner_code_value_config2">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="kt-portlet">
                            <div class="kt-portlet__foot kt-align-right p-2">
                                <div>
                                    {{-- <button type="button" class="btn btn-primary" id="btn_add"><i class="la la-save"></i> Lưu dữ liệu</button> --}}
                                    <a href="#" class="btn btn-primary" wire:click.prevent="$emit('SaveConfig2Script')"><i class="la la-save"></i>Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- end:: Content config 2 -->

          </div>
          <div class="tab-pane fade show active" id="config3" role="tabpanel" aria-labelledby="config3-tab">

            <h3>Config 3</h3>
            {{-- begin content config 3--}}
            @if($message3)
                <div style="margin: 10px; width: 70%;" class="alert alert-primary" role="alert">
                  {{$message3}}
                </div>
            @endif
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <form id="kt_add_form">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="kt-portlet">
                            <!--begin::Form-->
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <select
                                            class="form-control"
                                            id="telco-config3"
                                            name="telco"
                                            >
                                                <option selected="selected" value="viettel">Viettel</option>
                                                <option value="mobifone">Mobifone</option>
                                                <option value="vinaphone">Vinaphone</option>
                                                <option value="vnmobile">VNMobile</option>
                                                <option value="beeline">Beeline</option>
                                                <option value="viettel_data">Viettel Data</option>
                                                <option value="mobifone_data">Mobifone Data</option>
                                                <option value="vinaphone_data">Vinaphone Data</option>
                                                <option value="vnmobile_data">VNMobile Data</option>
                                                <option value="beeline_data">Beeline Data</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code
                                            <span class="kt-font-danger">
                                                <i class="fa fa-xs fa-star"></i>
                                            </span>
                                        </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                      <select class="form-control" id="input-providerCodeLivewire-config3" name="providerCode">
                                            @foreach($providerCodeData as $providerCodeData3)
                                            <option value="{{$providerCodeData3}}">{{$providerCodeData3}}</option>
                                            @endforeach
                                        </select>

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="telcoServiceTypeConfig3" name="telcoServiceType" >
                                                <option value="prepaid">prepaid</option>
                                                <option value="postpaid">postpaid</option>
                                            </select>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="kt-portlet">
                            <div class="kt-portlet__foot kt-align-right p-2">
                                <div>
                                    {{-- <button type="button" class="btn btn-primary" id="btn_add"><i class="la la-save"></i> Lưu dữ liệu</button> --}}
                                    <a
                                    class="btn btn-primary"
                                    wire:click.prevent="$emit('SaveConfig3Script')"
                                    style="color: #FFF;"
                                    >
                                    <i class="la la-save"></i>Save</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- end:: Content config 3 -->
          </div>


          <div class="tab-pane fade show active" id="config4" role="tabpanel" aria-labelledby="config4-tab">
            <h3>Config 4</h3>
            @if($message4)
                <div style="margin: 10px; width: 70%;" class="alert alert-primary" role="alert">
                  {{$message4}}
                </div>
            @endif

          {{-- begin content config 4--}}
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <form id="kt_add_form">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="kt-portlet">
                            <!--begin::Form-->
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <select
                                            class="form-control"
                                            id="telco4"
                                            name="telco4"
                                            wire:model.prevent="telcoValue4"
                                            wire:change="$emit('getTelcoValue4Script')"
                                            >
                                                <option selected="selected" value="viettel">Viettel</option>
                                                <option value="mobifone">Mobifone</option>
                                                <option value="vinaphone">Vinaphone</option>
                                                <option value="vnmobile">VNMobile</option>
                                                <option value="beeline">Beeline</option>
                                                <option value="viettel_data">Viettel Data</option>
                                                <option value="mobifone_data">Mobifone Data</option>
                                                <option value="vinaphone_data">Vinaphone Data</option>
                                                <option value="vnmobile_data">VNMobile Data</option>
                                                <option value="beeline_data">Beeline Data</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code
                                            <span class="kt-font-danger">
                                                <i class="fa fa-xs fa-star"></i>
                                            </span>
                                        </label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                        <select class="form-control" id="input4-providerCodeLivewire" name="providerCode">
                                            @foreach($providerCodeData as $providerCodeData4)
                                            <option value="{{$providerCodeData4}}">{{$providerCodeData4}}</option>
                                            @endforeach
                                        </select>

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Value <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select
                                            class="form-control"
                                            id="telcoValue4"
                                            name="telcoValue"
                                            >
                                                @foreach($telcoValue4Data as $telData4)
                                                <option value="{{$telData4}}">{{$telData4}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            <select class="form-control" id="telcoServiceType4" name="telcoServiceType" >
                                                <option value="prepaid">prepaid</option>
                                                <option value="postpaid">postpaid</option>
                                            </select>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="kt-portlet">
                            <div class="kt-portlet__foot kt-align-right p-2">
                                <div>
                                    {{-- <button type="button" class="btn btn-primary" id="btn_add"><i class="la la-save"></i> Lưu dữ liệu</button> --}}
                                    {{-- <a href="#" wire:click.prevent="$emit('SaveConfig1Script')" class="btn btn-primary"><i class="la la-save"></i>Save</a> --}}
                                    <li style="list-style: none;" class="nav-item" role="presentation">
                                        <button wire:click.prevent="$emit('SaveConfig4Script')" class="btn btn-primary" id="config4-tab" data-bs-toggle="tab" data-bs-target="#config4" type="button" role="tab" aria-controls="config4" aria-selected="false"><i class="la la-save"></i>Save</button>
                                      </li>
                                      {{-- <span>{{$message}}</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- end:: Content config 4 -->


            </div>
        </div>





    </div>

</div>
