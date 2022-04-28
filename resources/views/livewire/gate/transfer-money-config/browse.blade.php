<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Danh sách config
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="dropdown dropdown-inline">
                    @can('transfer-money-config-add')                        
                    <livewire:gate.transfer-money-config.create />
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
        <!--begin: Search Form -->
        <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Partner code:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <x-widget.select2 wire:model="partnerCode">
                                            <option value="">&nbsp;</option>
                                            @foreach ($listPartnerCode as $item)
                                            <option value="{{ $item }}">
                                                {{ $item }}
                                            </option>
                                            @endforeach
                                        </x-widget.select2>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-section__content m-5">
            <div class="kt-pagination kt-pagination--brand">
                <div class="kt-pagination__toolbar">
                    <select class="form-control kt-font-brand" style="width: 60px" wire:model="perPage">
                        <option value="1">1</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
                <div class="kt-margin-b-10-tablet-and-mobile">
                    Showing {{ $meta->firstItem() }} - {{ $meta->lastItem() }} of {{ $meta->total() }}
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Partner Code</th>
                        <th>Transaction Fee (VND)</th>
                        <th>Transaction Fee Ratio (%)</th>
                        <th>Check Account Fee (VND)</th>
                        <th class="text-right">#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($configs as $config)
                    <tr>
                        <td>{{ $config->partnerCode }}</td>
                        <td>{{ number_format($config->transactionFee ?? 0) }}</td>
                        <td>{{ $config->transactionFeePercent }}</td>
                        <td>{{ number_format($config->checkAccountFee) }}</td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                    data-toggle="dropdown">
                                    <i class="flaticon-more-1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        @can('transfer-money-config-edit', $config)
                                        <li class="kt-nav__item">
                                            <a href="#" role="button" class="kt-nav__link" data-toggle="modal"
                                                data-target="#update-transfer-money-modal"
                                                wire:click="$emit('edit', {{ $config->id }})">
                                                <i class="kt-nav__link-icon flaticon2-contract"></i>
                                                <span class="kt-nav__link-text">Edit</span>
                                            </a>
                                        </li>
                                        @endcan
                                        @can('transfer-money-config-delete', $config)
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link" x-data x-on:click.prevent="
                                                swal.fire({
                                                    title: 'Xác nhận',
                                                    text: 'Bạn chắc chắn muốn xóa config này chứ?',
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Xóa!',
                                                    cancelButtonText: 'Hủy'
                                                }).then(function(result) {
                                                    if (result.value) {
                                                        $wire.delete({{ $config->id }})
                                                    }
                                                    swal.close();
                                                });
                                            ">
                                                <i class="kt-nav__link-icon flaticon2-trash"></i>
                                                <span class="kt-nav__link-text">Delete</span>
                                            </a>
                                        </li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @empty
                    <td colspan="5" class="text-center">Không tìm thấy kết quả</td>
                    @endforelse
                </tbody>
            </table>

            {{ $meta->onEachSide(1)->links() }}
        </div>
    </div>

    <livewire:gate.transfer-money-config.edit />
</div>