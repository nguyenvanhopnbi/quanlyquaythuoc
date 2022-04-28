@extends('index')
@section('page-header', 'Shopcard Item Report')
@section('page-sub-header', 'Shopcard Item Report')
@section('style')
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.4/dayjs.min.js" defer></script>
@endsection
@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">

            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">

        <!--begin: Search Form -->
        <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="POST"
            action="{{ route('shopcard.report.store') }}" x-data="{selector: null}" x-init="
                    selector = flatpickr($refs.input, {dateFormat: 'd-m-Y', inline: 'true', mode: 'range', maxDate: 'today'})
                    selector.setDate(dayjs().subtract(1, 'month').startOf('month').format('DD-MM-YYYY') + ' to ' + dayjs().subtract(1, 'month').endOf('month').format('DD-MM-YYYY'))
                " x-on:submit.prevent="
                    axios.post('{{ route('shopcard.report.store') }}', {
                        _token: '{{ csrf_token() }}',
                        range: $refs.input.value
                    })
                        .then(response => {
                            location.href = response.data.path;
                            swal.fire('Thành công', 'Đã tạo báo cáo', 'success')
                        })
                        .catch(() => swal.fire('Thất bại', 'Xin thử lại sau', 'error'))

                ">
            @csrf
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-6">
                    <input type="text" class="form-control" x-ref="input" name="range" />
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-outline-secondary mt-2"
                                x-on:click.prevent="selector.setDate(dayjs().subtract(1, 'day').format('DD-MM-YYYY'))">
                                Hôm qua
                            </button>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-outline-secondary mt-2"
                                x-on:click.prevent="selector.setDate(dayjs().subtract(1, 'week').startOf('week').format('DD-MM-YYYY') + ' to ' + dayjs().subtract(1, 'week').endOf('week').format('DD-MM-YYYY'))">
                                Tuần trước
                            </button>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-outline-secondary mt-2"
                                x-on:click.prevent="selector.setDate(dayjs().subtract(1, 'month').startOf('month').format('DD-MM-YYYY') + ' to ' + dayjs().subtract(1, 'month').endOf('month').format('DD-MM-YYYY'))">
                                Tháng trước
                            </button>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-outline-secondary mt-2"
                                x-on:click.prevent="selector.setDate(dayjs().subtract(1, 'year').startOf('year').format('DD-MM-YYYY') + ' to ' + dayjs().subtract(1, 'year').endOf('year').format('DD-MM-YYYY'))">
                                Năm trước
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    @endsection

    @section('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @endsection