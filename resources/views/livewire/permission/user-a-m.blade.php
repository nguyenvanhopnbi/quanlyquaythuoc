
@push('css')
    <style type="text/css">
        .flaticon2-search-1{
            font-size: 1.15rem;
            color: #93a2dd;
            cursor: pointer;
        }
    </style>
@endpush
<div>

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Quản lý user AM
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    @can('am-user-manage-add')
                    <div class="dropdown dropdown-inline">
                        <a data-toggle="modal" data-target="#addnewModel" wire:click.prevent="$emit('adnewUserAMScript')" href="#" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm mới</a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            {{-- View details modal --}}
            <div wire:ignore.self class="modal fade" id="ViewDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(isset($statusUserMessage))
                    <div class="row">
                        <div class="col">
                            @if($statusUserWarning)
                            <span class="alert alert-danger">{{$statusUserMessage}}</span>
                            @else
                            <span class="alert alert-primary">{{$statusUserMessage}}</span>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <label for="status">AM status: </label>
                            <select name="status" id="status" class="form-control">
                                <option value="yes" {{($statusUser == 'yes')?'selected':''}} >YES</option>
                                <option value="no" {{($statusUser == 'no')?'selected':''}}>NO</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="$emit('changeStatusScript')" type="button" class="btn btn-primary">Change</button>
                    <input wire:ignore type="hidden" id="emailUser">
                  </div>
                </div>
              </div>
            </div>
            {{-- End view detail modal --}}


            <!-- Update Modal -->
            <div wire:ignore.self class="modal fade" id="updateUserAMModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form wire:submit.prevent="$emit('updateUserAMFormScript')">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    @if($message)
                    <div class="row">
                        <div class="col">
                            <span class="alert alert-primary">{{$message}}</span>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <label for="emailUpdateUserAM">Email: </label>
                            <input value="{{(isset($email))?$email:''}}" type="email" required class="form-control" id="emailUpdateUserAM">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="partner_code">Partner Code: </label>
                            <span style="display: flex;">
                                <input list="partnerListUpdate" type="text" class="form-control" id="partnerCodeUpdateUserAM">

                                <datalist id="partnerListUpdate">
                                    @if(isset($partnerList->data))
                                    @foreach($partnerList->data as $listUpdate)
                                    @if($listUpdate->partner_code != null)
                                    <option value="{{$listUpdate->partner_code}}">

                                        {{($listUpdate->partner_code == $listUpdate->name)?'':$listUpdate->name}}

                                    </option>
                                    @endif
                                    @endforeach
                                    @endif
                                </datalist>

                                <a wire:click.prevent="$emit('updateUserAMScript')" style="color: white; height: 39px; line-height: 30px; margin-top: 5px;" class="badge badge-success">Add</a>
                            </span>

                            <ul>
                                @if(isset($partnerCode))
                                @foreach($partnerCode as $code)
                                <li>
                                    <a>{{$code}}</a>
                                    <a wire:click.prevent="removePartnerCodeView('{{$code}}')" ><i style="font-size: 10px; color: red; margin-left: 15px;" class="flaticon2-delete"></i></a>
                                </li>
                                @endforeach
                                @endif
                            </ul>

                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button  type="submit" class="btn btn-primary">update</button>
                  </div>
                </div>

                </form>
              </div>
            </div>


            <!-- Modal Add new -->
            <div wire:ignore.self class="modal fade" id="addnewModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form wire:submit.prevent="$emit('addNewUserAMScript')">

              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if($message)
                    <div class="row">
                        <div class="col">
                            <span class="alert alert-primary">{{$message}}</span>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <label for="email">Email: </label>
                            <input type="email" class="form-control" required id="emailAddnew">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="partnerCode">Partner Code: </label>
                            <span style="display: flex;">
                                <input list="partnerList" type="text" class="form-control" required id="partner_code_Addnew">

                                <datalist id="partnerList">
                                    @if(isset($partnerList->data))
                                    @foreach($partnerList->data as $listAdd)
                                    @if($listAdd->partner_code != null)
                                    <option value="{{$listAdd->partner_code}}">

                                        {{($listAdd->partner_code == $listAdd->name)?'':$listAdd->name}}

                                    </option>
                                    @endif
                                    @endforeach
                                    @endif
                                </datalist>

                                <a wire:click.prevent="$emit('addPartnerCodeScript')" class="badge badge-success" href="#" style="height: 39px; line-height: 30px; margin-top: 5px;">Add</a>
                            </span>

                            <ul>
                                @if(isset($partnerCode))
                                @foreach($partnerCode as $code)
                                <li>
                                    <a>{{$code}}</a>
                                    <a wire:click.prevent="removePartnerCodeView('{{$code}}')" ><i style="font-size: 10px; color: red; margin-left: 15px;" class="flaticon2-delete"></i></a>
                                </li>
                                @endforeach
                                @endif
                            </ul>

                        </div>
                    </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>

            </form>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="Email">Email: </label>
                    <input type="Email" class="form-control" id="emailSearch">
                </div>
                <div class="col-md-3">
                    <button wire:click.prevent="$emit('searchScript')" type="button" class="btn btn-primary" style="margin-top: 34px;"> Search </button>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Partner Code</th>
                                <th>Create At</th>
                                <th>Update At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($listUser))
                            @foreach($listUser as $list)
                            <tr>
                                <td>{{$list->id}}</td>
                                <td>{{$list->email}}</td>
                                <td>{{$list->partner_code}}</td>
                                <td>{{date('d-m-Y H:i:s', strtotime($list->created_at))}}</td>
                                <td>{{date('d-m-Y H:i:s', strtotime($list->updated_at))}}</td>
                                <td style="width: 100px;">
                                    @can('am-user-manage-edit')
                                    <a data-toggle="modal" data-target="#updateUserAMModal" data-placement="top" title="Update User AM" wire:click.prevent="$emit('getDateTableupdateUserAMModalScript', '{{$list->id}}')" data-toggle="modal" data-target="#UpdatePartnerBusiness">
                                        <i class="flaticon2-pen"></i> |
                                    </a>
                                    @endcan
                                    @can('am-user-manage-delete')
                                    <a data-placement="top" title="Delete User AM" wire:click.prevent="$emit('deleteUserAMScript', '{{$list->id}}')">
                                        <i class="flaticon2-delete"></i> |
                                    </a>
                                    @endcan
                                    @can('am-user-manage-active')
                                    <a data-toggle="modal" data-target="#ViewDetailsModal" data-placement="top" title="Active User AM" wire:click.prevent="$emit('ViewUserAMScript', '{{$list->email}}')">
                                        <i class="flaticon2-search-1"></i>
                                    </a>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>


                    {{$listUser->links()}}
                </div>
            </div>
        </div>

    </div>


