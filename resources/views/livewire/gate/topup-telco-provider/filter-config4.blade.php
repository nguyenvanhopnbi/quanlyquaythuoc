<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!--begin: Search Form -->
            <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Telco:</label>
                                        <div class="kt-input-icon kt-input-icon--left">

                                            <input list="telcoSearchConfig4" type="text" class="form-control" name="telcoconfig4" id="telcoSearchconfig4" >

                                            <datalist id="telcoSearchConfig4">
                                                <option  value="viettel">
                                                <option value="mobifone">
                                                <option value="vinaphone">
                                                <option value="vnmobile">
                                                <option value="beeline">
                                                <option value="viettel_data">
                                                <option value="mobifone_data">
                                                <option value="vinaphone_data">
                                                <option value="vnmobile_data">
                                                <option value="beeline_data">

                                            </datalist>

                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Provider code:</label>
                                        {{-- @dd($providerCodeALLConfig4->providerCode) --}}
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input list="providerCodeSearchConfig4" type="text" class="form-control" name="provider_code_searchconfig4" id="provider_code_searchconfig4">
                                            @if(isset($providerCodeALLConfig4) or !empty($providerCodeALLConfig4))
                                            <datalist id="providerCodeSearchConfig4">
                                                @foreach($providerCodeALLConfig4 as $pvdSearchC4)
                                                <option value="{{$pvdSearchC4->providerCode}}"></option>
                                                @endforeach
                                            </datalist>
                                            @endif
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input list="partnerCodeSearchConfig4" type="text" class="form-control" name="partnercode_code_searchconfig4" id="partnercode_code_searchconfig4">
                                            <datalist id="partnerCodeSearchConfig4">
                                                @foreach($partnerCodeList4 as $partnerCodeConfig4)
                                                <option value="{{$partnerCodeConfig4->partner_code}}">
                                                @endforeach
                                            </datalist>
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <a wire:click.prevent="$emit('searchConfig4Script')" class="btn btn-primary" style="color:#FFF">Search</a>
                                            <a type="button" data-toggle="modal" data-target="#addModalConfig4" style="color: #FFF; width: 80px;" class="btn btn-primary"> Add new </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
</div>
