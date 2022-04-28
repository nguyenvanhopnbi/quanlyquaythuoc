<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Blacklist IP

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
                                        <label>IP:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input placeholder="enter your IP" type="text" class="form-control" name="search_IP" id="search_IP">
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
                                            placeholder="Y-m-d H:i:s" class="form-control" type="text" id="startTimeSearch" name="startTimeSearch">
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
                                            placeholder="Y-m-d H:i:s" class="form-control" type="text" id="endTimeSearch" name="endTimeSearch">
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
                                            wire:click.prevent="$emit('searchBlacklistiPScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>
                                            <a data-toggle="modal" data-target="#addnewccBlacklistIP"
                                            wire:click.prevent="$emit('addnewBlacklistiPModal')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Add new</a>

                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end search form --}}

            {{-- begin modal add new cc account bypass --}}
            <div wire:ignore.self class="modal fade" id="addnewccBlacklistIP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new BlacklistIP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <table class="table table-light">
                    @if(!isset($message))
                        <span id="statusBlacklistIP" style="display: none !important;" class="d-flex justify-content-center">
                        @livewire('loading.loading')
                    </span>

                    @endif
                    @if(isset($message))
                    <tr>
                        <td colspan="2"><span class="alert alert-info">{{$message}}</span></td>
                    </tr>
                    @endif
                    <tr>
                        <td><span class="d-flex justify-content-center">Blacklist IP: </span></td>
                        <td><input placeholder="Enter your IP" type="text" class="form-control" id="BlacklistIP"></td>

                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('addNewBlacklistIPScript')" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal add new cc account bybass --}}

 {{-- begin modal update BlacklistIP --}}
            <div wire:ignore.self class="modal fade" id="UpdateccBlacklistIP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update BlacklistIP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <table class="table table-light">
                   @if(!isset($messageUpdate))
                        <span id="statusBlacklistIPUpdate" style="display: none !important;" class="d-flex justify-content-center">
                        @livewire('loading.loading')
                    </span>

                    @endif
                    @if(isset($messageUpdate))
                    <tr>
                        <td colspan="2"><span class="alert alert-info">{{$messageUpdate}}</span></td>
                    </tr>
                    @endif
                    <tr>
                        <td><span class="d-flex justify-content-center">Blacklist IP: </span></td>
                        <td>
                            <input type="hidden" id="IDblacklistIP" value="">
                            <input placeholder="Enter your IP" type="text" class="form-control"
                            id="UpdateBlacklistIP"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('UpdateBlacklistIPScript')" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal update cc account bybass --}}

            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>IP</th>
                        <th>Update at</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if(isset($BlacklistIP))
                    @foreach($BlacklistIP as $listip)
                    <tr>
                        <td><input id="IDblacklistIP-{{$listip->id}}" type="hidden" value="{{$listip->ip}}">{{$listip->id}}</td>
                        <td><input id="IPblacklist-{{$listip->id}}" type="hidden" value="{{$listip->ip}}">{{$listip->ip}}</td>
                        <td>{{date('Y-m-d H:i:s', $listip->updated_at)}}</td>
                        <td>
                            <a data-placement="top" title="Update Blacklist IP" wire:click.prevent="$emit('getDateTableBlacklistIP', '{{$listip->id}}')" data-toggle="modal" data-target="#UpdateccBlacklistIP">
                <i class="flaticon2-pen"></i> |
            </a>
            <a data-placement="top" title="Delete BlacklistIP" wire:click.prevent="$emit('deleteBlacklistIPScript', '{{$listip->id}}')">
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
                <li wire:click.prevent = "gotoPageCurrent({{$currentPage - 1}})" class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @if(isset($totalPage))
                @for($i = 1; $i <= $totalPage ; $i++)
                <li class="page-item @if($currentPage == $i) {{'active'}} @endif"><a class="page-link">{{$i}}</a></li>
                @endfor
                @endif
                <li wire:click.prevent = "gotoPageCurrent({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
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
