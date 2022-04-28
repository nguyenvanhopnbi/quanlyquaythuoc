
{{-- @dump($detail) --}}
@extends('index')
@section('page-header', 'Banks transaction')
@section('page-sub-header', 'Danh sách giao dịch bank')
@section('style')

@endsection
@section('content')

@livewire('gate.bank-transaction.bank-transaction-popup-refund', ['detail' => $detail])



<!-- <div class="modal fade" id="popup_refund_{{$detail['transaction_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Refund giao dịch {{$detail['transaction_id']}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Transaction Id:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{$detail['transaction_id']}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 row">
                        <div class="col-xl-6 col-md-6">
                            <label for="providerName" class="col-form-label label-popup">Amount:</label>
                        </div>
                        <div class="col-xl-6 col-md-6 span-value-popup">
                            <span>{{number_format($detail['max_amount'], 0 , ',', '.')}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 row">
                        <div class="col-xl-3 col-md-3">
                            <label for="providerName" class="col-form-label label-popup">Số tiền Refund:</label>
                        </div>
                        <div class="col-xl-9 col-md-9">
                            <select class="span-value-popup form-control" id="refund_amount" name="refund_amount"></select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 row">
                        <div class="col-xl-3 col-md-3">
                            <label for="providerName" class="col-form-label label-popup">Lý do refund:</label>
                        </div>
                        <div class="col-xl-9 col-md-9">
                            <textarea class="span-value-popup form-control" id="refund_reason" name="refund_reason"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-action-refund">Refund</button>
                <button type="button" class="btn btn-outline-brand" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->
@endsection
@section('script')
<script src="admin/js/pages/gate/bank-transaction/refund.js" type="text/javascript" defer></script>
@endsection

@section('scriptlivewire')
    <script src="{{asset('js/refund.js')}}"></script>
    <script>


    </script>
@endsection


