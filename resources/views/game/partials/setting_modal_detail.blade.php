{{--<div class="modal fade show" id="modal-log" tabindex="-1" style="display: initial"--}}
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="select-column-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="select-column-modal-label">Chi tiết game</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="md-content">
                <table class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                    <tr>
                        <th colspan="2" class="text-center">Thông tin chung</th>
                        <th colspan="2" class="text-center">Thông tin URL</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Game ID</th>
                        <td col="id"></td>
                        <th>URL lấy danh sách server</th>
                        <td col="server_url"></td>
                    </tr>
                    <tr>
                        <th>Tên game</th>
                        <td col="game_name"></td>
                        <th>URL check nhân vật</th>
                        <td col="role_url"></td>
                    </tr>
                    <tr>
                        <th>Partner Code</th>
                        <td col="partner_code"></td>
                        <th>URL lấy gói nạp</th>
                        <td col="package_url"></td>
                    </tr>
                    <tr>
                        <th>Hoạt động</th>
                        <td col="active_text"></td>
                        <th>URL thông báo kết quả</th>
                        <td col="notify_url"></td>
                    </tr>
                    <tr>
                        <th>Trạng thái duyệt</th>
                        <td col="status_text"></td>
                    </tr>
                    <tr>
                        <th>Thời gian tạo</th>
                        <td col="created_at"></td>

                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div id="groupActive" class="mr-auto">
                    <button class="btn btn-primary" data-value="1">Kích hoạt hoạt động</button>
                    <button class="btn btn-warning" data-value="0">Tạm dừng hoạt động</button>
                </div>
                <div id="groupApprove">
                    <button class="btn btn-danger" data-value="rejected">Từ chối duyệt</button>
                    <button class="btn btn-primary" data-value="approved">Chấp nhận xét duyệt</button>
                </div>
            </div>
        </div>
    </div>
</div>
