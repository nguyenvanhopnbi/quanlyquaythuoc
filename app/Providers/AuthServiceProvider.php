<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    const GOD = [
        'tuanpm@appota.com',
        'hopnv1@appota.com',
        'thoantk@appota.com',
        'chidtk@appota.com',
        'xuantt@appotapay.com',
        'kimthoa971611@gmail.com'
    ];

    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return in_array($user->email, self::GOD) ? true : null;
        });

        Gate::define('paypal-list-register', fn (User $user) => $user->isAbleTo('paypal-list-register'));

        Gate::define('gate-partner-service-type-config', fn (User $user) => $user->isAbleTo('gate-partner-service-type-config'));

        Gate::define('qrcode-list', fn (User $user) => $user->isAbleTo('qrcode-list'));
        Gate::define('transfer-money-internal-money-transaction', fn (User $user) => $user->isAbleTo('transfer-money-internal-money-transaction'));

        Gate::define('ebill-ipn-logs-transaction-by-account', fn (User $user) => $user->isAbleTo('ebill-ipn-logs-transaction-by-account'));

        Gate::define('transfer-money-config-double-check-provider', fn (User $user) => $user->isAbleTo('transfer-money-config-double-check-provider'));

        Gate::define('dashboard-all-view', fn (User $user) => $user->isAbleTo('dashboard-all-view'));

        Gate::define('gate-vendor-token-list', fn (User $user) => $user->isAbleTo('gate-vendor-token-list'));

        Gate::define('am-user-manage', fn (User $user) => $user->isAbleTo('am-user-manage'));
        Gate::define('am-user-manage-add', fn (User $user) => $user->isAbleTo('am-user-manage-add'));
        Gate::define('am-user-manage-edit', fn (User $user) => $user->isAbleTo('am-user-manage-edit'));
        Gate::define('am-user-manage-delete', fn (User $user) => $user->isAbleTo('am-user-manage-delete'));
        Gate::define('am-user-manage-active', fn (User $user) => $user->isAbleTo('am-user-manage-active'));

        Gate::define('partner-browse', fn (User $user) => $user->isAbleTo('partner-browse'));
        Gate::define('partner-read', fn (User $user) => $user->isAbleTo('partner-read'));
        Gate::define('partner-edit', fn (User $user) => $user->isAbleTo('partner-edit'));
        Gate::define('partner-add', fn (User $user) => $user->isAbleTo('partner-add'));
        Gate::define('partner-delete', fn (User $user) => $user->isAbleTo('partner-delete'));

        Gate::define('resend-action-gate-transaction', fn (User $user) => $user->isAbleTo('resend-action-gate-transaction'));
        Gate::define('refund-action-gate-transaction', fn (User $user) => $user->isAbleTo('refund-action-gate-transaction'));
        Gate::define('hold-action-gate-transaction', fn (User $user) => $user->isAbleTo('hold-action-gate-transaction'));
        Gate::define('unhold-action-gate-transaction', fn (User $user) => $user->isAbleTo('unhold-action-gate-transaction'));


        Gate::define('partner-paygate-config-browse', fn (User $user) => $user->isAbleTo('partner-paygate-config-browse'));
        Gate::define('partner-paygate-config-edit', fn (User $user) => $user->isAbleTo('partner-paygate-config-edit'));
        Gate::define('partner-paygate-config-add', fn (User $user) => $user->isAbleTo('partner-paygate-config-add'));
        Gate::define('partner-paygate-config-delete', fn (User $user) => $user->isAbleTo('partner-paygate-config-delete'));

        Gate::define('partner-paygate-fee-config', fn (User $user) => $user->isAbleTo('partner-paygate-fee-config'));

        Gate::define('partner-payment-method-config', fn (User $user) => $user->isAbleTo('partner-payment-method-config'));




        Gate::define('partner-transaction-browse', fn (User $user) => $user->isAbleTo('partner-transaction-browse'));
        Gate::define('partner-transaction-read', fn (User $user) => $user->isAbleTo('partner-transaction-read'));
        Gate::define('partner-transaction-export', fn (User $user) => $user->isAbleTo('partner-transaction-export'));
        Gate::define('partner-application-browse', fn (User $user) => $user->isAbleTo('partner-application-browse'));
        Gate::define('partner-application-read', fn (User $user) => $user->isAbleTo('partner-application-read'));
        Gate::define('partner-application-edit', fn (User $user) => $user->isAbleTo('partner-application-edit'));
        Gate::define('partner-application-add', fn (User $user) => $user->isAbleTo('partner-application-add'));
        Gate::define('partner-application-delete', fn (User $user) => $user->isAbleTo('partner-application-delete'));


        Gate::define('partner-application-service-config-browse', fn (User $user) => $user->isAbleTo('partner-application-service-config-browse'));
        Gate::define('partner-application-service-config-edit', fn (User $user) => $user->isAbleTo('partner-application-service-config-edit'));
        Gate::define('partner-application-service-config-add', fn (User $user) => $user->isAbleTo('partner-application-service-config-add'));
        Gate::define('partner-application-service-config-delete', fn (User $user) => $user->isAbleTo('partner-application-service-config-delete'));


        Gate::define('partner-balance-browse', fn (User $user) => $user->isAbleTo('partner-balance-browse'));
        Gate::define('partner-balance-read', fn (User $user) => $user->isAbleTo('partner-balance-read'));
        Gate::define('partner-balance-edit', fn (User $user) => $user->isAbleTo('partner-balance-edit'));
        Gate::define('partner-balance-export', fn (User $user) => $user->isAbleTo('partner-balance-export'));

        Gate::define('partner-bank-account', fn (User $user) => $user->isAbleTo('partner-bank-account'));
        Gate::define('partner-bank-account-create', fn (User $user) => $user->isAbleTo('partner-bank-account-create'));
        Gate::define('partner-bank-account-make', fn (User $user) => $user->isAbleTo('partner-bank-account-make'));
        Gate::define('partner-bank-account-make-list', fn (User $user) => $user->isAbleTo('partner-bank-account-make-list'));

        Gate::define('partner-section-view', function (User $user) {
            $policies = collect([
                'partner-browse',
                'partner-read',
                'partner-edit',
                'partner-add',
                'partner-delete',
                'partner-paygate-config-browse',
                'partner-paygate-config-edit',
                'partner-paygate-config-add',
                'partner-paygate-config-delete',
                'partner-transaction-browse',
                'partner-transaction-read',
                'partner-application-browse',
                'partner-application-read',
                'partner-application-edit',
                'partner-application-add',
                'partner-application-delete',
                'partner-application-service-config-browse',
                'partner-application-service-config-edit',
                'partner-application-service-config-add',
                'partner-application-service-config-delete',
                'partner-balance-browse',
                'partner-balance-read',
                'partner-balance-add',
                'partner-balance-edit',
                'partner-bank-account',
                'partner-bank-account-create',
                'partner-bank-account-make',
                'partner-bank-account-make-list',
            ]);
            return $policies->contains(fn ($policy) => $user->isAbleTo($policy));
        });

        Gate::define('gate-money-dashboard-browse', fn (User $user) => $user->isAbleTo('gate-money-dashboard-browse'));
        Gate::define('gate-bank-browse', fn (User $user) => $user->isAbleTo('gate-bank-browse'));
        Gate::define('gate-bank-edit', fn (User $user) => $user->isAbleTo('gate-bank-edit'));
        Gate::define('gate-bank-add', fn (User $user) => $user->isAbleTo('gate-bank-add'));
        Gate::define('gate-bank-delete', fn (User $user) => $user->isAbleTo('gate-bank-delete'));
        Gate::define('gate-transaction-browse', fn (User $user) => $user->isAbleTo('gate-transaction-browse'));

        Gate::define('gate-bank-transactions-cross-check', fn (User $user) => $user->isAbleTo('gate-bank-transactions-cross-check'));

        Gate::define('gate-bank-transactions-hold', fn (User $user) => $user->isAbleTo('gate-bank-transactions-hold'));

        Gate::define('gate-bank-transactions-unhold', fn (User $user) => $user->isAbleTo('gate-bank-transactions-unhold'));


        Gate::define('gate-transaction-read', fn (User $user) => $user->isAbleTo('gate-transaction-read'));
        Gate::define('gate-transaction-export', fn (User $user) => $user->isAbleTo('gate-transaction-export'));
        Gate::define('gate-transaction-refund', fn (User $user) => $user->isAbleTo('gate-transaction-refund'));
        Gate::define('gate-transaction-refund-browse', fn (User $user) => $user->isAbleTo('gate-transaction-refund-browse'));
        Gate::define('gate-transaction-refund-read', fn (User $user) => $user->isAbleTo('gate-transaction-refund-read'));
        Gate::define('gate-transaction-refund-export', fn (User $user) => $user->isAbleTo('gate-transaction-refund-export'));
        Gate::define('gate-vendor-browse', fn (User $user) => $user->isAbleTo('gate-vendor-browse'));
        Gate::define('gate-vendor-edit', fn (User $user) => $user->isAbleTo('gate-vendor-edit'));
        Gate::define('gate-vendor-add', fn (User $user) => $user->isAbleTo('gate-vendor-add'));
        Gate::define('gate-vendor-delete', fn (User $user) => $user->isAbleTo('gate-vendor-delete'));

        Gate::define('gate-partner-bank-vendor-browse', fn (User $user) => $user->isAbleTo('gate-partner-bank-vendor-browse'));

        Gate::define('gate-partner-payment-method-vendor-config', fn (User $user) => $user->isAbleTo('gate-partner-payment-method-vendor-config'));


        Gate::define('gate-partner-bank-vendor-edit', fn (User $user) => $user->isAbleTo('gate-partner-bank-vendor-edit'));
        Gate::define('gate-partner-bank-vendor-add', fn (User $user) => $user->isAbleTo('gate-partner-bank-vendor-add'));
        Gate::define('gate-partner-bank-vendor-delete', fn (User $user) => $user->isAbleTo('gate-partner-bank-vendor-delete'));
        Gate::define('gate-partner-vendor-browse', fn (User $user) => $user->isAbleTo('gate-partner-vendor-browse'));
        Gate::define('gate-partner-vendor-edit', fn (User $user) => $user->isAbleTo('gate-partner-vendor-edit'));
        Gate::define('gate-partner-vendor-add', fn (User $user) => $user->isAbleTo('gate-partner-vendor-add'));
        Gate::define('gate-partner-vendor-delete', fn (User $user) => $user->isAbleTo('gate-partner-vendor-delete'));
        Gate::define('gate-ipn-log-browse', fn (User $user) => $user->isAbleTo('gate-ipn-log-browse'));
        Gate::define('gate-ipn-log-read', fn (User $user) => $user->isAbleTo('gate-ipn-log-read'));
        Gate::define('gate-money-audit-browse', fn (User $user) => $user->isAbleTo('gate-money-audit-browse'));
        Gate::define('gate-money-audit-read', fn (User $user) => $user->isAbleTo('gate-money-audit-read'));
        Gate::define('gate-money-audit-export', fn (User $user) => $user->isAbleTo('gate-money-audit-export'));
        Gate::define('gate-money-dashboard-export', fn (User $user) => $user->isAbleTo('gate-money-dashboard-export'));
        Gate::define('gate-section-view', function (User $user) {
            $policies = collect([
                'gate-money-dashboard-browse',
                'gate-bank-browse',
                'gate-bank-edit',
                'gate-bank-add',
                'gate-bank-delete',
                'gate-transaction-browse',
                'gate-transaction-read',
                'gate-transaction-refund-browse',
                'gate-transaction-refund-read',
                'gate-vendor-browse',
                'gate-vendor-edit',
                'gate-vendor-add',
                'gate-vendor-delete',
                'gate-partner-bank-vendor-browse',
                'gate-partner-bank-vendor-edit',
                'gate-partner-bank-vendor-add',
                'gate-partner-bank-vendor-delete',
                'gate-partner-vendor-browse',
                'gate-partner-vendor-edit',
                'gate-partner-vendor-add',
                'gate-partner-vendor-delete',
                'gate-ipn-log-browse',
                'gate-ipn-log-read',
                'gate-money-audit-browse',
                'gate-money-audit-read',
                'gate-money-dashboard-export',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });

        Gate::define('charging-card-transaction-dashboard-browse', fn (User $user) => $user->isAbleTo('charging-card-transaction-dashboard-browse'));
        Gate::define('charging-card-transaction-browse', fn (User $user) => $user->isAbleTo('charging-card-transaction-browse'));
        Gate::define('charging-card-transaction-read', fn (User $user) => $user->isAbleTo('charging-card-transaction-read'));
        Gate::define('charging-card-transaction-export', fn (User $user) => $user->isAbleTo('charging-card-transaction-export'));
        Gate::define('charging-card-transaction-section-view', function (User $user) {
            $policies = collect([
                'charging-card-transaction-dashboard-browse',
                'charging-card-transaction-browse',
                'charging-card-transaction-read',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });

        Gate::define('topup-dashboard-browse', fn (User $user) => $user->isAbleTo('topup-dashboard-browse'));
        Gate::define('topup-denomination-browse', fn (User $user) => $user->isAbleTo('topup-denomination-browse'));
        Gate::define('topup-denomination-edit', fn (User $user) => $user->isAbleTo('topup-denomination-edit'));
        Gate::define('topup-denomination-add', fn (User $user) => $user->isAbleTo('topup-denomination-add'));
        Gate::define('topup-denomination-delete', fn (User $user) => $user->isAbleTo('topup-denomination-delete'));
        Gate::define('topup-transaction-browse', fn (User $user) => $user->isAbleTo('topup-transaction-browse'));
        Gate::define('topup-transaction-read', fn (User $user) => $user->isAbleTo('topup-transaction-read'));
        Gate::define('topup-transaction-export', fn (User $user) => $user->isAbleTo('topup-transaction-export'));
        Gate::define('topup-transaction-refund', fn (User $user) => $user->isAbleTo('topup-transaction-refund'));
        Gate::define('topup-provider-config-browse', fn (User $user) => $user->isAbleTo('topup-provider-config-browse'));
        Gate::define('topup-provider-config-read', fn (User $user) => $user->isAbleTo('topup-provider-config-read'));
        Gate::define('topup-provider-config-edit', fn (User $user) => $user->isAbleTo('topup-provider-config-edit'));
        Gate::define('topup-provider-config-add', fn (User $user) => $user->isAbleTo('topup-provider-config-add'));
        Gate::define('topup-provider-config-delete', fn (User $user) => $user->isAbleTo('topup-provider-config-delete'));
        Gate::define('topup-telco-provider-browse', fn (User $user) => $user->isAbleTo('topup-telco-provider-browse'));
        Gate::define('topup-telco-provider-edit', fn (User $user) => $user->isAbleTo('topup-telco-provider-edit'));
        Gate::define('topup-telco-provider-add', fn (User $user) => $user->isAbleTo('topup-telco-provider-add'));
        Gate::define('topup-telco-provider-delete', fn (User $user) => $user->isAbleTo('topup-telco-provider-delete'));
        Gate::define('topup-discount-config-browse', fn (User $user) => $user->isAbleTo('topup-discount-config-browse'));
        Gate::define('topup-discount-config-edit', fn (User $user) => $user->isAbleTo('topup-discount-config-edit'));
        Gate::define('topup-discount-config-add', fn (User $user) => $user->isAbleTo('topup-discount-config-add'));
        Gate::define('topup-discount-config-delete', fn (User $user) => $user->isAbleTo('topup-discount-config-delete'));
        Gate::define('topup-section-view', function (User $user) {
            $policies = collect([
                'topup-dashboard-browse',
                'topup-transaction-browse',
                'topup-transaction-read',
                'topup-provider-config-browse',
                'topup-provider-config-read',
                'topup-provider-config-edit',
                'topup-provider-config-add',
                'topup-provider-config-delete',
                'topup-telco-provider-browse',
                'topup-telco-provider-edit',
                'topup-telco-provider-add',
                'topup-telco-provider-delete',
                'topup-discount-config-browse',
                'topup-discount-config-edit',
                'topup-discount-config-add',
                'topup-discount-config-delete',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });

        Gate::define('bill-service-category-browse', fn (User $user) => $user->isAbleTo('bill-service-category-browse'));
        Gate::define('bill-service-category-edit', fn (User $user) => $user->isAbleTo('bill-service-category-edit'));
        Gate::define('bill-service-category-add', fn (User $user) => $user->isAbleTo('bill-service-category-add'));
        Gate::define('bill-service-category-delete', fn (User $user) => $user->isAbleTo('bill-service-category-delete'));
        Gate::define('bill-service-browse', fn (User $user) => $user->isAbleTo('bill-service-browse'));
        Gate::define('bill-service-edit', fn (User $user) => $user->isAbleTo('bill-service-edit'));
        Gate::define('bill-service-add', fn (User $user) => $user->isAbleTo('bill-service-add'));
        Gate::define('bill-service-delete', fn (User $user) => $user->isAbleTo('bill-service-delete'));
        Gate::define('bill-transaction-browse', fn (User $user) => $user->isAbleTo('bill-transaction-browse'));
        Gate::define('bill-transaction-read', fn (User $user) => $user->isAbleTo('bill-transaction-read'));
        Gate::define('bill-provider-browse', fn (User $user) => $user->isAbleTo('bill-provider-browse'));
        Gate::define('bill-provider-edit', fn (User $user) => $user->isAbleTo('bill-provider-edit'));
        Gate::define('bill-provider-add', fn (User $user) => $user->isAbleTo('bill-provider-add'));
        Gate::define('bill-provider-delete', fn (User $user) => $user->isAbleTo('bill-provider-delete'));
        Gate::define('bill-provider-service-match-browse', fn (User $user) => $user->isAbleTo('bill-provider-service-match-browse'));
        Gate::define('bill-provider-service-match-edit', fn (User $user) => $user->isAbleTo('bill-provider-service-match-edit'));
        Gate::define('bill-provider-service-match-add', fn (User $user) => $user->isAbleTo('bill-provider-service-match-add'));
        Gate::define('bill-provider-service-match-delete', fn (User $user) => $user->isAbleTo('bill-provider-service-match-delete'));
        Gate::define('bill-section-view', function (User $user) {
            $policies = collect([
                'bill-service-category-browse',
                'bill-service-category-edit',
                'bill-service-category-add',
                'bill-service-category-delete',
                'bill-transaction-browse',
                'bill-transaction-read',
                'bill-provider-browse',
                'bill-provider-edit',
                'bill-provider-add',
                'bill-provider-delete',
                'bill-provider-service-match-browse',
                'bill-provider-service-match-edit',
                'bill-provider-service-match-add',
                'bill-provider-service-match-delete',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });

        Gate::define('shopcard-card-dashboard', fn (User $user) => $user->isAbleTo('shopcard-card-dashboard'));
        Gate::define('shopcard-card-dashboard-browse', fn (User $user) => $user->isAbleTo('shopcard-card-dashboard-browse'));
        Gate::define('shopcard-card-browse', fn (User $user) => $user->isAbleTo('shopcard-card-browse'));
        Gate::define('shopcard-card-edit', fn (User $user) => $user->isAbleTo('shopcard-card-edit'));
        Gate::define('shopcard-card-add', fn (User $user) => $user->isAbleTo('shopcard-card-add'));
        Gate::define('shopcard-card-delete', fn (User $user) => $user->isAbleTo('shopcard-card-delete'));
        Gate::define('shopcard-card-export', fn (User $user) => $user->isAbleTo('shopcard-card-export'));
        Gate::define('shopcard-card-item-browse', fn (User $user) => $user->isAbleTo('shopcard-card-item-browse'));
        Gate::define('shopcard-card-item-read', fn (User $user) => $user->isAbleTo('shopcard-card-item-read'));

        Gate::define('shopcard-card-item-add', fn (User $user) => $user->isAbleTo('shopcard-card-item-add'));

        // Code card
        Gate::define('shopcard-card-item-code-card', fn (User $user) => $user->isAbleTo('shopcard-card-item-code-card'));
        // End code card

        // start lottery
        Gate::define('lottery', fn (User $user) => $user->isAbleTo('lottery'));

        // end lottery


        // double check doi soat
        Gate::define('double-check-provider', fn (User $user) => $user->isAbleTo('double-check-provider'));

        // end double check doi soat

        // doi soat Ebill
        Gate::define('gate-ebill-cross-check', fn (User $user) => $user->isAbleTo('gate-ebill-cross-check'));
        Gate::define('gate-ebill-partner-va-fee', fn (User $user) => $user->isAbleTo('gate-ebill-partner-va-fee'));

        Gate::define('ebill-partner-va-fee', fn (User $user) => $user->isAbleTo('ebill-partner-va-fee'));
        Gate::define('ebill-partner-schedule-detail', fn (User $user) => $user->isAbleTo('ebill-partner-schedule-detail'));

        Gate::define('gate-ebill-partner-reconciliation-data', fn (User $user) => $user->isAbleTo('gate-ebill-partner-reconciliation-data'));
        // end doi soat Ebill

        Gate::define('shopcard-card-item-edit', fn (User $user) => $user->isAbleTo('shopcard-card-item-edit'));
        Gate::define('shopcard-card-item-export', fn (User $user) => $user->isAbleTo('shopcard-card-item-export'));
        Gate::define('shopcard-card-transaction-browse', fn (User $user) => $user->isAbleTo('shopcard-card-transaction-browse'));
        Gate::define('shopcard-card-transaction-read', fn (User $user) => $user->isAbleTo('shopcard-card-transaction-read'));
        Gate::define('shopcard-card-transaction-add', fn (User $user) => $user->isAbleTo('shopcard-card-transaction-add'));
        Gate::define('shopcard-card-transaction-export', fn (User $user) => $user->isAbleTo('shopcard-card-transaction-export'));
        Gate::define('shopcard-card-partner-card-data-browse', fn (User $user) => $user->isAbleTo('shopcard-card-partner-card-data-browse'));
        Gate::define('shopcard-card-partner-card-data-read', fn (User $user) => $user->isAbleTo('shopcard-card-partner-card-data-read'));
        Gate::define('shopcard-card-partner-card-data-export', fn (User $user) => $user->isAbleTo('shopcard-card-partner-card-data-export'));
        Gate::define('shopcard-card-discount-config-browse', fn (User $user) => $user->isAbleTo('shopcard-card-discount-config-browse'));
        Gate::define('shopcard-card-discount-config-edit', fn (User $user) => $user->isAbleTo('shopcard-card-discount-config-edit'));
        Gate::define('shopcard-card-discount-config-add', fn (User $user) => $user->isAbleTo('shopcard-card-discount-config-add'));
        Gate::define('shopcard-card-discount-config-delete', fn (User $user) => $user->isAbleTo('shopcard-card-discount-config-delete'));
        Gate::define('shopcard-card-report-create', fn (User $user) => $user->isAbleTo('shopcard-card-report-create'));
        Gate::define('shopcard-card-auto-import-card', fn (User $user) => $user->isAbleTo('shopcard-card-auto-import-card'));
        Gate::define('shopcard-card-auto-import-card-ajax-save-config', fn (User $user) => $user->isAbleTo('shopcard-card-auto-import-card-ajax-save-config'));
        Gate::define('shopcard-section-view', function (User $user) {
            $policies = collect([
                'shopcard-card-dashboard-browse',
                'shopcard-card-dashboard',
                'shopcard-card-browse',
                'shopcard-card-edit',
                'shopcard-card-add',
                'shopcard-card-delete',
                'shopcard-card-item-browse',
                'shopcard-card-item-read',
                'shopcard-card-item-add',
                'shopcard-card-item-browse',
                'shopcard-card-item-read',
                'shopcard-card-item-add',
                'shopcard-card-partner-card-data-browse',
                'shopcard-card-partner-card-data-read',
                'shopcard-card-discount-config-browse',
                'shopcard-card-discount-config-edit',
                'shopcard-card-discount-config-add',
                'shopcard-card-report-create',
                'shopcard-card-auto-import-card',
                'shopcard-card-auto-import-card-ajax-save-config',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });

        Gate::define('ebill-virtual-account-collect-money-browse', fn (User $user) => $user->isAbleTo('ebill-virtual-account-collect-money-browse'));
        Gate::define('ebill-virtual-account-collect-money-edit', fn (User $user) => $user->isAbleTo('ebill-virtual-account-collect-money-edit'));
        Gate::define('ebill-virtual-account-collect-money-add', fn (User $user) => $user->isAbleTo('ebill-virtual-account-collect-money-add'));
        Gate::define('ebill-virtual-account-collect-money-delete', fn (User $user) => $user->isAbleTo('ebill-virtual-account-collect-money-delete'));
        Gate::define('ebill-virtual-account-ebill-browse', fn (User $user) => $user->isAbleTo('ebill-virtual-account-ebill-browse'));

        Gate::define('ebill-virtual-account-manage-balance', fn (User $user) => $user->isAbleTo('ebill-virtual-account-manage-balance'));


        Gate::define('ebill-virtual-account-ebill-read', fn (User $user) => $user->isAbleTo('ebill-virtual-account-ebill-read'));
        Gate::define('ebill-virtual-account-ebill-transaction-browse', fn (User $user) => $user->isAbleTo('ebill-virtual-account-ebill-transaction-browse'));
        Gate::define('ebill-virtual-account-ebill-transaction-read', fn (User $user) => $user->isAbleTo('ebill-virtual-account-ebill-transaction-read'));
        Gate::define('ebill-virtual-account-virtual-account-browse', fn (User $user) => $user->isAbleTo('ebill-virtual-account-virtual-account-browse'));
        Gate::define('ebill-virtual-account-virtual-account-read', fn (User $user) => $user->isAbleTo('ebill-virtual-account-virtual-account-read'));
        Gate::define('ebill-virtual-account-section-view', function (User $user) {
            $policies = collect([
                'ebill-virtual-account-collect-money-browse',
                'ebill-virtual-account-collect-money-edit',
                'ebill-virtual-account-collect-money-add',
                'ebill-virtual-account-collect-money-delete',
                'ebill-virtual-account-ebill-browse',
                'ebill-virtual-account-ebill-read',
                'ebill-virtual-account-ebill-transaction-browse',
                'ebill-virtual-account-ebill-transaction-read',
                'ebill-virtual-account-virtual-account-browse',
                'ebill-virtual-account-virtual-account-read',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });

        // risk management
        Gate::define('risk-management-list', fn (User $user) => $user->isAbleTo('risk-management-list'));

        Gate::define('risk-management-list-rule-risk', fn (User $user) => $user->isAbleTo('risk-management-list-rule-risk'));

        Gate::define('risk-management-list-cc-acount-bypass', fn (User $user) => $user->isAbleTo('risk-management-list-cc-acount-bypass'));

        Gate::define('risk-management-list-cc-partner-bin-card-allow', fn (User $user) => $user->isAbleTo('risk-management-list-cc-partner-bin-card-allow'));

        Gate::define('risk-management-list-rule-splecial', fn (User $user) => $user->isAbleTo('risk-management-list-rule-splecial'));

        Gate::define('risk-management-list-partner-rule-splecial', fn (User $user) => $user->isAbleTo('risk-management-list-partner-rule-splecial'));

        Gate::define('risk-management-list-history', fn (User $user) => $user->isAbleTo('risk-management-list-history'));

        Gate::define('risk-management-list-blacklist-ip', fn (User $user) => $user->isAbleTo('risk-management-list-blacklist-ip'));



        // end risk management


        Gate::define('transfer-money-dashboard-browse', fn (User $user) => $user->isAbleTo('transfer-money-dashboard-browse'));

        Gate::define('transfer-money-transaction-browse', fn (User $user) => $user->isAbleTo('transfer-money-transaction-browse'));

        Gate::define('transfer-money-manage-balance', fn (User $user) => $user->isAbleTo('transfer-money-manage-balance'));

        Gate::define('transfer-money-transaction-read', fn (User $user) => $user->isAbleTo('transfer-money-transaction-read'));
        Gate::define('transfer-money-transaction-refund', fn (User $user) => $user->isAbleTo('transfer-money-transaction-refund'));
        Gate::define('transfer-money-transaction-export', fn (User $user) => $user->isAbleTo('transfer-money-transaction-export'));
        Gate::define('transfer-money-provider-browse', fn (User $user) => $user->isAbleTo('transfer-money-provider-browse'));
        Gate::define('transfer-money-provider-read', fn (User $user) => $user->isAbleTo('transfer-money-provider-read'));
        Gate::define('transfer-money-provider-edit', fn (User $user) => $user->isAbleTo('transfer-money-provider-edit'));
        Gate::define('transfer-money-provider-add', fn (User $user) => $user->isAbleTo('transfer-money-provider-add'));
        Gate::define('transfer-money-provider-delete', fn (User $user) => $user->isAbleTo('transfer-money-provider-delete'));
        Gate::define('transfer-money-config-browse', fn (User $user) => $user->isAbleTo('transfer-money-config-browse'));
        Gate::define('transfer-money-config-edit', fn (User $user) => $user->isAbleTo('transfer-money-config-edit'));
        Gate::define('transfer-money-config-add', fn (User $user) => $user->isAbleTo('transfer-money-config-add'));
        Gate::define('transfer-money-config-delete', fn (User $user) => $user->isAbleTo('transfer-money-config-delete'));
        Gate::define('transfer-money-check-account-transaction-browse', fn (User $user) => $user->isAbleTo('transfer-money-check-account-transaction-browse'));
        Gate::define('transfer-money-check-account-transaction-export', fn (User $user) => $user->isAbleTo('transfer-money-check-account-transaction-export'));

        Gate::define('transfer-money-section-view', function (User $user) {
            $policies = collect([
                'transfer-money-dashboard-browse',
                'transfer-money-transaction-browse',
                'transfer-money-transaction-read',
                'transfer-money-provider-browse',
                'transfer-money-provider-read',
                'transfer-money-provider-edit',
                'transfer-money-provider-add',
                'transfer-money-config-browse',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });

        Gate::define('user-browse', fn (User $user) => $user->isAbleTo('user-browse'));
        Gate::define('user-edit', fn (User $user) => $user->isAbleTo('user-edit'));
        Gate::define('role-browse', fn (User $user) => $user->isAbleTo('role-browse'));
        Gate::define('role-edit', fn (User $user) => $user->isAbleTo('role-edit'));
        Gate::define('role-add', fn (User $user) => $user->isAbleTo('role-add'));
        Gate::define('role-delete', fn (User $user) => $user->isAbleTo('role-delete'));
        Gate::define('permission-browse', fn (User $user) => $user->isAbleTo('permission-browse'));
        Gate::define('permission-edit', fn (User $user) => $user->isAbleTo('permission-edit'));
        Gate::define('permission-add', fn (User $user) => $user->isAbleTo('permission-add'));
        Gate::define('permission-delete', fn (User $user) => $user->isAbleTo('permission-delete'));
        Gate::define('security-section-view', function (User $user) {
            $policies = collect([
                'user-browse',
                'user-edit',
                'role-browse',
                'role-edit',
                'role-add',
                'role-delete',
                'permission-browse',
                'permission-edit',
                'permission-add',
                'permission-delete',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });


        Gate::define('ebill-ipn-logs-browse', fn (User $user) => $user->isAbleTo('ebill-ipn-logs-browse'));
        Gate::define('ebill-ipn-logs-browse-tool-create-transaction', fn (User $user) => $user->isAbleTo('ebill-ipn-logs-browse-tool-create-transaction'));


        Gate::define('ebill-ipn-logs-read', fn (User $user) => $user->isAbleTo('ebill-ipn-logs-read'));
        Gate::define('ebill-ipn-logs-section-view', function (User $user) {
            $policies = collect([
                'ebill-ipn-logs-browse',
                'ebill-ipn-logs-read',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });

        Gate::define('ebill-dashboard-browse', fn (User $user) => $user->isAbleTo('ebill-dashboard-browse'));
        Gate::define('ebill-dashboard-view', function (User $user) {
            $policies = collect([
                'ebill-dashboard-browse',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });

        Gate::define('activity-browse', fn (User $user) => $user->isAbleTo('activity-browse'));

        Gate::define('viewHorizon', function ($user) {
            return in_array($user->email, [
                'thoantk@appota.com',
            ]);
        });

        Gate::define('transfer-transaction-log', fn (User $user) => $user->isAbleTo('transfer-transaction-log'));
        Gate::define('transfer-transaction-view', fn (User $user) => $user->isAbleTo('transfer-transaction-view'));
        Gate::define('transfer-transaction-create', fn (User $user) => $user->isAbleTo('transfer-transaction-create'));
        Gate::define('system-manager-view', function (User $user) {
            $policies = collect([
                'transfer-transaction-log',
                'transfer-transaction-view',
                'transfer-transaction-create',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });
        Gate::define('payment-link-overview', fn (User $user) => $user->isAbleTo('payment-link-overview'));
        Gate::define('payment-link-transaction', fn (User $user) => $user->isAbleTo('payment-link-transaction'));

        Gate::define('payment-link-channel', fn (User $user) => $user->isAbleTo('payment-link-channel'));

        Gate::define('payment-link-customer', fn (User $user) => $user->isAbleTo('payment-link-customer'));
        Gate::define('payment-link-view', function (User $user) {
            $policies = collect([
                'payment-link-overview',
                'payment-link-transaction',
                'payment-link-channel',
                'payment-link-customer',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });

        Gate::define('game-overview', fn (User $user) => $user->isAbleTo('game-overview'));
        Gate::define('game-transaction', fn (User $user) => $user->isAbleTo('game-transaction'));
        Gate::define('game-setting', fn (User $user) => $user->isAbleTo('game-setting'));
        Gate::define('game-view', function (User $user) {
            $policies = collect([
                'game-overview',
                'game-transaction',
                'game-setting',
            ]);
            return $policies->contains(fn ($policy) => $user->can($policy));
        });
        Gate::define('export-mix', fn (User $user) => $user->isAbleTo('export-mix'));

    }
}
