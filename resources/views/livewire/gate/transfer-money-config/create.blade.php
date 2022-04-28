<div>
    <a href="#" class="btn btn-brand btn-icon-sm" type="button" data-toggle="modal"
        data-target="#create-transfer-money-config-modal">
        <i class="flaticon2-plus"></i> Thêm config
    </a>
    <div wire:ignore.self class="modal fade" id="create-transfer-money-config-modal" tabindex="-1" role="dialog"
        aria-labelledby="create-transfer-money-config-label" aria-hidden="true" x-data
        @saved.window="$($el).modal('hide')">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-transfer-money-config-label">
                        Config mới
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label for="partnerCode" class="form-control-label">Partner:</label>
                            <x-widget.choices wire:model="partnerCode">
                                @foreach ($listPartnerCode as $item)
                                <option value="{{ $item }}">
                                    {{ $item }}
                                </option>
                                @endforeach
                            </x-widget.choices>
                            @error('partnerCode')
                            <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="transactionFee" class="form-control-label">Transaction (VNĐ):</label>
                            <x-widget.currency-live type="text" class="form-control"
                                wire:model.defer="transactionFee" />
                            @error('transactionFee')
                            <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="transactionFeePercent" class="form-control-label">Transaction Fee Ratio (%):</label>
                            <input type="number" class="form-control" min="0" wire:model.defer="transactionFeePercent">
                            @error('transactionFeePercent')
                            <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="checkAccountFee" class="form-control-label">Check Account Fee (VNĐ):</label>
                            <x-widget.currency-live type="text" class="form-control"
                                wire:model.defer="checkAccountFee" />
                            @error('checkAccountFee')
                            <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="save">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>