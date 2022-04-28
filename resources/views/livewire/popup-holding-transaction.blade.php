<div>
    {{-- In work, do what you enjoy. --}}
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="row">
            <div class="col-md-8 col-lg-9">
                <div class="kt-portlet">
                    <!--begin::Form-->
                    <div class="kt-form">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6 row">
                                    @if(isset($message))
                                        <div class="alert @if($warning == false)
                                        {{'alert-info'}}
                                        @else
                                        {{'alert-warning'}}
                                        @endif"
                                        style="margin: 0 auto">{{$message}}</div>
                                    @endif
                                    <div class="col-xl-6 col-md-6">
                                        <label for="providerName" class="col-form-label label-popup">Transaction Id:</label>
                                    </div>
                                    <div class="col-xl-6 col-md-6 span-value-popup">
                                        <span id="transaction_id">{{$detail['transaction_id']}}</span>
                                        <input id="transactionIDModel" type="hidden" value="{{$detail['transaction_id']}}">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-lg-12 row">
                                    <div class="col-xl-3 col-md-3">
                                        <label for="providerName" class="col-form-label label-popup">Lý do holding:</label>
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
                            <a wire:click.prevent = "$emit('holdingScript')" class="btn btn-primary text-light" >Hold</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
</div>

@push('scriptsChart')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('resultGateHoldingScript', (msg)=>{

            Swal.fire({
              icon: 'error',
              title: 'Quyền hạn',
              text: msg.message
            })

        });
    </script>
@endpush



