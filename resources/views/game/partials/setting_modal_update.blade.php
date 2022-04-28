{{--<div class="modal fade show" id="modal-update" tabindex="-1" style="display: initial"--}}
     <div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="select-column-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="select-column-modal-label">Cập nhật game</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                @csrf
                <input name="id" type="hidden"/>
                <div class="modal-body" id="md-content">
                    <table class="table table-bordered table-striped" style="width: 100%">
                        <tbody>
                        <tr>
                            <th style="vertical-align: middle" width="30%">Tên game</th>
                            <td>
                                <input name="game_name" type="text" class="form-control" placeholder="Tên game"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle">URL lấy danh sách server</th>
                            <td>
                                <input name="server_url" type="text" class="form-control" placeholder="URL lấy danh sách server"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle">URL check nhân vật</th>
                            <td>
                                <input name="role_url" type="text" class="form-control" placeholder="URL check nhân vật"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle">URL lấy gói nạp</th>
                            <td>
                                <input name="package_url" type="text" class="form-control" placeholder="URL lấy gói nạp"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle">URL thông báo kết quả</th>
                            <td>
                                <input name="notify_url" type="text" class="form-control" placeholder="URL thông báo kết quả"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle">Trạng thái duyệt</th>
                            <td>
                                <select name="status" class="form-control">
                                    <option value="pending">Chờ duyệt</option>
                                    <option value="approved">Đồng ý duyệt</option>
                                    <option value="rejected">Từ chối</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle">Hoạt động</th>
                            <td>
                                <select name="active" class="form-control">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Tạm dừng</option>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnUpdateSubmit">Cập nhật</button>
                </div>
            </form>

        </div>
    </div>
</div>
