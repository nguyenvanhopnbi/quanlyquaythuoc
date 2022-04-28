<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
     <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Partner Appota Service
                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">

            {{-- begin search form  --}}

            <div class="kt-portlet__body">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">

                                            <input list="listPartnerCode" placeholder="enter your partner code" type="text" class="form-control" name="search_partner_code" id="search_partner_code"
                                            @if(!empty(request()->input('partnerCode')))
                                            value="{{request()->input('partnerCode')}}"
                                            @endif
                                            >

                                            <datalist id="listPartnerCode">
                                                @if(isset($partnerCodeList))
                                                @foreach($partnerCodeList as $list)
                                                <option value="{{$list->partner_code}}"></option>
                                                @endforeach
                                                @endif
                                            </datalist>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <label>Start Time:</label>
                                            <div class="kt-input-icon kt-input-icon--left">
                                                <input placeholder="Y-m-d H:i:s" class="form-control" type="text" id="startTimeSearch" name="startTimeSearch"
                                                @if(!empty(request()->input('startTime')))
                                                value="{{date('Y-m-d H:i:s', request()->input('startTime'))}}"
                                                @endif
                                                >
                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-search"></i></span>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <label>End Time:</label>
                                            <div class="kt-input-icon kt-input-icon--left">
                                                <input placeholder="Y-m-d H:i:s" class="form-control" type="text" id="endTimeSearch" name="endTimeSearch"
                                                @if(!empty(request()->input('endTime')))
                                                value="{{date('Y-m-d H:i:s', request()->input('endTime'))}}"
                                                @endif
                                                >
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
                                            <a
                                            wire:click.prevent="$emit('searchPartnerAppotaServiceScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>

                                            <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addNewPartnerAppotaService"> Add new </a>

                                        </div>
                                    </div>
                                </div>
                                @if(isset($messageBypassSearch))
                                <div style="width: 70%; margin-top: 10px" class="alert alert-warning">{{$messageBypassSearch}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end search form --}}

            {{-- add new form --}}
            <div wire:ignore.self class="modal fade" id="addNewPartnerAppotaService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Partner Appota Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message))
                    <div class="form-group @if($warming) {{'alert alert-warning'}} @else {{ 'alert alert-info' }}  @endif">{{$message}}</div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputEmail1">Partner Code: </label>
                        <input list="partnerCode_list" type="text" class="form-control" id="partner_code" placeholder="enter partner code">
                        <datalist id="partnerCode_list">

                            @if(isset($partnerCodeList))
                            @foreach($partnerCodeList as $listaddnew)
                            <option value="{{$listaddnew->partner_code}}"></option>
                            @endforeach
                            @endif

                        </datalist>

                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Appota Service Code: </label>
                        <input list="appota_service_code_list" type="text" class="form-control" id="appota_service_code" placeholder="enter appota service code">
                        <datalist id="appota_service_code_list">

                            <option value="EWALLET"></option>
                            <option value="PAYGATE"></option>

                        </datalist>

                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Title: </label>
                        <input type="text" class="form-control" id="appota_service_title" placeholder="enter appota service title">
                      </div>

                      <div wire:ignore class="form-group">
                        <label for="appota_service_details_add">Details: </label>
                        <textarea type="text" class="form-control" id="DetailsAddneweditor">
                        </textarea>
                      </div>

                     {{--  <div class="form-group" style="display: none;">
                        <label for="appota_service_detail">Detail: </label>
                        <input wire:keydown.enter="$emit('pushDetailScript')"
                        value=""
                        type="text"
                        class="form-control"
                        id="appota_service_detail" placeholder="enter appota service details">
                        {!! $details !!}
                        <a wire:click.prevent="removeDetails"><i class="flaticon2-delete"></i></a>
                      </div> --}}

                      <div class="form-group">
                        <label for="exampleInputEmail1">Point: </label>
                        <input type="text" class="form-control" id="appota_service_point" placeholder="enter appota service point">
                      </div>

                      <div class="form-group">
                        <label for="isActive">Is Active: </label>
                        <input id="isActive" type="checkbox" name="isActive" value="0">

                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('savePartnerAppotaServiceScript')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>

            {{-- end add new form --}}

            {{-- Begin update form --}}
            <div wire:ignore.self class="modal fade" id="UpdatePartnerAppotaService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Partner Appota Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message))
                    <div class="form-group @if($warming) {{'alert alert-warning'}} @else {{ 'alert alert-info' }}  @endif">{!! $message !!}</div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputEmail1">Partner Code: </label>
                        <input list="partnerCode_list_update" type="text" class="form-control" id="partner_code_update" placeholder="enter partner code">
                        <datalist id="partnerCode_list_update">
                            @if(isset($partnerCodeList))
                            @foreach($partnerCodeList as $listupdate)
                            <option value="{{$listupdate->partner_code}}"></option>
                            @endforeach
                            @endif
                        </datalist>

                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Appota Service Code: </label>
                        <input list="appota_service_code_list_update" type="text" class="form-control" id="appota_service_code_update" placeholder="enter appota service code">
                        <datalist id="appota_service_code_list_update">
                            <option value="EWALLET"></option>
                            <option value="PAYGATE"></option>
                        </datalist>
                      </div>

                      <div class="form-group">
                        <label for="appota_service_title_update">Title: </label>
                        <input type="text" class="form-control" id="appota_service_title_update" placeholder="enter appota service title">
                      </div>

                      <div wire:ignore class="form-group">
                        <label for="appota_service_details_add">Details: </label>
                        <textarea type="text" class="form-control" id="DetailsUpdateeditor">
                        </textarea>
                      </div>

                      {{-- <div class="form-group">
                        <label for="appota_service_detail">Detail: </label>
                        <input wire:keydown.enter="$emit('pushDetailUpdateScript')"
                        placeholder="Enter your details and hit enter!"
                        value=""
                        type="text"
                        class="form-control"
                        id="appota_service_detail_update" placeholder="enter appota service details">
                        {!! $detailUpdate !!}
                        <a wire:click.prevent="removeDetails"><i class="flaticon2-delete"></i></a>
                      </div>
 --}}
                      <div class="form-group">
                        <label for="exampleInputEmail1">Point: </label>
                        <input value="" type="text" class="form-control" id="appota_service_point_update" placeholder="enter appota service point">
                      </div>
                      <div class="form-group">
                        <label for="isActive">Is Active: </label>
                        <input id="isActive_update" type="checkbox" name="isActive" value="0">
                        <input type="hidden" id="ID_UpdatePartnerAppotaService" value="{{$idUpdate}}">
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('UpdatePartnerAppotaServiceScript')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>


            {{-- end update form --}}

            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Partner Code</th>
                        <th>Appota Service Code</th>
                        <th>Title</th>
                        <th>Detail</th>
                        <th>Point</th>
                        <th>Is_active</th>
                        <th>Update At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if(isset($dataPartnerAppotaService))
                    @foreach($dataPartnerAppotaService as $data)
                    <tr>
                        <td><input id="partnerAppotaServiceID-{{$data->id}}" type="hidden" value="{{$data->id}}">{{$data->id}}</td>

                        <td><input id="PartnerCode-{{$data->id}}" type="hidden" value="{{$data->partner_code}}">{{$data->partner_code}}</td>

                        <td><input id="AppotaServiceCode-{{$data->id}}" type="hidden" value="{{$data->appota_service_code}}">{{$data->appota_service_code}}</td>

                        <td><input id="title-{{$data->id}}" type="hidden" value="{{$data->title}}">{{$data->title}}</td>

                        <td><input id="details-{{$data->id}}" type="hidden" value="{{$data->detail}}">{!! $data->detail !!}</td>

                        <td><input id="point-{{$data->id}}" type="hidden" value="{{$data->point}}">{{$data->point}}</td>

                        <td><input id="isActive-{{$data->id}}" type="hidden" value="{{$data->is_active}}">{{($data->is_active == '1')?"active":"inactive"}}</td>

                        <td>{{date('Y-m-d H:i:s', $data->updated_at)}}</td>
                        <td style="width: 100px;">

                            <a data-placement="top" title="Update Partner Appota Service" wire:click.prevent="$emit('getDateTablePartnerAppotaServiceScript', '{{$data->id}}')" data-toggle="modal" data-target="#UpdatePartnerAppotaService">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a data-placement="top" title="Delete This Partner Appota Service" wire:click.prevent="$emit('deletePartnerAppotaServiceScript', '{{$data->id}}')">
                                <i class="flaticon2-delete"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item @if($currentPage <= 1) {{'disabled'}} @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @if(isset($totalPage))
                @for($i = 1; $i <= $totalPage; $i++)
                <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item @if($currentPage == $i) {{'active'}}  @endif"><a class="page-link">{{$i}}</a></li>
                @endfor
                @endif
                <li class="page-item @if($currentPage >= $totalPage) {{'disabled'}} @endif">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
        </div>

    </div>
</div>

