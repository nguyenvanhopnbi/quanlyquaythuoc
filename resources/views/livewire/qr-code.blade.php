<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách Qr code
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a
                        data-toggle="modal"
                        data-target="#addNew"
                        href="#" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm mới</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body" style="overflow: scroll;">

            <div wire:loading wire:target="loading" class="loadingWrap">
                @livewire('loading.loading')
            </div>


            {{-- Modal details --}}
            <div wire:ignore.self class="modal fade bd-example-modal-lg" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col">account_id</div>
                        <div class="col" id="account_id_details">Value1</div>
                        <div class="col">partner_code</div>
                        <div class="col" id="partner_code_details">Value2</div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">application_id</div>
                        <div class="col" id="application_id_details">Value1</div>
                        <div class="col">store_name</div>
                        <div class="col" id="store_name_details">Value2</div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">store_id</div>
                        <div class="col" id="store_id_details">Value1</div>
                        <div class="col">balance</div>
                        <div class="col" id="balance_details">Value2</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">bank_code</div>
                        <div class="col" id="bank_code_details">Value1</div>
                        <div class="col">vendor_code</div>
                        <div class="col" id="vendor_code_details">Value2</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">vendor_ref_id</div>
                        <div class="col" id="vendor_ref_id_details">Value1</div>
                        <div class="col">vendor_bank_code</div>
                        <div class="col" id="vendor_bank_code_details">Value2</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">vendor_bank_name</div>
                        <div class="col" id="vendor_bank_name_details">Value1</div>
                        <div class="col">vendor_bank_branch</div>
                        <div class="col" id="vendor_bank_branch_details">Value2</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">vendor_account_no</div>
                        <div class="col" id="vendor_account_no_details">Value1</div>
                        <div class="col">vendor_account_name</div>
                        <div class="col" id="vendor_account_name_details">Value2</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">created_at</div>
                        <div class="col" id="created_at_details">Value1</div>
                        <div class="col">qr_code</div>
                        <div class="col"><img width="50" height="50" id="qr_code_details" src="" alt=""></div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">icon</div>
                        <div class="col"><img id="icon_details" width="50" height="50" src="" alt=""></div>
                        <div class="col">description</div>
                        <div class="col" id="description_details">Value2</div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">status</div>
                        <div class="col" id="status_details">Value1</div>
                        <div class="col">address</div>
                        <div class="col" id="address_details">Value2</div>
                    </div>


                    <div class="row mt-3">
                        <div class="col">email</div>
                        <div class="col" id="email_details">Value1</div>
                        <div class="col">notify_email</div>
                        <div class="col" id="notify_email_details">Value2</div>
                    </div>





                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                  </div>
                </div>
              </div>
            </div>


            <div class="row">
                <!-- Modal Add new-->
                    <div wire:ignore.self class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label for="">Name Store:</label>
                                <input type="text" id="nameAdd" class="form-control">
                            </div>
                            @error('nameAdd')
                            <div class="row">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror

                            <div class="row">
                                <label for="">Partner Code:</label>
                                <input type="text" id="partner_codeAdd" class="form-control">
                            </div>

                            @error('partner_codeAdd')
                            <div class="row">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror

                            <div class="row">
                                <label for="">Address:</label>
                                <input type="text" id="addressAdd" class="form-control">
                            </div>

                            @error('addressAdd')
                            <div class="row">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror

                            <div class="row">
                                <label for="">Description:</label>
                                <textarea id="descriptionAdd" class="form-control"></textarea>
                            </div>

                            @error('descriptionAdd')
                            <div class="row">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror

                            <div class="row">
                                <label for="">Icon:</label>
                                <label wire:ignore for="loading" id="loading" style="display: none; color: red;">Loading ..</label>
                                <input type="file" id="icon_logo_create" class="form-control">
                            </div>


                            @error('urlLogoIcon')
                            <div class="row">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror

                            @if(isset($urlLogoIcon))
                            <div class="row">
                                <img width="80" height="80" src="{{$urlLogoIcon}}" alt="icon logo">
                            </div>
                            @endif
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <span wire:click.prevent="loading">
                                <button wire:click.prevent="$emit('createScript')" type="button" class="btn btn-primary">Save</button>
                            </span>

                          </div>
                        </div>
                      </div>
                    </div>
            </div>

            <div class="row">
                <!-- Modal Edit-->
                    <div wire:ignore.self class="modal fade" id="EditQrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <label for="">Status:</label>
                                <select class="form-control" id="statusEdit">
                                    <option value="inactive">Inactive</option>
                                    <option value="active">Active</option>
                                </select>
                                {{-- <input type="text" id="statusEdit" class="form-control"> --}}
                            </div>
                            @error('statusEdit')
                            <div class="row">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror


                            <div wire:ignore class="row" id="addressEdit-display">
                                <label for="">Address:</label>
                                <input type="text" id="addressEdit" class="form-control">
                            </div>

                            @error('addressEdit')
                            <div class="row">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror

                            <div class="row">
                                <label for="">Description:</label>
                                <textarea id="descriptionEdit" class="form-control"></textarea>
                            </div>

                            @error('descriptionEdit')
                            <div class="row">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror

                            <div class="row">
                                <label for="">Icon:</label>
                                <label wire:ignore for="loading" id="loadingEdit" style="display: none; color: red;">Loading ..</label>
                                <input type="file" id="icon_logo_Edit" class="form-control">
                            </div>


                            @error('urlLogoIconEdit')
                            <div class="row">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror

                            @if(isset($urlLogoIconEdit))
                            <div class="row">
                                <img id="urlLogoIconEdit" width="80" height="80" src="{{$urlLogoIconEdit}}" alt="icon logo">
                            </div>
                            @endif
                            @if(!isset($urlLogoIconEdit))
                            <div class="row">
                                <img id="urlLogoIconEdit" width="80" height="80" src="" alt="icon logo">
                            </div>
                            @endif
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input wire:ignore type="hidden" id="accountIDEdit">
                            <span wire:click.prevent="loading">
                                <button wire:click.prevent="$emit('editScript')" type="button" class="btn btn-primary">Update</button>
                            </span>

                          </div>
                        </div>
                      </div>
                    </div>
            </div>


            <div class="row" style="margin-bottom: 20px;">
                <div class="col-3">
                    <label for="">Name</label>
                    <input type="text" id="nameSearch" class="form-control" placeholder="Nhập tên store">
                </div>
                <div class="col-3">
                    <label for="">Partner Code: </label>
                    <input list="partnerCodeList" type="text" id="partnerCodeSearch" class="form-control" placeholder="Nhập partner code">
                    <datalist id="partnerCodeList">
                        @if(isset($partnerCodeList))
                        @foreach($partnerCodeList as $list2)
                        <option value="{{$list2->partner_code}}">{{($list2->partner_code == $list2->name)?'':$list2->name}}</option>
                        @endforeach
                        @endif
                    </datalist>
                </div>
                <div class="col-3">
                    <label for="">ApplicationID</label>
                    <input type="text" id="application_idSearch" class="form-control" placeholder="Nhập tên application id">
                </div>
                <div class="col-3">
                    <label for="">Vendor code: </label>
                    <input type="text" id="vendor_codeSearch" class="form-control" placeholder="Nhập tên vendor code">
                </div>
                <div class="col-3">
                    <label for="">Vendor bank code</label>
                    <input type="text" id="vendor_bank_codeSearch" class="form-control" placeholder="Nhập tên vendor bank code">
                </div>
                <div class="col-3">
                    <label for="">Vendor account no</label>
                    <input type="text" id="vendor_account_noSearch" class="form-control" placeholder="Nhập tên vendor account no">
                </div>
                <div class="col-3">
                    <label for=""> </label>
                    <button wire:click.prevent="$emit('searchScript')" style="margin-top: 34px;" class="btn btn-primary">Search</button>
                </div>
            </div>



            <div class="row">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>AccountID</th>
                            <th>Application ID</th>
                            <th>Partner Code</th>
                            <th>Store Name</th>
                            <th>Status</th>
                            <th>Balance</th>
                            <th>Bank code</th>
                            <th>Vendor code</th>
                            <th>Qr Code</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dump($dataList) --}}
                        @if(isset($dataList))
                        @foreach($dataList as $list)
                        <tr>
                            <td>{{$list->account_id}}
                                <input type="hidden" id="account_id-{{$list->account_id}}"
                                value="{{$list->account_id}}">
                                <input type="hidden" id="partner_code-{{$list->account_id}}"
                                value="{{$list->partner_code}}">
                                <input type="hidden" id="application_id-{{$list->account_id}}"
                                value="{{$list->application_id}}">
                                <input type="hidden" id="store_name-{{$list->account_id}}"
                                value="{{$list->store_name}}">
                                <input type="hidden" id="store_id-{{$list->account_id}}"
                                value="{{$list->store_id}}">
                                <input type="hidden" id="balance-{{$list->account_id}}"
                                value="{{$list->balance}}">
                                <input type="hidden" id="bank_code-{{$list->account_id}}"
                                value="{{$list->bank_code}}">
                                <input type="hidden" id="vendor_code-{{$list->account_id}}"
                                value="{{$list->vendor_code}}">
                                <input type="hidden" id="vendor_ref_id-{{$list->account_id}}"
                                value="{{$list->vendor_ref_id}}">
                                <input type="hidden" id="vendor_bank_code-{{$list->account_id}}"
                                value="{{$list->vendor_bank_code}}">
                                <input type="hidden" id="vendor_bank_name-{{$list->account_id}}"
                                value="{{$list->vendor_bank_name}}">
                                <input type="hidden" id="vendor_bank_branch-{{$list->account_id}}"
                                value="{{$list->vendor_bank_branch}}">
                                <input type="hidden" id="vendor_account_no-{{$list->account_id}}"
                                value="{{$list->vendor_account_no}}">
                                <input type="hidden" id="vendor_account_name-{{$list->account_id}}"
                                value="{{$list->vendor_account_name}}">
                                <input type="hidden" id="created_at-{{$list->account_id}}"
                                value="{{date('d-m-Y H:i:s', $list->created_at)}}">
                                <input type="hidden" id="qr_code-{{$list->account_id}}"
                                value="{{$list->qr_code}}">
                                <input type="hidden" id="email-{{$list->account_id}}"
                                value="{{$list->email}}">
                                <input type="hidden" id="notify_email-{{$list->account_id}}"
                                value="{{$list->notify_email}}">
                                <input type="hidden" id="status-{{$list->account_id}}" value="{{$list->status}}">
                                <input type="hidden" id="address-{{$list->account_id}}" value="{{$list->address}}">
                                <input type="hidden" id="icon-{{$list->account_id}}" value="{{$list->icon}}">
                                <input type="hidden" id="description-{{$list->account_id}}"
                                value="{{$list->description}}">
                            </td>
                            <td>{{$list->application_id}}</td>

                            <td>{{$list->partner_code}}</td>
                            <td>{{$list->store_name}}</td>
                            <td>{!! ($list->status == 'active')?'<span class="badge badge-primary">Active</span>':'<span class="badge badge-danger">Inactive</span>' !!}</td>
                            <td>{{$list->balance}}</td>
                            <td>{{$list->bank_code}}</td>
                            <td>{{$list->vendor_code}}</td>
                            <td>
                                <a
                                target="_blank"
                                href="{{$list->qr_code}}" download="">
                                    <img width="70" height="70" src="{{$list->qr_code}}" alt="">
                                </a>

                            </td>
                            <td>
                                {{date('d-m-Y H:i:s', $list->created_at)}}
                            </td>
                            <td>

                            <a data-placement="top" title="Sửa Qrcode" wire:click.prevent="$emit('getDateTableUpdateScript', '{{$list->account_id}}')" data-toggle="modal" data-target="#EditQrcode">
                                <i class="flaticon2-pen"></i> |
                            </a>

                            <a wire:click.prevent="$emit('ShowChitietQRcodeScript', '{{$list->account_id}}')" data-toggle="modal" data-target="#modalDetails">
                                <i style="font-size: 1.15rem; color: #93a2dd; cursor: pointer;" class="flaticon-search-magnifier-interface-symbol"></i>
                            </a>
                            <input type="text" width="70px" height="1px" style="visibility: hidden;">

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
                    @for($i = $start; $i <= $end; $i++)
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

        Livewire.on('messageScript', message=>{
            if(message.warning){
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: message.message,
                  showConfirmButton: false,
                  timer: 3000
                })
            }else{
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: message.message,
                  showConfirmButton: false,
                  timer: 3000
                })
            }
        });

        Livewire.on('endUploadCreateScript', url=>{
            document.getElementById('loading').style.display = 'none';
            document.getElementById('loadingEdit').style.display = 'none';
        });

        Livewire.on('createScript', ()=>{
            var name = document.getElementById('nameAdd').value;
            var partner_code = document.getElementById('partner_codeAdd').value;
            var address = document.getElementById('addressAdd').value;
            var description = document.getElementById('descriptionAdd').value;
            Livewire.emit('create', name, partner_code, address, description);
        });

        Livewire.on('editScript', ()=>{
            var accountID = document.getElementById('accountIDEdit').value;
            var status = document.getElementById('statusEdit').value;
            var address = document.getElementById('addressEdit').value;
            var description = document.getElementById('descriptionEdit').value;

            Livewire.emit('edit', accountID, status, address, description);
        });


        Livewire.on('searchScript', ()=>{
            var name = document.getElementById('nameSearch').value;
            var partnerCode = document.getElementById('partnerCodeSearch').value;
            var applicationID = document.getElementById('application_idSearch').value;
            var vendorCode = document.getElementById('vendor_codeSearch').value;
            var vendorBankCode = document.getElementById('vendor_bank_codeSearch').value;
            var vendorAccountNo = document.getElementById('vendor_account_noSearch').value;

            Livewire.emit('search', name, partnerCode, applicationID, vendorCode, vendorBankCode, vendorAccountNo);
        });


        Livewire.on('getDateTableUpdateScript', accountID=>{

            // Livewire.emit('resetUrl');

            document.getElementById('accountIDEdit').value = accountID;
            var status = document.getElementById('status-' + accountID).value;
            if(status == 'active'){
                document.getElementById('statusEdit').value = 'active';
                document.getElementById('addressEdit-display').style.display="none";
            }else{
                document.getElementById('statusEdit').value = 'inactive';
                document.getElementById('addressEdit-display').style.display="block";
            }

            document.getElementById('addressEdit').value = document.getElementById('address-' + accountID).value;
            document.getElementById('descriptionEdit').value = document.getElementById('description-' + accountID).value;
            document.getElementById('statusEdit').value = document.getElementById('status-' + accountID).value;
            document.getElementById('urlLogoIconEdit').src = document.getElementById('icon-' + accountID).value;
        });


        document.addEventListener("livewire:load", function() {

            var iconInput = document.getElementById('icon_logo_create');
            iconInput.addEventListener('input', () => {

                var file = iconInput.files[0];
                if(file.name != ''){
                    document.getElementById('loading').style.display = 'block';
                }

                let formData = new FormData();
                formData.append('icon', file);
                axios.post('/upload-image',
                    formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                ).then(response => {
                    Livewire.emit('updateImage', response.data);
                }).catch(function(err) {
                    alert("{{ __('Transaction.notice_upload_image_invalid') }}");
                });
            });


            // img edit event

            var iconInputEdit = document.getElementById('icon_logo_Edit');
            iconInputEdit.addEventListener('input', () => {

                var fileEdit = iconInputEdit.files[0];
                if(fileEdit.name != ''){
                    document.getElementById('loadingEdit').style.display = 'block';
                }

                let formDataEdit = new FormData();
                formDataEdit.append('icon', fileEdit);
                axios.post('/upload-image',
                    formDataEdit,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
                ).then(response => {
                    Livewire.emit('updateImageEdit', response.data);
                }).catch(function(err) {
                    alert("{{ __('Transaction.notice_upload_image_invalid') }}");
                });
            });

        });

        Livewire.on('ShowChitietQRcodeScript', accountID=>{
            document.getElementById('account_id_details').innerHTML = document.getElementById('account_id-' + accountID).value;

            document.getElementById('partner_code_details').innerHTML = document.getElementById('partner_code-' + accountID).value;

            document.getElementById('application_id_details').innerHTML = document.getElementById('application_id-' + accountID).value;

            document.getElementById('store_name_details').innerHTML = document.getElementById('store_name-' + accountID).value;

            document.getElementById('store_id_details').innerHTML = document.getElementById('store_id-' + accountID).value;
            document.getElementById('balance_details').innerHTML = document.getElementById('balance-' + accountID).value;

            document.getElementById('bank_code_details').innerHTML = document.getElementById('bank_code-' + accountID).value;
            document.getElementById('vendor_code_details').innerHTML = document.getElementById('vendor_code-' + accountID).value;

            document.getElementById('vendor_ref_id_details').innerHTML = document.getElementById('vendor_ref_id-' + accountID).value;
            document.getElementById('vendor_bank_code_details').innerHTML = document.getElementById('vendor_bank_code-' + accountID).value;

            document.getElementById('vendor_bank_name_details').innerHTML = document.getElementById('vendor_bank_name-' + accountID).value;

            document.getElementById('vendor_bank_branch_details').innerHTML = document.getElementById('vendor_bank_branch-' + accountID).value;

            document.getElementById('vendor_account_no_details').innerHTML = document.getElementById('vendor_account_no-' + accountID).value;

            document.getElementById('vendor_account_name_details').innerHTML = document.getElementById('vendor_account_name-' + accountID).value;
            document.getElementById('created_at_details').innerHTML = document.getElementById('created_at-' + accountID).value;

            document.getElementById('qr_code_details').src = document.getElementById('qr_code-' + accountID).value;
            document.getElementById('icon_details').src = document.getElementById('icon-' + accountID).value;
            document.getElementById('description_details').innerHTML = document.getElementById('description-' + accountID).value;

            document.getElementById('status_details').innerHTML = document.getElementById('status-' + accountID).value;
            document.getElementById('address_details').innerHTML = document.getElementById('address-' + accountID).value;
            document.getElementById('email_details').innerHTML = document.getElementById('email-' + accountID).value;
            document.getElementById('notify_email_details').innerHTML = document.getElementById('notify_email-' + accountID).value;
        });



    </script>
@endpush
