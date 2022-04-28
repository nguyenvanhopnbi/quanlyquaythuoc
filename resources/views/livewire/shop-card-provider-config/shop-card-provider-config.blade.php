<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Shop Card Provider Config
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            {{-- begin search form shop card provider config --}}

            <div class="kt-portlet__body">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Provider Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input placeholder="enter your provider code" type="text" class="form-control" name="search_providerCode" id="search_providerCode">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div>

                                    {{-- <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
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
                                            placeholder="enter your card number" type="text" class="form-control" name="endTimeSearch" id="endTimeSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>

                                    </div> --}}

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <a
                                            wire:click.prevent="$emit('searchShopCardProviderConfigScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>

                                            <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addnewShopCardProviderConfig"> Add new </a>

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

            {{-- end search form Shop card Provider Config --}}

            {{-- begin modal add new shop card provider config --}}
            <div wire:ignore.self class="modal fade" id="addnewShopCardProviderConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Shop card provider Config</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <table class="table table-light">
                    @if(!isset($message))
                        <span id="statusCCAccountBypass" style="display: none !important;" class="d-flex justify-content-center">
                        @livewire('loading.loading')
                    </span>

                    @endif
                    @if(isset($message))
                    <tr>
                        <td colspan="2"><span class="alert @if($warning) {{'alert-warning'}} @else {{'alert-info'}} @endif">{{$message}}</span></td>
                    </tr>
                    @endif


                    <tr>
                        <td><span class="d-flex justify-content-center">Provider Code: </span></td>
                        <td><input type="text" class="form-control" id="addnew_provider_code"></td>

                    </tr>
                    <tr>
                        <td><span class="d-flex justify-content-center">Secret Key: </span></td>
                        <td>
                            <input  type="text" class="form-control" id="addnew_secretKey">
                        </td>
                    </tr>
                    <tr>
                        <td><span class="d-flex justify-content-center">RSA Public Key: </span></td>
                        <td>
                            <input  type="text" class="form-control" id="addnew_rsaPublicKey">
                        </td>
                    </tr>
                    <tr>
                        <td><span class="d-flex justify-content-center">RSA Private Key: </span></td>
                        <td>
                            <input  type="text" class="form-control" id="addnew_rsaPrivateKey">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('addNewShopCardProviderConfigScript')" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal add new shop card provider config --}}


{{-- begin modal update shop card provider config --}}
            <div wire:ignore.self class="modal fade" id="updateShopCardProviderConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Shop card provider Config</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <table class="table table-light">
                    @if(!isset($message))
                        <span id="statusCCAccountBypass" style="display: none !important;" class="d-flex justify-content-center">
                        @livewire('loading.loading')
                    </span>

                    @endif
                    @if(isset($message))
                    <tr>
                        <td colspan="2"><span class="alert @if($warning) {{'alert-warning'}} @else {{'alert-info'}} @endif">{{$message}}</span></td>
                    </tr>
                    @endif
                    <tr>
                        <td><span class="d-flex justify-content-center">Secret Key: </span></td>
                        <td>
                            <input  type="text" class="form-control" id="update_secretKey">
                        </td>
                    </tr>

                    <tr>
                        <td><span class="d-flex justify-content-center">RSA Public Key: </span></td>
                        <td>
                            <input  type="text" class="form-control" id="update_rsaPublicKey">
                        </td>
                    </tr>

                    <tr>
                        <td><span class="d-flex justify-content-center">RSA Private Key: </span></td>
                        <td>
                            <input  type="text" class="form-control" id="update_rsaPrivateKey">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('updateShopCardProviderConfigScript')" type="button" class="btn btn-primary">update</button>
                <input type="hidden" id="IDproviderConfigUpdate" value="{{$IDproviderConfigUpdate}}">
            </div>
        </div>
    </div>
</div>
{{-- end modal update shop card provider config --}}

            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Provider Code</th>
                        <th>Secret Key</th>
                        <th>RSA PublicKey</th>
                        <th>RSA Private Key</th>
                        <th>Update Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($providerShopCardList))
                    @foreach($providerShopCardList as $list)
                    <tr>
                        <td><input id="IDProvider-{{$list->providerId}}" type="hidden" value="{{$list->providerId}}">{{$list->providerId}}</td>

                        <td><input id="providerCode-{{$list->providerId}}" type="hidden" value="{{$list->providerCode}}">{{$list->providerCode}}</td>

                        <td><input id="secretKey-{{$list->providerId}}" type="hidden" value="{{$list->secretKey}}">{{$list->secretKey}}</td>
                        <td><input id="rsaPublicKey-{{$list->providerId}}" type="hidden" value="{{$list->rsaPublicKey}}">{{$list->rsaPublicKey}}</td>



                        <td><input id="rsaPrivateKey-{{$list->providerId}}" type="hidden" value="{{$list->rsaPrivateKey}}">{{$list->rsaPrivateKey}}</td>

                        <td>{{date('Y-m-d H:i:s', $list->updated_at)}}</td>
                        <td style="width: 100px;">
                            <a data-placement="top" title="Update Shop Card Provider Config" wire:click.prevent="$emit('getDateTableShopCardProviderConfig', '{{$list->providerId}}')" data-toggle="modal" data-target="#updateShopCardProviderConfig">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a data-placement="top" title="Delete Shop Card Provider Config" wire:click.prevent="$emit('deleteShopCardProviderConfigScript', '{{$list->providerId}}')">
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
                <li wire:click.prevent="getCurrentPage({{$currentPage - 1}})" class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @if(isset($providerShopCardList))
                @for($i = $start; $i <= $end; $i++)
                <li wire:click.prevent = "getCurrentPage({{$i}})" class="page-item @if($i == $currentPage) {{'active'}}  @endif"><a class="page-link" href="#">{{$i}}</a></li>
                @endfor
                @endif
                <li wire:click.prevent="getCurrentPage({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
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
