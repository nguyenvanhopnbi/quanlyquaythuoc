{{--<div class="modal fade show" id="modal-log" tabindex="-1" style="display: initial"--}}
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="select-column-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="select-column-modal-label">Chi tiết Giao dịch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="md-content">
                <table class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                    <tr>
                        <th colspan="2" class="text-center">Thông tin giao dịch</th>
                        <th colspan="2" class="text-center">Thông tin thẻ nạp</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Mã giao dịch</th>
                        <td col="transactionId"></td>
                        <th>Tên Nhân vật</th>
                        <td col="role_name"></td>
                    </tr>
                    <tr>
                        <th>Partner Code</th>
                        <td col="partnerCode"></td>
                        <th>Mệnh giá</th>
                        <td col="package_name"></td>
                    </tr>
                    <tr>
                        <th>Số tiền</th>
                        <td col="amount"></td>
                        <th>Máy chủ</th>
                        <td col="server_name"></td>
                    </tr>
                    <tr>
                        <th>Order ID</th>
                        <td col="orderId"></td>
                        <th>Mô tả</th>
                        <td col="description"></td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td col="paymentMethod"></td>
                        <th>Thời gian tạo</th>
                        <td col="created_at"></td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td col="status"></td>
                        <th>User ID mua</th>
                        <td col="user_id"></td>
                    </tr>
                    <tr>
                        <th>Order ID</th>
                        <td col="orderId"></td>
                        <th>Error Code</th>
                        <td col="errorCode"></td>
                    </tr>
                    <tr>
                        <th>Đối tác đã xác nhận?</th>
                        <td col="is_notify"></td>
                        <th>Error Message</th>
                        <td col="message"></td>
                    </tr>
                    <tr>
                        <th>Số lần thông báo tới đối tác</th>
                        <td col="notify_times"></td>
                    </tr>
                    <tr>
                        <th>Kênh bán</th>
                        <td col="application_name"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
