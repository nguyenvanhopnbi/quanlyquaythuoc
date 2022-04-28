<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Ebill Bank
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="/partner-partners/add" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#themmoiEbillBank"><i class="flaticon2-plus"></i> Thêm Mới</a>
                    </div>
                </div>
            </div>
            {{-- modal sua Ebill Bank --}}
            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="suaEbillBank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa Ebill Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    @if(isset($message))
                    <div class="row">
                        @if(!$warning)
                        <div class="col"><span class="alert alert-primary">{{$message}}</span></div>
                        @else
                        <div class="col"><span class="alert alert-warning">{{$message}}</span></div>
                        @endif
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-3"><label for="">Bank Code:</label> </div>
                        <div class="col-9"><input type="text" class="form-control" id="ebill_bank_code_update"></div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-3"><label for="">Bank Name:</label> </div>
                        <div class="col-9"><input type="text" class="form-control" id="ebill_bank_name_update"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label for="">Active:</label> </div>
                        <div class="col-9">
                            <select name="" id="ebill_active_update" class="form-control">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label for="">Transfer Provider Code:</label> </div>
                        <div class="col-9">
                            <input autocomplete="off" list="listDanhSachProviderUpdate" type="text" class="form-control" id="ebill_transfer_provider_code_update">
                            <datalist id="listDanhSachProviderUpdate">
                                @if(isset($listProvider))
                                @foreach($listProvider as $list22)
                                <option value="{{$list22->providerCode}}"></option>
                                @endforeach
                                @endif
                            </datalist>
                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-3"><label for="">Ebill Provider Code:</label> </div>
                        <div class="col-9"><input type="text" class="form-control" id="ebill_provider_code_update"></div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('updateEbillBankScript')" type="button" class="btn btn-primary">Update</button>
                    <input type="hidden" id="ID_UPdate" value="{{$idUpdate}}">
                  </div>
                </div>
              </div>
            </div>

            {{-- end modal sua Ebill Bank --}}


            {{-- modal them moi --}}
            <div wire:ignore.self class="modal fade" id="themmoiEbillBank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới Ebill Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($message))
                    <div class="row">
                        @if(!$warning)
                        <div class="col"><span class="alert alert-primary">{{$message}}</span></div>
                        @else
                        <div class="col"><span class="alert alert-warning">{{$message}}</span></div>
                        @endif
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-3"><label for="">Bank Code:</label> </div>
                        <div class="col-9">
                            <input type="text" class="form-control" id="ebill_bank_code">

                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-3"><label for="">Bank Name:</label> </div>
                        <div class="col-9"><input type="text" class="form-control" id="ebill_bank_name"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label for="">Active:</label> </div>
                        <div class="col-9">
                            <select name="" id="ebill_active" class="form-control">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label for="">Transfer Provider Code:</label> </div>
                        <div class="col-9">
                            <input autocomplete="off" list="listDanhSachProvider" type="text" class="form-control" id="ebill_transfer_provider_code">
                            <datalist id="listDanhSachProvider">
                                @if(isset($listProvider))
                                @foreach($listProvider as $list11)
                                <option value="{{$list11->providerCode}}"></option>
                                @endforeach
                                @endif
                            </datalist>
                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-3"><label for="">Ebill Provider Code:</label> </div>
                        <div class="col-9"><input type="text" class="form-control" id="ebill_provider_code"></div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('saveNewEbillBankScript')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
            {{-- end modal them moi --}}
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col">
                    <label>Bank code:</label>
                    <input type="text" class="form-control" id="bank_code_search">
                </div>
                <div class="col">
                    <label>Bank name:</label>
                    <input type="text" class="form-control" id="bank_name_search">
                </div>
                <div class="col">
                    <label>Active</label>
                    <select name="" id="active_search" class="form-control">
                        <option value="all">All</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="col">
                    <label>Transfer Provider Code</label>
                    <input type="text" id="transer_provider_code_search" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>Ebill Provider Code:</label>
                    <input type="text" id="ebill_provider_code_search" class="form-control">
                </div>
                <div class="col">
                    <label for="">Start Time:</label>
                    <input type="text" id="startTimeSearch" class="form-control">
                </div>
                <div class="col">
                    <label for="">End Time: </label>
                    <input type="text" id="endTimeSearch" class="form-control">
                </div>
                <div class="col">
                    <button wire:click.prevent="$emit('searchEbillBankScript')" style="margin-top: 35px" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bank Code</th>
                       {{--  <th>Bank Name</th> --}}
                       <th>Transfer Provider Code</th>
                        <th>Active</th>

                        <th>Created At</th>
                        <th>Update At</th>
                        {{-- <th>Ebill provider Code</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($getListEbillBank))
                    @foreach($getListEbillBank as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->bank_code}}
                            <input type="hidden" id="bank_code-{{$list->id}}" value="{{$list->bank_code}}">
                            </td>
                   {{--      <td>{{$list->bank_name}}
                            <input type="hidden" id="bank_name-{{$list->id}}" value="{{$list->bank_name}}">
                        </td> --}}
                         <td>{{$list->transfer_provider_code}}
                            <input type="hidden" id="transfer_provider_code-{{$list->id}}" value="{{$list->transfer_provider_code}}">
                        </td>
                        <td>{{$list->active}}
                            <input type="hidden" id="active-{{$list->id}}" value="{{$list->active}}">
                        </td>

                        <td>{{date('d-m-Y', $list->created_at)}}
                            <input type="hidden" id="created_at-{{$list->created_at}}" value="{{date('d-m-Y', $list->created_at)}}">
                        </td>
                        <td>{{date('d-m-Y', $list->updated_at)}}</td>
                    {{--     <td>{{$list->ebill_provider_code}}
                            <input type="hidden" id="ebill_provider_code-{{$list->id}}" value="{{$list->ebill_provider_code}}">
                        </td> --}}
                        <td>
                            <a data-placement="top" title="Update Ebill Bank" wire:click.prevent="$emit('getDateTableEbillBankScript', '{{$list->id}}')" data-toggle="modal" data-target="#suaEbillBank">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a data-placement="top" title="Delete Ebill Bank" wire:click.prevent="$emit('deleteEbillBLankScript', '{{$list->id}}')">
                                <i class="flaticon2-delete"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(isset($getListEbillBank))
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li wire:click.prevent="gotoCurrentPage('{{$currentPage - 1}}')" class="page-item @if($currentPage <= 1) {{'disabled'}}  @endif">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                @for($i = $start; $i <= $end; $i++)
                <li wire:click.prevent="gotoCurrentPage('{{$i}}')" class="page-item @if($currentPage == $i) {{'active'}} @endif"><a class="page-link" href="#">{{$i}}</a></li>
                @endfor
                <li wire:click.prevent="gotoCurrentPage('{{$currentPage + 1}}')" class="page-item @if($currentPage >= $totalPage) {{'disabled'}}  @endif">
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
