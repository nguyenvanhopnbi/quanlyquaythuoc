<div wire:ignore.self class="modal fade" id="update-permission-modal" tabindex="-1" role="dialog"
    aria-labelledby="update-permission-label" aria-hidden="true" x-data x-on:saved.window="$($el).modal('hide')">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update-permission-label">
                    Cập nhật quyền hạn
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="save">
                    <div class="form-group">
                        <label for="name" class="form-control-label">Mã:</label>
                        <input type="text" class="form-control" wire:model="permission.name">
                        @error('permission.name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="display_name" class="form-control-label">Tên:</label>
                        <input type="text" class="form-control" wire:model="permission.display_name">
                        @error('permission.display_name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-control-label">Mô tả:</label>
                        <input type="text" class="form-control" wire:model="permission.description">
                        @error('permission.description') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="id_group_permission" class="form-control-label">Nhóm quyền:</label>
                        <select wire:ignore class="form-control" wire:model.prevent="permission.id_group_permission">
                            @if(isset($getGroupName))

                            @if($groupCurrentID == null)
                            <option value="">Chọn nhóm quyền</option>
                            @endif

                            @foreach($getGroupName as $getGroupName)
                            <option
                            @if(isset($groupCurrentID))
                            @if($groupCurrentID == $getGroupName->id and $groupCurrentID != null)
                            {{'selected="selected"'}}
                            @endif

                            @endif
                            @if(!empty($getGroupName->group_name))
                            value="{{$getGroupName->id}}">{{$getGroupName->group_name}}</option>
                            @endif
                            @endforeach
                            @endif

                            {{-- <option value="{{$groupCurrentID}}">{{$groupCurrentID}}</option> --}}
                        </select>
                        {{-- <input type="text" class="form-control"
                        wire:model="permission.ID_group_permission"> --}}
                        @error('permission.id_group_permission') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="save">Lưu</button>
            </div>
        </div>
    </div>
</div>
