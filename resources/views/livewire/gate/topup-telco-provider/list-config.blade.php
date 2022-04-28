<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Cấu Hình Dịch Vụ
                </h3>
            </div>
            <div style="display: none;" class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="/topup-telco-provider/add" class="btn btn-primary"><i class="flaticon2-plus"></i> Thêm telco provider</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body kt-portlet__body--fit">
        @include('elements.alert_flash')
        <!--begin: Datatable -->

        <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 10px">
          <li class="nav-item" role="presentation">
            <button class="nav-link @if($success1 == 1) {{'active'}} @endif" id="listconfig1-tab" data-bs-toggle="tab" data-bs-target="#listconfig1" type="button" role="tab" aria-controls="listconfig1" aria-selected="true">Config: Ưu tiên 1</button>

          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link @if($success2 == 1) {{'active'}} @endif" id="listconfig2-tab" data-bs-toggle="tab" data-bs-target="#listconfig2" type="button" role="tab" aria-controls="listconfig2" aria-selected="false">Config: Ưu tiên 2</button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link @if($success4 == 1) {{'active'}} @endif" id="listconfig4-tab" data-bs-toggle="tab" data-bs-target="#listconfig4" type="button" role="tab" aria-controls="listconfig4" aria-selected="false">Config: Ưu tiên 3</button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link @if($success3 == 1) {{'active'}} @endif" id="listconfig3-tab" data-bs-toggle="tab" data-bs-target="#listconfig3" type="button" role="tab" aria-controls="listconfig3" aria-selected="false">Config: Ưu tiên 4</button>
          </li>



        </ul>

        <div class="tab-content" id="myTabContent">

            {{-- List config 1 --}}
          <div class="tab-pane fade @if($success1 == 1) {{'show active'}} @endif" id="listconfig1" role="tabpanel" aria-labelledby="home-tab">

            <div class="kt-portlet__body">

            <!--begin: Search Form -->
            <label>Cấu hình dịch vụ theo Partner, Provider, Mệnh giá </label>
            <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Telco:</label>
                                        <div class="kt-input-icon kt-input-icon--left">

                                            <input list="telcoSearchConfig1" type="text" class="form-control" name="telcoconfig1" id="telcoconfig1" >

                                            <datalist id="telcoSearchConfig1">
                                                <option  value="viettel">
                                                <option value="mobifone">
                                                <option value="vinaphone">
                                                <option value="vnmobile">
                                                <option value="beeline">
                                                <option value="viettel_data">
                                                <option value="mobifone_data">
                                                <option value="vinaphone_data">
                                                <option value="vnmobile_data">
                                                <option value="beeline_data">

                                            </datalist>

                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Provider code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input list="providerCodeListConfig1Search" type="text" class="form-control" name="provider_code_searchconfig1" id="provider_code_searchconfig1">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">

                                            <datalist id="providerCodeListConfig1Search">
                                                @if(isset($providerCodeALL))
                                                @foreach($providerCodeALL as $providercodeSearchconfig1)
                                                <option
                                                    value="{{$providercodeSearchconfig1->providerCode}}">
                                                </option>
                                                @endforeach
                                                @endif
                                            </datalist>

                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input list="partnerCodeSearchConfig1" type="text" class="form-control" name="partnercode_code_searchconfig1" id="partnercode_code_searchconfig1">
                                            <datalist id="partnerCodeSearchConfig1">
                                                @if(isset($partnerCodeList))
                                                @foreach($partnerCodeList as $partnerCodeConfig1)
                                                <option value="{{$partnerCodeConfig1->partner_code}}">
                                                @endforeach
                                                @endif
                                            </datalist>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <a wire:click.prevent="$emit('searchConfig1Script')" class="btn btn-primary" style="color:#FFF">Search</a>
                                            <a type="button" data-toggle="modal" data-target="#addModalConfig1" style="color: #FFF;" class="btn btn-primary"> Add new </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        {{-- @dd($partnerCodeList) --}}



        <div class="kt-datatable_config1" id="ajax_data_listconfig1">

            {{-- Modal add new config 1 --}}
            @livewire('gate.topup-telco-provider.addconfig1')
            {{-- End modal --}}

            {{-- start modal edit config1 --}}

            <div wire:ignore.self class="modal fade" id="editConfig1ModalScript" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Config (Ưu tiên 1)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message1) and !empty($message1))
                    <div class="form-group row" id="messageResultc1">

                        <label class="alert @if($warning) {{'alert-warning'}} @else {{'alert-primary'}}  @endif ">{{$message1}}</label>

                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                        <div class="col-12 col-lg-12 col-xl-9">

                        <input wire:change.prevent="$emit('getTelcoValueConfig1Script')" list="listtelcoeditconfig111" type="text" id="telcoeditconfig111" class="form-control" >

                        <datalist id="listtelcoeditconfig111">
                            <option value="viettel">Viettel</option>
                            <option value="mobifone">Mobifone</option>
                            <option value="vinaphone">Vinaphone</option>
                            <option value="vnmobile">VNMobile</option>
                            <option value="beeline">Beeline</option>
                            <option value="viettel_data">Viettel Data</option>
                            <option value="mobifone_data">Mobifone Data</option>
                            <option value="vinaphone_data">Vinaphone Data</option>
                            <option value="vnmobile_data">VNMobile Data</option>
                            <option value="beeline_data">Beeline Data</option>
                        </datalist>

                    </div>
                    </div>


                <div class="form-group row">
                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code
                        <span class="kt-font-danger">
                            <i class="fa fa-xs fa-star"></i>
                        </span>
                    </label>
                    <div class="col-12 col-lg-12 col-xl-9">
                        <input type="text" list="providerCodeListConfig1Edit" class="form-control" id="editProviderCodeConfig1">

                        <datalist id="providerCodeListConfig1Edit">
                            @if(isset($providerCodeALL))
                            @foreach($providerCodeALL as $providercodeEditconfig1)
                            <option
                                value="{{$providercodeEditconfig1->providerCode}}">
                            </option>
                            @endforeach
                            @endif
                        </datalist>

                </div>
            </div>


            <div class="form-group row">
                <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Value <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                <div class="col-12 col-lg-12 col-xl-9">
                    <input type="text" list="editValueConfig1List" id="editValueConfig1" class="form-control">
                    {{-- @dump($telcoValueDatac1) --}}
                    <datalist id="editValueConfig1List">
                        @if(isset($telcoValueDatac1))
                        @foreach($telcoValueDatac1 as $telcoc1edit)
                        <option value="{{str_replace('.', '', $telcoc1edit)}}">{{$telcoc1edit}}</option>
                        @endforeach
                        @endif
                    </datalist>
                </div>
            </div>


            <div class="form-group row">
                <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                <div class="col-12 col-lg-12 col-xl-9">
                    <select class="form-control" id="telcoServiceTypeaddconfig1Edit" name="telcoServiceType" >
                        <option value="prepaid">prepaid</option>
                        <option value="postpaid">postpaid</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner Code<span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                <div class="col-12 col-lg-12 col-xl-9">
                    <input list="partnerCodeListConfig1edit" required type="text" class="form-control" name="parner_code_value" id="parner_code_value_editconfig1">
                    <datalist id="partnerCodeListConfig1edit">
                        @if(isset($partnerCodeList))
                        @foreach($partnerCodeList as $partnerCodeConfig1edit)
                            <option value="{{$partnerCodeConfig1edit->partner_code}}">
                        @endforeach

                        @endif
                    </datalist>


                    </div>
                </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('editConfig1Script2222')" type="button" class="btn btn-primary">Save changes</button>
                    <input type="hidden" value="{{$idEditConfig1111}}" id="idEditConfig1111">
                  </div>
                </div>
              </div>
            </div>
            {{-- end modal edit config1 --}}

            <div class="scrollme">
                <table class="table table-light">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Partner Code</th>
                        <th>Provider Code</th>
                        <th>Value</th>
                        <th>Telco</th>
                        <th>Telco Service Type</th>
                        <th>Update at</th>
                        <th>Action</th>
                    </tr>

                  </thead>
                  <tbody>
                   {{--  <tr id="row-messageUpudateDelete">
                        <td colspan="7" style="color: red;">
                            @if($message1)
                            {{$message1}}
                            @endif

                        </td>
                    </tr> --}}
                    {{-- @dump($listConfig1) --}}
                    @if(isset($listConfig1))
                    @foreach($listConfig1 as $list1)
                    <tr>
                        <td  id="providerID-{{$list1->providerId}}">{{$list1->providerId}}</td>
                        <td>
                        <input list="" id="partnerCodeConfig1-{{$list1->providerId}}" type="hidden" value="{{$list1->partnerCode}}">

                            {{$list1->partnerCode}}
                    </td>
                        <td>
                        <input id="providerCodeConfig1-{{$list1->providerId}}" type="hidden" value="{{$list1->providerCode}}">{{$list1->providerCode}}
                    </td>
                        <td>
                        <input id="value-{{$list1->providerId}}"  type="hidden" value="{{$list1->value}}">{{$list1->value}}

                    </td>
                        <td><input id="telcoConfig1-{{$list1->providerId}}" type="hidden" value="{{$list1->telco}}">{{$list1->telco}}
                    </td>

                        <td>
                        <input id="telcoServiceTypeConfig1-{{$list1->providerId}}" type="hidden" value="{{$list1->telco_service_type}}">{{$list1->telco_service_type}}
                    </td>
                    <td>
                        {{date('Y-m-d H:i:s', $list1->updated_at)}}
                    </td>

                        <td><a data-toggle="modal" data-target="#editConfig1ModalScript" wire:click.prevent="$emit('editConfig1ModalScript', '{{$list1->providerId}}')"><i class="flaticon2-pen"></i></a> | <a
                            wire:click.prevent="$emit('deleteConfig1Script', '{{$list1->providerId}}')">
                            <i class="flaticon2-delete"></i></a></td>

                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
            </div>


            @if(isset($page1))
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item @if(($page1 - 1) < 1) {{ 'disabled' }} @endif">

                  <a wire:click.prevent="getListConfig1Page1({{$page1 - 1}})" class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                @for($i = 1 ; $i <= $pages1 ; $i++)
                <li class="page-item"><a wire:click.prevent="getListConfig1Page1({{$i}})" class="page-link" href="#">{{$i}}</a></li>
                @endfor

                <li class="page-item @if(($page1 + 1) > $pages1) {{'disabled'}} @endif">
                  <a wire:click.prevent='getListConfig1Page1({{$page1 + 1}})' class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
            @endif

        </div>

        </div>

          {{-- End List config 1 --}}

        {{-- List config 2 --}}
        <div wire:ignore.self class="tab-pane fade @if($success2 == 1) {{'show active'}}  @endif" id="listconfig2" role="tabpanel" aria-labelledby="listconfig2-tab">
        <div class="kt-portlet__body">
        {{-- filter config2 --}}
        <label>  Cấu hình dịch vụ theo Partner, Provider </label>
        @livewire('gate.topup-telco-provider.filter-config2')
        {{-- end filter config 2 --}}
        </div>

            <div class="kt-datatable_config1" id="ajax_data_listconfig1">

                {{-- Modal add new config 2 --}}

                @livewire('gate.topup-telco-provider.addconfig2')
                {{-- End modal --}}


            {{-- start modal edit config2--}}

            <div wire:ignore.self class="modal fade" id="editConfig2ModalScript" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Config (Ưu tiên 2)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message2) and !empty($message2))
                    <div class="form-group row" id="messageResultc1">

                        <label class="alert @if($warning) {{'alert-warning'}} @else {{'alert-primary'}}  @endif ">{{$message2}}</label>

                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                        <div class="col-12 col-lg-12 col-xl-9">

                        <input list="listtelcoeditconfig2" type="text" id="telcoeditconfig2" class="form-control" >

                        <datalist id="listtelcoeditconfig2">
                            <option value="viettel">Viettel</option>
                            <option value="mobifone">Mobifone</option>
                            <option value="vinaphone">Vinaphone</option>
                            <option value="vnmobile">VNMobile</option>
                            <option value="beeline">Beeline</option>
                            <option value="viettel_data">Viettel Data</option>
                            <option value="mobifone_data">Mobifone Data</option>
                            <option value="vinaphone_data">Vinaphone Data</option>
                            <option value="vnmobile_data">VNMobile Data</option>
                            <option value="beeline_data">Beeline Data</option>
                        </datalist>

                    </div>
                    </div>


                <div class="form-group row">
                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code
                        <span class="kt-font-danger">
                            <i class="fa fa-xs fa-star"></i>
                        </span>
                    </label>
                    <div class="col-12 col-lg-12 col-xl-9">
                        <input type="text" list="providerCodeListConfig2Edit" class="form-control" id="editProviderCodeConfig2">

                        <datalist id="providerCodeListConfig2Edit">
                            @if(isset($providerCodeALL))
                            @foreach($providerCodeALL as $providercodeEditconfig1)
                            <option
                                value="{{$providercodeEditconfig1->providerCode}}">
                            </option>
                            @endforeach
                            @endif
                        </datalist>

                </div>
            </div>

            <div class="form-group row">
                <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                <div class="col-12 col-lg-12 col-xl-9">
                    <select class="form-control" id="telcoServiceTypeconfig2Edit" name="telcoServiceType" >
                        <option value="prepaid">prepaid</option>
                        <option value="postpaid">postpaid</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Partner Code<span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                <div class="col-12 col-lg-12 col-xl-9">
                    <input list="partnerCodeListConfig1edit" required type="text" class="form-control" name="parner_code_value" id="parner_code_value_editconfig2">
                    <datalist id="partnerCodeListConfig1edit">
                        @if(isset($partnerCodeList))
                        @foreach($partnerCodeList as $partnerCodeConfig1edit)
                            <option value="{{$partnerCodeConfig1edit->partner_code}}">
                        @endforeach

                        @endif
                    </datalist>


                    </div>
                </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('editConfig2Script')" type="button" class="btn btn-primary">Save changes</button>
                    <input type="hidden" value="{{$idEditConfig2}}" id="idEditConfig2">
                  </div>
                </div>
              </div>
            </div>
            {{-- end modal edit config2--}}
                <div class = "scrollme">
                    <table class="table table-light">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th> Partner Code </th>
                            <th>Provider Code</th>
                            <th>Telco</th>
                            <th>Telco Service Type</th>
                            <th>Update at</th>
                            <th>Action</th>
                        </tr>
                          </thead>
                          <tbody>
                           {{--  <tr>
                            <td style="color:red;" colspan="6" id="messageUpdateConfig2">
                                @if($message2)
                                {{$message2}}
                                @endif

                            </td>
                            </tr> --}}
                            @if(isset($listConfig2))
                            @foreach($listConfig2 as $list2)
                            <tr>
                                <td>
                                <input type="hidden" value="{{$list2->id}}" id = "id-{{$list2->id}}" />
                                {{$list2->id}}
                                </td>
                                <td>
                                <input type="hidden" list="partnerCodeConfig2" value="{{$list2->partnerCode}}" id="partnerCode-{{$list2->id}}" />

                                {{$list2->partnerCode}}
                                </td>
                                <td>
                                <input type="hidden" value="{{$list2->providerCode}}" id = "providerCodeConfig2-{{$list2->id}}" />{{$list2->providerCode}}
                                </td>
                                <td>
                                <input type="hidden" value="{{$list2->telco}}" id="telcoConfig2-{{$list2->id}}" />
                                {{$list2->telco}}

                                </td>
                                <td>
                                <input type="hidden" value="{{$list2->telco_service_type}}" id="telcoServiceTypeConfig2-{{$list2->id}}" />
                                {{$list2->telco_service_type}}
                                </td>

                               <td>
                                   {{date('Y-m-d H:i:s', $list2->updated_at)}}
                               </td>

                                <td>
                                <a
                                data-toggle="modal" data-target="#editConfig2ModalScript"
                                wire:click.prevent="$emit('getDataTableConfig2Script', '{{$list2->id}}')">
                                <i class="flaticon2-pen"></i></a> | <a wire:click.prevent="$emit('deleteConfig2Script', {{$list2->id}})"> <i class="flaticon2-delete"></i> </a> </td>
                            </tr>
                            @endforeach
                            @endif
                          </tbody>
                        </table>
                </div>

                @if(isset($page2))
                <nav aria-label="Page navigation example">
                  <ul class="pagination">

                    <li class="page-item @if(($page2 - 1) < 1) {{'disabled'}}  @endif">
                      <a wire:click.prevent="getListConfig1Page2({{$page2 - 1}})" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    @for($i = 1; $i <= $page2 ; $i++)
                    <li class="page-item"><a class="page-link" href="#">{{$i}}</a></li>
                    @endfor
                    <li class="page-item @if(($page2 + 1) > $pages2) {{'disabled'}}  @endif">
                      <a wire:click.prevent="getListConfig1Page2({{$page2 + 1}})" class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                @endif
            </div>


        </div>

        {{-- End List config 2 --}}

        {{-- Begin listConfig3 --}}



        <div wire:ignore.self class="tab-pane fade @if($success3 == 1) {{'show active'}} @endif" id="listconfig3" role="tabpanel" aria-labelledby="listconfig3-tab">
            <div class="kt-portlet__body">

            <!--begin: Search Form -->
            <label> Cấu hình dịch vụ theo Provider (Config ưu tiên 4) </label>
            <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Telco:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="telcoconfig3" id="telcoconfig3">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Provider code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" name="provider_codeConfig3" id="provider_codeConfig3">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <button wire:click.prevent="$emit('searchConfig3Script')" class="btn btn-primary" method="submit">Tìm Kiếm</button>
                                            <a type="button" data-toggle="modal" data-target="#addModalConfig3" style="color: #FFF;" class="btn btn-primary"> Add new </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

          <div class="kt-datatable_config3 table-config" id="ajax_data_config3">

           {{-- Modal add new config 44444444 --}}
                @livewire('gate.topup-telco-provider.addconfig3')
            {{-- End modal 44444444444 --}}


            {{-- start modal edit config 44444444444444444444--}}

            <div wire:ignore.self class="modal fade" id="editConfig444ModalScript" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Config (Ưu tiên 4)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message444) and !empty($message444))
                    <div class="form-group row" id="messageResultc1">

                        <label class="alert @if($warning) {{'alert-warning'}} @else {{'alert-primary'}}  @endif ">{{$message444}}</label>

                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                        <div class="col-12 col-lg-12 col-xl-9">

                        <input list="listtelcoeditconfig2" type="text" id="telcoeditconfig444" class="form-control" >

                        <datalist id="listtelcoeditconfig2">
                            <option value="viettel">Viettel</option>
                            <option value="mobifone">Mobifone</option>
                            <option value="vinaphone">Vinaphone</option>
                            <option value="vnmobile">VNMobile</option>
                            <option value="beeline">Beeline</option>
                            <option value="viettel_data">Viettel Data</option>
                            <option value="mobifone_data">Mobifone Data</option>
                            <option value="vinaphone_data">Vinaphone Data</option>
                            <option value="vnmobile_data">VNMobile Data</option>
                            <option value="beeline_data">Beeline Data</option>
                        </datalist>

                    </div>
                    </div>


                <div class="form-group row">
                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code
                        <span class="kt-font-danger">
                            <i class="fa fa-xs fa-star"></i>
                        </span>
                    </label>
                    <div class="col-12 col-lg-12 col-xl-9">
                        <input type="text" list="providerCodeListConfig444Edit" class="form-control" id="editProviderCodeConfig4444">

                        <datalist id="providerCodeListConfig444Edit">
                            @if(isset($providerCodeALL))
                            @foreach($providerCodeALL as $providercodeEditconfig4)
                            <option
                                value="{{$providercodeEditconfig4->providerCode}}">
                            </option>
                            @endforeach
                            @endif
                        </datalist>

                </div>
            </div>

            <div class="form-group row">
                <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                <div class="col-12 col-lg-12 col-xl-9">
                    <select class="form-control" id="telcoServiceTypeconfig444Edit" name="telcoServiceType" >
                        <option value="prepaid">prepaid</option>
                        <option value="postpaid">postpaid</option>
                    </select>
                </div>
            </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('editConfig444Script')" type="button" class="btn btn-primary">Save changes</button>
                    <input type="hidden" value="{{$idConfig444}}" id="idEditConfig444">
                  </div>
                </div>
              </div>
            </div>
            {{-- end modal edit config 444444444444444444444444--}}

            <div class="scrollme">
                <table class="table table-light">
                  <thead>
                    <tr>
                        <th> ID </th>
                        <th> Provider Code </th>
                        <th> Telco </th>
                        <th> Telco Service Type </th>
                        <th> Create Time</th>
                        <th> Action </th>
                    </tr>
                    </thead>
                      <tbody>
                       {{--  <tr>

                        <td style="color:red" colspan="6" id="messageUpdateConfig3">
                        @if($message3)
                            {{$message3}}
                        @endif

                        </td>
                        </tr> --}}
                        @if(isset($listConfig3))
                        @foreach($listConfig3 as $list4)
                        <tr>
                            <td>
                            <input type="hidden" value="{{$list4->id}}" id="{{$list4->id}}" />{{$list4->id}}
                             </td>
                            <td>
                            <input type="hidden" value="{{$list4->providerCode}}" id="providerCode-{{$list4->id}}" />{{$list4->providerCode}}
                            </td>
                            <td>
                            <input type="hidden" value="{{$list4->telco}}" id="telco-{{$list4->id}}" />{{$list4->telco}}
                            </td>
                            <td>
                            <input
                            type="hidden"
                            value="{{$list4->telco_service_type}}"
                            id="telcoServiceType-{{$list4->id}}" />{{$list4->telco_service_type}}
                             </td>
                            <td>
                            <input type="hidden" value="{{date("Y-m-d H:i:s", $list4->created_at)}}" />{{date("Y-m-d H:i:s", $list4->created_at)}}
                            </td>

                            <td><a data-toggle="modal" data-target="#editConfig444ModalScript" wire:click.prevent="$emit('updateConfig444Script', '{{$list4->id}}')"> <i class="flaticon2-pen"></i> </a> | <a
                            wire:click.prevent="$emit('deleteConfig444Script', '{{$list4->id}}')"> <i class="flaticon2-delete"></i> </a> </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
            </div>


                @if(isset($page3))
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item @if(($page3 - 1) < 1) {{'disabled'}}  @endif">
                      <a wire:click.prevent="getListConfig1Page3({{$page3 - 1}})" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    @for($i = 1; $i <= $page3 ; $i++)
                    <li class="page-item"><a class="page-link" href="#">{{$i}}</a></li>
                    @endfor
                    <li class="page-item @if(($page3 + 1) > $pages4) {{'disabled'}}  @endif">
                      <a wire:click.prevent="getListConfig1Page3({{$page3 + 1}})" class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                @endif

          </div>
        </div>

        {{-- end list config 3 --}}

        {{-- Begin list config 4 --}}

        <div wire:ignore.self class="tab-pane fade @if($success4 == 1) {{'active show'}} @endif" id="listconfig4" role="tabpanel" aria-labelledby="listconfig4-tab">
            <div class="kt-portlet__body">
            {{-- filter config 4 --}}
            <label> Cấu hình dịch vụ theo Provider, Mệnh giá </label>
            @livewire('gate.topup-telco-provider.filter-config4')
            {{-- End Filter config 4 --}}
            </div>

          <div class="kt-datatable_config4" id="ajax_data_listconfig4">

            {{-- Modal add new config 3 --}}
                @livewire('gate.topup-telco-provider.addconfig4')
            {{-- End modal --}}

            {{-- start modal edit config3 --}}

            <div wire:ignore.self class="modal fade" id="editConfig3ModalScript" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Config (Ưu tiên 3)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message333) and !empty($message333))
                    <div class="form-group row">

                        <label class="alert @if($warning) {{'alert-warning'}} @else {{'alert-primary'}}  @endif ">{{$message333}}</label>

                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                        <div class="col-12 col-lg-12 col-xl-9">

                        <input list="listtelcoeditconfig3" type="text" id="telcoeditconfig3333" class="form-control" >

                        <datalist id="listtelcoeditconfig3">
                            <option value="viettel">Viettel</option>
                            <option value="mobifone">Mobifone</option>
                            <option value="vinaphone">Vinaphone</option>
                            <option value="vnmobile">VNMobile</option>
                            <option value="beeline">Beeline</option>
                            <option value="viettel_data">Viettel Data</option>
                            <option value="mobifone_data">Mobifone Data</option>
                            <option value="vinaphone_data">Vinaphone Data</option>
                            <option value="vnmobile_data">VNMobile Data</option>
                            <option value="beeline_data">Beeline Data</option>
                        </datalist>

                    </div>
                    </div>


                <div class="form-group row">
                    <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Provider code
                        <span class="kt-font-danger">
                            <i class="fa fa-xs fa-star"></i>
                        </span>
                    </label>
                    <div class="col-12 col-lg-12 col-xl-9">
                        <input type="text" list="providerCodeListConfig3Edit" class="form-control" id="editProviderCodeConfig333">

                        <datalist id="providerCodeListConfig3Edit">
                            @if(isset($providerCodeALL))
                            @foreach($providerCodeALL as $providercodeEditconfig3)
                            <option
                                value="{{$providercodeEditconfig3->providerCode}}">
                            </option>
                            @endforeach
                            @endif
                        </datalist>

                </div>
            </div>




            <div class="form-group row">
                <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Telco service type <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                <div class="col-12 col-lg-12 col-xl-9">
                    <select class="form-control" id="telcoServiceTypeEditConfig333" name="telcoServiceTypeEditConfig3" >
                        <option value="prepaid">prepaid</option>
                        <option value="postpaid">postpaid</option>
                    </select>
                </div>
            </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('editConfig3Script333')" type="button" class="btn btn-primary">Save changes</button>
                    <input type="hidden" value="{{$idEditConfig3}}" id="idEditConfig333">
                  </div>
                </div>
              </div>
            </div>
            {{-- end modal edit config3 --}}
            {{-- @dump($listConfig4) --}}
            <div class="scrollme">
                <table class="table table-light">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Telco</th>
                        <th>Telco Service Type</th>
                        <th>Provider Code</th>
                        <th>Value</th>
                        <th>Create Time</th>

                        <th></th>
                    </tr>
                      </thead>
                      <tbody>
                     {{--  <tr>
                      <td style="color:red; " colspan="6" id="messageUpdateConfig4">
                      @if($message4)
                      {{$message4}}
                      @endif

                      </td>
                      </tr> --}}
                        @if(isset($listConfig4))
                        {{-- @dd($listConfig4) --}}
                        @foreach($listConfig4 as $list4)
                        <tr>
                            <td>
                            <input type="hidden" value="{{$list4->providerId}}"
                            id="providerIDConfig4-{{$list4->providerId}}" />{{$list4->providerId}}
                             </td>

                             <td>
                            <input type="hidden" value="{{$list4->telco}}"
                            id="telcoConfig333-{{$list4->providerId}}" />{{$list4->telco}}
                            </td>

                            <td>
                            <input type="hidden" value="{{$list4->telco_service_type}}"
                            id="telcoServiceTypeConfig333-{{$list4->providerId}}" />{{$list4->telco_service_type}}
                            </td>

                            <td>
                            <input type="hidden" value="{{$list4->providerCode}}"
                            id="providerCodeConfig333-{{$list4->providerId}}" />{{$list4->providerCode}}
                            </td>
                            <td>
                            <input type="hidden" value="{{$list4->value}}" id="value333-{{$list4->providerId}}" />{{$list4->value}}
                            </td>
                            <td>
                            <input type="hidden" value="{{date("Y-m-d H:i:s", $list4->created_at)}}" />{{date("Y-m-d H:i:s", $list4->created_at)}}
                            </td>

                            <td>
                            <a data-toggle="modal" data-target="#editConfig3ModalScript" wire:click.prevent="$emit('getDataTableConfig3Script', '{{$list4->providerId}}')"> <i class="flaticon2-pen"></i> </a>
                             | <a
                            wire:click.prevent="$emit('deleteConfig3Script', '{{$list4->providerId}}')"> <i class="flaticon2-delete"></i> </a> </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
            </div>

                @if(isset($page4))
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item @if(($page4 - 1) < 1) {{'disabled'}}  @endif">
                      <a wire:click.prevent="getListConfig1Page4({{$page4 - 1}})" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    @for($i = 1; $i <= $page4 ; $i++)
                    <li class="page-item"><a class="page-link" href="#">{{$i}}</a></li>
                    @endfor
                    <li class="page-item @if(($page4 + 1) > $pages4) {{'disabled'}}  @endif">
                      <a wire:click.prevent="getListConfig1Page4({{$page4 + 1}})" class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                @endif

            </div>



        </div>

        {{-- End List config 4 --}}

        </div>




            <!--end: Datatable -->
        </div>
    </div>
</div>
