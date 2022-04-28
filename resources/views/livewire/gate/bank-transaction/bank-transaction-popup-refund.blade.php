<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Refund bank transaction </h3>
        </div>
    </div>
</div>

<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <form id="kt_add_form">
        @if(isset($message) and !$warning)
        <div class="row">
            <div class="col">
                <span class="alert alert-primary">{{$message}}</span>
            </div>
        </div>
        @elseif(isset($message) and $warning)
        <div class="row">
            <div class="col">
                <span class="alert alert-danger">{{$message}}</span>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-8 col-lg-9">
                <div class="kt-portlet">
                    <!--begin::Form-->
                    <div class="kt-form">
                        <div class="kt-portlet__body">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <div class="col-lg-6 row">
                                    <div class="col-xl-6 col-md-6">
                                        <label for="providerName" class="col-form-label label-popup">Transaction Id:</label>
                                    </div>
                                    <div class="col-xl-6 col-md-6 span-value-popup">
                                        <span id="transaction_id">{{$detail['transaction_id']}}</span>
                                        <input type="hidden" id="transaction_id_value" value="{{$detail['transaction_id']}}">
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
                                        <input type="hidden" id="max_amount"
                                        value="{{$detail['max_amount']}}">
                                    </div>
                                </div>
                            </div>
                            <div wire:ignore class="form-group row">
                                <div wire:ignore class="col-lg-12 row">
                                    <div wire:ignore class="col-xl-3 col-md-3">
                                        <label for="providerName" class="col-form-label label-popup">Số tiền refund:</label>
                                    </div>
                                    <div wire:ignore class="col-xl-9 col-md-9">
                                        <select class=" form-control" id="amount" name="amount"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 row">
                                    <div class="col-xl-3 col-md-3">
                                        <label for="providerName" class="col-form-label label-popup">Lý do refund:</label>
                                    </div>
                                    <div class="col-xl-9 col-md-9">
                                        <textarea class=" form-control" id="reason" name="reason"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="kt-portlet">
                    <div class="kt-portlet__foot p-2">
                        <div>

                       {{--      <button type="button" class="btn btn-primary" id="btn_refund">Refund</button> --}}

                            @if($detail['bank_code'] == 'MOCA')

                            <a
                            wire:click.prevent="$emit('refundMocaScript')"
                            style="color: white;"
                            class="btn btn-primary">Refund</a>

                            @else
                            <button type="button" class="btn btn-primary" id="btn_refund">Refund</button>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- end:: Content -->
</div>
</div>
