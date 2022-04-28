<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Danh sách giao dịch
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="dropdown dropdown-inline">
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
                                    <label>Transaction id:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="tmc_transaction_id" type="text" class="form-control"
                                            wire:model.defer="filter.transactionId">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Partner ref id:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="tmc_partner_ref_id" type="text" class="form-control"
                                            wire:model.defer="filter.partnerRefId">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Account no:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="tmc_account_no" type="text" class="form-control"
                                            wire:model.defer="filter.accountNo">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                    <label>Partner code:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <x-widget.select2 id="tmc_partner_code" class="form-control"
                                            wire:model.defer="filter.partnerCode">
                                            <option value="">&nbsp;</option>
                                            @foreach ($listPartnerCode as $item)
                                            <option value="{{ $item }}">
                                                {{ $item }}
                                            </option>
                                            @endforeach
                                        </x-widget.select2>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Status:</label>
                                    <div class="kt-input-icon ">
                                        <select id="tmc_status" type="text" class="form-control"
                                            wire:model.defer="filter.status">
                                            <option value="">All</option>
                                            <option value="success">success</option>
                                            <option value="pending">pending</option>
                                            <option value="error">error</option>
                                            <option value="refund">refund</option>
                                        </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Check Status:</label>
                                    <div class="kt-input-icon ">
                                        <select id="tmc_checkstatus" type="text" class="form-control"
                                            wire:model.defer="filter.checkAccountStatus">
                                            <option value="">All</option>
                                            <option value="success">success</option>
                                            <option value="pending">pending</option>
                                            <option value="error">error</option>
                                        </select>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <label>Bank code:</label>
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input id="tmc_bank_code" type="text" class="form-control"
                                            wire:model.defer="filter.bankCode">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày bắt đầu:</label>
                                        </div>

                                        <x-widget.flatpickr id="tmc_startTime" class="form-control"
                                            wire:model.defer="filter.startTime" readonly
                                            placeholder="Chọn thời gian bắt đầu" />
                                    </div>
                                </div>

                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Ngày kết thúc:</label>
                                        </div>
                                        <x-widget.flatpickr id="tmc_endTime" class="form-control"
                                            wire:model.defer="filter.endTime" readonly
                                            placeholder="Chọn thời gian kết thúc" />
                                    </div>
                                </div>
                                <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                    <div class="form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>&nbsp;</label>
                                        </div>
                                        <button class="btn btn-primary" wire:click.prevent="filter">Tìm Kiếm</button>
                                        @can('transfer-money-check-account-transaction-export')
                                        {{-- <button class="btn btn-success" wire:click.prevent="export"
                                            wire:loading.attr="disabled">Export</button> --}}

                                            <button
                                            class="btn btn-success"
                                            wire:click.prevent="$emit('ExportTransferMoneyCheckAccountTransactionScript')"
                                            wire:loading.attr="disabled">Export</button>
                                        @endcan
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
                        <th>Transaction ID</th>
                        <th>Partner Code</th>
                        <th>Bank Code</th>
                        <th>Fee</th>
                        <th>Status</th>
                        <th>Check Status</th>
                        <th>Time</th>
                        <th class="text-right">#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions ?? [] as $key => $item)
                    <tr>
                        <td>{{ $item->transactionId }}</td>
                        <td>{{ $item->partnerCode }}</td>
                        <td>{{ $item->bankCode }}</td>
                        <td>{{ number_format($item->fee ?? 0, 0, ',', '.') }}</td>
                        <td><x-custom.status>{{ $item->status }}</x-custom.status></td>
                        <td><x-custom.status>{{ $item->checkAccountStatus }}</x-custom.status></td>
                        <td>{{ Carbon\Carbon::createFromTimestamp($item->requestTime)->format('d-m-Y H:i:s') }}
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                    data-toggle="dropdown">
                                    <i class="flaticon-more-1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__item">
                                            <a class="kt-nav__link" data-toggle="modal"
                                                data-target="#show-transaction-modal"
                                                wire:click.prevent="show({{ $key }})">
                                                <i class="kt-nav__link-icon flaticon2-contract"></i>
                                                <span class="kt-nav__link-text">Detail</span>
                                            </a>
                                        </li>
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

    <div wire:ignore.self class="modal fade" id="show-transaction-modal" tabindex="-1"
        aria-labelledby="show-transaction-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="show-transaction-modal-label">Chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <b>Transaction Id: </b>
                                <span>{{ $transaction['transactionId'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Partner Ref Id: </b>
                                <span>{{ $transaction['partnerRefId'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Partner Code: </b>
                                <span>{{ $transaction['partnerCode'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Application Id: </b>
                                <span>{{ $transaction['applicationId'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Application Name: </b>
                                <span>{{ $transaction['applicationName'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Bank Code: </b>
                                <span>{{ $transaction['bankCode'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Account No: </b>
                                <span>{{ $transaction['accountNo'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Account Name: </b>
                                <span>{{ $transaction['accountName'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Account Type: </b>
                                <span>{{ $transaction['accountType'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Fee: </b>
                                <span>{{ $transaction['fee'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Status: </b>
                                <span><x-custom.status>{{ $transaction['status'] ?? '' }}</x-custom.status></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Check Status: </b>
                                <span><x-custom.status>{{ $transaction['checkAccountStatus'] ?? '' }}</x-custom.status></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Error Code: </b>
                                <span>{{ $transaction['errorCode'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Error Message: </b>
                                <span>{{ $transaction['errorMessage'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Provider Code: </b>
                                <span>{{ $transaction['providerCode'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Provider Response Data: </b>
                                <span class="text-break">{{ $transaction['providerResponseData'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Request Time: </b>
                                <span>{{ $transaction['requestTime'] ?? '' }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b>Response Time: </b>
                                <span>{{ $transaction['responseTime'] ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-transparent" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
