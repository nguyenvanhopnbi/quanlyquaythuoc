<div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Cấu hình vendor theo payment method
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a data-toggle="modal" data-target="#modalAddnew" href="#" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm mới</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col">
                    <label for="partner code">Partner code: </label>
                    <input list="partnerCodeListSearch" type="text" class="form-control" id="filter_partner_code">

                    <datalist id="partnerCodeListSearch">
                        @if(isset($partnerCodeList))
                        @foreach($partnerCodeList as $list3)
                        <option value="{{$list3->partner_code}}">{{($list3->partner_code == $list3->name)?'':$list3->name}}</option>
                        @endforeach
                        @endif
                    </datalist>

                </div>
                <div class="col">
                    <label for="Vendor code">Vendor code: </label>
                    <input list="vendorCodeList" type="text" class="form-control" id="filter_vendor_code">
                    <datalist id="vendorCodeList">
                        @if(isset($vendorCodeList))
                        @foreach($vendorCodeList as $listvendor)
                        <option value="{{$listvendor->vendor_code}}">
                            {{($listvendor->vendor_code == $listvendor->vendor_name)?'':$listvendor->vendor_name}}
                        </option>
                        @endforeach
                        @endif
                    </datalist>
                </div>
                <div class="col">
                    <label for="bank code">Payment method: </label>
                    <input type="text" class="form-control" id="filter_payment_method">

                </div>
                <div class="col" style="margin-bottom: 30px;">
                    <button wire:click.prevent="$emit('searchScript')" style="margin-top: 34px;" class="btn btn-primary">Search</button>
                </div>
            </div>
            <div class="row">


                {{-- modal add new --}}
                <div wire:ignore.self class="modal fade" id="modalAddnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="col">
                                <label for="partnerCode">Partner Code:</label>
                                <input autocomplete="off" list="partnerCodeListAddnew" type="text" class="form-control" id="addnew_partner_code">
                                <datalist id="partnerCodeListAddnew">
                                    @if(isset($partnerCodeList))
                                    @foreach($partnerCodeList as $list2)
                                    <option value="{{$list2->partner_code}}">{{($list2->partner_code == $list2->name)?'':$list2->name}}</option>
                                    @endforeach
                                    @endif
                                </datalist>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="partnerCode">Payment method:</label>
                                <select wire:change.prevent="$emit('getVendorCodeScript')" class="form-control" id="addnew_payment_method">
                                    <option value="">Choose payment method..</option>
                                    <option value="ATM">ATM</option>
                                    <option value="CC">CC</option>
                                    {{-- <option value="EWALLET">EWALLET</option> --}}
                                    <option value="VA">VA</option>
                                    <option value="MM">Mobile Money</option>
                                </select>
                                {{-- <input type="text" class="form-control" id="addnew_payment_method"> --}}
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <label for="partnerCode">Vendor Code:</label>
                                <input autocomplete="off" list="vendorCodeListAddnew" type="text" class="form-control" id="addnew_vendor_code">
                                <datalist id="vendorCodeListAddnew">
                                    @if(isset($vendorCodeList))
                                    @foreach($vendorCodeList as $listvendor2)
                                    <option value="{{$listvendor2->vendor_code}}">
                                        {{($listvendor2->vendor_code == $listvendor2->vendor_name)?'':$listvendor2->vendor_name}}
                                    </option>
                                    @endforeach
                                    @endif
                                </datalist>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:click.prevent="$emit('addnewScript')" type="button" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end modal add new --}}

                {{-- start modal update --}}
                 <div wire:ignore.self class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="col">
                                <label for="partnerCode">Partner Code:</label>
                                <input
                                placeholder="Nhập partner code.."
                                list="partnerCodeListUpdate" type="text" class="form-control" id="update_partner_code">
                                <datalist id="partnerCodeListUpdate">
                                    @if(isset($partnerCodeList))
                                    @foreach($partnerCodeList as $list1)
                                    <option value="{{$list1->partner_code}}">{{($list1->partner_code == $list1->name)?'':$list1->name}}</option>
                                    @endforeach
                                    @endif
                                </datalist>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="partnerCode">Payment method:</label>
                                <select
                                wire:change.prevent="$emit('getVendorCodePaymentMethodUpdateScript')" class="form-control" id="update_payment_method">
                                    <option value="">Choose payment method..</option>
                                    <option value="ATM">ATM</option>
                                    <option value="CC">CC</option>
                                    {{-- <option value="EWALLET">EWALLET</option> --}}
                                    <option value="VA">VA</option>
                                    <option value="MM">Mobile Money</option>
                                </select>
                                {{-- <input type="text" class="form-control" id="update_payment_method"> --}}
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <label for="partnerCode">Vendor Code:</label>
                                <input
                                autocomplete="off"
                                list="vendorCodeListUpdate" type="text" class="form-control" id="update_vendor_code">

                                <datalist id="vendorCodeListUpdate">
                                    @if(isset($vendorCodeList))
                                    @foreach($vendorCodeList as $listvendor3)
                                    <option value="{{$listvendor3->vendor_code}}">
                                        {{($listvendor3->vendor_code == $listvendor3->vendor_name)?'':$listvendor3->vendor_name}}
                                    </option>
                                    @endforeach
                                    @endif
                                </datalist>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:click.prevent="$emit('updateScript')" type="button" class="btn btn-primary">Save</button>
                        <input wire:ignore type="hidden" id="idUpdate">
                      </div>
                    </div>
                  </div>
                </div>

                {{-- end modal update --}}


                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Partner code</th>
                            <th>Payment method</th>
                            <th>Vendor code</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dump($dataList); --}}

                        @if(isset($dataList))
                        @foreach($dataList as $list)
                        <tr>
                            <td>{{$list->id}}
                                <input type="hidden" id="partner_code-{{$list->id}}" value="{{$list->partner_code}}">
                                <input type="hidden" id="payment_method-{{$list->id}}" value="{{$list->payment_method}}">
                                <input type="hidden" id="vendor_code-{{$list->id}}" value="{{$list->vendor_code}}">
                            </td>
                            <td>{{$list->partner_code}}</td>
                            <td>{{$list->payment_method}}</td>
                            <td>{{$list->vendor_code}}</td>
                            <td>{{date('d-m-Y H:i:s', $list->created_at)}}</td>
                            <td>{{date('d-m-Y H:i:s', $list->updated_at)}}</td>
                            <td>
                                <span style="overflow: visible; position: relative; width: 110px;">
                                    <a
                                    wire:click.prevent="$emit('getDataTableScipt', '{{$list->id}}')"
                                    data-toggle="modal"
                                    data-target="#modalupdate"
                                    href="#" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details"><i class="flaticon2-pen"></i></a>
                            <a
                            wire:click.prevent="$emit('deleteScript', '{{$list->id}}')"
                            href="#" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete"><i class="flaticon2-delete"></i></a></span>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li wire:click.prevent="gotoCurrentPage({{$currentPage - 1}})" class="page-item {{($currentPage <= 1)?'disabled':''}}">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    @for($i = $start; $i<= $end; $i++)
                    <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item {{($i == $currentPage)?'active':''}}"><a class="page-link" href="#">{{$i}}</a></li>
                    @endfor
                    <li wire:click.prevent="gotoCurrentPage({{$currentPage + 1}})" class="page-item {{($currentPage >= $totalPage)?'disabled':''}}">
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
</div>
@push('scriptsChart')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('searchScript', ()=>{
        var partnerCode = document.getElementById('filter_partner_code').value;
        var vendorCode = document.getElementById('filter_vendor_code').value;
        var payment_method = document.getElementById('filter_payment_method').value;

        Livewire.emit('search', partnerCode, vendorCode, payment_method);
    });

    Livewire.on('addnewScript', ()=>{
        var partnerCode = document.getElementById('addnew_partner_code').value;
        var payment_method = document.getElementById('addnew_payment_method').value;
        var vendorCode = document.getElementById('addnew_vendor_code').value;

        if(partnerCode == ''){
            alert('Bạn cần nhập Partner Code: ');
            document.getElementById('addnew_partner_code').focus();
            return;
        }

        if(payment_method == ''){
            alert('Bạn cần nhập Payment method: ');
            document.getElementById('addnew_payment_method').focus();
            return;
        }


        if(vendorCode == ''){
            alert('Bạn cần nhập Vendor Code: ');
            document.getElementById('addnew_vendor_code').focus();
            return;
        }

        Livewire.emit('addnew', partnerCode, payment_method, vendorCode);
    });

    Livewire.on('messageScript',(message)=>{

        document.getElementById("addnew_partner_code").value = "";
        document.getElementById("addnew_payment_method").value = "";
        document.getElementById('addnew_vendor_code').value = "";


        if(message.warning == false){
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: message.message,
              showConfirmButton: true,
            }).then((result)=>{
                if(result.isConfirmed){
                    $('#modalAddnew').modal('hide');
                    $('#modalupdate').modal('hide');

                }
            });
        }else{
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: message.message,
              showConfirmButton: true,
              // timer: 3000
            })
        }

    });

    Livewire.on('getDataTableScipt', id=>{
        document.getElementById('idUpdate').value = id;
        document.getElementById('update_partner_code').value = document.getElementById('partner_code-' + id).value;

        document.getElementById('update_payment_method').value = document.getElementById('payment_method-' + id).value;

        document.getElementById('update_vendor_code').value = document.getElementById('vendor_code-' + id).value;
    });

    Livewire.on('updateScript', ()=>{
        var partnerCode = document.getElementById('update_partner_code').value;
        var payment_method = document.getElementById('update_payment_method').value;
        var vendorCode = document.getElementById('update_vendor_code').value;
        var id = document.getElementById('idUpdate').value;

        if(partnerCode == ''){
            alert('Bạn cần nhập Partner Code: ');
            document.getElementById('update_partner_code').focus();
            return;
        }

        if(payment_method == ''){
            alert('Bạn cần nhập Payment method: ');
            document.getElementById('update_payment_method').focus();
            return;
        }


        if(vendorCode == ''){
            alert('Bạn cần nhập Vendor Code: ');
            document.getElementById('update_vendor_code').focus();
            return;
        }

        Livewire.emit('update', id, partnerCode, payment_method, vendorCode);

    });

    Livewire.on('deleteScript', id=>{
            Swal.fire({
              title: 'Bạn có chắc chắn xóa?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                Livewire.emit('delete', id);
              }
            })
    });

    Livewire.on('getVendorCodeScript', ()=>{
        var paymentMethod = document.getElementById('addnew_payment_method').value;
        Livewire.emit('getVendorCodePaymentMethod', paymentMethod);
    });

    Livewire.on('getVendorCodePaymentMethodUpdateScript', ()=>{
        var paymentMethod = document.getElementById('update_payment_method').value;
        Livewire.emit('getVendorCodePaymentMethod', paymentMethod);
    });

</script>
@endpush
