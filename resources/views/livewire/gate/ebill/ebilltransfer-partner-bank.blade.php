<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Transfer Partner Bank Provider
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a
                        data-toggle="modal"
                        data-target="#themmoiTransferPartnerBank"
                        href="/partner-partners/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm Mới</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal edit --}}
         <div wire:ignore.self class="modal fade" id="editTransferPartnerBank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Transfer Partner Bank Provider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @if(isset($message) and !$warning)
                <div class="row">
                    <div class="col"><span class="alert alert-primary">{{$message}}</span></div>
                </div>
                @elseif(isset($message) and $warning)
                <div class="row">
                    <div class="col"><span class="alert alert-danger">{{$message}}</span></div>
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <label for="">Partner Code: </label>
                        <input type="text" class="form-control" id="partner_code_edit">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Bank Code: </label>
                        <input type="text" class="form-control" id="Bank_code_edit">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Provider Code: </label>
                        <input type="text" class="form-control" id="provider_code_edit">
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('EditEbillPartnerProviderScript')" type="button" class="btn btn-primary">Update</button>
                <input type="hidden" id="ID_Update" value="{{$idUpdate}}">
              </div>
            </div>
          </div>
        </div>
        {{-- end modal edit --}}

        {{-- modal them moi --}}
        <div wire:ignore.self class="modal fade" id="themmoiTransferPartnerBank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới Transfer Partner Bank Provider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @if(isset($message) and !$warning)
                <div class="row">
                    <div class="col"><span class="alert alert-primary">{{$message}}</span></div>
                </div>
                @elseif(isset($message) and $warning)
                <div class="row">
                    <div class="col"><span class="alert alert-danger">{{$message}}</span></div>
                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <label for="">Partner Code: </label>
                        <input type="text" class="form-control" id="partner_code">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Bank Code: </label>
                        <input type="text" class="form-control" id="Bank_code">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Provider Code: </label>
                        <input type="text" class="form-control" id="provider_code">
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('saveNewEbillPartnerProviderScript')" type="button" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- end modal them moi --}}
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col">
                    <label for="">Partner Code:</label>
                    <input type="text" class="form-control" id="searchPartnerCode">
                </div>
                <div class="col">
                    <label for="">Bank Code:</label>
                    <input type="text" class="form-control" id="searchBankCode">
                </div>
                <div class="col">
                    <label for="">Provider Code:</label>
                    <input type="text" class="form-control" id="searchProviderCode">
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <label for="">Start Time:</label>
                    <input type="text" class="form-control" id="startTimeSearch" placeholder="Ngày bắt đầu">
                </div>
                <div class="col">
                    <label for="">End Time:</label>
                    <input type="text" class="form-control" id="endTimeSearch" placeholder="Ngày kết thúc" >
                </div>
                <div class="col">
                    <button wire:click.prevent="$emit('SearchEbillBankPartnerProviderScript')" style="margin-top: 34px" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Partner Code</th>
                        <th>Bank Code</th>
                        <th>Provider Code</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($EbillPartnerBankTransfer))
                    @foreach($EbillPartnerBankTransfer as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->partner_code}}
                            <input type="hidden" id="partner_code-{{$list->id}}" value="{{$list->partner_code}}">
                        </td>
                        <td>{{$list->bank_code}}
                            <input type="hidden" id="bank_code-{{$list->id}}" value="{{$list->bank_code}}">
                        </td>
                        <td>{{$list->provider_code}}
                            <input type="hidden" id="provider_code-{{$list->id}}" value="{{$list->provider_code}}">
                        </td>
                        <td>{{date('d-m-Y', $list->created_at)}}</td>
                        <td>{{date('d-m-Y', $list->updated_at)}}</td>
                        <td>
                            <a data-placement="top"
                            title="Update Transfer Partner Bank Provider" wire:click.prevent="$emit('getDateTableEbillBankPartnerProviderScript', '{{$list->id}}')" data-toggle="modal" data-target="#editTransferPartnerBank">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a data-placement="top" title="Delete Transfer Partner Bank Provider" wire:click.prevent="$emit('deleteEbillBLankPartnerProviderScript', '{{$list->id}}')">
                                <i class="flaticon2-delete"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(isset($EbillPartnerBankTransfer))
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
                <li wire:click.prevent="gotoCurrentPage('{{$currentPage + 1}}')" class="page-item @if($currentPage >= $totalPage) {{'disabled'}} @endif">
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
