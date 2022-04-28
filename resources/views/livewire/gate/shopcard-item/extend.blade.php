<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <form id="kt_add_form">
        <div class="row">
            <div class="col-12 col-md-10 col-xl-8 mx-auto">
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-portlet__head--center progress-header" style="display:none">
                        <div class="col-md-4 col-lg-12 progress-create-card-item" style="margin-top:2%;">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <div class="kt-form">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-md-4 kt-align-left">
                                    <button type="button" class="btn btn-primary" wire:click="save">
                                        <i class="far fa-save"></i> Lưu dữ liệu
                                    </button>
                                </div>
                                <div class="col-md-8 kt-align-right">
                                    <a href="/file-temp/card-item-extend.txt" target="_blank" class="btn btn-outline-success">
                                        <i class="far fa-eye"></i> Xem mẫu
                                    </a>
                                    <label role="button" class="btn btn-success mb-0">
                                        <i class="fas fa-file-import"></i> Import dữ liệu
                                        <input type="file" class="d-none" wire:model="import"
                                            accept="text/plain, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                                    </label>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-4 col-lg-2 col-form-label text-right">
                                    Nhập danh sách thẻ
                                    <span class="kt-font-danger"><i class="fa fa-xs fa-star"></i></span>
                                </label>
                                <div class="col-8 col-lg-10">
                                    <textarea class="form-control" rows="20" wire:model.defer="data"
                                        placeholder="serial:expiry"></textarea>
                                    @error('data')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
