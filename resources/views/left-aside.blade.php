<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="">
                <img alt="Logo" src="/logo_apay.svg" width="92px" />
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                fill="#000000" fill-rule="nonzero"
                                transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                            <path
                                d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                        </g>
                    </svg>
                </span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                fill="#000000" fill-rule="nonzero" />
                            <path
                                d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                        </g>
                    </svg>
                </span>
            </button>
            <!--
            <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
            -->
        </div>
    </div>
    <!-- end:: Aside -->
    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
            data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <x-layouts.aside.item :href="route('home')" :active="request()->routeIs('home')">
                    <x-slot name="icon">
                        <span class="kt-menu__link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                    <path
                                        d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>
                    </x-slot>
                    Trang chủ
                </x-layouts.aside.item>

                 @can('dashboard-all-view')
                    <x-layouts.aside.item :href="route('dashboard.general.view')"
                                                  :active="request()->is('general-dashboard')">
                        <x-slot name="icon">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon-analytics"></i>
                        </span>
                    </x-slot>
                                Tổng Quan Chung
                    </x-layouts.aside.item>
                @endcan



                @can('system-manager-view')
                    <x-layouts.aside.submenu title="Quản Lý Hệ Thống" :active="request()->is('system*')">
                        <x-slot name="icon">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-cube"></i>
                            </span>
                        </x-slot>
                        @can('system-manager-view')
                            <x-layouts.aside.item :href="route('system.transfer.index')"
                                                  :active="request()->is('system/transfer-logs')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Tool chuyển tiền nội bộ
                            </x-layouts.aside.item>
                        @endcan
                    </x-layouts.aside.submenu>
                @endcan

                @can('partner-section-view')
                    <x-layouts.aside.submenu title="Quản lý Partner" :active="request()->is('partner*')">
                        <x-slot name="icon">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-avatar"></i>
                            </span>
                        </x-slot>

                        @can('partner-browse')
                            <x-layouts.aside.item :href="route('gate.partner.list')"
                                :active="request()->is('partner-partners*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Danh Sách Partner
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-paygate-config-browse')
                            <x-layouts.aside.item :href="route('gate.partner.paygate.congfig.list')"
                                :active="request()->is('partner-paygate-config*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Cấu Hình Phí Cổng TT
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-transaction-browse')
                            <x-layouts.aside.item :href="route('gate.partner-transaction.list')"
                                :active="request()->is('partner-transactions*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Danh Sách Giao Dịch
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-application-browse')
                            <x-layouts.aside.item :href="route('gate.application.list')"
                                :active="request()->is('partner-applications*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Quản Lý Sản Phẩm
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-application-service-config-browse')
                            <x-layouts.aside.item :href="route('gate.application-service-config.list')"
                                :active="request()->is('partner-application-service-configs*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Quản Lý Cấu Hình Sản Phẩm
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-balance-browse')
                            <x-layouts.aside.item :href="route('gate.partner-balance.list')"
                                :active="request()->is('partner-balance*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Tool Cộng, Trừ Tiền partner
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-balance-browse')
                            <x-layouts.aside.item :href="route('gate.partner-payment-method.list')"
                                :active="request()->is('partner-payment-method*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Cấu hình chặn PTTT
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-balance-browse')
                            <x-layouts.aside.item :href="route('gate.partner-appota-service.list')"
                                :active="request()->is('partner-appota-service*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Partner Appota Service
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-business')
                            <x-layouts.aside.item :href="route('gate.partner-business')"
                                :active="request()->is('partner-business*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Partner Business
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-cooperate')
                            <x-layouts.aside.item :href="route('gate.partner-Cooperate')"
                                :active="request()->is('partner-co-operate*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Partner Cooperate
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-juridical')
                            <x-layouts.aside.item :href="route('gate.partner-Juridical')"
                                :active="request()->is('partner-juridical*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Partner Juridical
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-operate-status')
                            <x-layouts.aside.item :href="route('gate.partner-Operate')"
                                :active="request()->is('partner-operate-status*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Partner Operate Status
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-document-report')
                            <x-layouts.aside.item :href="route('gate.partner-document-report')"
                                :active="request()->is('partner-document-report*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Partner Document Report
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-document-time-response')
                            <x-layouts.aside.item :href="route('gate.partner-document-time-response')"
                                :active="request()->is('partner-document-time-response*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Partner Document Time Response
                            </x-layouts.aside.item>
                        @endcan



                        @can('partner-paygate-fee-config')
                            <x-layouts.aside.item :href="route('gate.partner-paygate-fee-config')"
                                :active="request()->is('partner-paygate-fee-config*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Partner Paygate Fee Config
                            </x-layouts.aside.item>
                        @endcan

                        @can('partner-bank-account')
                            <x-layouts.aside.item :href="route('partner.bank-account')"
                                                  :active="request()->is('partner/bank-account')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Danh sách tài khoản thanh toán
                            </x-layouts.aside.item>
                        @endcan
                        @can('partner-bank-account-make')
                            <x-layouts.aside.item :href="route('partner.bank-account.make')"
                                                  :active="request()->is('partner/bank-account/make')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Tạo yêu cầu thanh toán
                            </x-layouts.aside.item>
                        @endcan
                        @can('partner-bank-account-make-list')
                            <x-layouts.aside.item :href="route('partner.bank-account.make.list')"
                                                  :active="request()->is('partner/bank-account/make/list*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Danh sách lệnh chuyển tiền Partner
                            </x-layouts.aside.item>
                        @endcan

                    </x-layouts.aside.submenu>
                @endcan

                @can('gate-section-view')
                    <li class="kt-menu__item  {{ Request::is('gate*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Box2.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path
                                            d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z"
                                            fill="#000000"></path>
                                        <path
                                            d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z"
                                            fill="#000000" opacity="0.3"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="kt-menu__link-text">Dịch Vụ Cổng Thanh Toán</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        @can('gate-money-dashboard-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-money-dashboard*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.money.dashboard') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Tổng quan</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('gate-bank-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-banks*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.bank.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Ngân Hàng</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('gate-transaction-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">

                                    <li class="kt-menu__item {{ Request::is('gate-transactions*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.transaction.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Giao Dịch Ngân Hàng</span>
                                        </a>
                                    </li>


                                    <li class="kt-menu__item {{ Request::is('gate-bank-transactions-cross-check*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.transaction.list.cross.check') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh sách giao dịch thu hộ qua cổng thanh toán</span>
                                        </a>
                                    </li>

                                    <li class="kt-menu__item {{ Request::is('gate-bank-transactions-hold*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.transaction.list.hold') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Giao Dịch Ngân Hàng Hold</span>
                                        </a>
                                    </li>

                                    <li class="kt-menu__item {{ Request::is('gate-bank-transactions-unhold*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.transaction.list.unhold') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Giao Dịch Ngân Hàng UnHold</span>
                                        </a>
                                    </li>

                                    {{-- <li class="kt-menu__item {{ Request::is('gate-bank-transactions-Unhold*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.transaction.list.unhold') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Giao Dịch Ngân Hàng UnHold</span>
                                        </a>
                                    </li> --}}


                                </ul>
                            </div>
                        @endcan

                        @can('gate-transaction-refund-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-transaction-refund') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.transaction.refund.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Giao Dịch Ngân Hàng Refund</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('gate-vendor-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-vendor*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.bank-vendor.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Bank Vendor</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('gate-partner-bank-vendor-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-partner-bank-vendor*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.partner-bank-vendor.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Cấu Hình Bank Vendor Theo Partner</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('gate-partner-vendor-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-partner-vendor*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.partner-vendor.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Cấu Hình Vendor Theo Partner</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('gate-partner-payment-method-vendor-config')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-partner-payment-method-vendor-config*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.partner-bank-vendor.list.payment.method') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Cấu Hình Vendor Theo Payment Method</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('partner-payment-method-config')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-partner-payment-method-config*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.partner-payment-method-config') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Partner Payment Method Config</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        {{-- @can('partner-payment-method-config')
                            <x-layouts.aside.item :href="route('gate.partner-payment-method-config')"
                                :active="request()->is('partner-payment-method-config*')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Partner Payment Method Config
                            </x-layouts.aside.item>
                        @endcan --}}

                        @can('gate-ipn-log-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-ipn-log*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ipn-log.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">IPN Logs</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('gate-money-audit-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-money-audit*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.money.audit.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Đối Soát</span>
                                        </a>
                                    </li>

                                    {{-- Tool money transaction --}}
                                    <li class="kt-menu__item {{ Request::is('gate-money-tool-update-transaction*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.money.audit.toolUpdateTransaction') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Tool Cập Nhật Giao dịch</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                       {{--  @can('gate-vendor-token-list')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::routeIs('gate.bank_vendor.token.list') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.bank_vendor.token.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh sách Tokens</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan --}}


                        @can('gate-vendor-token-list')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-vendor-token-list*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.bank_vendor.token.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh sách Tokens</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('gate-partner-service-type-config')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('gate-partner-service-type-config*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.partner.service.type.config') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">List Partner Type Config</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                    </li>
                @endcan

                @can('charging-card-transaction-section-view')
                    <li class="kt-menu__item  {{ Request::is('charging-card*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa far fa-credit-card"></i>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="kt-menu__link-text">Dịch Vụ Charging</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        @can('charging-card-transaction-dashboard-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('charging-card-transaction/dashboard') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('charging.card.dashboard') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Tổng Quan</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('charging-card-transaction-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('charging-card-transactions') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('charging.card.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Giao Dịch Gạch Thẻ AC</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan


                        @can('charging-card-transaction-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('charging-card-sandbox-transactions') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('charging.card.sandbox.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Charging Sandbox Card</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                    </li>
                @endcan

                @can('topup-section-view')
                    <li class="kt-menu__item  {{ Request::is('topup*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-money-check-alt"></i>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="kt-menu__link-text">Dịch Vụ Topup</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        @can('topup-dashboard-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('topup-dashboard*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('topup.dashboard') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Tổng quan</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('topup-denomination-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('topup-denomination*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('topup.denomination.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Cấu Hình Mệnh Giá Topup </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('topup-transaction-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('topup-transactions*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('topup.transaction.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Giao Dịch</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('topup-provider-config-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('topup-provider-configs*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('topup.provider-config.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Cấu Hình Provider </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('topup-telco-provider-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('topup-telco-provider*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('topup.telco-provider.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Cấu Hình Dịch Vụ</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('topup-discount-config-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('topup-discount-config*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('topup.discount-config.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Cấu Hình Tỉ Lệ Chiết Khấu </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan
                    </li>
                @endcan

                @can('bill-section-view')
                    <li class="kt-menu__item  {{ Request::is('bill*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M3,4 L20,4 C20.5522847,4 21,4.44771525 21,5 L21,7 C21,7.55228475 20.5522847,8 20,8 L3,8 C2.44771525,8 2,7.55228475 2,7 L2,5 C2,4.44771525 2.44771525,4 3,4 Z M10,10 L20,10 C20.5522847,10 21,10.4477153 21,11 L21,13 C21,13.5522847 20.5522847,14 20,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L20,16 C20.5522847,16 21,16.4477153 21,17 L21,19 C21,19.5522847 20.5522847,20 20,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z"
                                            fill="#000000" />
                                        <rect fill="#000000" opacity="0.3" x="2" y="10" width="5" height="10" rx="1" />
                                    </g>
                                </svg>
                            </span>
                            <span class="kt-menu__link-text">Dịch Vụ TT Hóa Đơn</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                @can('bill-service-category-browse')
                                    <li class="kt-menu__item {{ Request::is('bill-service-dashboard*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('bill.serviceCategory.dashboard') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Tổng quan</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('bill-service-category-browse')
                                    <li class="kt-menu__item {{ Request::is('bill-service-category*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('bill.serviceCategory.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Mục Dịch Vụ</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('bill-service-browse')
                                    <li class="kt-menu__item {{ Request::is('bill-services*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('bill.service.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Dịch Vụ</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('bill-transaction-browse')
                                    <li class="kt-menu__item {{ Request::is('bill-transaction*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('bill.transaction.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Giao Dịch</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('bill-provider-browse')
                                    <li class="kt-menu__item {{ Request::is('bill-providers*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('bill.provider.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Provider</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('bill-provider-service-match-browse')
                                    <li class="kt-menu__item {{ Request::is('bill-provider-service-match*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('bill.providerServiceMatch.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Cấu Hình Dịch Vụ</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>

                    </li>
                @endcan

                @can('shopcard-card-browse')
                    <li class="kt-menu__item  {{ Request::is('shopcard-card*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-shopping-cart"></i>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="kt-menu__link-text">Dịch Vụ Bán Thẻ</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">

                                @can('shopcard-card-dashboard')
                                    <li class="kt-menu__item {{ Request::is('shopcard-card-dashboard*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('shopcard.dashboard') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Tổng quan</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('shopcard-card-browse')
                                    <li class="kt-menu__item {{ Request::is('shopcard-cards*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('shopcard.card.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Thẻ</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('shopcard-card-item-browse')
                                    <li class="kt-menu__item {{ Request::is('shopcard-card-items*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('shopcard.card-item.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Item Thẻ</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('shopcard-card-transaction-browse')
                                    <li class="kt-menu__item {{ Request::is('shopcard-card-transactions*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('shopcard.transaction.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Giao Dịch</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('shopcard-card-partner-card-data-browse')
                                    <li class="kt-menu__item {{ Request::is('shopcard-card-partner-card-data*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('shopcard.partner-card-data.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Thẻ Đã Bán</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('shopcard-card-partner-card-data-browse')
                                    <li class="kt-menu__item {{ Request::is('shopcard-card-provider-config*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('shopcard.providerConfig.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Shop card provider config</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('shopcard-card-discount-config-browse')
                                    <li class="kt-menu__item {{ Request::is('shopcard-card-discount-configs*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('shopcard.discount-config.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Cấu Hình Tỉ Lệ Chiết Khấu</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('shopcard-card-report-create')
                                    <x-layouts.aside.item :href="route('shopcard.report.create')"
                                        :active="request()->routeIs('shopcard.report.*')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Tạo báo cáo
                                    </x-layouts.aside.item>
                                @endcan

                                @can('shopcard-card-auto-import-card')
                                    <li class="kt-menu__item {{ Request::is('shopcard-card-auto-import-card*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('shopcard.auto-import-card.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">CONFIG AUTO IMPORT CARD ITEMS</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('shopcard-card-auto-import-card')
                                    <li class="kt-menu__item {{ Request::is('shopcard-card-auto-import-logs-card*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('shopcard.auto-import-card.list-logs') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Logs import cards items</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    @endcan
                    @can('ebill-virtual-account-section-view')
                    <li class="kt-menu__item  {{ Request::is('ebill-virtual-account*', 'ebill-dashboard*', 'ebill-ipn-logs*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Box2.svg-->
                                <i class="flaticon-profile"></i>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="kt-menu__link-text"> Dịch Vụ Thu Hộ Qua VA</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        @can('ebill-dashboard-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-dashboard*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill-dashboard') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Tổng quan</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('ebill-virtual-account-collect-money-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-virtual-account-collect-money*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.collect-money-partner.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Cấu Hình Provider</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('ebill-virtual-account-ebill-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-virtual-account-ebills*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Ebill</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('ebill-virtual-account-ebill-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-virtual-account-manage-balance*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill.manage.balance') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Quản lý số dư</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('ebill-virtual-account-ebill-transaction-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-virtual-account-ebill-transaction*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill-transaction.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Giao Dịch Ebill</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('ebill-virtual-account-virtual-account-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-virtual-account-virtual-account*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.virtual-account.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Virtual Account</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('ebill-ipn-logs-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-ipn-logs-trans*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill-ipn-logs.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Ebill Ipn Logs</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan


                        @can('ebill-ipn-logs-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-ipn-logs-partner-provider-config*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill-ipn-logs.ConfigEBillPartnerProvider') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">
                                                Cấu Hình Theo Partner, Provider
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('ebill-ipn-logs-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-ipn-logs-partner-bank-provider-config*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill-ipn-logs.ConfigEBillPartnerBankProvider') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">
                                                Cấu Hình Theo Partner, Bank, Provider
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan


                        @can('ebill-ipn-logs-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-ipn-logs-doisoat*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill-ipn-logs.doisoatthuhoavoipartner') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Đối soát thu hộ với Provider</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('ebill-ipn-logs-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-ipn-logs-request-back-money*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill-ipn-logs.RequestBankMoney') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">
                                            Tool Yêu Cầu Resend IPN GD Wooribank
                                        </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('ebill-ipn-logs-browse')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-ipn-logs-import-ebill-va-provider*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill-ipn-logs.ImportVAProvider') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">
                                            Tool Import Tài Khoản VA
                                        </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan


                        @can('ebill-ipn-logs-browse-tool-create-transaction')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-ipn-logs-ebill-resend-transaction*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill-ipn-logs.resend-transaction') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">
                                            Tool Tạo Giao Dịch
                                        </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan

                        @can('ebill-ipn-logs-transaction-by-account')
                            <div class="kt-menu__submenu ">
                                <span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item {{ Request::is('ebill-ipn-logs-transaction-by-account*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('gate.ebill-ipn-get.list.ebill-transaction') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">
                                            List Ebill Transaction By Account
                                        </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan






                    {{--     @can('doi-soat-thu-ho-partner')
                                    <x-layouts.aside.item :href="route('double-check.DoiSoatThuHovoiPartner')"
                                        :active="request()->routeIs('double-check.DoiSoatThuHovoiPartner')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Đối soát thu hộ với Partner
                                    </x-layouts.aside.item>
                                @endcan --}}

                    </li>
                @endcan
                {{-- begin --}}

                @can('transfer-money-section-view')
                    <li class="kt-menu__item  {{ Request::is('transfer-money-*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Box2.svg-->
                                <i class="flaticon-security"></i>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="kt-menu__link-text">Dịch Vụ Chi Hộ</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>



                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">

                                @can('transfer-money-dashboard-browse')
                                    <x-layouts.aside.item :href="route('transfer-money.dashboard')"
                                        :active="request()->routeIs('transfer-money.dashboard')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Tổng quan
                                    </x-layouts.aside.item>
                                @endcan

                                @can('transfer-money-transaction-browse')
                                    <li class="kt-menu__item {{ Request::is('transfer-money-transactions*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('transfer.money.transaction.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Quản Lý Giao Dịch</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('transfer-money-transaction-browse')
                                    <li class="kt-menu__item {{ Request::is('transfer-money-manage-balance*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('transfer.money.managebalance.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Quản Lý Số Dư</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('transfer-money-check-account-transaction-browse')
                                    <x-layouts.aside.item :href="route('transfer.money.check-account-transaction')"
                                        :active="request()->routeIs('transfer.money.check-account-transaction')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Giao Dịch Check Bank Info
                                    </x-layouts.aside.item>
                                @endcan

                                @can('transfer-money-provider-browse')
                                    <li class="kt-menu__item {{ Request::is('transfer-money-provider*') ? 'kt-menu__item--active' : '' }}"
                                        aria-haspopup="true">
                                        <a href="{{ route('transfer.money.provider.list') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Danh Sách Provider</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('transfer-money-config-browse')
                                    <x-layouts.aside.item :href="route('transfer.money.config')"
                                        :active="request()->routeIs('transfer.money.config')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Cấu hình phí
                                    </x-layouts.aside.item>
                                @endcan

                                @can('transfer-money-config-browse')
                                    <x-layouts.aside.item :href="route('transfer.money.config.update')"
                                        :active="request()->routeIs('transfer.money.config.update')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Tool Cập Nhật Giao Dịch
                                    </x-layouts.aside.item>
                                @endcan

                               @can('transfer-money-config-browse')
                                    <x-layouts.aside.item :href="route('transfer.money.config.partnerProvider')"
                                        :active="request()->routeIs('transfer.money.config.partnerProvider')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Cấu hình provider theo partner
                                    </x-layouts.aside.item>
                                @endcan

                                @can('transfer-money-config-browse')
                                    <x-layouts.aside.item :href="route('transfer.money.config.ebillBank')"
                                        :active="request()->routeIs('transfer.money.config.ebillBank')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Cấu Hình Theo Bank
                                    </x-layouts.aside.item>
                                @endcan

                                @can('transfer-money-config-browse')
                                    <x-layouts.aside.item :href="route('transfer.money.config.transferPartnerebillBank')"
                                        :active="request()->routeIs('transfer.money.config.transferPartnerebillBank')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Cấu Hình Theo Partner, Bank, Provider
                                    </x-layouts.aside.item>
                                @endcan


                                @can('transfer-money-config-double-check-provider')
                                    <x-layouts.aside.item :href="route('transfer.money.config.doisoatvoiprovider.list')"
                                        :active="request()->routeIs('transfer.money.config.doisoatvoiprovider.list')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Đối soát chi hộ với Provider
                                    </x-layouts.aside.item>
                                @endcan


                                @can('transfer-money-internal-money-transaction')
                                    <x-layouts.aside.item :href="route('transfer-money.TransferMoneyInternalTransaction')"
                                        :active="request()->routeIs('transfer-money.TransferMoneyInternalTransaction')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Log GD Chuyển Tiền Nội Bộ
                                    </x-layouts.aside.item>
                                @endcan

                                @can('transfer-money-config-browse')
                                    <x-layouts.aside.item :href="route('transfer-money.firmBankingIpnLogs')"
                                        :active="request()->routeIs('transfer-money.firmBankingIpnLogs')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Danh sách Ipn logs
                                    </x-layouts.aside.item>
                                @endcan


                               {{--  @can('transfer-money-config-browse')
                                    <x-layouts.aside.item :href="route('double-check.doisoatvoiprovider')"
                                        :active="request()->routeIs('double-check.doisoatvoiprovider')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        File đối soát Provider
                                    </x-layouts.aside.item>
                                @endcan --}}

                                {{-- @can('transfer-money-check-account-bank-browse')
                            <x-layouts.aside.item :href="route('transfer.money.check-account-bank')" :active="request()->routeIs('transfer.money.check-account-bank')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                TT Tài khoản
                            </x-layouts.aside.item>
                            @endcan --}}
                            </ul>
                        </div>
                    </li>
                @endcan


{{--
                @can('transfer-money-section-view')

                <li class="kt-menu__item  {{ Request::is('transfer-internal-money-transaction*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">

                    <x-layouts.aside.item :href="route('transfer-money.TransferMoneyInternalTransaction')"
                                        :active="request()->routeIs('transfer-money.TransferMoneyInternalTransaction')">
                        <x-slot name="icon">
                            <i style="font-size: 1.3rem; margin-right: 18px ;" class="flaticon-security"><span></span></i>
                        </x-slot>
                            Dịch vụ chuyển tiền nội bộ
                    </x-layouts.aside.item>
                </li>

                @endcan --}}

                @can('payment-link-view')
                    <x-layouts.aside.submenu title="Payment Link" :active="request()->is('p*')">
                        <x-slot name="icon">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-cube"></i>
                            </span>
                        </x-slot>
                        @can('payment-link-overview')
                            <x-layouts.aside.item :href="route('plink.overview')"
                                                  :active="request()->routeIs('plink.overview')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Tổng quan
                            </x-layouts.aside.item>
                        @endcan
                        @can('payment-link-transaction')
                            <x-layouts.aside.item :href="route('plink.transaction')"
                                                  :active="request()->routeIs('plink.transaction')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Quản lý giao dịch
                            </x-layouts.aside.item>
                        @endcan
                        @can('payment-link-channel')
                            <x-layouts.aside.item :href="route('plink.channel')"
                                                  :active="request()->routeIs('plink.channel')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Danh sách kênh bán
                            </x-layouts.aside.item>
                        @endcan
                        @can('payment-link-customer')
                            <x-layouts.aside.item :href="route('plink.customer')"
                                                  :active="request()->routeIs('plink.customer')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Danh sách khách hàng
                            </x-layouts.aside.item>
                        @endcan

                    </x-layouts.aside.submenu>
                @endcan
                @can('game-view')
                    <x-layouts.aside.submenu title="Nạp Game" :active="request()->is('game*')">
                        <x-slot name="icon">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-rocket"></i>
                            </span>
                        </x-slot>
                        @can('game-overview')
                            <x-layouts.aside.item :href="route('game.overview')"
                                                  :active="request()->routeIs('game.overview')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Tổng quan
                            </x-layouts.aside.item>
                        @endcan
                        @can('game-transaction')
                            <x-layouts.aside.item :href="route('game.transaction')"
                                                  :active="request()->routeIs('game.transaction')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Quản lý giao dịch
                            </x-layouts.aside.item>
                        @endcan
                        @can('game-setting')
                            <x-layouts.aside.item :href="route('game.setting')"
                                                  :active="request()->routeIs('game.setting')">
                                <x-slot name="icon">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                </x-slot>
                                Danh sách Game
                            </x-layouts.aside.item>
                        @endcan
                    </x-layouts.aside.submenu>
                @endcan

                {{-- risk management --}}
                @can('risk-management-list')
                    <li class="kt-menu__item  {{ Request::is('risk-management*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-list-2"></i>
                            </span>
                            <span class="kt-menu__link-text">Quản Trị Rủi Ro</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">

                                @can('risk-management-list')
                                    <x-layouts.aside.item :href="route('risk-management.list')"
                                        :active="request()->routeIs('risk-management.list')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Whitelist vs Blacklist
                                    </x-layouts.aside.item>
                                @endcan

                                @can('risk-management-list-rule-risk')
                                    <x-layouts.aside.item :href="route('risk-management.ruleRisk')"
                                        :active="request()->routeIs('risk-management.ruleRisk')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Rule Risk
                                    </x-layouts.aside.item>
                                @endcan

                                @can('risk-management-list-cc-acount-bypass')
                                    <x-layouts.aside.item :href="route('risk-management.cc-account-bypass')"
                                        :active="request()->routeIs('risk-management.cc-account-bypass')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        CC Acount Bypass
                                    </x-layouts.aside.item>
                                @endcan

                                @can('risk-management-list-cc-partner-bin-card-allow')
                                    <x-layouts.aside.item :href="route('risk-management.ccPartnerBinCardAllow')"
                                        :active="request()->routeIs('risk-management.ccPartnerBinCardAllow')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        CC Partner BinCard Allow
                                    </x-layouts.aside.item>
                                @endcan

                                @can('risk-management-list-rule-splecial')
                                    <x-layouts.aside.item :href="route('risk-rule-splecial.list')"
                                        :active="request()->routeIs('risk-rule-splecial.list')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Special Rule
                                    </x-layouts.aside.item>
                                @endcan

                                @can('risk-management-list-partner-rule-splecial')
                                    <x-layouts.aside.item :href="route('risk-partner-rule-splecial.list')"
                                        :active="request()->routeIs('risk-partner-rule-splecial.list')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Partner Special rule
                                    </x-layouts.aside.item>
                                @endcan

                                @can('risk-management-list-history')
                                    <x-layouts.aside.item :href="route('risk-management.historyManagement')"
                                        :active="request()->routeIs('risk-management.historyManagement')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Risk History Manager
                                    </x-layouts.aside.item>
                                @endcan
                                @can('risk-management-list-blacklist-ip')
                                    <x-layouts.aside.item :href="route('risk-management.blacklistIP')"
                                        :active="request()->routeIs('risk-management.blacklistIP')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Blacklist IP
                                    </x-layouts.aside.item>
                                @endcan

                            </ul>
                        </div>

                    </li>
                @endcan
                {{-- end risk management --}}



                {{-- @can('activity-browse')
                    <x-layouts.aside.item :href="route('double-check.list')" :active="request()->routeIs('double-check.list')">
                        <x-slot name="icon">
                            <span class="kt-menu__link-icon">
                                <i
                                class="flaticon-interface-1"></i>
                            </span>
                        </x-slot>
                        Đối soát
                    </x-layouts.aside.item>
                @endcan --}}

                {{-- start lottery --}}
                @can('lottery')
                    <li class="kt-menu__item  {{ Request::is('lottery-list*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-list-2"></i>
                            </span>
                            <span class="kt-menu__link-text">Lottery</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">


                                @can('lottery')
                                    <x-layouts.aside.item :href="route('lottery.list')"
                                        :active="request()->routeIs('lottery.list')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Lottery
                                    </x-layouts.aside.item>
                                @endcan

                                @can('lottery')
                                    <x-layouts.aside.item :href="route('lottery.list.win')"
                                        :active="request()->routeIs('lottery.list.win')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Danh sách trúng thưởng
                                    </x-layouts.aside.item>
                                @endcan

                                @can('lottery')
                                    <x-layouts.aside.item :href="route('lottery.list.provider')"
                                        :active="request()->routeIs('lottery.list.provider')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Provider
                                    </x-layouts.aside.item>
                                @endcan

                            </ul>
                        </div>

                    </li>
                @endcan
                {{-- end lottery --}}


                {{-- start qrCode --}}
                @can('qrcode-list')
                    <li class="kt-menu__item  {{ Request::is('qrcode-list*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-list-2"></i>
                            </span>
                            <span class="kt-menu__link-text">QrCode</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">


                                @can('qrcode-list')
                                    <x-layouts.aside.item :href="route('qrcode.list')"
                                        :active="request()->routeIs('qrcode.list')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Qrcode List
                                    </x-layouts.aside.item>
                                @endcan



                            </ul>
                        </div>

                    </li>
                @endcan
                {{-- end qrCode --}}


                {{-- start paypal --}}

                 @can('paypal-list-register')
                    <li class="kt-menu__item  {{ Request::is('paypal-list*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-list-2"></i>
                            </span>
                            <span class="kt-menu__link-text">Paypal</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">


                                @can('paypal-list-register')
                                    <x-layouts.aside.item :href="route('paypal.list.register')"
                                        :active="request()->routeIs('paypal.list.register')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Register
                                    </x-layouts.aside.item>
                                @endcan

                            </ul>
                        </div>

                    </li>
                @endcan

                {{-- end paypal --}}






                {{-- start doi soat --}}
                @can('double-check-provider')
                    <li class="kt-menu__item  {{ Request::is('cross-check*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-list-2"></i>
                            </span>
                            <span class="kt-menu__link-text">Đối soát cổng thanh toán</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">


                                @can('double-check-provider')
                                    <x-layouts.aside.item :href="route('double-check.list')"
                                        :active="request()->routeIs('double-check.list')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Danh sách đối soát
                                    </x-layouts.aside.item>
                                @endcan

                                @can('double-check-provider')
                                    <x-layouts.aside.item :href="route('double-check.confirm-schedule')"
                                        :active="request()->routeIs('double-check.confirm-schedule')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Lịch đối soát
                                    </x-layouts.aside.item>
                                @endcan


                                @can('double-check-provider')
                                    <x-layouts.aside.item :href="route('double-check.doisoatvoiPartner')"
                                        :active="request()->routeIs('double-check.doisoatvoiPartner')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Chu kỳ đối soát partner
                                    </x-layouts.aside.item>
                                @endcan

                               {{--  @can('doi-soat-thu-ho-partner')
                                    <x-layouts.aside.item :href="route('double-check.DoiSoatThuHovoiPartner')"
                                        :active="request()->routeIs('double-check.DoiSoatThuHovoiPartner')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Đối soát thu hộ với Partner
                                    </x-layouts.aside.item>
                                @endcan
 --}}

                            </ul>
                        </div>

                    </li>
                @endcan
                {{-- end doi soat --}}
                {{-- start doi soat Ebill --}}
                @can('gate-ebill-cross-check')
                    <li class="kt-menu__item  {{ Request::is('ebill-*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-list-2"></i>
                            </span>
                            <span class="kt-menu__link-text">Đối soát Ebill</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">


                                @can('gate-ebill-cross-check')
                                    <x-layouts.aside.item :href="route('gate.ebill.transaction.list.cross.check')"
                                        :active="request()->routeIs('gate.ebill.transaction.list.cross.check')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Chu kỳ đối soát dịch vụ thu hộ VA
                                    </x-layouts.aside.item>
                                @endcan

                                @can('ebill-partner-va-fee')
                                    <x-layouts.aside.item :href="route('gate.ebill.partner.va.fee')"
                                        :active="request()->routeIs('gate.ebill.partner.va.fee')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Cấu hình phí dịch vụ thu hộ VA
                                    </x-layouts.aside.item>
                                @endcan

                                @can('ebill-partner-schedule-detail')
                                    <x-layouts.aside.item :href="route('gate.ebill.partner.schedule.details')"
                                        :active="request()->routeIs('gate.ebill.partner.schedule.details')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Lịch đối soát thu hộ VA
                                    </x-layouts.aside.item>
                                @endcan


                                @can('gate-ebill-partner-reconciliation-data')
                                    <x-layouts.aside.item :href="route('gate.ebill.partner.va.reconciliation.data')"
                                        :active="request()->routeIs('gate.ebill.partner.va.reconciliation.data')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Danh sách đối soát thu hộ VA
                                    </x-layouts.aside.item>
                                @endcan

                            </ul>
                        </div>

                    </li>
                @endcan
                {{-- end doi soat ebill --}}

                @can('export-mix')
                    <x-layouts.aside.item :href="route('export.mix')" :active="request()->routeIs('export.mix')">
                        <x-slot name="icon">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-file"></i>
                            </span>
                        </x-slot>
                        Export DS đối soát
                    </x-layouts.aside.item>
                @endcan


                {{-- bao mat test --}}

                 @can('security-section-view')
                    <li class="kt-menu__item  {{ Request::is('permissions*') ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
                        aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon-map"></i>
                            </span>
                            <span class="kt-menu__link-text">Bảo mật</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>

                        <div class="kt-menu__submenu ">
                            <span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">


                                @can('user-browse')
                                    <x-layouts.aside.item :href="route('users.index')"
                                        :active="request()->routeIs('users.index')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Thành viên
                                    </x-layouts.aside.item>
                                @endcan

                                @can('role-browse')
                                    <x-layouts.aside.item :href="route('roles.index')"
                                        :active="request()->routeIs('roles.index')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Vai trò
                                    </x-layouts.aside.item>
                                @endcan

                                @can('permission-browse')
                                    <x-layouts.aside.item :href="route('permissions')"
                                        :active="request()->routeIs('permissions')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Quyền hạn
                                    </x-layouts.aside.item>
                                @endcan
                                {{-- am-user-manage --}}

                                @can('permission-browse')
                                    <x-layouts.aside.item :href="route('group-permissions')"
                                        :active="request()->routeIs('group-permissions')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Nhóm quyền
                                    </x-layouts.aside.item>
                                @endcan

                                @can('am-user-manage')
                                    <x-layouts.aside.item :href="route('user-am-manage')"
                                        :active="request()->routeIs('user-am-manage')">
                                        <x-slot name="icon">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                        </x-slot>
                                        Quản lý User AM
                                    </x-layouts.aside.item>
                                @endcan

                            </ul>
                        </div>

                    </li>
                @endcan
                {{-- end bao mat test --}}




                @can('activity-browse')
                    <x-layouts.aside.item :href="route('admin.activities')" :active="request()->routeIs('admin.activities')">
                        <x-slot name="icon">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon-calendar-with-a-clock-time-tools"></i>
                            </span>
                        </x-slot>
                        Lịch sử hoạt động
                    </x-layouts.aside.item>
                @endcan

            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>
