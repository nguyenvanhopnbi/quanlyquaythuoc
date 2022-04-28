<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    CC Partner Bincard Allow
                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">

             {{-- begin search form cc acount by pass --}}

            <div class="kt-portlet__body">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input list="PartnerCodeList" placeholder="enter your partner code" type="text" class="form-control" name="searchPartnerCode" id="searchPartnerCode">
                                            <datalist id="PartnerCodeList">
                                                @if(isset($partnerCodeList))
                                                @foreach($partnerCodeList as $listPartner)
                                                <option value="{{$listPartner->partner_code}}"></option>
                                                @endforeach
                                                @endif
                                            </datalist>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Bin Card:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input placeholder="enter your Bin Card" type="text" class="form-control" name="searchBinCard" id="searchBinCard">
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
                                            placeholder="Y-m-d H:i:s" type="text" class="form-control" name="startTimeSearch" id="startTimeSearch">
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
                                            placeholder="Y-m-d H:i:s" type="text" class="form-control" name="endTimeSearch" id="endTimeSearch">
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
                                            wire:click.prevent="$emit('searchCCBinCardAllowScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>

                                            <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addnewccBincardAllow"> Add new </a>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end search form cc  --}}

            {{-- begin modal add new cc  --}}
            <div wire:ignore.self class="modal fade" id="addnewccBincardAllow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add CC Bin Card Allow</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <table class="table table-light">
                    @if(!isset($message))
                        <span id="statusAddccBinCardAllow" style="display: none !important;" class="d-flex justify-content-center">
                        @livewire('loading.loading')
                    </span>

                    @endif
                    @if(isset($message))
                    <tr>
                        <td colspan="2"><span class="alert @if($warning) {{'alert-warning'}} @else {{'alert-info'}} @endif">{{$message}}</span></td>
                    </tr>
                    @endif
                    <tr>
                        <td><span class="d-flex justify-content-center">Bin Card: </span></td>
                        <td><input placeholder="Enter your Bin card" type="text" class="form-control" id="BinCardAddnew"></td>

                    </tr>
                    <tr>
                        <td><span class="d-flex justify-content-center">Partner Code: </span></td>
                        <td>
                            <input placeholder="Choose your partner code" list="listPartnerCodeAddnew" type="text" class="form-control" id="partnercodeAddnew">

                            <datalist id="listPartnerCodeAddnew">
                                @if(isset($partnerCodeList))
                                @foreach($partnerCodeList as $ParnercodelistAddnew)
                                <option value="{{$ParnercodelistAddnew->partner_code}}"></option>
                                @endforeach
                                @endif
                            </datalist>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('addNewCCPartnerBinCardAllowScript')" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal add new  --}}


{{-- begin modal update cc  --}}
            <div wire:ignore.self class="modal fade" id="UpdateccBincardAllow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update CC Bin Card Allow</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <table class="table table-light">
                    @if(!isset($messageUpdate))
                        <span id="statusAddccBinCardAllow" style="display: none !important;" class="d-flex justify-content-center">
                        @livewire('loading.loading')
                    </span>

                    @endif
                    @if(isset($messageUpdate))
                    <tr>
                        <td colspan="2"><span class="alert alert-info">{{$messageUpdate}}</span></td>
                    </tr>
                    @endif
                    <tr>
                        <td><span class="d-flex justify-content-center">Bin Card: </span></td>
                        <td>
                            <input type="hidden" value="{{$idBinCard}}" id="UpdateIDPartnerBinCard">
                            <input placeholder="Enter your Bin card" type="text" class="form-control" id="UpdateBinCard"></td>

                    </tr>
                    <tr>
                        <td><span class="d-flex justify-content-center">Partner Code: </span></td>
                        <td>
                            <input placeholder="Choose your partner code" list="listPartnerCodeAddnew" type="text" class="form-control" id="Updatepartnercode">

                            <datalist id="listPartnerCodeAddnew">
                                @if(isset($partnerCodeList))
                                @foreach($partnerCodeList as $ParnercodelistUpdate)
                                <option value="{{$ParnercodelistUpdate->partner_code}}"></option>
                                @endforeach
                                @endif
                            </datalist>

                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('UpdateCCPartnerBinCardAllowScript')" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal add new cc  --}}


            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bin Card</th>
                        <th>Partner Code</th>
                        <th>Update at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($this->binCardList))
                    @foreach($this->binCardList as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td><input id="BinCard-{{$list->id}}" type="hidden" value="{{$list->bin_card}}">{{$list->bin_card}}</td>
                        <td><input id="partnerCode-{{$list->id}}" type="hidden" value="{{$list->partner_code}}">{{$list->partner_code}}</td>
                        <td>{{date('Y-m-d H:i:s', $list->updated_at)}}</td>
                        <td>
                            <a data-placement="top" title="Update CC Partner BinCard Allow" wire:click.prevent="$emit('getDateTableccPartnerCodeBinCard', '{{$list->id}}')" data-toggle="modal" data-target="#UpdateccBincardAllow">
                <i class="flaticon2-pen"></i> |
            </a>
            <a data-placement="top" title="Delete CC Partner BinCard Allow" wire:click.prevent="$emit('deleteCCPartnerBinCardAllowScript', '{{$list->id}}')">
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
                <li class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif" wire:click.prevent="gotoPage({{$currentPage - 1}})">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @if(isset($totalPage))
                @for($i = 1; $i <= $totalPage; $i++)
                <li class="page-item @if($currentPage == $i) {{'active'}} @endif" wire:click.prevent="gotoPage({{$currentPage}})"><a class="page-link">{{$i}}</a></li>
                @endfor
                @endif
                <li wire:click.prevent="gotoPage({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
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
