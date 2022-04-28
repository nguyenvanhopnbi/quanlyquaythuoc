<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Partner VA reconciliation schedule
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
                        <input list="partnerCodeListEdit" type="text" class="form-control" id="partner_code_edit">
                        <datalist id="partnerCodeListEdit">
                            @if(isset($listPartnerCode->data))
                            @foreach($listPartnerCode->data as $list1)
                            @if($list1->partner_code != null)
                            <option value="{{$list1->partner_code}}">
                                {{($list1->partner_code == $list1->name)?"":$list1->name}}
                            </option>
                            @endif
                            @endforeach
                            @endif
                        </datalist>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Schedule Code: </label>
                        <select id="schedule_code_edit" class="form-control">
                            {{-- <option value="">Choose schedule code</option> --}}
                            <option value="every_day">Every day</option>
                          {{--   <option value="every_three_day">Every Three day</option>
                            <option value="every_week">Every week</option>
                            <option value="every_month">Every month</option> --}}
                        </select>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('EditEbillCrossCheckScript')" type="button" class="btn btn-primary">Update</button>
                <input wire:ignore type="hidden" id="ID_Update">
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
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
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
                        <input list="partnerCodeListAddnew" type="text" class="form-control" id="partner_code">
                        <datalist id="partnerCodeListAddnew">
                            @if(isset($listPartnerCode->data))
                            @foreach($listPartnerCode->data as $list2)
                            @if($list2->partner_code != null)
                            <option value="{{$list2->partner_code}}">
                                {{($list2->partner_code == $list2->name)?"":$list2->name}}
                            </option>
                            @endif
                            @endforeach
                            @endif
                        </datalist>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="">Schedule Code: </label>
                        <select type="text" class="form-control" id="schedule-add-new">
                            {{-- <option value="">Choose schedule</option> --}}
                            <option value="every_day">Every day</option>
                  {{--           <option value="every_three_day">Every Three day</option>
                            <option value="every_week">Every week</option>
                            <option value="every_month">Every month</option> --}}
                        </select>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click.prevent="$emit('saveNewEbillCrossCheckScript')" type="button" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- end modal them moi --}}
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col">
                    <label for="">Partner Code:</label>
                    <input list="partnerCodeListSearch" type="text" class="form-control" id="searchPartnerCode">
                    <datalist id="partnerCodeListSearch">
                            @if(isset($listPartnerCode->data))
                            @foreach($listPartnerCode->data as $list3)
                            @if($list3->partner_code != null)
                            <option value="{{$list3->partner_code}}">
                                {{($list3->partner_code == $list3->name)?"":$list3->name}}
                            </option>
                            @endif
                            @endforeach
                            @endif
                        </datalist>
                </div>

                <div class="col" style="margin-top: 5px;">
                    <label for="">Schedule Code: </label>
                    <select type="text" class="form-control" id="schedule-search">
                        <option value="">Choose schedule</option>
                        <option value="every_day">Every day</option>
                        <option value="every_three_day">Every Three day</option>
                        <option value="every_week">Every week</option>
                        <option value="every_month">Every month</option>
                    </select>
                </div>

                <div class="col">
                    <label for="">Start Time:</label>
                    <input type="text" class="form-control" id="startTimeSearch" placeholder="Ngày bắt đầu">
                </div>
                <div class="col">
                    <label for="">End Time:</label>
                    <input type="text" class="form-control" id="endTimeSearch" placeholder="Ngày kết thúc" >
                </div>
                <div class="col">
                    <button wire:click.prevent="$emit('searchEbillCrossCheckScript')" style="margin-top: 34px" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Schedule Code</th>
                        <th>Partner Code</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($listData))
                    @foreach($listData->data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->schedule_code_display}}
                            <input type="hidden" id="schedule_code-{{$list->id}}" value="{{$list->schedule_code}}">
                        </td>
                        <td>{{$list->partner_code}}
                            <input type="hidden" id="partner_code-{{$list->id}}" value="{{$list->partner_code}}">
                        </td>
                        <td>{{date('d-m-Y', $list->created_at)}}</td>
                        <td>{{date('d-m-Y', $list->updated_at)}}</td>
                        <td>
                            <a data-placement="top"
                            title="Update Ebill Cross-check" wire:click.prevent="$emit('getDateTableEbillCrossCheckScript', '{{$list->id}}')" data-toggle="modal" data-target="#editTransferPartnerBank">
                                <i class="flaticon2-pen"></i> |
                            </a>
                            <a data-placement="top" title="Delete Ebill Cross-check" wire:click.prevent="$emit('deleteEbillCrossCheckScript', '{{$list->id}}')">
                                <i class="flaticon2-delete"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(isset($listData))
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

@push('scriptsChart')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('searchEbillCrossCheckScript', ()=>{
                var partnerCode = document.getElementById('searchPartnerCode').value;
                var startTime = document.getElementById('startTimeSearch').value;
                var endTime = document.getElementById('endTimeSearch').value;
                var scheduleSearch = document.getElementById('schedule-search').value;

                Livewire.emit('searchEbillCrossCheck', partnerCode, scheduleSearch, startTime, endTime);
            });

            Livewire.on('saveNewEbillCrossCheckScript', ()=>{
                var partnerCode = document.getElementById('partner_code').value;
                var schedule = document.getElementById('schedule-add-new').value;

                if(partnerCode == ''){
                    alert('Bạn cần nhập PartnerCode');
                    document.getElementById('partner_code').focus();
                    return;
                }
                if(schedule == ''){
                    alert('Bạn cần nhập schedule');
                    document.getElementById('schedule-add-new').focus();
                    return;
                }

                Livewire.emit('saveNewEbillCrossCheck', partnerCode, schedule);

                setTimeout(function(){
                    Livewire.emit('resetMessage');
                }, 7000);
            });

            Livewire.on('getDateTableEbillCrossCheckScript', id=>{
                document.getElementById('partner_code_edit').value = document.getElementById('partner_code-' + id).value;

                document.getElementById('schedule_code_edit').value = document.getElementById('schedule_code-' + id).value;

                document.getElementById('ID_Update').value = id;
            });

            Livewire.on('EditEbillCrossCheckScript', ()=>{
                var cheduleCode = document.getElementById('schedule_code_edit').value;
                var partnerCode = document.getElementById('partner_code_edit').value;
                var id = document.getElementById('ID_Update').value;

                if(cheduleCode == ''){
                    alert('Bạn cần chọn schedule code.');
                    document.getElementById('schedule_code_edit').focus();
                    return;
                }

                if(partnerCode == ''){
                    alert('Bạn cần chọn partnerCode.');
                    document.getElementById('partner_code_edit').focus();
                    return;
                }

                Livewire.emit('EditEbillCrossCheck', id, cheduleCode, partnerCode);
            });


            Livewire.on('deleteEbillCrossCheckScript', id=>{
                var cFirm = confirm('Bạn có chắc chắn xóa ID: ' + id +'?');
                if(cFirm){
                    Livewire.emit('deleteEbillCrossCheck', id);
                }
            });

        })

    </script>
@endpush
