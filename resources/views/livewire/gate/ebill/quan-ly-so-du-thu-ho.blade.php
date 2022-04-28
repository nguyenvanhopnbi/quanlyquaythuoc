<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Quản lý số dư
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                       {{--  <a href="/partner-partners/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm Provider</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-light" style="width: 600px;">
                <thead>
                    <tr>
                        <th colspan="2">Danh sách số dư</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($listDanhSach))
                    @foreach($listDanhSach as $name => $value)
                    <tr>
                        <td>{{$name}}</td>
                        <td>{{number_format($value, '0', '', '.')}} VNĐ</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>
