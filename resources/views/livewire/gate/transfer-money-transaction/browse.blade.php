<div>
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
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Search Form -->
            <form class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10" method="GET">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-xl-12 order-2 order-xl-1">
                                <div class="row align-items-center">

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Transaction id:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="Tm_transaction_id" type="text" class="form-control"
                                                wire:model.defer="filter.transactionId">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Provider Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="Tm_providerCode" type="text" class="form-control"
                                                wire:model.defer="filter.providerCode">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Bank Code:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="Tm_BankCode" type="text" class="form-control"
                                                wire:model.defer="filter.bankCode">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>provider Ref Id:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="Tm_providerRefId" type="text" class="form-control"
                                                wire:model.defer="filter.providerRefId">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner ref id:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="Tm_partner_ref_id" type="text" class="form-control"
                                                wire:model.defer="filter.partnerRefId">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Partner code:</label>
                                        <input list="partnerCodeListData" id="Tm_partner_code" type="text"
                                        class="form-control"
                                        wire:model.lazy="filter.partnerCode">
                                        <datalist id="partnerCodeListData">
                                            @foreach ($listPartnerCode as $item)
                                            <option value="{{ $item }}"></option>

                                            @endforeach
                                        </datalist>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                        <label>Application id:</label>
                                        <x-widget.selectpicker id="Tm_application_id" class="form-control" data-live-search="true"
                                            wire:model.lazy="filter.applicationId">
                                            <option value="">&nbsp;</option>
                                            @foreach ($listApplicationId as $key => $item)
                                                <option value="{{ $key }}">
                                                    {{ $item }}
                                                </option>
                                            @endforeach
                                        </x-widget.selectpicker>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Customer Phone number:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="Tm_Customer_Phone_Number" type="text" class="form-control"
                                                wire:model.defer="filter.customerPhoneNumber">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Status:</label>
                                        <div class="kt-input-icon ">
                                            <select id="Tm_status" type="text" class="form-control" wire:model.defer="filter.status">
                                                <option value="">All</option>
                                                <option value="pending">pending</option>
                                                <option value="success">success</option>
                                                <option value="error">error</option>
                                                <option value="processing">processing</option>
                                                <option value="refund">refund</option>
                                                <option value="cancel">cancel</option>
                                            </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Transfer Status:</label>
                                        <div class="kt-input-icon ">
                                            <select id="Tm_transfer_status" type="text" class="form-control"
                                                wire:model.defer="filter.transferStatus">
                                                <option value="">All</option>
                                                <option value="pending">pending</option>
                                                <option value="success">success</option>
                                                <option value="error">error</option>
                                                <option value="processing">processing</option>
                                            </select>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Amount:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="Tm_amount" type="text" class="form-control" wire:model.defer="filter.amount">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <label>Account Number:</label>
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input id="Tm_Account_number" type="text" class="form-control" wire:model.defer="filter.accountNo">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Kiểu thời gian: </label>
                                            </div>
                                            <select class="form-control" name="Tm_TimeType" id="Tm_TimeType">
                                                <option value="requestTime">Request Time</option>
                                                <option value="responseTime">Response Time</option>
                                            </select>


                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày bắt đầu: </label>
                                            </div>
                                            <input
                                            autocomplete="off"
                                            id="Tm_startTime"
                                            class="form-control"
                                            placeholder="Y-m-d H:i:s"
                                             />

                                        </div>
                                    </div>

                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Ngày kết thúc:</label>
                                            </div>
                                            <input
                                            autocomplete="off"
                                            placeholder="Y-m-d H:i:s" type="text" id="Tm_endTime" class="form-control"/>
                                        </div>
                                    </div>


                                    <div class="col-md-3 kt-margin-b-20-tablet-and-mobile input-search-second">
                                        <div class="form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>&nbsp;</label>
                                            </div>
                                            <button class="btn btn-primary"
                                            wire:click.prevent="$emit('searchScript')"
                                                wire:loading.attr="disabled">Tìm Kiếm</button>


                                                <button id="exportTransaction" class="btn btn-success"
                                                wire:click.prevent="$emit('ExportTransferMoneyTransactionScript')" wire:loading.attr="disabled"
                                                wire:loading.class="kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light">Export</button>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit" style="overflow: scroll;">
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-end pr-5">
                    <h5>Total amount:&nbsp;<span class="text-monospace field-total-amount">{{ $totalAmount }}</span>
                    </h5>
                </div>
            </div>
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
                <table class="table table-striped" id="tableTransactionEX">
                    <thead>
                        <tr>
                            <th>Transaction id</th>
                            <th>Partner Code</th>
                            <th>Provider Code</th>
                            <th>Bank Code</th>
                            <th>Amount</th>
                            <th>Transfer Amount</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th>Transfer Status</th>
                            <th>Time</th>
                            <th class="text-right">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($transactions) --}}
                        @forelse ($transactions ?? [] as $key => $item)
                            <tr>
                                <td>{{ $item->transactionId }}</td>
                                <td>{{ $item->partnerCode }}</td>
                                <td>{{ $item->providerCode }}</td>
                                <td>{{ $item->bankCode}}</td>
                                <td>{{ number_format($item->amount ?? 0, 0, ',', '.') }}</td>
                                <td>{{ number_format($item->transferAmount ?? 0, 0, ',', '.') }}</td>
                                <td>{{ number_format($item->fee ?? 0, 0, ',', '.') }}</td>
                                <td>
                                    <x-custom.status>{{ $item->status }}</x-custom.status>
                                </td>
                                <td>
                                    <x-custom.status>{{ $item->transferStatus }}</x-custom.status>
                                </td>
                                <td>{{ Carbon\Carbon::createFromTimestamp($item->requestTime)->format('Y-m-d H:i:s') }}
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
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li wire:click.prevent="gotoCurrentPage({{$currentPage - 1}})" class="page-item @if($currentPage <= 1) {{'disabled'}} @endif">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    @for($i = $start; $i <= $end; $i++)
                    <li wire:click.prevent="gotoCurrentPage({{$i}})" class="page-item"><a class="page-link" href="#">{{$i}}</a></li>
                    @endfor
                    <li wire:click.prevent="gotoCurrentPage({{$currentPage + 1}})" class="page-item @if($currentPage >= $totalPage) {{'disabled'}} @endif">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>

                {{-- {{ $meta->onEachSide(3)->links() }} --}}
            </div>
        </div>

        <div wire:ignore.self class="modal fade" id="show-transaction-modal" tabindex="-1"
            aria-labelledby="show-transaction-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="show-transaction-modal-label">
                            Chi tiết
                            <span x-data="{transaction: @entangle('transaction')}"
                                x-on:refund-failed.window="swal.fire('Thất bại', 'Có lỗi xảy ra! Xin thử lại sau...', 'error')"
                                x-on:refund-successfully.window.="swal.fire('Thành công', 'Giao dịch đã refund', 'success')">
                                @can('transfer-money-transaction-refund')
                                    <button type="button" class="btn btn-danger" x-cloak
                                        x-show="transaction.status == 'success' && transaction.transferStatus == 'pending'"
                                        wire:click.prevent="$emit('refundScript')">Refund</button>
                                @endcan
                            </span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            {{-- @dump($transaction) --}}
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Transaction id:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['transactionId'] ?? '' }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Partner ref id:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['partnerRefId'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Partner code:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['partnerCode'] ?? '' }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Application Id/Name:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['applicationId'] ?? '' }}/{{ $transaction['applicationName'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Customer Phone number:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['customerPhoneNumber'] ?? '' }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Bank Code:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['bankCode'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Account Number:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['accountNo'] ?? '' }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Account Name:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['accountName'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Account Type:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['accountType'] ?? '' }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Amount:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ number_format($transaction['amount'] ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Transfer Amount:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ number_format($transaction['transferAmount'] ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Fee:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ number_format($transaction['fee'] ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Fee Type:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['fee_type'] ?? '' }}</span>
                                </div>
                            </div>


                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Contract Number:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['contractNumber'] ?? '' }}</span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Status:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <x-custom.status>{{ $transaction['status'] ?? '' }}</x-custom.status>
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Transfer Status:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <x-custom.status>{{ $transaction['transferStatus'] ?? '' }}</x-custom.status>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Error code:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['errorCode'] ?? '' }}</span>
                                </div>
                            </div>

                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Error message:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['errorMessage'] ?? '' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Provider Ref Id:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['providerRefId'] ?? '' }}</span>
                                </div>
                            </div>

                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Provider Code:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['providerCode'] ?? '' }}</span>
                                </div>
                            </div>

                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Message:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>{{ $transaction['message'] ?? '' }}</span>
                                </div>
                            </div>

                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Extra Data:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <textarea disabled="true"
                                        rows="5">{{ $transaction['extraData'] ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Request Time:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <span>
                                        <x-custom.format-timestamp :timestamp="$transaction['requestTime'] ?? 0" />
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Response Time:</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <x-custom.format-timestamp :timestamp="$transaction['responseTime'] ?? 0" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6 row">
                                <div class="col-xl-6 col-md-6">
                                    <label for="" class="col-form-label label-popup">Provider Response Data::</label>
                                </div>
                                <div class="col-xl-6 col-md-6 span-value-popup">
                                    <textarea disabled="true" rows="10"
                                        cols="70">{{ $transaction['providerResponseData'] ?? '' }}</textarea>
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
</div>

@push('scriptsChart')
    <script>
        Livewire.on('refundScript', ()=>{
            var cFirm = confirm("Bạn có chắc chắn muốn refund giao dịch này không?");
            if(cFirm){
                Livewire.emit('refund');
            }

        });
    </script>
@endpush

