<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Cập nhập bank vendor </h3>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <form id="kt_edit_form">
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <div class="kt-portlet">
                            <!--begin::Form-->
                            <div class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="providerName" class="col-12 col-lg-12 col-xl-3 col-form-label">Vendor code <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9">
                                            {{csrf_field()}}
                                            <input wire:ignore type="hidden" id="_id" name="_id" value="{{$detail['id']}}">
                                            <input wire:ignore class="form-control" type="text" id="vendor_code" name="vendor_code" value="{{$detail['vendor_code']}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Vendor name <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-8">
                                            <input wire:ignore class="form-control" type="text" id="vendor_name" name="vendor_name" value="{{$detail['vendor_name']}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Public <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-8">
                                            <select wire:ignore class="form-control" type="text" id="public" name="public">
                                                <option value="yes" @if($detail['public'] === 'yes') selected @endif>yes</option>
                                                <option value="no"  @if($detail['public'] === 'no') selected @endif>no</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- @dump($detail) --}}

                                    <div class="form-group row">
                                        <label for="providerCode" class="col-12 col-lg-12 col-xl-3 col-form-label">Payment Method <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span></label>
                                        <div class="col-12 col-lg-12 col-xl-9 d-flex">
                                            <select wire:ignore class="form-control" type="text" value="" id="payment_method" name="payment_method">
                                                <option value="">Choose payment method</option>
                                                <option value="ATM">ATM</option>
                                                <option value="CC">CC</option>
                                                <option value="EWALLET">EWALLET</option>
                                                <option value="VA">VA</option>
                                                <option value="MM">Mobile Money</option>
                                            </select>
                                            <a wire:click.prevent="$emit('addMorePaymentmethodScript')" href="#" class="badge badge-primary pt-3">Add</a>
                                        </div>
                                    </div>
                                    @if(isset($paymentMethodArr) and !empty($paymentMethodArr))
                                    <div class="form-group row">
                                        <ul>
                                            @foreach($paymentMethodArr as $pay)
                                            @if($pay != '')
                                            <li>{{$pay}} <span><a wire:click.prevent="$emit('deletePaymentmethodScript', '{{$pay}}')" href="#" style="font-weight: bold; color: red; margin-left: 20px;">x</a></span></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif



                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="kt-portlet">
                            <div class="kt-portlet__foot kt-align-right p-2">
                                <div>
                                    {{-- <button type="button" class="btn btn-primary" id="btn_edit"><i class="la la-save"></i> Lưu dữ liệu</button> --}}
                                    <a wire:click.prevent="$emit('editScript')" class="btn btn-primary text-light" id="btn_edit_method"><i class="la la-save"></i> Lưu dữ liệu</a>

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

@push('scriptsChart')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        Livewire.on('messageScript', ()=>{
            Swal.fire({
              icon: 'success',
              title: 'Sửa cấu hình vendor payment method thành công!',
            })
        });


        Livewire.on('addMorePaymentmethodScript', ()=>{
            var payment_method = document.getElementById('payment_method').value;
            Livewire.emit('addMorePaymentmethod', payment_method);
        });


        Livewire.on('deletePaymentmethodScript', pay=>{
            Livewire.emit('deletePaymentmethod', pay);
        });

        Livewire.on('editScript', ()=>{
            var id = document.getElementById('_id').value;

            var vendor_code = document.getElementById('vendor_code').value;
            var vendor_name = document.getElementById('vendor_name').value;
            var public = document.getElementById('public').value;
            var payment_method = document.getElementById('payment_method').value;
            Livewire.emit('edit', id, vendor_code, vendor_name, public, payment_method);
        });

    </script>
@endpush
