<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gate\GeneralDashboard\dashboard;
use App\Http\Livewire\Gate\Ebill\EbillVAReconciliationData;
use App\Http\Livewire\Gate\Ebill\BienBanDoiSoat;
use App\Http\Livewire\DoubleCheck\Doublecheck;

Route::any('adminer', '\Aranyasen\LaravelAdminer\AdminerAutologinController@index');
Route::middleware('guest')->namespace('Auth')->group(function () {
    Route::get('login', 'LoginController@redirectToProvider')->name('login');
    Route::get('callback', 'LoginController@handleCallback')->name('handleCallback');
});

Route::middleware(['auth'])->group(function () {

    // Route::get('paginate', 'WelcomeController@testPagination');

    // Route::get('permission', 'WelcomeController@permission');

    // Route::get('email', 'WelcomeController@sendEmail');

    Route::get('/', 'WelcomeController@index')->name('home');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('new-otp', 'Auth\ConfirmOtpController@sendNewOtpToUser')
        ->name('new-otp');
    Route::namespace('Bill')->group(function () {
        // Manage Bill Provider
        Route::get('/bill-providers', 'BillProvidersController@index')
            ->name('bill.provider.list')
            ->middleware('can:bill-provider-browse');
        Route::get('/bill-providers/add', 'BillProvidersController@add')
            ->name('bill.provider.add')
            ->middleware('can:bill-provider-add');
        Route::post('/bill-providers/add', 'BillProvidersController@addAction')
            ->name('bill.provider.addAction')
            ->middleware('can:bill-provider-add');
        Route::get('/bill-providers/detail/{id}', ['uses' => 'BillProvidersController@detail'])
            ->name('bill.provider.detail')
            ->middleware('can:bill-provider-read');
        Route::get('/bill-providers/edit/{id}', ['uses' => 'BillProvidersController@edit'])
            ->name('bill.provider.edit')
            ->middleware('can:bill-provider-edit');
        Route::post('/bill-providers/edit/{id}', ['uses' => 'BillProvidersController@editAction'])
            ->name('bill.provider.editAction')
            ->middleware('can:bill-provider-edit');
        Route::get('/bill-providers/delete/{id}', ['uses' => 'BillProvidersController@delete'])
            ->name('bill.provider.delete')
            ->middleware('can:bill-provider-delete');
        Route::get('/bill-providers/ajax/get-list', 'BillProvidersController@ajaxGetList')
            ->name('bill.provider.ajax.getList')
            ->middleware('can:bill-provider-browse');

        // Manage Bill Service
        Route::get('/bill-services', 'BillServicesController@index')
            ->name('bill.service.list')
            ->middleware('can:bill-service-browse');
        Route::get('/bill-services/ajax/get-list', 'BillServicesController@ajaxGetList')
            ->name('bill.service.ajax.getList')
            ->middleware('can:bill-service-browse');
        Route::get('/bill-services/add', 'BillServicesController@add')
            ->name('bill.service.add')
            ->middleware('can:bill-service-add');
        Route::post('/bill-services/addAction', 'BillServicesController@addAction')
            ->name('bill.service.addAction')
            ->middleware('can:bill-service-add');
        Route::get('/bill-services/edit/{id}', ['uses' => 'BillServicesController@edit'])
            ->name('bill.service.edit')
            ->middleware('can:bill-service-edit');
        Route::post('/bill-services/editAction/{id}', ['uses' => 'BillServicesController@editAction'])
            ->name('bill.service.editAction')
            ->middleware('can:bill-service-edit');
        Route::get('/bill-services/delete/{id}', ['uses' => 'BillServicesController@delete'])
            ->name('bill.service.delete')
            ->middleware('can:bill-service-delete');
        Route::get('/bill-services/ajax/get-list-source', 'BillServicesController@ajaxGetListSource')
            ->name('bill.service.ajax.getListSource')
            ->middleware('can:bill-service-browse');

        // // Manage Bill Provider Config
        // Route::get('/bill-provider-config', 'BillProvidersConfigController@index')->name('bill.providerConfig.list');
        // Route::get('/bill-provider-config/add', 'BillProvidersConfigController@add')->name('bill.providerConfig.add');
        // Route::post('/bill-provider-config/addAction', 'BillProvidersConfigController@addAction')->name('bill.providerConfig.addAction');
        // Route::get('/bill-provider-config/detail/{id}', ['uses' => 'BillProvidersConfigController@detail'])->name('bill.providerConfig.detail');
        // Route::get('/bill-provider-config/edit/{id}', ['uses' => 'BillProvidersConfigController@edit'])->name('bill.providerConfig.edit');
        // Route::post('/bill-provider-config/editAction/{id}', ['uses' => 'BillProvidersConfigController@editAction'])->name('bill.providerConfig.editAction');
        // Route::get('/bill-provider-config/delete/{id}', ['uses' => 'BillProvidersConfigController@delete'])->name('bill.providerConfig.delete');
        // Route::get('/bill-provider-config/ajax/get-list', 'BillProvidersConfigController@ajaxGetList')->name('bill.providerConfig.ajax.getList');

        // Dashboard Bill Service Category
        Route::get('/bill-service-dashboard', 'BillServicesCategoryController@dashboard')
            ->name('bill.serviceCategory.dashboard')
            ->middleware('can:bill-service-category-browse');


        // Manage Bill Service Category
        Route::get('/bill-service-category', 'BillServicesCategoryController@index')
            ->name('bill.serviceCategory.list')
            ->middleware('can:bill-service-category-browse');

        Route::get('/bill-service-category/add', 'BillServicesCategoryController@add')
            ->name('bill.serviceCategory.add')
            ->middleware('can:bill-service-category-add');
        Route::post('/bill-service-category/addAction', 'BillServicesCategoryController@addAction')
            ->name('bill.serviceCategory.addAction')
            ->middleware('can:bill-service-category-add');
        Route::get('/bill-service-category/detail/{id}', ['uses' => 'BillServicesCategoryController@detail'])
            ->name('bill.serviceCategory.detail')
            ->middleware('can:bill-service-category-read');
        Route::get('/bill-service-category/edit/{id}', ['uses' => 'BillServicesCategoryController@edit'])
            ->name('bill.serviceCategory.edit')
            ->middleware('can:bill-service-category-edit');
        Route::post('/bill-service-category/editAction/{id}', ['uses' => 'BillServicesCategoryController@editAction'])
            ->name('bill.serviceCategory.editAction')
            ->middleware('can:bill-service-category-edit');
        Route::get('/bill-service-category/delete/{id}', ['uses' => 'BillServicesCategoryController@delete'])
            ->name('bill.serviceCategory.delete')
            ->middleware('can:bill-service-category-delete');
        Route::get('/bill-service-category/ajax/get-list', 'BillServicesCategoryController@ajaxGetList')
            ->name('bill.serviceCategory.ajax.getList')
            ->middleware('can:bill-service-category-browse');
        Route::get('/bill-service-category/ajax/get-list-source', 'BillServicesCategoryController@ajaxGetListSource')
            ->name('bill.serviceCategory.ajax.getListSource')
            ->middleware('can:bill-service-category-browse');

        //Bill Transaction
        Route::get('/bill-transaction', 'BillTransactionController@index')
            ->name('bill.transaction.list')
            ->middleware('can:bill-transaction-browse');

        Route::get('/bill-transaction-export', 'BillTransactionController@exportcsv')
            ->name('bill.transaction.list.export')
            ->middleware('can:bill-transaction-browse');


        Route::get('/bill-transaction/ajax/get-list', 'BillTransactionController@ajaxGetList')
            ->name('bill.transaction.ajax.getList')
            ->middleware('can:bill-transaction-browse');
        Route::get('/bill-transaction/detail/{id}', ['uses' => 'BillTransactionController@detail'])
            ->name('bill.transaction.detail')
            ->middleware('can:bill-transaction-read');

        //Bill Provider Service Match
        Route::get('/bill-provider-service-match', 'BillProviderServiceMatchController@index')
            ->name('bill.providerServiceMatch.list')
            ->middleware('can:bill-provider-service-match-browse');
        Route::get('/bill-provider-service-match/ajax/get-list', 'BillProviderServiceMatchController@ajaxGetList')
            ->name('bill.providerServiceMatch.ajax.getList')
            ->middleware('can:bill-provider-service-match-browse');
        Route::get('/bill-provider-service-match/add', 'BillProviderServiceMatchController@add')
            ->name('bill.providerServiceMatch.add')
            ->middleware('can:bill-provider-service-match-add');
        Route::post('/bill-provider-service-match/addAction', 'BillProviderServiceMatchController@addAction')
            ->name('bill.providerServiceMatch.addAction')
            ->middleware('can:bill-provider-service-match-add');
        Route::get('/bill-provider-service-match/edit/{id}', ['uses' => 'BillProviderServiceMatchController@edit'])
            ->name('bill.providerServiceMatch.edit')
            ->middleware('can:bill-provider-service-match-edit');
        Route::post('/bill-provider-service-match/editAction/{id}', ['uses' => 'BillProviderServiceMatchController@editAction'])
            ->name('bill.providerServiceMatch.editAction')
            ->middleware('can:bill-provider-service-match-edit');
        Route::get('/bill-provider-service-match/delete/{id}', ['uses' => 'BillProviderServiceMatchController@delete'])
            ->name('bill.providerServiceMatch.delete')
            ->middleware('can:bill-provider-service-match-delete');
    });

    Route::namespace('Gate')->group(function () {
        // Manage gate application
        Route::get('/partner-applications', 'ApplicationController@index')
            ->name('gate.application.list')
            ->middleware('can:partner-application-browse');
        Route::get('/partner-applications/add', 'ApplicationController@add')
            ->name('gate.application.add')
            ->middleware('can:partner-application-add');
        Route::post('/gate-application/add', 'ApplicationController@addAction')
            ->name('gate.application.addAction')
            ->middleware('can:partner-application-add');
        Route::get('/partner-application/detail/{id}', ['uses' => 'ApplicationController@detail'])
            ->name('gate.application.detail')
            ->middleware('can:partner-application-read');
        Route::get('/partner-applications/edit/{id}', ['uses' => 'ApplicationController@edit'])
            ->name('gate.application.edit')
            ->middleware('can:partner-application-edit');
        Route::post('/gate-application/edit/{id}', ['uses' => 'ApplicationController@editAction'])
            ->name('gate.application.editAction')
            ->middleware('can:partner-application-edit');
        Route::get('/gate-application/delete/{id}', ['uses' => 'ApplicationController@delete'])
            ->name('gate.application.delete')
            ->middleware('can:partner-application-delete');
        Route::get('/gate-application/ajax/get-list', 'ApplicationController@ajaxGetList')
            ->name('gate.application.ajax.getList')
            ->middleware('can:partner-application-browse');
        Route::get('/gate-application/ajax/get-list-source', 'ApplicationController@ajaxGetListSource')
            ->name('gate.application.ajax.getListSource')
            ->middleware('can:partner-application-browse');

        // Manage gate application
        Route::get('/partner-application-service-configs', 'ApplicationServiceConfigController@index')
            ->name('gate.application-service-config.list')
            ->middleware('can:partner-application-service-config-browse');
        Route::get('/partner-application-service-configs/add', 'ApplicationServiceConfigController@add')
            ->name('gate.application-service-configs.add')
            ->middleware('can:partner-application-service-config-add');
        Route::post('/gate-application-service-config/add', 'ApplicationServiceConfigController@addAction')
            ->name('gate.application-service-config.addAction')
            ->middleware('can:partner-application-service-config-add');
        Route::get('/partner-application-service-config/detail/{id}', ['uses' => 'ApplicationServiceConfigController@detail'])
            ->name('gate.application-service-config.detail')
            ->middleware('can:partner-application-service-config-read');
        Route::get('/partner-application-service-configs/edit/{id}', ['uses' => 'ApplicationServiceConfigController@edit'])
            ->name('gate.application-service-configs.edit')
            ->middleware('can:partner-application-service-config-edit');
        Route::post('/gate-application-service-config/edit/{id}', ['uses' => 'ApplicationServiceConfigController@editAction'])
            ->name('gate.application.editAction')
            ->middleware('can:partner-application-service-config-edit');
        Route::get('/gate-application-service-config/delete/{id}', ['uses' => 'ApplicationServiceConfigController@delete'])
            ->name('gate.application-service-config.delete')
            ->middleware('can:partner-application-service-config-delete');
        Route::get('/gate-application-service-config/ajax/get-list', 'ApplicationServiceConfigController@ajaxGetList')
            ->name('gate.application-service-config.ajax.getList')
            ->middleware('can:partner-application-service-config-browse');

        // Manage bank
        Route::get('/gate-banks', 'BankController@index')
            ->name('gate.bank.list')
            ->middleware('can:gate-bank-browse');
        Route::get('/gate-bank/add', 'BankController@add')
            ->name('gate.bank.add')
            ->middleware('can:gate-bank-add');
        Route::post('/gate-bank/add', 'BankController@addAction')
            ->name('gate.bank.addAction')
            ->middleware('can:gate-bank-add');
        Route::get('/gate-bank/detail/{id}', ['uses' => 'BankController@detail'])
            ->name('gate.bank.detail')
            ->middleware('can:gate-bank-read');
        Route::get('/gate-bank/edit/{id}', ['uses' => 'BankController@edit'])
            ->name('gate.bank.edit')
            ->middleware('can:gate-bank-edit');
        Route::post('/gate-bank/edit/{id}', ['uses' => 'BankController@editAction'])
            ->name('gate.bank.editAction')
            ->middleware('can:gate-bank-edit');
        Route::get('/gate-bank/delete/{id}', ['uses' => 'BankController@delete'])
            ->name('gate.bank.delete')
            ->middleware('can:gate-bank-delete');
        Route::get('/gate-bank/ajax/get-list', 'BankController@ajaxGetList')
            ->name('gate.bank.ajax.getList')
            ->middleware('can:gate-bank-browse');
        Route::get('/gate-bank/ajax/get-list-source', 'BankController@ajaxGetListSource')
            ->name('gate.bank.ajax.getListSource')
            ->middleware('can:gate-bank-browse');
        // Manage bank transaction

        Route::get('/gate-transactions', 'BankTransactionController@index')
            ->name('gate.transaction.list')
            ->middleware('can:gate-transaction-browse');

        // doi soat Ebill
        Route::get('/ebill-cross-check', 'EbillCrossCheckController@reconciliationSchedule')
            ->name('gate.ebill.transaction.list.cross.check')
            ->middleware('can:gate-ebill-cross-check');

        Route::get('/ebill-partner-va-fee', 'EbillCrossCheckController@partnerVAfee')
            ->name('gate.ebill.partner.va.fee')
            ->middleware('can:ebill-partner-va-fee');

        Route::get('/ebill-partner-va-fee-export-csv', [App\Http\Livewire\Gate\Ebill\EbillVAFeeConfig::class, 'exportCSV'])
            ->name('gate.ebill.partner.va.fee.exportcsv')
            ->middleware('can:ebill-partner-va-fee');

        Route::get('/ebill-partner-schedule-detail', 'EbillCrossCheckController@scheduleDetails')
            ->name('gate.ebill.partner.schedule.details')
            ->middleware('can:ebill-partner-schedule-detail');

        Route::get('/ebill-partner-schedule-detail-export', [App\Http\Livewire\Gate\Ebill\ScheduleDetails::class, 'exportCSV'])
            ->name('gate.ebill.partner.schedule.details.export')
            ->middleware('can:ebill-partner-schedule-detail');




        Route::get('/ebill-partner-va-reconciliation-data', 'EbillCrossCheckController@partnerReconciliationData')
            ->name('gate.ebill.partner.va.reconciliation.data')
            ->middleware('can:gate-ebill-partner-reconciliation-data');


        Route::get('/ebill-partner-va-bienbandoisoat', 'EbillCrossCheckController@bienbandoisoat')
            ->name('gate.ebill.partner.va.bienbandoisoat')
            ->middleware('can:gate-ebill-partner-reconciliation-data');

        // Route::get('/ebill-partner-va-bienbandoisoat-export', [BienBanDoiSoat::class, 'ExportCSV'])
        //     ->name('gate.ebill.partner.va.bienbandoisoat.data.export')
        //     ->middleware('can:gate-ebill-partner-reconciliation-data');


        Route::get('/ebill-partner-va-reconciliation-data-export', [EbillVAReconciliationData::class, 'partnerReconciliationDataExport'])
            ->name('gate.ebill.partner.va.reconciliation.data.export')
            ->middleware('can:gate-ebill-partner-reconciliation-data');


        Route::get('/ebill-partner-va-bank-transaction-reconciliation-data-export', [Doublecheck::class, 'partnerVABankTransactionDataExport'])
            ->name('gate.ebill.partner.va.reconciliation.data.export')
            ->middleware('can:gate-ebill-partner-reconciliation-data');

        Route::get('/ebill-partner-va-bank-transaction-reconciliation-data-exportVA', [Doublecheck::class, 'partnerVABankTransactionDataExportVA'])
            ->name('gate.ebill.partner.va.reconciliation.data.export.va')
            ->middleware('can:gate-ebill-partner-reconciliation-data');


        // Route::get('/ebill-partner-va-reconciliation-data-export', 'EbillVAReconciliationData@partnerReconciliationDataExport')
        //     ->name('gate.ebill.partner.va.reconciliation.data.export')
        //     ->middleware('can:gate-ebill-partner-reconciliation-data');

        // end doi soat Ebill


        // Danh sách giao dịch lệch đối soát
        Route::get('/gate-bank-transactions-cross-check', 'BankTransactionController@CrossCheckTranSaction')
            ->name('gate.transaction.list.cross.check')
            ->middleware('can:gate-bank-transactions-cross-check');

        Route::get('/bank-transaction-cross-check-export', 'BankTransactionController@ExportCrossCheckTranSaction')
            ->name('gate.transaction.export.cross.check')
            ->middleware('can:gate-transaction-browse');



        Route::get('/gate-bank-transactions-hold', 'BankTransactionController@HoldTransaction')
            ->name('gate.transaction.list.hold')
            ->middleware('can:gate-bank-transactions-hold');

        // Route::get('/gate-bank-transactions-unhold', 'BankTransactionController@UnHoldTransaction')
        //     ->name('gate.transaction.list.unhold')
        //     ->middleware('can:gate-transaction-browse');

        Route::get('/gate-bank-transactions-unhold', 'BankTransactionController@UnHoldTransaction')
            ->name('gate.transaction.list.unhold')
            ->middleware('can:gate-bank-transactions-unhold');

        // Route::get('/gate-transactions', 'BankTransactionLivewireController@index')
        //     ->name('gate.transaction.list')
        //     ->middleware('can:gate-transaction-browse');

        Route::get('/exportCSV', 'ExportBankController@exportCSV')->name('bankExportCSV');
        Route::get('/gate-transaction/detail/{id}', ['uses' => 'BankTransactionController@detail'])
            ->name('gate.bank-transaction.detail')
            ->middleware('can:gate-transaction-read');
        Route::get('/gate-bank-transaction/ajax/get-list', 'BankTransactionController@ajaxGetList')
            ->name('gate.bank-transaction.ajax.getList')
            ->middleware('can:gate-transaction-browse');
        Route::post('/gate-bank-transaction/export', 'BankTransactionController@exportTransaction')
            ->name('gate.bank-transaction.ajax.getList')
            ->middleware('can:gate-transaction-export');
        Route::get('/gate-bank-transaction/list-export-columns', 'BankTransactionController@listExportColumns')
            ->name('gate.bank-transaction.ajax.listExportColumns');
        Route::get('/gate-bank-transaction/download', 'BankTransactionController@downloadTransaction')
            ->name('gate.bank-transaction.export.download')
            ->middleware('can:gate-transaction-export');
        Route::post('/gate-bank-transaction/resendIpn', 'BankTransactionController@resendIpn')
            ->name('gate.bank-transaction.ajax.resendIpn')
            ->middleware('can:gate-transaction-read');

        Route::get('/gate-transactions/refund/popup', 'BankTransactionController@getPopupRefund')
            ->name('gate.bank-transaction.ajax.getPopupRefund')
            ->middleware('can:gate-transaction-read');

        Route::get('/gate-transactions/holding/popup', 'BankTransactionController@getPopupHolding')
            ->name('gate.bank-transaction.ajax.getPopupHolding')
            ->middleware('can:gate-transaction-read');

        Route::get('/gate-transactions/unholding/popup', 'BankTransactionController@getPopupunHolding')
            ->name('gate.bank-transaction.ajax.getunPopupHolding')
            ->middleware('can:gate-transaction-read');

        // Route::post('/gate-bank-transaction/refund', 'BankTransactionController@refundTransaction')
        //     ->name('gate.bank-transaction.ajax.refundTransaction')
        //     ->middleware('can:gate-transaction-refund');
        Route::post('/gate-bank-transaction/refund', 'BankTransactionController@refundTransaction')
            ->name('gate.bank-transaction.ajax.refundTransaction')
            ->middleware('can:refund-action-gate-transaction');
        //refund
        Route::get('/gate-transaction-refund', 'BankTransactionController@refundTransactions')
            ->name('gate.transaction.refund.list')
            ->middleware('can:gate-transaction-refund-browse');

        Route::get('/gate-transaction-refund-exportcsv', 'ExportBankTransactionRefund@ExportBankTransactionRefund')
            ->name('gate.transaction.refund.listExportCSV')
            ->middleware('can:gate-transaction-refund-browse');


        Route::get('/gate-bank-refund-transaction/ajax/get-list', 'BankTransactionController@ajaxGetListRefund')
            ->name('gate.bank-refund-transaction.ajax.getList')
            ->middleware('can:gate-transaction-refund-browse');
        Route::get('/gate-bank-refund-transaction/detail/{id}', ['uses' => 'BankTransactionController@detailRefundTransaction'])
            ->name('gate.bank-transaction.detail')
            ->middleware('can:gate-transaction-refund-read');
        Route::post('/gate-bank-refund-transaction/export', 'BankTransactionController@exportRefundTransaction')
            ->name('gate.bank-transaction.ajax.getList')
            ->middleware('can:gate-transaction-refund-export');
        Route::get('/gate-bank-refund-transaction/download', 'BankTransactionController@downloadRefundTransaction')
            ->name('gate.bank-transaction.ajax.getList')
            ->middleware('can:gate-transaction-refund-export');

        // Manage bank vendor
        Route::get('/gate-vendor', 'BankVendorController@index')
            ->name('gate.bank-vendor.list')
            ->middleware('can:gate-vendor-browse');
        Route::get('/gate-vendor/add', 'BankVendorController@add')
            ->name('gate.bank-vendor.add')
            ->middleware('can:gate-vendor-add');
        Route::post('/gate-vendor/add', 'BankVendorController@addAction')
            ->name('gate.bank-vendor.addAction')
            ->middleware('can:gate-vendor-add');
        Route::get('/gate-vendor/detail/{id}', ['uses' => 'BankVendorController@detail'])
            ->name('gate.bank-vendor.detail')
            ->middleware('can:gate-vendor-read');
        Route::get('/gate-vendor/edit/{id}', ['uses' => 'BankVendorController@edit'])
            ->name('gate.bank-vendor.edit')
            ->middleware('can:gate-vendor-edit');
        Route::post('/gate-vendor/edit/{id}', ['uses' => 'BankVendorController@editAction'])
            ->name('gate.bank-vendor.editAction')
            ->middleware('can:gate-vendor-edit');
        Route::get('/gate-vendor/delete/{id}', ['uses' => 'BankVendorController@delete'])
            ->name('gate.bank-vendor.delete')
            ->middleware('can:gate-vendor-delete');
        Route::get('/gate-vendor/ajax/get-list', 'BankVendorController@ajaxGetList')
            ->name('gate.bank-vendor.ajax.getList')
            ->middleware('can:gate-vendor-browse');
        Route::get('/gate-vendor/ajax/get-list-source', 'BankVendorController@ajaxGetListSource')
            ->name('gate.bank-vendor.ajax.getListSource')
            ->middleware('can:gate-vendor-browse');
        // Manage ipn logs
        Route::get('/gate-ipn-logs', 'IpnLogsController@index')
            ->name('gate.ipn-log.list')
            ->middleware('can:gate-ipn-log-browse');
        Route::get('/gate-ipn-logs/detail/{id}', ['uses' => 'IpnLogsController@detail'])
            ->name('gate.ipn-logs.detail')
            ->middleware('can:gate-ipn-log-read');
        Route::get('/gate-ipn-logs/ajax/get-list', 'IpnLogsController@ajaxGetList')
            ->name('gate.ipn-logs.ajax.getList')
            ->middleware('can:gate-ipn-log-browse');

        // partner bank vendor
        Route::get('/gate-partner-bank-vendors', 'PartnerBankVendorController@index')
            ->name('gate.partner-bank-vendor.list')
            ->middleware('can:gate-partner-bank-vendor-browse');

        Route::get('/gate-partner-payment-method-vendor-config', 'PartnerBankVendorController@bankVendorPaymentMethod')
            ->name('gate.partner-bank-vendor.list.payment.method')
            ->middleware('can:gate-partner-payment-method-vendor-config');



        Route::get('/gate-partner-bank-vendor/add', 'PartnerBankVendorController@add')
            ->name('gate.partner-bank-vendor.add')
            ->middleware('can:gate-partner-bank-vendor-add');
        Route::post('/gate-partner-bank-vendor/add', 'PartnerBankVendorController@addAction')
            ->name('gate.partner-bank-vendor.addAction')
            ->middleware('can:gate-partner-bank-vendor-add');
        Route::get('/gate-partner-bank-vendor/detail/{id}', ['uses' => 'PartnerBankVendorController@detail'])
            ->name('gate.partner-bank-vendor.detail')
            ->middleware('can:gate-partner-bank-vendor-browse');

        Route::get('/gate-partner-bank-vendor/edit/{id}', ['uses' => 'PartnerBankVendorController@edit'])
            ->name('gate.partner-bank-vendor.edit')
            ->middleware('can:gate-partner-bank-vendor-edit');

        Route::post('/gate-partner-bank-vendor/edit/{id}', ['uses' => 'PartnerBankVendorController@editAction'])
            ->name('gate.partner-bank-vendor.editAction')
            ->middleware('can:gate-partner-bank-vendor-edit');

        Route::get('/gate-partner-bank-vendor/delete/{id}', ['uses' => 'PartnerBankVendorController@delete'])
            ->name('gate.partner-bank-vendor.delete')
            ->middleware('can:gate-partner-bank-vendor-delete');
        Route::get('/gate-partner-bank-vendor/ajax/get-list', 'PartnerBankVendorController@ajaxGetList')
            ->name('gate.partner-bank-vendor.ajax.getList')
            ->middleware('can:gate-partner-bank-vendor-browse');

        // partner bank vendor
        Route::get('/gate-partner-vendors', 'PartnerVendorController@index')
            ->name('gate.partner-vendor.list')
            ->middleware('can:gate-partner-vendor-browse');

        Route::get('/gate-partner-vendor/add', 'PartnerVendorController@add')
            ->name('gate.partner-vendor.add')
            ->middleware('can:gate-partner-vendor-add');
        Route::post('/gate-partner-vendor/add', 'PartnerVendorController@addAction')
            ->name('gate.partner-vendor.addAction')
            ->middleware('can:gate-partner-vendor-add');
        Route::get('/gate-partner-vendor/detail/{id}', ['uses' => 'PartnerVendorController@detail'])
            ->name('gate.partner-vendor.detail')
            ->middleware('can:gate-partner-vendor-browse');
        Route::get('/gate-partner-vendor/edit/{id}', ['uses' => 'PartnerVendorController@edit'])
            ->name('gate.partner-vendor.edit')
            ->middleware('can:gate-partner-vendor-edit');
        Route::post('/gate-partner-vendor/edit/{id}', ['uses' => 'PartnerVendorController@editAction'])
            ->name('gate.partner-vendor.editAction')
            ->middleware('can:gate-partner-vendor-edit');
        Route::get('/gate-partner-vendor/delete/{id}', ['uses' => 'PartnerVendorController@delete'])
            ->name('gate.partner-vendor.delete')
            ->middleware('can:gate-partner-vendor-delete');
        Route::get('/gate-partner-vendor/ajax/get-list', 'PartnerVendorController@ajaxGetList')
            ->name('gate.partner-vendor.ajax.getList')
            ->middleware('can:gate-partner-vendor-browse');


        // Route::get('/gate-partner-payment-method-vendor-config', 'PartnerBankVendorController@bankVendorPaymentMethod')
        //     ->name('gate.partner-bank-vendor.list.payment.method')
        //     ->middleware('can:gate-partner-bank-vendor-browse');

        Route::get('/gate-partner-payment-method-vendor-config', 'PartnerBankVendorController@bankVendorPaymentMethod')
            ->name('gate.partner-bank-vendor.list.payment.method')
            ->middleware('can:gate-partner-payment-method-vendor-config');

        // partner
        Route::get('/partner-partners', 'PartnerController@index')
            ->name('gate.partner.list')
            ->middleware('can:partner-browse');

        Route::get('/partner-partners-export', 'PartnerController@exportPartner')
            ->name('gate.partner.exportCSV')
            ->middleware('can:partner-browse');

        Route::get('/partner-partners/add', 'PartnerController@add')
            ->name('gate.partner.add')
            ->middleware('can:partner-add');
        Route::post('/partner-partners/add', 'PartnerController@addAction')
            ->name('gate.partner.addAction')
            ->middleware('can:partner-add');
        Route::get('/partner-partners/detail/{id}', ['uses' => 'PartnerController@detail'])
            ->name('gate.partner.detail')
            ->middleware('can:partner-read');
        Route::get('/partner-partners/edit/{id}', ['uses' => 'PartnerController@edit'])
            ->name('gate.partner.edit')
            ->middleware('can:partner-edit');
        Route::post('/partner-partners/edit/{id}', ['uses' => 'PartnerController@editAction'])
            ->name('gate.partner.editAction')
            ->middleware('can:partner-edit');
        Route::get('/partner-partners/delete/{id}', ['uses' => 'PartnerController@delete'])
            ->name('gate.partner.delete')
            ->middleware('can:partner-delete');
        Route::get('/partner-partners/ajax/get-list', 'PartnerController@ajaxGetList')
            ->name('gate.partner.ajax.getList')
            ->middleware('can:partner-browse');
        Route::get('/partner-partners/ajax/get-list-source', 'PartnerController@ajaxGetListSource')
            ->name('gate.partner.ajax.getListSource')
            ->middleware('can:partner-browse');


        //partner gate config
        Route::get('/partner-paygate-config', 'PartnerPaygateConfigController@index')
            ->name('gate.partner.paygate.congfig.list')
            ->middleware('can:partner-paygate-config-browse');
        Route::get('/partner-paygate-config/add', 'PartnerPaygateConfigController@add')
            ->name('gate.partner.paygate.congfig.add')
            ->middleware('can:partner-paygate-config-add');
        Route::post('/partner-paygate-config/add', 'PartnerPaygateConfigController@addAction')
            ->name('gate.partner.paygate.congfig.addAction')
            ->middleware('can:partner-paygate-config-add');
        Route::get('/partner-paygate-config/detail/{id}', ['uses' => 'PartnerPaygateConfigController@detail'])
            ->name('gate.partner.paygate.congfig.detail')
            ->middleware('can:partner-paygate-config-read');
        Route::get('/partner-paygate-config/edit/{id}', ['uses' => 'PartnerPaygateConfigController@edit'])
            ->name('gate.partner.paygate.congfig.edit')
            ->middleware('can:partner-paygate-config-edit');
        Route::post('/partner-paygate-config/edit/{id}', ['uses' => 'PartnerPaygateConfigController@editAction'])
            ->name('gate.partner.paygate.congfig.editAction')
            ->middleware('can:partner-paygate-config-edit');
        Route::get('/partner-paygate-config/delete/{id}', ['uses' => 'PartnerPaygateConfigController@delete'])
            ->name('gate.partner.paygate.congfig.delete')
            ->middleware('can:partner-paygate-config-delete');
        Route::get('/partner-paygate-config/ajax/get-list', 'PartnerPaygateConfigController@ajaxGetList')
            ->name('gate.partner.ajax.paygate.congfig.getList')
            ->middleware('can:partner-paygate-config-browse');
        Route::get('/partner-paygate-config/ajax/get-list-source', 'PartnerPaygateConfigController@ajaxGetListSource')
            ->name('gate.partner.ajax.getListSource')
            ->middleware('can:partner-paygate-config-browse');

        //partner balance log
        Route::get('/partner-balance', 'PartnerBalanceController@index')
            ->name('gate.partner-balance.list')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-payment-method', 'PartnerPaymentMethod@index')
            ->name('gate.partner-payment-method.list')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-appota-service', 'PartnerAppotaService@index')
            ->name('gate.partner-appota-service.list')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-business', 'partnerBusiness@index')
            ->name('gate.partner-business')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-co-operate', 'partnerCooperate@index')
            ->name('gate.partner-Cooperate')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-juridical', 'partnerJuridical@index')
            ->name('gate.partner-Juridical')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-operate-status', 'partnerOperate@index')
            ->name('gate.partner-Operate')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-document-report', 'partnerDocumentReport@index')
            ->name('gate.partner-document-report')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-document-time-response', 'partnerDocumentReport@document')
            ->name('gate.partner-document-time-response')
            ->middleware('can:partner-balance-browse');

        Route::get('/gate-partner-payment-method-config', 'partnerDocumentReport@paymentMethodConfig')
            ->name('gate.partner-payment-method-config')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-paygate-fee-config', 'partnerDocumentReport@partnerPaygateFeeConfig')
            ->name('gate.partner-paygate-fee-config')
            ->middleware('can:partner-paygate-fee-config');

        Route::get('/partner-paygate-fee-config-export', [App\Http\Livewire\Gate\PartnerDocumentReport\PartnerPaygateFeeConfig::class, 'exportCSV'])
            ->name('gate.partner-paygate-fee-config-export')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-paygate-fee-config-addnew', 'partnerDocumentReport@partnerPaygateFeeConfigAdd')
            ->name('gate.partner-paygate-fee-config-add')
            ->middleware('can:partner-balance-browse');

        Route::post('/partner-paygate-fee-config-addnew-post', 'partnerDocumentReport@partnerPaygateFeeConfigAddPostMethod')
            ->name('gate.partner-paygate-fee-config-add-post')
            ->middleware('can:partner-balance-browse');

        Route::get('/partner-paygate-fee-config-update', 'partnerDocumentReport@partnerPaygateFeeConfigUpdate')
            ->name('gate.partner-paygate-fee-config-update')
            ->middleware('can:partner-balance-browse');

        Route::post('/partner-paygate-fee-config-update-post', 'partnerDocumentReport@partnerPaygateFeeConfigUpdates')
            ->name('gate.partner-paygate-fee-config-update-post')
            ->middleware('can:partner-balance-browse');




        Route::get('/partner-balance/add', 'PartnerBalanceController@add')
            ->name('gate.partner-balance.add')
            ->middleware('can:partner-balance-edit');
        Route::post('/partner-balance/add', 'PartnerBalanceController@addAction')
            ->name('gate.partner-balance.addAction')
            ->middleware('can:partner-balance-edit');
        Route::get('/partner-balance/sub', 'PartnerBalanceController@sub')
            ->name('gate.partner-balance.sub')
            ->middleware('can:partner-balance-edit');
        Route::post('/partner-balance/sub', 'PartnerBalanceController@subAction')
            ->name('gate.partner-balance.subAction')
            ->middleware('can:partner-balance-edit');
        Route::get('/partner-balance/detail/{id}', ['uses' => 'PartnerBalanceController@detail'])
            ->name('gate.partner-balance.read')
            ->middleware('can:partner-balance-browse');
        Route::get('/partner-balance/ajax/get-list', 'PartnerBalanceController@ajaxGetList')
            ->name('gate.partner-balance.ajax.getList')
            ->middleware('can:partner-balance-browse');


        Route::post('/partner-balance-report', 'PartnerBalanceController@storeReport')
            ->name('gate.partner-balance.report.storeReport')
            ->middleware('can:partner-balance-export');

        Route::post('/partner-balance-report-exportcsv', 'PartnerBalanceExportCSVController@exportcsv')
            ->name('gate.partner-balance.report.storeReportExportCSV')
            ->middleware('can:partner-balance-export');

        Route::get('/partner-balance-report/{name}', 'PartnerBalanceController@downloadReport')
            ->name('gate.partner-balance.report.downloadReport')
            ->middleware('can:partner-balance-export');

        // partner bank vendor
        Route::get('/partner-transactions', 'PartnerTransactionController@index')
            ->name('gate.partner-transaction.list')
            ->middleware('can:partner-transaction-browse');

        Route::get('/partner-transactions-exportcsv', 'ExportCSVPartnerTransaction@exportcsv')
            ->name('partner-transaction-exportcsv')
            ->middleware('can:partner-transaction-browse');

        Route::get('/partner-balance-exportcsv', 'PartnerBalanceExportCSVController@exportcsv')
            ->name('partner-balance-exportcsv')
            ->middleware('can:partner-transaction-browse');


        Route::get('/partner-transactions/detail/{id}', ['uses' => 'PartnerTransactionController@detail'])
            ->name('gate.partner-transaction.detail')
            ->middleware('can:partner-transaction-read');
        Route::get('/partner-transactions/ajax/get-list', 'PartnerTransactionController@ajaxGetList')
            ->name('gate.partner-transaction.ajax.getList')
            ->middleware('can:partner-transaction-browse');
        Route::get('/partner-transactions/view/{id}', 'PartnerTransactionController@detail')
            ->name('gate.partner-transaction.view')
            ->middleware('can:partner-transaction-read');
        Route::post('/partner-transactions/export', 'PartnerTransactionController@exportTransaction')
            ->name('gate.partner-transaction.ajax.getList')
            ->middleware('can:partner-transaction-export');
        Route::get('/partner-transactions/download', 'PartnerTransactionController@downloadTransaction')
            ->name('gate.partner-transaction.ajax.getList')
            ->middleware('can:partner-transaction-export');

        // partner bank vendor
        Route::get('/topup-discount-configs', 'TopupDiscountConfigController@index')
            ->name('topup.discount-config.list')
            ->middleware('can:topup-discount-config-browse');
        Route::get('/topup-discount-config/add', 'TopupDiscountConfigController@add')
            ->name('topup.discount-config.add')
            ->middleware('can:topup-discount-config-add');
        Route::post('/topup-discount-config/add', 'TopupDiscountConfigController@addAction')
            ->name('topup.discount-config.addAction')
            ->middleware('can:topup-discount-config-add');
        Route::get('/topup-discount-config/detail/{id}', ['uses' => 'TopupDiscountConfigController@detail'])
            ->name('topup.discount-config.detail')
            ->middleware('can:topup-discount-config-read');
        Route::get('/topup-discount-config/edit/{id}', ['uses' => 'TopupDiscountConfigController@edit'])
            ->name('topup.discount-config.edit')
            ->middleware('can:topup-discount-config-edit');
        Route::post('/topup-discount-config/edit/{id}', ['uses' => 'TopupDiscountConfigController@editAction'])
            ->name('topup.discount-config.editAction')
            ->middleware('can:topup-discount-config-edit');
        Route::get('/topup-discount-config/delete/{id}', ['uses' => 'TopupDiscountConfigController@delete'])
            ->name('topup.discount-config.delete')
            ->middleware('can:topup-discount-config-delete');
        Route::get('/topup-discount-configs/ajax/get-list', 'TopupDiscountConfigController@ajaxGetList')
            ->name('topup.discount-config.ajax.getList')
            ->middleware('can:topup-discount-config-browse');

        // denomination
        Route::get('/topup-denominations', 'TopupDenominationConfigController@index')
            ->name('topup.denomination.list')
            ->middleware('can:topup-denomination-browse');
        Route::get('/topup-denomination/add', 'TopupDenominationConfigController@add')
            ->name('topup.denomination.add')
            ->middleware('can:topup-denomination-add');
        Route::post('/topup-denomination/add', 'TopupDenominationConfigController@addAction')
            ->name('topup.denomination.addAction')
            ->middleware('can:topup-denomination-add');
        Route::get('/topup-denomination/detail/{id}', ['uses' => 'TopupDenominationConfigController@detail'])
            ->name('topup.denomination.detail')
            ->middleware('can:topup-denomination-read');
        Route::get('/topup-denomination/edit/{id}', ['uses' => 'TopupDenominationConfigController@edit'])
            ->name('topup.denomination.edit')
            ->middleware('can:topup-denomination-edit');
        Route::post('/topup-denomination/edit/{id}', ['uses' => 'TopupDenominationConfigController@editAction'])
            ->name('topup.denomination.editAction')
            ->middleware('can:topup-denomination-edit');
        Route::get('/topup-denomination/delete/{id}', ['uses' => 'TopupDenominationConfigController@delete'])
            ->name('topup.denomination.delete')
            ->middleware('can:topup-denomination-delete');
        Route::get('/topup-denomination/ajax/get-list', 'TopupDenominationConfigController@ajaxGetList')
            ->name('topup.denomination.ajax.getList')
            ->middleware('can:topup-denomination-browse');

        // partner bank vendor
        Route::get('/topup-provider-configs', 'TopupProviderConfigController@index')
            ->name('topup.provider-config.list')
            ->middleware('can:topup-provider-config-browse');
        Route::get('/topup-provider-configs/add', 'TopupProviderConfigController@add')
            ->name('topup.provider-config.add')
            ->middleware('can:topup-provider-config-add');
        Route::post('/topup-provider-configs/add', 'TopupProviderConfigController@addAction')
            ->name('topup.provider-config.addAction')
            ->middleware('can:topup-provider-config-add');
        Route::get('/topup-provider-configs/detail/{id}', ['uses' => 'TopupProviderConfigController@detail'])
            ->name('topup.provider-config.detail')
            ->middleware('can:topup-provider-config-read');
        Route::get('/topup-provider-configs/edit/{id}', ['uses' => 'TopupProviderConfigController@edit'])
            ->name('topup.provider-config.edit')
            ->middleware('can:topup-provider-config-edit');
        Route::post('/topup-provider-configs/edit/{id}', ['uses' => 'TopupProviderConfigController@editAction'])
            ->name('topup.provider-config.editAction')
            ->middleware('can:topup-provider-config-edit');
        Route::get('/topup-provider-configs/delete/{id}', ['uses' => 'TopupProviderConfigController@delete'])
            ->name('topup.provider-config.delete')
            ->middleware('can:topup-provider-config-delete');
        Route::get('/topup-provider-configs/ajax/get-list', 'TopupProviderConfigController@ajaxGetList')
            ->name('topup.provider-config.ajax.getList')
            ->middleware('can:topup-provider-config-browse');
        Route::get('/topup-provider-configs/ajax/get-list-source', 'TopupProviderConfigController@ajaxGetListSource')
            ->name('topup.provider-config.ajax.getListSource')
            ->middleware('can:topup-provider-config-browse');

        // partner bank vendor
        Route::get('/topup-telco-provider', 'TopupTelcoProviderController@index')
            ->name('topup.telco-provider.list')
            ->middleware('can:topup-telco-provider-browse');
        Route::get('/topup-telco-provider/add', 'TopupTelcoProviderController@add')
            ->name('topup.telco-provider.add')
            ->middleware('can:topup-telco-provider-browse');
        Route::post('/topup-telco-provider/add', 'TopupTelcoProviderController@addAction')
            ->name('topup.telco-provider.addAction')
            ->middleware('can:topup-telco-provider-browse');
        Route::get('/topup-telco-provider/detail/{id}', ['uses' => 'TopupTelcoProviderController@detail'])
            ->name('topup.telco-provider-config.detail')
            ->middleware('can:topup-telco-provider-browse');
        Route::get('/topup-telco-provider/edit/{id}', ['uses' => 'TopupTelcoProviderController@edit'])
            ->name('topup.telco-provider.edit')
            ->middleware('can:topup-telco-provider-browse');
        Route::post('/topup-telco-provider/edit/{id}', ['uses' => 'TopupTelcoProviderController@editAction'])
            ->name('topup.telco-provider.editAction')
            ->middleware('can:topup-telco-provider-browse');
        Route::get('/topup-telco-provider/delete/{id}', ['uses' => 'TopupTelcoProviderController@delete'])
            ->name('topup.telco-provider.delete')
            ->middleware('can:topup-telco-provider-browse');
        Route::get('/topup-telco-provider/ajax/get-list', 'TopupTelcoProviderController@ajaxGetList')
            ->name('topup.telco-provider.ajax.getList')
            ->middleware('can:topup-telco-provider-browse');

        // partner bank vendor
        Route::get('/topup-transactions', 'TopupTransactionController@index')
            ->name('topup.transaction.list')
            ->middleware('can:topup-transaction-browse');

        Route::get('/topup-transactions-export', 'ExportTopupTransaction@ExportTopupTransaction')
            ->name('topup.transaction.listExportcsv')
            ->middleware('can:topup-transaction-browse');

        Route::get('/topup-transactions/detail/{id}', ['uses' => 'TopupTransactionController@detail'])
            ->name('topup.transaction.detail')
            ->middleware('can:topup-transaction-read');
        Route::get('/topup-transactions/ajax/get-list', 'TopupTransactionController@ajaxGetList')
            ->name('topup.transaction.ajax.getList')
            ->middleware('can:topup-transaction-browse');
        Route::post('/topup-transactions/export', 'TopupTransactionController@exportTransaction')
            ->name('gate.partner-transaction.ajax.getList')
            ->middleware('can:topup-transaction-export');
        Route::get('/topup-transactions/download', 'TopupTransactionController@downloadTransaction')
            ->name('gate.partner-transaction.ajax.getList')
            ->middleware('can:topup-transaction-export');
        Route::post('/topup-transactions/refund', 'TopupTransactionController@refund')
            ->name('gate.partner-transaction.ajax.refund')
            ->middleware('can:topup-transaction-refund');

        //topup dashboard
        Route::get('/topup-dashboard', 'TopupDashboardController@index')
            ->name('topup.dashboard')
            ->middleware('can:topup-dashboard-browse');
        Route::get('/topup-dashboard/get-chart-transaction', 'TopupDashboardController@getChartTransaction')
            ->name('gate.topup.dashboard.chart.line')
            ->middleware('can:topup-dashboard-browse');
        Route::get('/topup-dashboard/get-flash-report', 'TopupDashboardController@getFlash')
            ->name('gate.topup.dashboard.flash')
            ->middleware('can:topup-dashboard-browse');

        //shopcard cart dashboard
        Route::get('/shopcard-card-dashboard', 'ShopCardDashboardController@index')
            ->name('shopcard.dashboard')
            ->middleware('can:shopcard-card-dashboard');

        Route::get('/shopcard-card-dashboard/get-chart-transaction', 'ShopCardDashboardController@getChartTransaction')
            ->name('shopcard.dashboard.chart.line')
            ->middleware('can:shopcard-card-dashboard-browse');
        Route::get('/shopcard-card-dashboard/get-flash-report', 'ShopCardDashboardController@getFlash')
            ->name('shopcard.dashboard.flash')
            ->middleware('can:shopcard-card-dashboard-browse');

        // shopcard card
        Route::get('/shopcard-cards', 'ShopCardController@index')
            ->name('shopcard.card.list')
            ->middleware('can:shopcard-card-browse');
        Route::get('/shopcard-cards/add', 'ShopCardController@add')
            ->name('shopcard.card.add')
            ->middleware('can:shopcard-card-add');
        Route::post('/shopcard-cards/add', 'ShopCardController@addAction')
            ->name('shopcard.card.addAction')
            ->middleware('can:shopcard-card-add');
        Route::get('/shopcard-cards/detail/{id}', ['uses' => 'ShopCardController@detail'])
            ->name('shopcard.card.detail')
            ->middleware('can:shopcard-card-read');
        Route::get('/shopcard-cards/edit/{id}', ['uses' => 'ShopCardController@edit'])
            ->name('shopcard.card.edit')
            ->middleware('can:shopcard-card-edit');
        Route::post('/shopcard-cards/edit/{id}', ['uses' => 'ShopCardController@editAction'])
            ->name('shopcard.card.editAction')
            ->middleware('can:shopcard-card-edit');
        Route::get('/shopcard-cards/delete/{id}', ['uses' => 'ShopCardController@delete'])
            ->name('shopcard.card.delete')
            ->middleware('can:shopcard-card-delete');
        Route::get('/shopcard-cards/ajax/get-list', 'ShopCardController@ajaxGetList')
            ->name('shopcard.card.ajax.getList')
            ->middleware('can:shopcard-card-browse');
        Route::post('/shopcard-cards/export', 'ShopCardController@exportTransaction')
            ->name('shopcard.card.ajax.export')
            ->middleware('can:shopcard-card-browse');
        Route::get('/shopcard-cards/download', 'ShopCardController@downloadTransaction')
            ->name('shopcard.card.ajax.download')
            ->middleware('can:shopcard-card-export');

        // shopcard auto import card
        Route::get('/shopcard-card-auto-import-card', 'ShopCardAutoImportCardController@index')
            ->name('shopcard.auto-import-card.list')
            ->middleware('can:shopcard-card-auto-import-card');
        Route::post('/shopcard-card-auto-import-card/ajax-save-config', 'ShopCardAutoImportCardController@ajaxSaveConfig')
            ->name('shopcard.auto-import-card.ajax-save-config')
            ->middleware('can:shopcard-card-auto-import-card-ajax-save-config');
        Route::post('/shopcard-card-auto-import-card/ajax-export', 'ShopCardAutoImportCardController@exportConfig')
            ->name('shopcard.auto-import-card.ajax-export')
            ->middleware('can:shopcard-card-auto-import-card');
        Route::get('/shopcard-card-auto-import-card/download', 'ShopCardAutoImportCardController@downloadConfig')
            ->name('shopcard.auto-import-card.download')
            ->middleware('can:shopcard-card-auto-import-card');


        // logs card auto import card
        Route::get('/shopcard-card-auto-import-logs-card', 'LogsImportCard@index')
            ->name('shopcard.auto-import-card.list-logs')
            ->middleware('can:shopcard-card-auto-import-card');

        Route::get('/shopcard-card-auto-import-logs-card-search', 'LogsImportCard@searchLogs')
            ->name('shopcard.auto-import-card.ajax-save-config-log')
            ->middleware('can:shopcard-card-auto-import-card');

        Route::get('/shopcard-card-auto-import-logs-card-search-export', 'ExportLogTransaction@LogsExport')
            ->name('shopcard.auto-import-card.ajax-save-config-log-export')
            ->middleware('can:shopcard-card-auto-import-card');


        Route::get('/shopcard-card-auto-import-logs-card/export', 'LogsImportCard@exportLogs')
            ->name('shopcard.auto-import-card.ajax-export-log')
            ->middleware('can:shopcard-card-auto-import-card');
        Route::get('/shopcard-card-auto-import-logs-card/download', 'LogsImportCard@download')
            ->name('shopcard.auto-import-card.download-log-config')
            ->middleware('can:shopcard-card-auto-import-card');

        // shopcard card item
        Route::get('/shopcard-card-items', 'ShopCardItemController@index')
            ->name('shopcard.card-item.list')
            ->middleware('can:shopcard-card-item-browse');
        Route::get('/shopcard-card-items/extend', 'ShopCardItemController@extend')
            ->name('shopcard.card-item.extend')
            ->middleware('can:shopcard-card-item-edit');


        Route::get('/shopcard-card-items/add', 'ShopCardItemController@add')
            ->name('shopcard.card-item.add')
            ->middleware('can:shopcard-card-item-add');

        Route::get('/shopcard-card-items/export-card', 'ShopCardItemController@exportcard')
            ->name('shopcard.card-item.exportcard')
            ->middleware('can:shopcard-card-item-add');


        Route::post('/shopcard-card-items/add', 'ShopCardItemController@addAction')
            ->name('shopcard.card-item.addAction')
            ->middleware('can:shopcard-card-item-add');
        Route::post('/shopcard-card-items/add/import', 'ShopCardItemController@import')
            ->name('shopcard.card-item.addAction.import')
            ->middleware('can:shopcard-card-item-add');
        Route::get('/shopcard-card-items/detail/{id}', ['uses' => 'ShopCardItemController@detail'])
            ->name('shopcard.card-item.detail')
            ->middleware('can:shopcard-card-item-read');
        Route::get('/shopcard-card-items/edit/{id}', ['uses' => 'ShopCardItemController@edit'])
            ->name('shopcard.card-item.edit')
            ->middleware('can:shopcard-card-item-browse');
        Route::post('/shopcard-card-items/edit/{id}', ['uses' => 'ShopCardItemController@editAction'])
            ->name('shopcard.card-item.editAction')
            ->middleware('can:shopcard-card-item-browse');
        Route::get('/shopcard-card-items/delete/{id}', ['uses' => 'ShopCardItemController@delete'])
            ->name('shopcard.card-item.delete')
            ->middleware('can:shopcard-card-item-browse');

        Route::get('/shopcard-card-items/ajax/get-list', 'ShopCardItemController@ajaxGetList')
            ->name('shopcard.card-item.ajax.getList')
            ->middleware('can:shopcard-card-item-browse');

        Route::get('/shopcard-card-items/ajax/get-list-export', 'ExportShopCardItemController@ExportShopCardItemController')
            ->name('shopcard.card-item.ajax.getListExport')
            ->middleware('can:shopcard-card-item-browse');

        Route::get('/shopcard-card-items/progress', 'ShopCardItemController@progress')
            ->name('shopcard.card-item.ajax.getProgress')
            ->middleware('can:shopcard-card-item-browse');
        Route::post('/shopcard-card-items/export', 'ShopCardItemController@exportTransaction')
            ->name('shopcard.card-item.ajax.export')
            ->middleware('can:shopcard-card-item-export');
        Route::get('/shopcard-card-items/download', 'ShopCardItemController@downloadTransaction')
            ->name('shopcard.card-item.ajax.download')
            ->middleware('can:shopcard-card-item-export');

        // shopcard card item
        Route::get('/shopcard-card-discount-configs', 'ShopCardDiscountConfigController@index')
            ->name('shopcard.discount-config.list')
            ->middleware('can:shopcard-card-discount-config-browse');
        Route::get('/shopcard-card-discount-configs/add', 'ShopCardDiscountConfigController@add')
            ->name('shopcard.discount-config.add')
            ->middleware('can:shopcard-card-discount-config-add');
        Route::post('/shopcard-card-discount-configs/add', 'ShopCardDiscountConfigController@addAction')
            ->name('shopcard.discount-config.addAction')
            ->middleware('can:shopcard-card-discount-config-add');
        Route::get('/shopcard-card-discount-configs/detail/{id}', ['uses' => 'ShopCardDiscountConfigController@detail'])
            ->name('shopcard.discount-config.detail')
            ->middleware('can:shopcard-card-discount-config-read');
        Route::get('/shopcard-card-discount-configs/edit/{id}', ['uses' => 'ShopCardDiscountConfigController@edit'])
            ->name('shopcard.discount-config.edit')
            ->middleware('can:shopcard-card-discount-config-edit');
        Route::post('/shopcard-card-discount-configs/edit/{id}', ['uses' => 'ShopCardDiscountConfigController@editAction'])
            ->name('shopcard.discount-config.editAction')
            ->middleware('can:shopcard-card-discount-config-edit');
        Route::get('/shopcard-card-discount-configs/delete/{id}', ['uses' => 'ShopCardDiscountConfigController@delete'])
            ->name('shopcard.discount-config.delete')
            ->middleware('can:shopcard-card-discount-config-delete');
        Route::get('/shopcard-card-discount-configs/ajax/get-list', 'ShopCardDiscountConfigController@ajaxGetList')
            ->name('shopcard.discount-config.ajax.getList')
            ->middleware('can:shopcard-card-discount-config-browse');

        // shopcard partner card data
        Route::get('/shopcard-card-partner-card-data', 'ShopCardPartnerCardDataController@index')
            ->name('shopcard.partner-card-data.list')
            ->middleware('can:shopcard-card-partner-card-data-browse');

        Route::get('/shopcard-card-provider-config', 'ShopCardProviderConfig@index')
            ->name('shopcard.providerConfig.list')
            ->middleware('can:shopcard-card-partner-card-data-browse');


        Route::get('/shopcard-card-partner-card-data/add', 'ShopCardPartnerCardDataController@add')
            ->name('shopcard.partner-card-data.add')
            ->middleware('can:shopcard-card-partner-card-data-browse');
        Route::post('/shopcard-card-partner-card-data/add', 'ShopCardPartnerCardDataController@addAction')
            ->name('shopcard.partner-card-data.addAction')
            ->middleware('can:shopcard-card-partner-card-data-browse');
        Route::get('/shopcard-card-partner-card-data/detail/{id}', ['uses' => 'ShopCardPartnerCardDataController@detail'])
            ->name('shopcard.partner-card-data.detail')
            ->middleware('can:shopcard-card-partner-card-data-read');
        Route::get('/shopcard-card-partner-card-data/edit/{id}', ['uses' => 'ShopCardPartnerCardDataController@edit'])
            ->name('shopcard.partner-card-data.edit')
            ->middleware('can:shopcard-card-partner-card-data-browse');
        Route::post('/shopcard-card-partner-card-data/edit/{id}', ['uses' => 'ShopCardPartnerCardDataController@editAction'])
            ->name('shopcard.partner-card-data.editAction')
            ->middleware('can:shopcard-card-partner-card-data-browse');
        Route::get('/shopcard-card-partner-card-data/delete/{id}', ['uses' => 'ShopCardPartnerCardDataController@delete'])
            ->name('shopcard.partner-card-data.delete')
            ->middleware('can:shopcard-card-partner-card-data-browse');

        Route::get('/shopcard-card-partner-card-data/ajax/get-list', 'ShopCardPartnerCardDataController@ajaxGetList')
            ->name('shopcard.partner-card-data.ajax.getList')
            ->middleware('can:shopcard-card-partner-card-data-browse');

        Route::get('/shopcard-card-partner-card-data/ajax/get-list-export', 'ExportShopCardPartnerData@ExportShopCardPartnerCardData')
            ->name('shopcard.partner-card-data.ajax.getListexport')
            ->middleware('can:shopcard-card-partner-card-data-browse');

        Route::post('/shopcard-card-partner-card-data/export', ['uses' => 'ShopCardPartnerCardDataController@exportTransaction'])
            ->name('shopcard.discount-config.export')
            ->middleware('can:shopcard-card-partner-card-data-export');
        Route::get('/shopcard-card-partner-card-data/download', 'ShopCardPartnerCardDataController@downloadTransaction')
            ->name('shopcard.discount-config.ajax.download')
            ->middleware('can:shopcard-card-partner-card-data-export');


        // shopcard transaction
        Route::get('/shopcard-card-transactions', 'ShopCardTransactionController@index')
            ->name('shopcard.transaction.list')
            ->middleware('can:shopcard-card-transaction-browse');
        Route::get('/shopcard-card-transactions/detail/{id}', ['uses' => 'ShopCardTransactionController@detail'])
            ->name('shopcard.transaction.detail')
            ->middleware('can:shopcard-card-transaction-read');

        Route::get('/shopcard-card-transactions/ajax/get-list', 'ShopCardTransactionController@ajaxGetList')
            ->name('shopcard.transaction.ajax.getList')
            ->middleware('can:shopcard-card-transaction-browse');

        Route::get('/shopcard-card-transactions/ajax/get-list-export', 'ExportShopCardTransaction@ExportShopCardTransaction')
            ->name('shopcard.transaction.ajax.getListexport')
            ->middleware('can:shopcard-card-transaction-browse');

        Route::post('/shopcard-card-transactions/export', ['uses' => 'ShopCardTransactionController@exportTransaction'])
            ->name('shopcard.discount-config.export')
            ->middleware('can:shopcard-card-transaction-export');
        Route::get('/shopcard-card-transactions/download', 'ShopCardTransactionController@downloadTransaction')
            ->name('shopcard.discount-config.ajax.download')
            ->middleware('can:shopcard-card-transaction-export');

        Route::get('/shopcard-card-report/create', 'ShopCardItemReportController@create')
            ->name('shopcard.report.create')
            ->middleware('can:shopcard-card-report-create');


        Route::post('/shopcard-card-report', 'ShopCardItemReportController@store')
            ->name('shopcard.report.store')
            ->middleware('can:shopcard-card-report-create');


        Route::get('/shopcard-card-report/{name}', 'ShopCardItemReportController@show')
            ->name('shopcard.report.show')
            ->middleware('can:shopcard-card-report-create');

        // collect-money-partner
        Route::get('/ebill-virtual-account-collect-money', 'CollectMoneyPartnerController@index')
            ->name('gate.collect-money-partner.list')
            ->middleware('can:ebill-virtual-account-collect-money-browse');
        Route::get('/ebill-virtual-account-collect-money/add', 'CollectMoneyPartnerController@add')
            ->name('gate.collect-money-partner.add')
            ->middleware('can:ebill-virtual-account-collect-money-add');
        Route::post('/ebill-virtual-account-collect-money/add', 'CollectMoneyPartnerController@addAction')
            ->name('gate.collect-money-partner.addAction')
            ->middleware('can:ebill-virtual-account-collect-money-add');
        Route::get('/ebill-virtual-account-collect-money/detail/{id}', ['uses' => 'CollectMoneyPartnerController@detail'])
            ->name('gate.collect-money-partner.detail')
            ->middleware('can:ebill-virtual-account-collect-money-read');
        Route::get('/ebill-virtual-account-collect-money/edit/{id}', ['uses' => 'CollectMoneyPartnerController@edit'])
            ->name('gate.collect-money-partner.edit')
            ->middleware('can:ebill-virtual-account-collect-money-edit');
        Route::post('/ebill-virtual-account-collect-money/edit/{id}', ['uses' => 'CollectMoneyPartnerController@editAction'])
            ->name('gate.collect-money-partner.editAction')
            ->middleware('can:ebill-virtual-account-collect-money-edit');
        Route::get('/ebill-virtual-account-collect-money/delete/{id}', ['uses' => 'CollectMoneyPartnerController@delete'])
            ->name('gate.collect-money-partner.delete')
            ->middleware('can:ebill-virtual-account-collect-money-delete');
        Route::get('/ebill-virtual-account-collect-money/ajax/get-list', 'CollectMoneyPartnerController@ajaxGetList')
            ->name('gate.collect-money-partner.ajax.getList')
            ->middleware('can:ebill-virtual-account-collect-money-browse');

        // ebill
        Route::get('/ebill-virtual-account-ebills', 'EbillController@index')
            ->name('gate.ebill.list')
            ->middleware('can:ebill-virtual-account-ebill-browse');

        Route::get('/ebill-virtual-account-manage-balance', 'EbillController@manageBalanceThuHo')
            ->name('gate.ebill.manage.balance')
            ->middleware('can:ebill-virtual-account-manage-balance');


        Route::get('/ebill-virtual-account-ebill/detail/{id}', ['uses' => 'EbillController@detail'])
            ->name('gate.ebill.detail')
            ->middleware('can:ebill-virtual-account-ebill-read');


        Route::get('/ebill-virtual-account-ebill/ajax/get-list', 'EbillController@ajaxGetList')
            ->name('gate.ebill.getList')
            ->middleware('can:ebill-virtual-account-ebill-browse');


        // ebill
        Route::get('/ebill-virtual-account-ebill-transaction', 'EbillTransactionController@index')
            ->name('gate.ebill-transaction.list')
            ->middleware('can:ebill-virtual-account-ebill-transaction-browse');

        Route::get('/ebill-virtual-account-ebill-transaction-resendIPN', 'EbillTransactionController@resendIPN')
            ->name('gate.ebill-transaction.resendIPN')
            ->middleware('can:ebill-virtual-account-ebill-transaction-browse');


        Route::get('/ebill-virtual-account-ebill-transaction/detail/{id}', ['uses' => 'EbillTransactionController@detail'])
            ->name('gate.ebill-transaction.detail')
            ->middleware('can:ebill-virtual-account-ebill-transaction-read');


        Route::get('/ebill-virtual-account-ebill-transaction/ajax/get-list', 'EbillTransactionController@ajaxGetList')
            ->name('gate.ebill-transaction.getList')
            ->middleware('can:ebill-virtual-account-ebill-transaction-browse');

        Route::get('/ebill-virtual-account-ebill-transaction/ajax/get-list-export', 'ExportEbillTransaction@ExportEbillTransaction')
            ->name('gate.ebill-transaction.getListexport')
            ->middleware('can:ebill-virtual-account-ebill-transaction-browse');


        Route::post('/ebill-virtual-account-ebill-transaction/export', 'EbillTransactionController@exportEbillTransaction')
            ->name('gate.ebill-transaction.ajax.export')
            ->middleware('can:ebill-virtual-account-ebill-transaction-browse');


        // ebill
        Route::get('/ebill-virtual-account-virtual-account', 'VirtualAccountController@index')
            ->name('gate.virtual-account.list')
            ->middleware('can:ebill-virtual-account-virtual-account-browse');

        Route::get('/ebill-virtual-account-virtual-account-export', 'VirtualAccountController@exportCSV')
            ->name('gate.virtual-account.list.export')
            ->middleware('can:ebill-virtual-account-virtual-account-browse');

        Route::get('/ebill-virtual-account-virtual-account/detail/{id}', ['uses' => 'VirtualAccountController@detail'])
            ->name('gate.virtual-account.detail')
            ->middleware('can:ebill-virtual-account-virtual-account-read');
        Route::get('/ebill-virtual-account-virtual-account/ajax/get-list', 'VirtualAccountController@ajaxGetList')
            ->name('gate.virtual-account.getList')
            ->middleware('can:ebill-virtual-account-virtual-account-browse');

        Route::get('/ebill-virtual-account-virtual-account-export', 'VirtualAccountController@exportCSV')
            ->name('gate.virtual-account.list.export')
            ->middleware('can:ebill-virtual-account-virtual-account-browse');




        // ebill IPN log
        Route::get('/ebill-ipn-logs-trans', 'EbillIpnLogsController@index')
            ->name('gate.ebill-ipn-logs.list')
            ->middleware('can:ebill-ipn-logs-browse');

        Route::get('/ebill-ipn-logs-partner-provider-config', 'DoubleCheck@ConfigEBillPartnerProvider')
            ->name('gate.ebill-ipn-logs.ConfigEBillPartnerProvider')
            ->middleware('can:ebill-ipn-logs-browse');

        Route::get('/ebill-ipn-logs-partner-bank-provider-config', 'DoubleCheck@ConfigEBillPartnerBankProvider')
            ->name('gate.ebill-ipn-logs.ConfigEBillPartnerBankProvider')
            ->middleware('can:ebill-ipn-logs-browse');


        Route::get('/ebill-ipn-logs-doisoat', 'DoubleCheck@DoiSoatThuHovoiPartner')
            ->name('gate.ebill-ipn-logs.doisoatthuhoavoipartner')
            ->middleware('can:ebill-ipn-logs-browse');

        Route::get('/ebill-ipn-logs-doisoat-exportCSV', [App\Http\Livewire\DoubleCheck\DoiSoatThuHoVoiPartner::class, 'ExportDoiSoatThuHoVoiPartner'])
            ->name('gate.ebill-ipn-logs.doisoatthuhoavoipartner.export')
            ->middleware('can:ebill-ipn-logs-browse');


        Route::get('/ebill-ipn-logs-request-back-money', 'DoubleCheck@RequestBankMoney')
            ->name('gate.ebill-ipn-logs.RequestBankMoney')
            ->middleware('can:ebill-ipn-logs-browse');

        Route::get('/ebill-ipn-logs-import-ebill-va-provider', 'DoubleCheck@ImportVAProvider')
            ->name('gate.ebill-ipn-logs.ImportVAProvider')
            ->middleware('can:ebill-ipn-logs-browse');

        Route::get('/ebill-ipn-logs-ebill-resend-transaction', 'DoubleCheck@ResendTransaction')
            ->name('gate.ebill-ipn-logs.resend-transaction')
            ->middleware('can:ebill-ipn-logs-browse');

        Route::get('/ebill-ipn-logs-transaction-by-account', 'DoubleCheck@getListEbillTransaction')
            ->name('gate.ebill-ipn-get.list.ebill-transaction')
            ->middleware('can:ebill-ipn-logs-transaction-by-account');


        Route::get('/ebill-ipn-logs/detail/{id}', ['uses' => 'EbillIpnLogsController@detail'])
            ->name('gate.ebill-ipn-logs.detail')
            ->middleware('can:ebill-ipn-logs-read');
        Route::get('/ebill-ipn-logs/ajax/get-list', 'EbillIpnLogsController@ajaxGetList')
            ->name('gate.ebill-ipn-logs.getList')
            ->middleware('can:ebill-ipn-logs-browse');
        //        Route::post('/ebill-virtual-account-ebill-transaction/export', 'EbillTransactionController@exportEbillTransaction')
        //            ->name('gate.ebill-transaction.ajax.export')
        //            ->middleware('can:ebill-virtual-account-ebill-transaction-browse');

        // Dashboard Ebill Controller
        Route::get('/ebill-dashboard', 'EbillDashboardController@index')
            ->name('gate.ebill-dashboard')
            ->middleware('can:ebill-dashboard-browse');
        Route::get('/ebill-dashboard/get-chart-transaction', 'EbillDashboardController@getChartTransaction')
            ->name('gate.ebill-dashboard.chart')
            ->middleware('can:ebill-dashboard-browse');
        Route::get('/ebill-dashboard/get-flash-report', 'EbillDashboardController@getFlash')
            ->name('gate.ebill-dashboard.dashboard.flash-report')
            ->middleware('can:ebill-dashboard-browse');

        // Dich vu chuyen tien noi bo
        Route::get('/transfer-money-internal-money-transaction', 'TransferMoneyDashboardController@TransferMoneyInternalTransaction')
            ->name('transfer-money.TransferMoneyInternalTransaction')
            ->middleware('can:transfer-money-internal-money-transaction');

        // Log IPN dich vu chi ho

        Route::get('/transfer-money-firm-banking-ipn-logs', 'TransferMoneyDashboardController@firmBankingIpnLogs')
            ->name('transfer-money.firmBankingIpnLogs')
            ->middleware('can:transfer-money-dashboard-browse');


        //TransferMoneyDashboardController
        Route::get('/transfer-money-dashboard', 'TransferMoneyDashboardController@index')
            ->name('transfer-money.dashboard')
            ->middleware('can:transfer-money-dashboard-browse');

        Route::get('/transfer-money-dashboard/get-chart-transaction', 'TransferMoneyDashboardController@getChartTransaction')
            ->name('gate.transfer-money.dashboard.chart.line')
            ->middleware('can:transfer-money-dashboard-browse');
        Route::get('/transfer-money-dashboard/get-flash-report', 'TransferMoneyDashboardController@getFlash')
            ->name('gate.transfer-money.dashboard.flash')
            ->middleware('can:transfer-money-dashboard-browse');
        // Đối soát
        Route::get('/cross-check-downloadcsv', 'DoubleCheck@downloadCSV')
            ->name('double-check.downloadCSV')
            ->middleware('can:double-check-provider');

        Route::get('/cross-check', 'DoubleCheck@doisoat')
            ->name('double-check.list')
            ->middleware('can:double-check-provider');

        Route::get('/cross-check-export-csv', [App\Http\Livewire\DoubleCheck\Doublecheck::class, 'ExportCSV'])
            ->name('double-check.list.export.csv')
            ->middleware('can:double-check-provider');

        Route::get('/cross-check-va-export-csv', [App\Http\Livewire\Gate\Ebill\EbillVAReconciliationData::class, 'ExportCSV'])
            ->name('double-check.list.va.export.csv')
            ->middleware('can:double-check-provider');


        Route::get('/cross-check-confirm-schedule', 'DoubleCheck@confirmSchedule')
            ->name('double-check.confirm-schedule')
            ->middleware('can:double-check-provider');

        Route::get('/cross-check-confirm-schedule-exportCSV', [App\Http\Livewire\DoubleCheck\ConfirmScheduleDoubleCheck::class, 'ExportConfirmSchedule'])
            ->name('double-check.confirm-schedule-exportCSV')
            ->middleware('can:double-check-provider');

        Route::get('/cross-check-partner', 'DoubleCheck@doisoatvoiPartner')
            ->name('double-check.doisoatvoiPartner')
            ->middleware('can:double-check-provider');

        // Route::get('/doi-soat-thu-ho-partner', 'DoubleCheck@DoiSoatThuHovoiPartner')
        //     ->name('double-check.DoiSoatThuHovoiPartner')
        //     ->middleware('can:double-check-provider');

        Route::get('/bien-ban-doi-soat', 'DoubleCheck@bienbandoisoat')
            ->name('double-check.bienbandoisoat')
            ->middleware('can:double-check-provider');

        Route::get('exportcsv', 'DoubleCheck@exportcsv')
            ->name('double-check.exportcsv')
            ->middleware('can:double-check-provider');

        // paypal

        Route::get('/paypal-list-register', 'Paypal@index')
            ->name('paypal.list.register')
            ->middleware('can:paypal-list-register');

        //qrCode


        Route::get('/qrcode-list', 'qrCodeController@index')
            ->name('qrcode.list')
            ->middleware('can:qrcode-list');

        // api upload image
        Route::post('/upload-image', [\App\Http\Livewire\QrCode::class, 'store'])
        ->name('upload.image')
        ->middleware('can:qrcode-list');


        //lottery
        Route::get('/lottery-list', 'Lottery\lottery@index')
            ->name('lottery.list')
            ->middleware('can:lottery');

        Route::get('/lottery-list-win', 'Lottery\lottery@listLotteryWin')
            ->name('lottery.list.win')
            ->middleware('can:lottery');

        Route::get('/lottery-list-provider', 'Lottery\lottery@listProvider')
            ->name('lottery.list.provider')
            ->middleware('can:lottery');

        // Risk management
        Route::get('/risk-management', 'riskManagementController@index')
            ->name('risk-management.list')
            ->middleware('can:risk-management-list');

        Route::get('/risk-management-rule-risk', 'riskManagementController@ruleRisk')
            ->name('risk-management.ruleRisk')
            ->middleware('can:risk-management-list-rule-risk');

        Route::get('/risk-management-cc-acount-bypass', 'riskManagementController@ccAccountBypass')
            ->name('risk-management.cc-account-bypass')
            ->middleware('can:risk-management-list-cc-acount-bypass');

        Route::get('/risk-management-cc-partner-bin-card-allow', 'riskManagementController@ccPartnerBinCardAllow')
            ->name('risk-management.ccPartnerBinCardAllow')
            ->middleware('can:risk-management-list-cc-partner-bin-card-allow');

        Route::get('/risk-management-rule-splecial', 'riskManagementController@ruleSpecial')
            ->name('risk-rule-splecial.list')
            ->middleware('can:risk-management-list-rule-splecial');

        Route::get('/risk-management-partner-rule-splecial', 'riskManagementController@PartnerruleSpecial')
            ->name('risk-partner-rule-splecial.list')
            ->middleware('can:risk-management-list-partner-rule-splecial');

        Route::get('/risk-management-history', 'riskManagementController@historyManagement')
            ->name('risk-management.historyManagement')
            ->middleware('can:risk-management-list-history');

        Route::get('/risk-management-history-export', 'riskManagementController@exportCSV')
            ->name('risk-management.historyManagementExportCSV')
            ->middleware('can:risk-management-list-history');

        Route::get('/risk-management-blacklist-ip', 'riskManagementController@blacklistIP')
            ->name('risk-management.blacklistIP')
            ->middleware('can:risk-management-list-blacklist-ip');

        //TransferMoneyTransactionController
        Route::get('/transfer-money-transactions', 'TransferMoneyTransactionController@index')
            ->name('transfer.money.transaction.list')
            ->middleware('can:transfer-money-transaction-browse');

        Route::get('/transfer-money-manage-balance', 'TransferMoneyTransactionController@managebalance')
            ->name('transfer.money.managebalance.list')
            ->middleware('can:transfer-money-manage-balance');

        Route::get('/transfer-money-transactions-export', 'ExportTransferMoneyTransaction@ExportTransferMoneyTransaction')
            ->name('transfer.money.transaction.listExport')
            ->middleware('can:transfer-money-transaction-browse');


        Route::get('/transfer-money-transactions/detail/{id}', ['uses' => 'TransferMoneyTransactionController@detail'])
            ->name('transfer.money.transaction.detail')
            ->middleware('can:transfer-money-transaction-read');
        Route::get('/transfer-money-transactions/ajax/get-list', 'TransferMoneyTransactionController@ajaxGetList')
            ->name('transfer.money.transaction.ajax.getList')
            ->middleware('can:transfer-money-transaction-browse');
        Route::post('/transfer-money-transactions/export', 'TransferMoneyTransactionController@exportTransaction')
            ->name('gate.transfer.money.transaction.ajax.getList')
            ->middleware('can:transfer-money-transaction-export');
        Route::get('/transfer-money-transactions/download', 'TransferMoneyTransactionController@downloadTransaction')
            ->name('gate.transfer.money.transaction.ajax.getList')
            ->middleware('can:transfer-money-transaction-export');
        Route::get('/transfer-money-transactions/refund', 'TransferMoneyTransactionController@refund')
            ->name('gate.transfer.money.transaction.refund')
            ->middleware('can:transfer-money-transaction-refund');

        //TransferMoneyProviderController
        Route::get('/transfer-money-provider', 'TransferMoneyProviderController@index')
            ->name('transfer.money.provider.list')
            ->middleware('can:transfer-money-provider-browse');
        Route::get('/transfer-money-provider/detail/{id}', ['uses' => 'TransferMoneyProviderController@detail'])
            ->name('transfer.money.provider.detail')
            ->middleware('can:transfer-money-provider-read');
        Route::get('/transfer-money-provider/ajax/get-list', 'TransferMoneyProviderController@ajaxGetList')
            ->name('transfer.money.provider.ajax.getList')
            ->middleware('can:transfer-money-provider-browse');
        Route::get('/transfer-money-provider/add', 'TransferMoneyProviderController@add')
            ->name('transfer.money.provider.add')
            ->middleware('can:transfer-money-provider-add');
        Route::post('/transfer-money-provider/add', 'TransferMoneyProviderController@addAction')
            ->name('transfer.money.provider.addAction')
            ->middleware('can:transfer-money-provider-add');
        Route::get('/transfer-money-provider/edit/{id}', ['uses' => 'TransferMoneyProviderController@edit'])
            ->name('transfer.money.provider.edit')
            ->middleware('can:transfer-money-provider-edit');
        Route::post('/transfer-money-provider/edit/{id}', ['uses' => 'TransferMoneyProviderController@editAction'])
            ->name('transfer.money.provider.editAction')
            ->middleware('can:transfer-money-provider-edit');
        Route::get('/transfer-money-provider/delete/{id}', ['uses' => 'TransferMoneyProviderController@delete'])
            ->name('transfer.money.provider.delete')
            ->middleware('can:transfer-money-provider-delete');

        //TransferMoneyConfig
        Route::get('/transfer-money-config', 'TransferMoneyConfigController')
            ->name('transfer.money.config');

        Route::get('/transfer-money-update-transaction', 'TransferMoneyConfigController@updateTransaction')
            ->name('transfer.money.config.update');

        Route::get('/transfer-money-config-partner-provider', 'TransferMoneyConfigController@partnerConfigProvider')
            ->name('transfer.money.config.partnerProvider');

        Route::get('/transfer-money-config-partner-ebill-bank', 'TransferMoneyConfigController@ebillBank')
            ->name('transfer.money.config.ebillBank');

            Route::get('/transfer-money-config-transfer-partner-ebill-bank', 'TransferMoneyConfigController@transferPartnerebillBank')
            ->name('transfer.money.config.transferPartnerebillBank');

        Route::get('/transfer-money-config-double-check-provider', 'DoubleCheck@doisoatvoiprovider')
            ->name('transfer.money.config.doisoatvoiprovider.list')
            ->middleware('can:transfer-money-config-double-check-provider');

        Route::get('/transfer-money-config-double-check-provider-export', [App\Http\Livewire\DoubleCheck\Provider::class, 'ExportCSVDoiSoatProvider'])
            ->name('transfer.money.config.doisoatvoiprovider')
            ->middleware('can:transfer-money-config-double-check-provider');

        // Route::get('/cross-check-confirm-schedule-exportCSV', [App\Http\Livewire\DoubleCheck\ConfirmScheduleDoubleCheck::class, 'ExportConfirmSchedule'])
        //     ->name('double-check.confirm-schedule-exportCSV')
        //     ->middleware('can:double-check-provider');

        // Route::get('/transfer-money-partner-config-provider', 'partnerDocumentReport@partnerConfigProvider')
        //     ->name('gate.partner-config-provider')
        //     ->middleware('can:partner-balance-browse');

        //TransferMoneyCheckAccountBank
        Route::get('transfer-money-check-account-bank', 'TransferMoneyCheckAccountBankController')
            ->name('transfer.money.check-account-bank')
            ->middleware('can:transfer-money-check-account-bank-browse');
        //TransferMoneyCheckAccountTransaction
        //
        Route::get('transfer-money-check-account-transaction', 'TransferMoneyCheckAccountTransactionController')
            ->name('transfer.money.check-account-transaction')
            ->middleware('can:transfer-money-check-account-transaction-browse');

        Route::get('transfer-money-check-account-transaction-exportcsv', 'ExportTransferMoneyCheckAccountTransaction@ExportTransferMoneyCheckAccountTransaction')
            ->name('transfer.money.check-account-transaction-exportcsv')
            ->middleware('can:transfer-money-check-account-transaction-browse');

        //Tool cap nhat giao dich
        Route::get('/gate-money-tool-update-transaction', 'ToolUpdateTransactionController@index')
            ->name('gate.money.audit.toolUpdateTransaction')
            ->middleware('can:gate-money-audit-browse');
        Route::get('/gate-vendor-token-list', 'BankVendorTokenController@tokenList')
            ->name('gate.bank_vendor.token.list')
            ->middleware('can:gate-vendor-token-list');

        //AppotaPay Partner Type Config api/v1/partner-service-type-config
        Route::get('/gate-partner-service-type-config', 'BankTransactionController@PartnerServiceTypeConfig')
            ->name('gate.partner.service.type.config')
            ->middleware('can:gate-partner-service-type-config');

        Route::get('/gate-vendor-token-list-export', [App\Http\Livewire\BankVendorTokenList::class, 'exportCSV'])
            ->name('gate.bank_vendor.token.list.export')
            ->middleware('can:gate-vendor-token-list');

        //Đối soát
        Route::get('/gate-money-audit', 'AuditController@index')
            ->name('gate.money.audit.list')
            ->middleware('can:gate-money-audit-browse');

        Route::get('/transfer-money-audit/ajax/get-list', 'AuditController@ajaxGetList')
            ->name('transfer.money.audit.getList')
            ->middleware('can:gate-money-audit-browse');
        Route::get('/transfer-money-audit/preview', 'AuditController@preview')
            ->name('transfer.money.audit.preview')
            ->middleware('can:gate-money-audit-read');
        Route::get('/transfer-money-audit/export', 'AuditController@export')
            ->name('transfer.money.audit.export')
            ->middleware('can:gate-money-audit-export');
        Route::get('/transfer-money-audit/download', 'AuditController@download')
            ->name('transfer.money.audit.download')
            ->middleware('can:gate-money-audit-export');

        //dashboard
        Route::get('/gate-money-dashboard', 'TranferMoneyDashdoardController@dashboard')
            ->name('gate.money.dashboard')
            ->middleware('can:gate-money-dashboard-browse');

        Route::get('gate-money-dashboard/get-chart-transaction', 'TranferMoneyDashdoardController@getChartTransaction')
            ->name('gate.money.dashboard.chart.line')
            ->middleware('can:gate-money-dashboard-browse');
        Route::get('/gate-money-dashboard/get-flash-report', 'TranferMoneyDashdoardController@getFlash')
            ->name('gate.money.dashboard.flash')
            ->middleware('can:gate-money-dashboard-browse');
        Route::get('/gate-money-dashboard/get-flash-report2', 'TranferMoneyDashdoardController@getFlashSecond')
            ->name('gate.money.dashboard.flashSecond')
            ->middleware('can:gate-money-dashboard-browse');
        Route::post('/gate-money-dashboard/export', 'TranferMoneyDashdoardController@exportBankTransactionDashboard')
            ->name('gate.money.dashboard.export')
            ->middleware('can:gate-money-dashboard-export');
        Route::get('/gate-money-dashboard/download', 'TranferMoneyDashdoardController@downloadBankTransactionDashboard')
            ->name('gate.money.export.download')
            ->middleware('can:gate-money-dashboard-export');
    });

    Route::namespace('Charging')->group(function () {

        // shopcard transaction
        Route::get('/charging-card-transactions', 'ChargingController@index')
            ->name('charging.card.list')
            ->middleware('can:charging-card-transaction-browse');

        Route::get('/charging-card-transactions-export', [App\Http\Livewire\GiaoDichTheAcCharging::class, 'exportCSV'])
            ->name('charging.card.list.export')
            ->middleware('can:charging-card-transaction-browse');

        Route::get('/charging-card-sandbox-transactions', 'ChargingController@sandbox')
            ->name('charging.card.sandbox.list')
            ->middleware('can:charging-card-transaction-browse');


        Route::get('/charging-card-transaction/dashboard', 'ChargingController@dashboard')
            ->name('charging.card.dashboard')
            ->middleware('can:charging-card-transaction-dashboard-browse');
        Route::get('/charging-card-transactions/detail/{id}', ['uses' => 'ChargingController@detail'])
            ->name('charging.card.detail')
            ->middleware('can:charging-card-transaction-read');
        Route::get('/charging-card-transactions/ajax/get-list', 'ChargingController@ajaxGetList')
            ->name('charging.card.ajax.getList')
            ->middleware('can:charging-card-transaction-browse');
        Route::post('/charging-card-transactions/export', 'ChargingController@exportTransaction')
            ->name('gate.bank-transaction.ajax.getList')
            ->middleware('can:charging-card-transaction-export');
        Route::get('/charging-card-transactions/download', 'ChargingController@downloadTransaction')
            ->name('gate.bank-transaction.ajax.getList')
            ->middleware('can:charging-card-transaction-export');
        Route::post('/charging-card-transactions/get-chart-transaction', 'ChargingController@getChartTransaction')
            ->middleware('can:charging-card-transaction-browse');
        Route::post('/charging-card-transactions/get-chart-pie', 'ChargingController@getChartPieTransaction')
            ->middleware('can:charging-card-transaction-browse');
        Route::post('/charging-card-transactions/get-flash-report', 'ChargingController@getFlashReport')
            ->middleware('can:charging-card-transaction-browse');
        Route::post('/charging-card-transactions/get-tt-transaction', 'ChargingController@getTtTransaction')
            ->middleware('can:charging-card-transaction-browse');
    });

    Route::group(['namespace' => 'PaymentLink', 'prefix' => 'payment-link'], function () {
        Route::get('overview', 'PaymentLinkController@overview')->name('plink.overview')->middleware('can:payment-link-overview');
        Route::get('overviewAjax', 'PaymentLinkController@overviewAjax')->name('plink.overview.ajax')->middleware('can:payment-link-overview');
        Route::get('transaction', 'PaymentLinkController@transactionList')->name('plink.transaction')->middleware('can:payment-link-transaction');
        Route::get('channel', 'PaymentLinkController@channelList')->name('plink.channel')->middleware('can:payment-link-channel');
        Route::get('customer', 'PaymentLinkController@customerList')->name('plink.customer')->middleware('can:payment-link-customer');
        Route::get('partner-list-ajax', 'PaymentLinkController@partnerList')->name('plink.partner_list_ajax')->middleware('can:payment-link-view');
    });

    Route::group(['namespace' => 'Game', 'prefix' => 'game'], function () {
        Route::get('overview', 'GameController@overview')->name('game.overview')->middleware('can:game-overview');
        Route::get('transactions', 'GameController@transaction')->name('game.transaction')->middleware('can:game-transaction');
        Route::get('settings', 'GameSettingController@settings')->name('game.setting')->middleware('can:game-setting');
        Route::post('setting/{id}/update', 'GameSettingController@update')->name('game.setting.update')->middleware('can:game-setting');
        Route::post('setting/{id}/approve', 'GameSettingController@settingApprove')->name('game.setting.approve')->middleware('can:game-setting');
        Route::post('setting/{id}/active', 'GameSettingController@settingActive')->name('game.setting.active')->middleware('can:game-setting');
        Route::get('partner-list-ajax', 'GameController@partnerList')->name('game.partner_list_ajax')->middleware('can:game-view');
        Route::get('applications', 'GameController@applications')->name('game.applications')->middleware('can:game-view');
    });

    Route::group(['namespace' => 'Partner', 'prefix' => 'partner'], function () {
        Route::get('bank-account', 'PartnerBankAccountController@accounts')->name('partner.bank-account')->middleware('can:partner-bank-account');
        Route::post('bank-account/{accountId}/delete', 'PartnerBankAccountController@accountDelete')->name('partner.bank-account.delete')->middleware('can:partner-bank-account');
        Route::post('bank-account/create', 'PartnerBankAccountController@accountCreate')->name('partner.bank-account.create')->middleware('can:partner-bank-account-create');
        Route::get('bank-account/make', 'PartnerBankAccountController@accountMake')->name('partner.bank-account.make')->middleware('can:partner-bank-account-make');
        Route::post('bank-account/make', 'PartnerBankAccountController@accountMakeSubmit')->name('partner.bank-account.make.submit')->middleware('can:partner-bank-account-make');
        Route::get('bank-account/partners', 'PartnerBankAccountController@partnerList')->name('partner.bank-account.partner_list')->middleware(['can:partner-section-view']);
        Route::get('bank-account/make/list-account', 'PartnerBankAccountController@accountListAjax')->name('partner.bank-account.account_list')->middleware('can:partner-bank-account-make');
        Route::post('bank-account/send-otp', 'AuthOtpController@sendOtp')->name('partner.bank-account.send-otp')->middleware('can:partner-bank-account-make');
        Route::get('bank-account/make/list', 'PartnerBankAccountController@accountMakeList')->name('partner.bank-account.make.list')->middleware('can:partner-bank-account-make-list');
        Route::post('bank-account/make/confirm-otp/{id}', 'AuthOtpController@confirmEmailOtp')->name('partner.bank-account.make.confirm')->middleware('can:partner-bank-account-make-list');
        Route::post('bank-account/make/resend-otp/{id}', 'AuthOtpController@resendEmailOtp')->name('partner.bank-account.make.confirm')->middleware('can:partner-bank-account-make-list');
        Route::post('bank-account/make/cancel/{id}', 'PartnerBankAccountController@cancelOrder')->name('partner.bank-account.make.confirm')->middleware('can:partner-bank-account-make-list');
        Route::get('partners', 'PartnerBankAccountController@partnerList');
    });

    Route::get('general-dashboard', [dashboard::class, 'index'])->name('dashboard.general.view')->middleware(['can:dashboard-all-view']);

    Route::group(['namespace' => 'System', 'prefix' => 'system'], function () {

        Route::get('transfer-logs', 'TransferLogController@index')->name('system.transfer.index')->middleware(['can:system-manager-view']);

        Route::get('transfer-list', 'TransferLogController@transactionList')->name('system.transfer.list')->middleware('can:transfer-transaction-log');
        Route::get('transfer-log/list-account', 'TransferLogController@logListAccount')->name('system.transfer.log.account')->middleware('can:transfer-transaction-log');
        Route::get('transfer-make', 'TransferLogController@transactionFormCreate')->name('system.transfer.make')->middleware('can:transfer-transaction-create');
        Route::post('transfer-make', 'TransferLogController@transactionFormSubmit')->name('system.transfer.make.submit')->middleware('can:transfer-transaction-create');
        Route::get('transfer-account/list', 'TransferAccountController@accountList')->name('system.transfer.account.list')->middleware('can:transfer-transaction-create');
        Route::post('transfer-send-otp', 'AuthOtpController@sendOtp')->name('system.transfer.send-otp')->middleware('can:transfer-transaction-create');
        Route::get('transfer-transaction', 'TransferTransactionController@index')->name('system.transfer.log.index')->middleware('can:transfer-transaction-view');
        Route::get('transfer-transaction-ajax', 'TransferTransactionController@transactionListAjax')->name('system.transfer.transaction.ajax')->middleware('can:transfer-transaction-view');
        Route::get('transfer/schedule/list-ajax', 'TransferScheduleLogController@scheduleLogListAjax')->middleware('can:transfer-transaction-log');
        Route::post('transfer/log/{logId}/set-state', 'TransferLogController@setStateJob')->middleware('can:transfer-transaction-log');
    });
    Route::group(['namespace' => 'Export', 'prefix' => 'export'], function () {
        Route::get('export-mix', 'ExportMixController@exportMix')->name('export.mix')->middleware('can:export-mix');
    });

    Route::namespace('Source')->group(function () {
        Route::get('/source/ajax/get-list-source-amount', 'SourceController@getSourceAmount');
    });

    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function () {
        Route::view('activities', 'activities.index')->name('activities');
    });
});
Route::get('send-test', 'System\AuthOtpController@sendOtpTest');


