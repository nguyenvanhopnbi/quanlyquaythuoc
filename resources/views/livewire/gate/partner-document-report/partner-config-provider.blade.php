<div>
    {{-- The whole world belongs to you. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Cấu hình Provider theo Partner
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
                                        <label>Provider Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">

                                            <input
                                            list = "ProviderList"
                                            autocomplete="off"
                                            placeholder="enter your provider code" type="text" class="form-control" name="search_provider_code" id="search_provider_code"
                                            @if(!empty(request()->input('providerCode')))
                                            value="{{request()->input('providerCode')}}"
                                            @endif
                                            >
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>

                                            <datalist id="ProviderList">
                                                @if(isset($providerList))
                                                @foreach($providerList as $Plist)
                                                <option value="{{$Plist->providerCode}}"></option>
                                                @endforeach
                                                @endif
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">

                                            <input
                                            autocomplete="off"
                                            list="listPartnerCode" placeholder="enter your partner code" type="text" class="form-control" name="search_partner_code" id="search_partner_code"
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
                                                <input
                                                autocomplete="off"
                                                placeholder="Y-m-d H:i:s" class="form-control" type="text" id="startTimeSearch" name="startTimeSearch"
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
                                                <input
                                                autocomplete="off"
                                                placeholder="Y-m-d H:i:s" class="form-control" type="text" id="endTimeSearch" name="endTimeSearch"
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
                                            wire:click.prevent="$emit('searchPartnerConfigProviderScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>

                                            <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addNewPartnerConfigProvider"> Add new </a>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end search form --}}

            {{-- add new --}}

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="addNewPartnerConfigProvider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            @if(isset($message) && $warning == false)
                            <span class="alert alert-primary">
                                {{$message}}
                            </span>
                            @elseif(isset($message) && $warning == true)
                            <span class="alert alert-warning">
                                {{$message}}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>Provider Code: </label></div>
                        <div class="col-9">
                            <input
                            autocomplete="off"
                            list="ProviderListAddnew" type="text" class="form-control" id="providerCodeAddnew">
                            <datalist id="ProviderListAddnew">
                                    @if(isset($providerList))
                                    @foreach($providerList as $Plist2)
                                    <option value="{{$Plist2->providerCode}}"></option>
                                    @endforeach
                                    @endif
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>Partner Code: </label></div>
                        <div class="col-9">
                            <input
                            autocomplete="off"
                            list="addnewPartnerCodeList" type="text" class="form-control" id="partnerCodeAddnew">

                            <datalist id="addnewPartnerCodeList">
                                @if(isset($partnerCodeList))
                                @foreach($partnerCodeList as $list2)
                                    <option value="{{$list2->partner_code}}"></option>
                                @endforeach
                                @endif
                            </datalist>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('addnewPartnerCodeConfigScript')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>

            {{-- end add new --}}

            {{-- update  --}}

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="UpdatePartnerConfigProvider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            @if(isset($message) && $warning == false)
                            <span class="alert alert-primary">
                                {{$message}}
                            </span>
                            @elseif(isset($message) && $warning == true)
                            <span class="alert alert-warning">
                                {{$message}}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>Provider Code: </label></div>
                        <div class="col-9">
                            <input
                            autocomplete="off"
                            list="UpdateProviderCodeList"
                            type="text" class="form-control" id="providerCodeUpdate">
                            <datalist id="UpdateProviderCodeList">
                                 @if(isset($providerList))
                                    @foreach($providerList as $Plist3)
                                    <option value="{{$Plist3->providerCode}}"></option>
                                    @endforeach
                                    @endif
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>Partner Code: </label></div>
                        <div class="col-9"><input
                            autocomplete="off"
                            list="UpdatePartnerCodeList" type="text" class="form-control" id="partnerCodeUpdate">

                            <datalist id="UpdatePartnerCodeList">
                                 @if(isset($partnerCodeList))
                                @foreach($partnerCodeList as $list2)
                                    <option value="{{$list2->partner_code}}"></option>
                                @endforeach
                                @endif
                            </datalist>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('UpdatePartnerCodeConfigScript')" type="button" class="btn btn-primary">Update</button>
                    <input type="hidden" id="IDUPdate" value="{{$IDUPdate}}">
                  </div>
                </div>
              </div>
            </div>

            {{-- end update --}}
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ProviderCode</th>
                        <th>PartnerCode</th>
                        <th>Create at</th>
                        <th>Update at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($DataList))
                    @foreach($DataList as $list)
                    <tr>
                        <td>{{$list->providerId}}
                            <input type="hidden" id="ID-{{$list->providerId}}" value="{{$list->providerId}}">
                        </td>
                        <td>{{$list->providerCode}}
                            <input type="hidden" id="providerCode-{{$list->providerId}}" value="{{$list->providerCode}}">
                        </td>
                        <td>{{$list->partnerCode}}
                            <input type="hidden" id="partnerCode-{{$list->providerId}}" value="{{$list->partnerCode}}">
                        </td>
                        <td>{{date('Y-m-d H:i:s', $list->createdAt)}}
                            <input type="hidden" id="createdAt-{{$list->providerId}}" value="{{$list->createdAt}}">
                        </td>
                        <td>{{date('Y-m-d H:i:s', $list->updatedAt)}}</td>
                        <td>
                            <a data-placement="top" title="Update Partner Config Provider" wire:click.prevent="$emit('getDateTablePartnerProviderConfigScript', '{{$list->providerId}}')" data-toggle="modal" data-target="#UpdatePartnerConfigProvider">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a data-placement="top" title="Delete Config Partner Provider" wire:click.prevent="$emit('deletePartnerProviderConfigScript', '{{$list->providerId}}')">
                                <i class="flaticon2-delete"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(isset($DataList))
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li wire:click.prevent="gotoCurrentPage({{$currentPage - 1}})"
                class="page-item @if($currentPage <= 1) {{'disabled'}} @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @for($i = $start; $i <= $end; $i++)
                <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item @if($currentPage == $i) {{'active'}} @endif"><a class="page-link" href="#">{{$i}}</a></li>
                @endfor
                <li wire:click.prevent="gotoCurrentPage({{$currentPage + 1}})"
                class="page-item @if($currentPage >= $totalPage) {{'disabled'}} @endif">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
            @endif
        </div>

    </div>
</div>
