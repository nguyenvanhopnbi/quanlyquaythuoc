<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Cấu hình chặn PTTT

                </h3>
            </div>

        </div>
        <div class="kt-portlet__body">

            <!--begin: Search Form -->
            {{-- <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10"> --}}
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input list="partnerCodeListSearch" type="text" class="form-control" name="search_partnerCode" id="search_partnerCode"
                                            @if(!empty(request()->input('partnerCodeSearch')))
                                            value="{{request()->input('partnerCodeSearch')}}"
                                            @endif
                                            >
                                            <datalist id="partnerCodeListSearch">
                                                @foreach($allPartnerCode as $partnerCodeSearch)
                                                <option value="{{$partnerCodeSearch->partner_code}}"></option>
                                                @endforeach
                                            </datalist>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Payment Method:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input list="payment_method_list_search" type="text" class="form-control" name="search_payment_method" id="search_payment_method"
                                            @if(!empty(request()->input('paymentMethodSearch')))
                                            value="{{request()->input('paymentMethodSearch')}}"
                                            @endif
                                            >
                                            <datalist id="payment_method_list_search">
                                            <option value="CC"></option>
                                            <option value="EWALLET"></option>
                                            <option value="ATM"></option>

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
                                            <a
                                            wire:click.prevent="$emit('searchPartnerMethodScript')"
                                            class="btn btn-primary"
                                            style="color:#FFF">Search</a>

                                            <a type="button" style="color: #FFF;" class="btn btn-primary" data-toggle="modal" data-target="#addNewPartnerMethod"> Add new </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- add new partner method --}}
            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="addNewPartnerMethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new partner method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message))
                    <div class="form-group @if($warmingMessage) {{'alert alert-warning'}} @else {{ 'alert alert-info' }}  @endif">{{$message}}</div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputEmail1">Partner Code: </label>
                        <input list="partnerCode_list" type="text" class="form-control" id="partner_code" placeholder="enter partner code">
                        <datalist id="partnerCode_list">
                            @foreach($allPartnerCode as $partnerCode)
                            <option value="{{$partnerCode->partner_code}}"></option>
                            @endforeach
                        </datalist>

                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Payment Method: </label>
                        <input list="payment_method_list" type="text" class="form-control" id="payment_method" placeholder="enter payment method">
                        <datalist id="payment_method_list">
                            <option value="CC"></option>
                            <option value="EWALLET"></option>
                            <option value="ATM"></option>

                        </datalist>

                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('savePartnerCodeMethodScript')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>

            {{-- end add new partner method --}}

            {{-- update partner method --}}
            <div wire:ignore.self class="modal fade" id="updatePartnerMethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update partner method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(!isset($messageUpdate))
                        <div id="partnermethodUpdateloadling" style="display: none !important;" class="d-flex justify-content-center">@livewire('loading.loading')</div>

                    @endif
                    @if(isset($messageUpdate))
                    <div class="form-group alert alert-info">{{$messageUpdate}}</div>
                    @endif
                    <div class="form-group">
                        <input type="hidden" id="idPartnerMethod" value="{{$idpartnerMethod}}">
                        <label for="exampleInputEmail1">Partner Code: </label>
                        <input list="partnerCode_list" type="text" class="form-control" id="partner_code_update" placeholder="enter partner code">
                        <datalist id="partnerCode_list">
                            @foreach($allPartnerCode as $partnerCode2)
                            <option value="{{$partnerCode2->partner_code}}"></option>
                            @endforeach
                        </datalist>

                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Payment Method: </label>
                        <input list="payment_method_list" type="text" class="form-control" id="payment_method_update" placeholder="enter payment method">
                        <datalist id="payment_method_list">
                            <option value="CC"></option>
                            <option value="EWALLET"></option>
                            <option value="ATM"></option>

                        </datalist>

                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('DataUpdateScript')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>

            {{-- end update partner method --}}


            {{-- detail partner method --}}

            <div class="modal fade" id="detailPartnerMethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Partner method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="listDetailsPartnerMethod">

                    <table class="table table-light">
                        <tr>
                            <td>
                                <label>ID: </label></td>
                            <td>
                                <input value="1"  type="text" id="id_details">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Partner Code: </label></td>
                            <td>
                                <input value="111222"  type="text" id="partner_code_details">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Payment Method: </label></td>
                            <td>
                                <input value="CC"  type="text" id="payment_method_details">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Create at: </label></td>
                            <td>
                                <input value="11/11/2022"  type="text" id="create_At_details">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Update at: </label></td>
                            <td>
                                <input value="11/11/2022"  type="text" id="update_At_details">
                            </td>
                        </tr>
                    </table>


                  </div>
                  <div class="modal-footer">
                   {{--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button> --}}
                  </div>
                </div>
              </div>
            </div>

            {{-- end detail partner method --}}

            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Partner Code</th>
                        <th>Payment Method</th>
                        <th>Update at</th>
                        <th>Action</th>
                    </tr>
                </thead>

                @if(isset($list))
                @foreach($list as $data2)
                <tr>
                    <td><input id="partnermethod-{{$data2->id}}" type="hidden" value="{{$data2->id}}">{{$data2->id}}</td>
                    <td><input id="partnerCode-{{$data2->id}}" type="hidden" value="{{$data2->partner_code}}">{{$data2->partner_code}}</td>
                    <td><input id="payment-method-{{$data2->id}}" type="hidden" value="{{$data2->payment_method}}">{{$data2->payment_method}}</td>
                    <td>{{date('Y-m-d H:i:s', $data2->updated_at)}}<input id="updateAt-{{$data2->id}}" type="hidden"
                        value="{{date('Y-m-d H:i:s', $data2->updated_at)}}">
                        <input id="createAt-{{$data2->id}}" type="hidden"
                        value="{{date('Y-m-d H:i:s', $data2->created_at)}}">
                    </td>
                    <td><a data-placement="top" title="Update Partner Method" wire:click.prevent="$emit('getDataUpdateScript', '{{$data2->id}}')" data-toggle="modal" data-target="#updatePartnerMethod">
                        <i class="flaticon2-pen"></i> |
                    </a>
                    <a data-placement="top" title="Delete partner method" wire:click.prevent="$emit('deletePartnerMethodScript', '{{$data2->id}}')">
                        <i class="flaticon2-delete"></i>
                    </a> |
                    <a data-placement="top" title="Detail partner method" data-toggle="modal" data-target="#detailPartnerMethod" style="font-size: 1.15rem; color: #93a2dd; cursor: pointer;" wire:click.prevent="$emit('detailPartnerMethod', '{{$data2->id}}')">
                        <i class="flaticon2-search"></i>
                    </a> </td>
                </tr>
                @endforeach
                @endif

            </table>

            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li wire:click="getCurrentPage({{$currentPage - 1}})" class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif">
                  <a class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @for($i = 1; $i <= $totalPage; $i++)
                <li wire:click.prevent="getCurrentPage({{$i}})" class="page-item"><a class="page-link">{{$i}}</a></li>
                @endfor
                <li wire:click="getCurrentPage({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
                  <a class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
        </div>
    </div>
</div>
