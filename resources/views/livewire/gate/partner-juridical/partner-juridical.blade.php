<div>
    {{-- Be like water. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Partner Business
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
                                            wire:click.prevent="$emit('searchPartnerJuridicalScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>

                                            <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addNewPartnerCooperate"> Add new </a>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end search form --}}

             {{-- add new form --}}
            <div wire:ignore.self class="modal fade" id="addNewPartnerCooperate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Partner Cooperate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message))
                    <div class="form-group @if($warning) {{'alert alert-warning'}} @else {{ 'alert alert-info' }}  @endif">{{$message}}</div>
                    @endif
                    <div class="form-group">
                        <label for="partner_code">Partner Code: </label>
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
                        <label for="exampleInputEmail1">Title: </label>
                        <input type="text" class="form-control" id="partner_title" placeholder="enter appota service title">
                      </div>

                      <div wire:ignore class="form-group">
                        <label for="appota_service_details_add">Details: </label>
                        <textarea type="text" class="form-control" id="DetailsAddneweditor">
                        </textarea>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Point: </label>
                        <input type="text" class="form-control" id="partner_point" placeholder="enter appota service point">
                      </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('savePartnerJuridicalScript')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>

            {{-- end add new form --}}

            {{-- update form --}}
            <div wire:ignore.self class="modal fade" id="UpdatePartnerBusiness" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Partner Business</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message))
                    <div class="form-group @if($warning) {{'alert alert-warning'}} @else {{ 'alert alert-info' }}  @endif">{!! $message !!}</div>
                    @endif
                    <div class="form-group">
                        <label for="partner_code">Partner Code: </label>
                        <input list="partnerCode_list" type="text" class="form-control" id="partner_code_Update" placeholder="enter partner code">
                        <datalist id="partnerCode_list">

                            @if(isset($partnerCodeList))
                            @foreach($partnerCodeList as $listUpdate)
                            <option value="{{$listUpdate->partner_code}}"></option>
                            @endforeach
                            @endif

                        </datalist>

                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Title: </label>
                        <input type="text" class="form-control" id="partner_business_title_update" placeholder="enter appota service title">
                      </div>

                      <div wire:ignore class="form-group">
                        <label for="appota_service_details_add">Details: </label>
                        <textarea type="text" class="form-control" id="DetailsUpdateeditor">
                        </textarea>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Point: </label>
                        <input type="hidden" value="{{$IDPartnerCo}}" id="IDPartnerCo">
                        <input type="text" class="form-control" id="partner_business_point" placeholder="enter appota service point">
                      </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('UpdatePartnerJuridicalScript')" type="button" class="btn btn-primary">Save</button>
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
                        <th>Title</th>
                        <th>Details</th>
                        <th>Point</th>
                        <th>Update at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($listPartnerJuridical))
                    @foreach($listPartnerJuridical as $list)
                    <tr>
                        <td><input id="IDPartnerCooperate-{{$list->id}}" type="hidden" value="{{$list->id}}">{{$list->id}}</td>

                        <td><input id="PartnerCode-{{$list->id}}" type="hidden" value="{{$list->partner_code}}">{{$list->partner_code}}</td>

                        <td><input id="Title-{{$list->id}}" type="hidden" value="{{$list->title}}">{{$list->title}}</td>

                        <td><input id="Details-{{$list->id}}" type="hidden" value="{{$list->detail}}">{!! $list->detail !!}</td>

                        <td><input id="Point-{{$list->id}}" type="hidden" value="{{$list->point}}">{{$list->point}}</td>

                        <td ><input type="hidden" value="{{$list->updated_at}}">{{date('Y-m-d H:i:s', $list->updated_at)}}</td>

                        <td style="width: 100px;">
                            <a data-placement="top" title="Update Partner Cooperate" wire:click.prevent="$emit('getDateTablePartnerCooperateScript', '{{$list->id}}')" data-toggle="modal" data-target="#UpdatePartnerBusiness">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a data-placement="top" title="Delete Partner Cooperate" wire:click.prevent="$emit('deletePartnerCooperateScript', '{{$list->id}}')">
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
                <li wire:click.prevent="gotoCurrentpage({{$currentPage - 1}})"
                class="page-item @if($currentPage <= 1) {{'disabled'}} @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @if(isset($totalPage))
                @for($i = 1; $i <= $totalPage; $i++)
                <li wire:click.prevent="gotoCurrentpage({{$i}})" class="page-item @if($currentPage == $i) {{'active'}}  @endif"><a class="page-link">{{$i}}</a></li>
                @endfor
                @endif
                <li wire:click.prevent="gotoCurrentpage({{$currentPage + 1}})"
                class="page-item @if($currentPage >= $totalPage) {{'disabled'}} @endif">
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
