<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Đối soát thu hộ với provider
                </h3>
            </div>

            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">

                    </div>
                </div>
            </div>

        </div>
        <div class="kt-portlet__body">

            <div class="row">
                <div class="col">
                    <input placeholder="Nhập ngày đối soát" type="text" id="TimeSearch" class="form-control">
                </div>
                <div class="col">
                    <select class="form-control mt-1" id="providerCode">
                        <option value="WOORIBANK">WOORIBANK</option>
                        <option value="VIETCAPITALBANK">VIETCAPITALBANK</option>
                    </select>
                </div>
                <div class="col">
                    <a wire:click.prevent="$emit('ExportDoiSoatThuHoVoiPartnerScript')" href="/partner-partners/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Export </a>

                </div>
                <div class="col">

                </div>
                <div class="col">

                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if(isset($message))
                    <span class="alert alert-danger">{{$message}}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">
            <table style="display: none;" class="table table-light">
                <thead>
                    <tr>
                        <th>Trans Ref ID</th>
                        <th>Status</th>
                        <th>MsgNo</th>
                        <th>Account Number</th>
                        <th>Account Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($listThuHoVoiPartner222))
                    @foreach($listThuHoVoiPartner as $list)
                    <tr>
                        <td>{{$list->transaction_ref_id}}</td>
                        <td>{{$list->status}}</td>
                        <td>{{$list->msgNo}}</td>
                        <td>{{$list->account_number}}</td>
                        <td>{{$list->account_name}}</td>
                        <td>{{$list->amount}}</td>
                        <td>{{date('d-m-Y', strtotime($list->date))}}</td>
                        <td>{{date('H:i:s', strtotime($list->time))}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>
