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
                        <th colspan="2" class="text-center">Thông tin thẻ</th>
                        <th colspan="2" class="text-center">Thanh toán</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Partner code</th>
                        <td col="partner_code"></td>
                        <th>Order Partner ID</th>
                        <td col="order_partner_id"></td>
                    </tr>
                    <tr>
                        <th>Card name</th>
                        <td col="card_name"></td>
                        <th>Vendor code</th>
                        <td col="vendor_code"></td>
                    </tr>
                    <tr>
                        <th>Card issuer</th>
                        <td col="card_issuer"></td>
                        <th>Bank code</th>
                        <td col="bank_code"></td>
                    </tr>
                    <tr>
                        <th>Card number</th>
                        <td col="card_number"></td>
                        <th>Token</th>
                        <td col="token"></td>
                    </tr>
                    <tr>
                        <th>Card Scheme</th>
                        <td col="card_scheme"></td>
                        <th>Vendor token</th>
                        <td col="vendor_token"></td>
                    </tr>
                    <tr>
                        <th>Card type</th>
                        <td col="card_type"></td>
                        <th>Created at</th>
                        <td col="created_at"></td>
                    </tr>
                    <tr>
                        <th>Card date</th>
                        <td col="card_date"></td>
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Status 3ds</th>
                        <td col="status_3ds"></td>
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td col="status"></td>
                        <th></th>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
