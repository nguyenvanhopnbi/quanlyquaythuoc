{{--<div class="modal fade show" id="modal-log" tabindex="-1" style="display: initial"--}}
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="select-column-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="select-column-modal-label">Chi tiết giao dịch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="md-content">
                <table class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                    <tr>
                        <th colspan="2" class="text-center">Thông tin tài khoản</th>
                        <th colspan="2" class="text-center">Thanh toán</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Partner code</th>
                        <td col="partner_code"></td>
                        <th>Partner ref ID</th>
                        <td col="partner_ref_id"></td>
                    </tr>
                    <tr>
                        <th>Tên tài khoản</th>
                        <td col="bank_account_name"></td>
                        <th>Biên bản đối soát ID</th>
                        <td col="bbds_id"></td>
                    </tr>
                    <tr>
                        <th>Số tài khoản</th>
                        <td col="bank_account_no"></td>
                        <th>Số tiền</th>
                        <td col="amount"></td>
                    </tr>
                    <tr>
                        <th>Loại tài khoản</th>
                        <td col="bank_account_type_text"></td>
                        <th>Trạng thái</th>
                        <td col="status_text"></td>
                    </tr>
                    <tr>
                        <th>Mã ngân hàng</th>
                        <td col="bank_code"></td>
                        <th>Ngày tạo</th>
                        <td col="created_at"></td>
                    </tr>
                    <tr>
                        <th>Chi nhánh</th>
                        <td col="bank_branch"></td>
                        <th>Nội dung</th>
                        <td col="content"></td>
                    </tr>
                    <tr>
                        <th>Người tạo</th>
                        <td col="creator"></td>
                        <th>Status Message</th>
                        <td col="status_message"></td>
                    </tr>
                    <tr>
                        <th>Người phê duyệt</th>
                        <td col="approver"></td>
                        <th>Thời gian duyệt</th>
                        <td col="approved_at"></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="align-items: baseline;">
                <div id="groupActive" class="mr-auto" style="width: 100%;display: flex;align-items: baseline;">
                    <button class="btn btn-danger" id="btnCancel" style="width: 210px">Từ chối thanh toán</button>
                    <button class="btn btn-primary ml-2" id="btnResend" style="width: 140px">Gửi lại OTP</button>
                    <div style="width: 100%">
                        <input class="form-control ml-2" style="width: 100%" name="code" placeholder="Nhập mã OTP nhận được từ email"/>
                    </div>
                </div>
                <div style="width: 190px;margin-left: 15px;">
                    <button class="btn btn-primary" id="formApprove">Xác nhận thanh toán</button>
                </div>
            </div>
        </div>
    </div>
</div>
