@push('css')
    <style type="text/css">

        .table td{
            color: #595d6e !important;
            font-size: 13px !important;
            font-weight: 300 !important;
            font-family: Roboto,Helvetica,sans-serif !important;
            -webkit-font-smoothing: antialiased !important;
        }
    </style>
@endpush

<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    List Partner Type Config
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a data-toggle="modal" data-target="#formCreate" class="btn btn-success btn-icon-sm text-white"><i class="fas fa-plus"></i>
                            Thêm mới
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="kt-portlet__body">
            <!-- Modal #formCreate -->
            <div wire:ignore.self class="modal fade" id="formCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="partnerCode">Partner Code: </label>
                            <input list="getListPartner" type="text" class="form-control" id="partnerCode">
                            <datalist id="getListPartner">
                                {{-- @dd($ListPartner); --}}
                                @if(isset($ListPartner))
                                @foreach($ListPartner as $list1)
                                <option value="{{$list1->partner_code}}">
                                    {{($list1->partner_code == $list1->name)?"":$list1->name}}
                                </option>
                                @endforeach
                                @endif
                            </datalist>
                        </div>

                    </div>
                    {{-- <div class="row">
                        <div class="col">
                            <label for="partnerCode">Type: </label>
                            <input type="text" class="form-control" id="type">
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col">
                            <label for="partnerCode">Mastercard Type: </label>
                            <input type="text" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="partnerCode">Napas type: </label>
                            <select class="form-control" id="napas_type">
                                <option value="">Chọn napas type</option>
                                <option value="WL1">WL1</option>
                                <option value="WL2">WL2</option>
                                <option value="WL3">WL3</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('addScript')" type="button" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>

            {{-- end modal add new --}}
            {{-- start modal edit --}}
            <div wire:ignore.self class="modal fade" id="formEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col">
                            <label for="partnerCode">Partner Code: </label>
                            <input list="getListPartner" type="text" class="form-control" id="partnerCodeEdit">
                            <datalist id="getListPartner">
                                {{-- @dd($ListPartner); --}}
                                @if(isset($ListPartner))
                                @foreach($ListPartner as $list2)
                                <option value="{{$list2->partner_code}}">
                                    {{($list2->partner_code == $list2->name)?"":$list2->name}}
                                </option>
                                @endforeach
                                @endif
                            </datalist>
                        </div>

                    </div>


                    {{-- <div class="row">
                        <div class="col">
                            <label for="partnerCode">Type: </label>
                            <input type="text" class="form-control" id="typeEdit">
                        </div>
                    </div> --}}


                    <div class="row">
                        <div class="col">
                            <label for="partnerCode">Mastercard Type: </label>
                            <input type="text" class="form-control" id="nameEdit">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="partnerCode">Napas type: </label>
                            <select class="form-control" id="napas_typeEdit">
                                <option value="">Chọn napas type</option>
                                <option value="WL1">WL1</option>
                                <option value="WL2">WL2</option>
                                <option value="WL3">WL3</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input wire:ignore type="hidden" id="idEditAction">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('editActionScript')" type="button" class="btn btn-primary">Edit</button>
                  </div>
                </div>
              </div>
            </div>
            {{-- end modal edit --}}
            <div class="row">
                <div class="col-3">
                    <label for="partnerCode">Partner Code: </label>
                    <input list="getListPartnerSearch" type="text" class="form-control" id="partnerCodeSearch">
                    <datalist id="getListPartnerSearch">
                        @if(isset($ListPartner))
                        @foreach($ListPartner as $list3)
                        <option value="{{$list3->partner_code}}">
                            {{($list3->partner_code == $list3->name)?"":$list3->name}}
                        </option>
                        @endforeach
                        @endif
                    </datalist>
                </div>
                <div class="col-3">
                    <label for="">Name: </label>
                    <input type="text" class="form-control" id="nameSearch">
                </div>

                {{-- <div class="col-3">
                    <label for="">Type: </label>
                    <input type="text" class="form-control" id="typeSearch">
                </div> --}}

                <div class="col-3">
                    <label for="Napas Type">Napas type: </label>
                    {{-- <input type="text" class="form-control" id="NapasType"> --}}
                    <select class="form-control mt-2" id="NapasType">
                        <option value="">Chọn napas type</option>
                        <option value="WL1">WL1</option>
                        <option value="WL2">WL2</option>
                        <option value="WL3">WL3</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin: 10px 0px 10px 0px; text-align: right;">
                <div class="col">
                    <button wire:click.prevent="$emit('searchScript')" class="btn btn-primary">Search</button>
                </div>
            </div>
            <div class="row">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th style="white-space: nowrap;">Partner Code</th>
                            <th>Mastercard Type</th>
                            {{-- <th>Type</th> --}}
                            <th style="white-space: nowrap;">Napas Type</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($dataList))
                        @foreach($dataList as $list)
                        <tr>
                            <td>{{$list->id}}
                                <input type="hidden" value="{{$list->id}}" id="id-{{$list->id}}">
                                <input type="hidden" value="{{$list->partner_code}}" id="partner_code-{{$list->id}}">
                                <input type="hidden" value="{{$list->mastercard_type}}" id="name-{{$list->id}}">
                                {{-- <input type="hidden" value="{{$list->type}}" id="type-{{$list->id}}"> --}}
                                <input type="hidden" value="{{$list->napas_type}}" id="napas_type-{{$list->id}}">
                            </td>
                            <td>{{$list->partner_code}}</td>
                            <td>{{$list->mastercard_type}}</td>
                            {{-- <td>{{$list->type}}</td> --}}
                            <td>{{$list->napas_type}}</td>
                            <td>{{date('d-m-Y H:i:s', $list->created_at)}}</td>
                            <td>{{date('d-m-Y H:i:s', $list->updated_at)}}</td>
                            <td class="">
                                <span class="d-flex">
                                    <a data-toggle="modal" data-target="#formEdit" wire:click.prevent="$emit('editScript', '{{$list->id}}')" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">
                                        <i class="flaticon2-pen"></i>
                                    </a>
                                    <a wire:click.prevent="$emit('deleteScript', '{{$list->id}}')" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete">
                                    <i class="flaticon2-delete"></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item {{($currentPage <= 1)?'disabled':''}}">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    @for($i=$start; $i<=$end; $i++)
                    <li class="page-item {{($i == $currentPage)?'active':''}}"><a class="page-link" href="#">{{$i}}</a></li>
                    @endfor
                    <li class="page-item {{($currentPage >= $totalPage)?'disabled':''}}">
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

        Livewire.on('searchScript', ()=>{
            var partnerCode = document.getElementById('partnerCodeSearch').value;
            var type = document.getElementById('typeSearch').value;
            var name = document.getElementById('nameSearch').value;
            var napasType = document.getElementById('NapasType').value;

            Livewire.emit('search', partnerCode, name, napasType);
        });

        Livewire.on('editScript', id=>{
            document.getElementById('partnerCodeEdit').value = document.getElementById('partner_code-' + id).value;
            // document.getElementById('typeEdit').value = document.getElementById('type-' + id).value;
            document.getElementById('nameEdit').value = document.getElementById('name-' + id).value;
            document.getElementById('napas_typeEdit').value = document.getElementById('napas_type-' + id).value;

            document.getElementById('idEditAction').value = id;

        });

        Livewire.on('editActionScript', ()=>{
            var id = document.getElementById('idEditAction').value;
            var partnerCode = document.getElementById('partnerCodeEdit').value;
            // var type = document.getElementById('typeEdit').value;
            var name = document.getElementById('nameEdit').value;
            var napasType = document.getElementById('napas_typeEdit').value;

            Livewire.emit('edit', id, partnerCode, name, napasType);
        });

        Livewire.on('deleteScript', id=>{

            Swal.fire({
              title: 'Bạn có chắc chắn xóa ID: ' + id + '?',
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


        Livewire.on('addScript', ()=>{
            var partnerCode = document.getElementById('partnerCode').value;
            // var type = document.getElementById('type').value;
            var name = document.getElementById('name').value;
            var napas_type = document.getElementById('napas_type').value;

            Livewire.emit('add', partnerCode, name, napas_type);
        });
    </script>
@endpush
