<div>
    {{-- In work, do what you enjoy. --}}
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Danh sách partner
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="dropdown dropdown-inline">
                        <a href="/partner-partners/add" class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Thêm Provider</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <main class="flex-column d-flex">
                <div class="block">
                    <div class="block-header">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <input type="text" class="form-control ipt-search" placeholder="Tìm kiếm theo ID hoặc tên nhà cung cấp" />
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-append date text-12" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                                <input class="form-control text-12" size="16" type="text" value="12-02-2012">
                                                <span class="add-on"></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="dropdown filterStatus" data-bs-toggle="cust_dropdown" data-bs-target="#payment_link_status">
                                                <button class="form-control dropdown-toggle text-12" type="button" id="filterStatus" data-bs-toggle="dropdown" aria-expanded="false">
                                                 Trạng thái
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="filterStatus" id="payment_link_status">
                                                  <li><a class="dropdown-item active" href="javascript:void(0);"><input type="radio" name="payment_filter" id="status_approved" value="1" /><label for="status_approved"><span class="text_filter">Tất cả</span></label></a></li>
                                                  <li><a class="dropdown-item" href="javascript:void(0);"><input type="radio" name="payment_filter" id="status_pending" value="2"  /><label for="status_pending"><span class="text_filter">Mới tạo</span></label></a></li>
                                                  <li><a class="dropdown-item" href="javascript:void(0);"><input type="radio" name="payment_filter" id="status_done" value="3"  /><label for="status_done"><span class="text_filter">Hoàn tất</span></label></a></li>
                                                  <li><a class="dropdown-item" href="javascript:void(0);"><input type="radio" name="payment_filter" id="status_cancel" value="4"  /><label for="status_cancel"><span class="text_filter">Đã hủy</span></label></a></li>
                                                  <li><a class="dropdown-item" href="javascript:void(0);"><input type="radio" name="payment_filter" id="status_expired" value="5"  /><label for="status_expired"><span class="text_filter">Hết hạn</span></label></a></li>
                                                </ul>
                                              </div>
                                        </div>


                                        <div class="col">
                                            <div class="d-grid">
                                                <button class="btn btn-success">Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                    </div>

                    <div class="block-content mt-3">
                        <div class="table-responsive">
                            <table class="table" id="listTrans">
                                <thead>
                                    <tr>
                                    <th>ID nhà cung cấp</th>
                                    <th>Tên nhà cung cấp</th>
                                    <th>Phí áp dụng</th>
                                    <th>Phí</th>
                                    <th>Ngày khởi tạo</th>
                                    <th>Trạng thái</th>
                                    <th class="dt-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dump($listProviderLottery) --}}
                                    @if(isset($listProviderLottery))
                                    @foreach($listProviderLottery as $list)
                                    <tr>
                                        <td><a href="#" data-bs-target="#transDetail" data-bs-toggle="offcanvas">{{$list->id}}</a></td>
                                        <td>
                                            <div class="ncc">
                                                <div class="ncc_img">
                                                    <img src="{{asset('Lottery/assets/images/ncc/ncc_1.png')}}" class="img-fluid" />
                                                </div>
                                                <div class="ncc_name">
                                                    {{$list->name}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{($list->isApply)?"Toàn bộ vé":"Từng loại vé"}}</td>
                                        <td>{{(isset($list->defaultCommission))?$list->defaultCommission:'0'}}%</td>
                                        <td>{{$list->created_at}}</td>
                                        <td><span class="badge badge-light-green">{{(isset($list->status))?$list->status:'no status'}}</span></td>
                                        <td class="dt-center">
                                            <a href="#">
                                              <i class="ic-edit"></i>
                                            </a>
                                          </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    {{-- <tr>
                                        <td><a href="#" data-bs-target="#transDetail" data-bs-toggle="offcanvas">#DS231312</a></td>
                                        <td>
                                            <div class="ncc">
                                                <div class="ncc_img">
                                                    <img src="{{asset('Lottery/assets/images/ncc/ncc_1.png')}}" class="img-fluid" />
                                                </div>
                                                <div class="ncc_name">
                                                    Xổ số kiến thiết
                                                </div>
                                            </div>
                                        </td>
                                        <td>Từng loại vé</td>
                                        <td>5%</td>
                                        <td>22/10/2021</td>
                                        <td><span class="badge badge-light-gray">Chưa kích hoạt</span></td>
                                        <td class="dt-center">
                                            <a href="#">
                                              <i class="ic-edit"></i>
                                            </a>
                                          </td>
                                    </tr> --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
</div>
