<div>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Quản lý Nhóm quyền
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <button
                        data-toggle="modal"
                        data-target="#addnewGroupRight"
                        class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> Thêm mới</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- edit modal --}}

        <div wire:ignore.self class="modal fade" id="editGroupRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  @if(isset($message) and !$warning)
                <div class="row">
                    <div class="col">
                        <span class="alert alert-primary">{{$message}}</span>
                    </div>
                </div>
                @endif
                @if(isset($message) and $warning)
                <div class="row">
                    <div class="col">
                        <span class="alert alert-danger">{{$message}}</span>
                    </div>
                </div>
                @endif
              </div>
              <div class="modal-body">

                <div class="row">
                    <div class="col">
                        <label for="GroupName">Group Name: </label>
                        <input type="text" class="form-control" id="group-name">
                        <input wire:ignore type="hidden" id="IDedit">
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('EditScript')" type="button" class="btn btn-primary">Update</button>
              </div>
            </div>
          </div>
        </div>

        {{-- end edit modal --}}



        {{-- add new modal --}}
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="addnewGroupRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                  @if(isset($message) and !$warning)
                <div class="row">
                    <div class="col">
                        <span class="alert alert-primary">{{$message}}</span>
                    </div>
                </div>
                @endif
                @if(isset($message) and $warning)
                <div class="row">
                    <div class="col">
                        <span class="alert alert-danger">{{$message}}</span>
                    </div>
                </div>
                @endif
              </div>


              <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label for="GroupName">Group Name: </label>
                        <input type="text" class="form-control" id="group-name-add-new">
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('AddnewScript')" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>

        {{-- end add new modal --}}
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Group Name" id="searchGroupName">
                    <button wire:click.prevent="$emit('SearchScript')" class="btn btn-primary">Search</button>
                </div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($getGroup))
                    @foreach($getGroup as $list)
                    <tr>
                        <td>{{$list->id}}
                            <input type="hidden" id="ID-{{$list->id}}" value="{{$list->id}}">
                        </td>
                        <td>{{$list->group_name}}
                            <input type="hidden" id="Group_Name-{{$list->id}}" value="{{$list->group_name}}">
                        </td>
                        <td style="width: 100px;"><a data-placement="top" title="Update" wire:click.prevent="$emit('getDataEdit', '{{$list->id}}')" data-toggle="modal" data-target="#editGroupRight">
            <i class="flaticon2-pen"></i> |
        </a>
        <a data-placement="top" title="Delete" wire:click.prevent="$emit('deleteScript', '{{$list->id}}')">
            <i class="flaticon2-delete"></i>
        </a></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            {{ $getGroup->links() }}
        </div>

    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.on('AddnewScript', ()=>{
            var groupName = document.getElementById("group-name-add-new").value;
            Livewire.emit('Addnew', groupName);
        });

        Livewire.on('getDataEdit', id=>{
            var id = document.getElementById("ID-" + id).value;
            var groupName = document.getElementById("Group_Name-" + id).value;
            document.getElementById("group-name").value = groupName;
            document.getElementById("IDedit").value = id;
        });

        Livewire.on('EditScript', ()=>{
            var groupName = document.getElementById("group-name").value;
            var id = document.getElementById("IDedit").value;

            Livewire.emit("Edit", groupName, id);
        });

        Livewire.on('deleteScript', id=>{
            var cFirm = confirm("Bạn chắc chắn xóa?");
            if(cFirm){
                Livewire.emit('delete', id);
            }

        });

        Livewire.on('SearchScript', ()=>{
            var groupName = document.getElementById("searchGroupName").value;
            Livewire.emit('Search', groupName);
        });
    });
</script>
