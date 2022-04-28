<?php

namespace App\Http\Controllers\Export;

use App\Services\System\TransferLogService;
use App\Transformers\System\TransferLogTransformer;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TransferLogExport
{
    private $filter;

    public function __construct(array $filter = [])
    {
        $this->filter = $filter;
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $this->filter['page'] = 1;
        $this->filter['limit'] = 100;
        $this->filter['get_transaction'] = true;
        $transferLogService = app(TransferLogService::class);
        $transactions = $transferLogService->transactionList(1, $this->filter['limit'], $this->filter);
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = now()->format('dmYHis') . '.csv';

        $lastPage = $transactions->lastPage();
        $header = [
            'ID',
            'Tên tài khoản chuyển',
            'Số tài khoản chuyển',
            'Mã ngân hàng tài khoản chuyển',
            'Tên tài khoản nhận',
            'Số tài khoản nhận',
            'Mã ngân hàng tài khoản nhận',
            'Tổng tiền',
            'Số tiền chuyển tối đa/1lần',
            'Số lần chuyển',
            'Số tiền đã chuyển',
            'Tần suất chuyển',
            'Trạng thái',
            'Hẹn lịch lúc',
            'Ngày tạo',
        ];
        $header2 = [
            'Lệnh ID',
            'Status',
            'Error Code',
            'Message',
            'amount',
            'transfer_amount',
            'appotapay_trans_id',
            'created_at',
        ];
        $sheet1Data = [];
        $sheet2Data = [];
        for ($i = 1; $i <= $lastPage; $i++) {
            $transactions = $transferLogService->transactionList($i, $this->filter['limit'], $this->filter);
            $data = $transactions->items();
            if (empty($data)) break;
            $data = TransferLogTransformer::convertAttributesForTable($data);

            foreach ($data as $key => $val) {
                $csv = [
                    $val['id'],
                    $val['account_name_from'],
                    "\t" . $val['account_no_from'],
                    $val['bank_code_from'],
                    $val['account_name_to'],
                    "\t" . $val['account_no_to'],
                    $val['bank_code_to'],
                    $val['total_amount'],
                    $val['amount_per_trans'],
                    $val['success_times'],
                    $val['amount_transferred_number'],
                    $val['schedule_type_text'],
                    $val['status_text'],
                    $val['schedule_at'],
                    $val['created_at'],
                ];
                if ($val->transactions->isNotEmpty()) {
                    foreach ($val->transactions as $key => $tran) {
                        $sheet2Data[] = [
                            $tran->transfer_log_id,
                            $tran->Status,
                            $tran->error_code,
                            $tran->message,
                            $tran->amount,
                            $tran->transfer_amount,
                            $tran->appotapay_trans_id,
                            $tran->created_at,
                        ];
                    }
                }
                $sheet1Data[] = $csv;
            }
        }

        $fileName = "Danh sách lệnh chuyển tiền nội bộ_' . $fileName . '.xlsx";
        $this->createExcel($spreadsheet, $sheet1Data, $header);
        $spreadsheet->createSheet(1)->setTitle('Giao dịch');
        $spreadsheet->setActiveSheetIndex(1);

        $sheet = $this->createExcel($spreadsheet, $sheet2Data, $header2);
        $spreadsheet->setActiveSheetIndex(0)->setTitle('Lệnh thanh toán');
        $sheet->download($spreadsheet, $fileName);
    }


    public function createExcel($spreadsheet, array $data, array $headers = [])
    {
        $sheet = $spreadsheet->getActiveSheet();

        for ($i = 0, $l = sizeof($headers); $i < $l; $i++) {
            $sheet->setCellValueByColumnAndRow($i + 1, 1, $headers[$i]);
        }

        for ($i = 0, $l = sizeof($data); $i < $l; $i++) { // row $i
            $j = 0;
            foreach ($data[$i] as $k => $v) { // column $j
                $sheet->setCellValueByColumnAndRow($j + 1, ($i + 1 + 1), $v);
                $j++;
            }
        }

        return $this;
    }

    public function download($spreadsheet, $fileName = 'data.xlsx')
    {
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($fileName) . '"');
        $writer->save('php://output');
    }

}
