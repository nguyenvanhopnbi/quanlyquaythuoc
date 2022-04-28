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
                        <th colspan="2" class="text-center">Thông tin khách hàng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Mã giao dịch</th>
                        <td col="transactionId"></td>
                        <th>Tên KH</th>
                        <td col="customerName"></td>
                    </tr>
                    <tr>
                        <th>Partner Code</th>
                        <td col="partnerCode"></td>
                        <th>Email</th>
                        <td col="customerEmail"></td>
                    </tr>
                    <tr>
                        <th>Số tiền</th>
                        <td col="amount"></td>
                        <th>SDT</th>
                        <td col="customerPhone"></td>
                    </tr>
                    <tr>
                        <th>Bank Code</th>
                        <td col="bankCode"></td>
                        <th>Địa chỉ</th>
                        <td col="customerAddress"></td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td col="paymentMethod"></td>
                        <th colspan="2" class="text-center">Thời gian giao dịch</th>
                    </tr>
                    <tr>
                        <th>Vendor Code</th>
                        <td col="vendorCode"></td>
                        <th>Thời gian tạo</th>
                        <td col="requestTime"></td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td col="status"></td>
                        <th>Thời gian hết hạn</th>
                        <td col="expiredAt"></td>
                    </tr>
                    <tr>
                        <th>Order ID</th>
                        <td col="orderId"></td>
                        <th>Thời gian huỷ</th>
                        <td col="cancelledAt"></td>
                    </tr>
                    <tr>
                        <th>Error Code</th>
                        <td col="errorCode"></td>
                        <th colspan="2" class="text-center">Thông tin liên kết</th>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td col="message"></td>
                        <th>Link ID</th>
                        <td col="id"></td>
                    </tr>
                    <tr>
                        <th>Mô tả đơn hàng</th>
                        <td col="orderInfo" colspan="3"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
