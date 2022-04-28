@extends('index')
@section('page-header', 'Dashboard Topup')
@section('page-sub-header', 'Dashboard Topup')
@section('style')

@endsection
@section('content')
<input type="hidden" id="tab-now" value="dasboard-index">

<div class="row">
	<div class="col-xl-12">
		<!--begin:: Widgets/Tasks -->
		<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Thống kê nhanh trong ngày
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">
				<!--begin::Section-->
				<div class="kt-section">
					<div class="kt-section__content kt-wizard-v12__form">
						<form name="form-filter-transaction">
							<div class="row">
								<div class="col col-lg-2 col-xl-2">
									<label>Partner code</label>
									<select  class="form-control" type="text" name="partner_code" id="partner_code_flash"></select>
								</div>
								<div class="col col-lg-3 col-xl-2">
									<label for="exampleInputPassword1">Từ ngày (tháng/ngày/năm)</label>
									<!-- <input type="date" name="time-from" id="time-from-flash" value="{{ date('Y-m-d') }}" class="form-control"> -->
									<input type="text" name="time-from" id="time-from-flash"  value="{{ date('m/d/Y') }}"  class="form-control">
								</div>
								<div class="col col-lg-3 col-xl-2">
									<label for="exampleInputPassword1">Đến ngày (tháng/ngày/năm)</label>
									<!-- <input type="date" name="time-to" id="time-to-flash" value="{{ date('Y-m-d') }}" class="form-control"> -->
									<input type="text" name="time-to" id="time-to-flash"   value="{{ date('m/d/Y') }}" class="form-control">
								</div>
								<div class="col col-lg-3 col-xl-2" style="padding-top:25px;">
									<button class="btn btn-primary btn-get-flash-chart">Tìm kiếm</button>
								</div>
							</div>
						</form>
					</div>
					<input type="hidden" value="{{ date('m/d/Y') }}" id="day-now">
				</div>
				<div id="table_flash_report_holder">

				</div>
				<!--end::Section-->
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xl-12">
		<!--begin:: Widgets/Tasks -->
		<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Thống kê giao dịch theo ngày
					</h3>
				</div>
			</div>
			<div class="kt-portlet__head param-search-dash">
				<!-- <div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Tasks
					</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
					<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
						<li class="nav-item">
							<a class="nav-link btn-search-day active" data-toggle="tab" href="#" role="tab">
							Day
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link btn-search-month" data-toggle="tab" href="#" role="tab">
							Month
							</a>
						</li>
					</ul>
					</div> -->
				<div class="kt-portlet__body">
					<!--begin::Section-->
					<div class="kt-section">
						<div class="kt-section__content kt-wizard-v4__form">
						<form name="form-filter-transaction">
							<div class="row">
								<div class="col col-lg-2 col-xl-2">
									<label>Partner code</label>
									<select type="text" name="partner_code" id="partner_code_chart" class="form-control" aria-describedby="emailHelp" placeholder="Partner code"></select>
								</div>

								<div class="col col-lg-3 col-xl-2">
									<label for="exampleInputPassword1">Từ ngày (tháng/ngày/năm)</label>
									<input type="input" name="time-from" value="{{ date('m/1/Y') }}" id="time-from" class="form-control" >
								</div>
								<div class="col col-lg-3 col-xl-2">
									<label for="exampleInputPassword1">Đến ngày (tháng/ngày/năm)</label>
									<input type="input" name="time-to" value="{{ date('m/d/Y') }}" id="time-to" class="form-control" placeholder="time">
								</div>
								<div class="col col-lg-3 col-xl-2" style="padding-top:25px">
									<button class="btn btn-primary btn-get-chart">Tìm kiếm</button>
								</div>
							</div>
						</form>
						</div>
						<div class="row" style="padding-top:1%;">
							<div class="col col-lg-3 col-xl-2">
								<label for="exampleInputPassword1"><b>Tổng giao dịch:</b></label>
								<!-- <input type="text" class="form-control" value="0" id="count_transaction" disabled="true"> -->
								<b><label  id="count_transaction">0</label></b>

							</div>
							<div class="col col-lg-3 col-xl-2">
								<label for="exampleInputPassword1"><b>Tổng số tiền:</b></label>
								<!-- <input type="text" class="form-control" value="0" id="sum_transaction" disabled="true"> -->
								<b><label  id="sum_transaction">0</label></b>

							</div>
						</div>

					</div>
					<!--end::Section-->
				</div>
			</div>
			<div class="kt-portlet__body holder-chart-used-card">
				<canvas height="215" id="kt_chart_latest_updates" class="sales-overview-sales-report chartjs-render-monitor dash-board-used-card"  style="width: 100%;"></canvas>
			</div>
		</div>
	</div>
</div>
@endsection
<script>
    var partnerCode = "{{ request()->input('partner_code') }}";
    var bankCode = "{{ request()->input('bank_code') }}";
    var applicationId = "{{ request()->input('application_id') }}";
</script>
@section('script')
    <!--begin::Page Vendors(used by this page) -->


    <!--end::Page Vendors -->
    <script src="assets/js/pages/crud/forms/widgets/select2.js" type="text/javascript" defer></script>
    <script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript" defer></script>
    <script src="admin/js/pages/gate/topup-dashboard/index.js" type="text/javascript" defer></script>
@endsection
