<div>
    {{-- In work, do what you enjoy. --}}
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

                                            <input list="telcoSearchConfig2" type="text" class="form-control" name="telcoconfig2" id="telcoSearchconfig2" >

                                            <datalist id="telcoSearchConfig2">
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
                                            <input list="providerCodeSearchConfig2" type="text" class="form-control" name="provider_code_searchconfig2" id="provider_code_searchconfig2">
                                            @if(isset($providerCodeALLConfig2) or !empty($providerCodeALLConfig2))
                                            <datalist id="providerCodeSearchConfig2">
                                                @foreach($providerCodeALLConfig2 as $pvdSearchC2)
                                                <option value="{{$pvdSearchC2->providerCode}}"></option>
                                                @endforeach
                                            </datalist>
                                            @endif

                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input list="partnerCodeSearchConfig2" type="text" class="form-control" name="partnercode_code_searchconfig2" id="partnercode_code_searchconfig2">
                                            @if(isset($partnerCodeList2) or !empty($partnerCodeList2))
                                            <datalist id="partnerCodeSearchConfig2">
                                                @foreach($partnerCodeList2 as $partnerCodeConfig2)
                                                <option value="{{$partnerCodeConfig2->partner_code}}">
                                                @endforeach
                                            </datalist>
                                            @endif
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <a wire:click.prevent="$emit('searchConfig2Script')" class="btn btn-primary" style="color:#FFF">Search</a>
                                            <a type="button" data-toggle="modal" data-target="#addModalConfig2" style="color: #FFF;" class="btn btn-primary"> Add new </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
</div>
