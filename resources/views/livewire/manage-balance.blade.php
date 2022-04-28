<div>
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
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-light w-50">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">Danh sách số dư</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($listBalance))
                    @foreach($listBalance as $name=>$value)
                    <tr>
                        <td>{{$name}}</td>
                        <td>
                            {{str_replace(",", ".", number_format($value))}}
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>
