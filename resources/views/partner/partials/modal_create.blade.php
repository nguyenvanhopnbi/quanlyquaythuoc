{{--<div class="modal fade show" id="modal-create" tabindex="-1" style="display: initial"--}}
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="select-column-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="select-column-modal-label">Thêm tài khoản ngân hàng</h5>
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
                            <th style="vertical-align: middle">Partner</th>
                            <td>
                                <select name="partner_code" class="form-control" id="modalPartnerCode" style="width: 100%">
                                    <option value="">- Partner -</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle">Hình thức chuyển khoản</th>
                            <td>
                                <select name="bank_account_type" class="form-control select2_default" style="width: 100%">
                                    <option value="">- Loại tài khoản -</option>
                                    <option value="account">Số tài khoản</option>
                                    <option value="card">Số thẻ</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle">Mã ngân hàng</th>
                            <td>
                                <select name="bank_code" class="form-control select2_default" style="width: 100%">
                                    <option value="">- Ngân hàng -</option>
                                    @foreach($banks as $bankCode => $text)
                                        <option value="{{$bankCode}}">{{$text}} - {{$bankCode}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle">Số tài khoản/Số thẻ</th>
                            <td>
                                <input name="bank_account_no" type="text" class="form-control" placeholder="Số tài khoản/Số thẻ"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle">Chi nhánh</th>
                            <td>
                                <input name="bank_branch" type="text" class="form-control" placeholder="Chi nhánh"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle" width="30%">Tên chủ tài khoản</th>
                            <td>
                                <input name="bank_account_name" type="text" class="form-control" placeholder="Tên tài khoản"/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnCreateSubmit">Thêm</button>
                </div>
            </form>

        </div>
    </div>
</div>