</div>

@push('scripts')
    <script>


        Livewire.on('ViewUserAMScript', email=>{

            document.getElementById('emailUser').value = email;

            Livewire.emit('ViewUserAM', email);
        });

        Livewire.on('changeStatusScript', ()=>{
            var email = document.getElementById('emailUser').value;

            var status = document.getElementById('status').value;
            Livewire.emit('changeStatus', email, status);
        });

        Livewire.on('addNewUserAMScript', ()=>{
            var email = document.getElementById('emailAddnew').value;
            var partner_code = document.getElementById('partner_code_Addnew').value;

            Livewire.emit('addNewUserAM', email, partner_code);

            setTimeout(function(){
                Livewire.emit('resetMessage');
            }, 5000);
        });


        Livewire.on('addPartnerCodeScript', ()=>{
            var partnerCode = document.getElementById('partner_code_Addnew').value;
            Livewire.emit('addPartnerCode', partnerCode);
        });

        Livewire.on('updateUserAMScript', ()=>{
            var partnerCode = document.getElementById('partnerCodeUpdateUserAM').value;
            Livewire.emit('addPartnerCode', partnerCode);
        });



        Livewire.on('deleteUserAMScript', id=>{
            var cFirm = confirm("Bạn chắc chắn muốn xóa user AM này?");
            if(cFirm){
                Livewire.emit('deleteUserAM', id);
            }
        });

        Livewire.on('getDateTableupdateUserAMModalScript', id=>{
            Livewire.emit('getDateTableupdateUserAMModal', id);
        });

        Livewire.on('updateUserAMFormScript', ()=>{
            var email = document.getElementById('emailUpdateUserAM').value;
            var partnerCode = document.getElementById('partnerCodeUpdateUserAM').value;

            Livewire.emit('updateUserAM', email, partnerCode);

            setTimeout(function(){
                Livewire.emit('resetMessage');
            }, 5000);
        });

        Livewire.on('searchScript', ()=>{
            var email = document.getElementById('emailSearch').value;
            Livewire.emit('search', email);
        });

    </script>
@endpush
