<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\Gate\BankVendorTokenService;
use Carbon\Carbon;

class BankVendorTokenList extends Component
{
    public function render()
    {
        return view('livewire.bank-vendor-token-list');
    }

    public function exportCSV(Request $request){
        $req = $request->all();
        $limit = 100;
        $page = 1;
        $filter = [
            'page' => $page,
            'limit' => $limit,
            'partner_code' => $request->partnerCode,
            'bank_code' => $request->bank_code,
            'vendor_code' => $request->vendor_code,
            'status' => $request->status,
            'status_3ds' => $request->status_3ds,
            'card_number' => $request->card_number,
            'card_name' => $request->card_name,
            'card_type' => $request->card_type,
            'fd' => $request->startTime ? Carbon::createFromFormat('m/d/Y', $request->startTime)->startOfDay()->format('m/d/Y') : now()->subDays(30)->format('m/d/Y'),
            'td' => $request->endTime ? Carbon::createFromFormat('m/d/Y', $request->endTime)->endOfDay()->format('m/d/Y') : now()->format('m/d/Y'),
        ];

        $statuses = [
            '' => 'Tất cả',
            'active' => 'Active',
            'inactive' => 'Inactive'
        ];
        $statuses3ds = [
            '' => 'Tất cả',
            'true' => 'True',
            'false' => 'False'
        ];
        $data = [
            'filter' => $filter,
            'statuses' => $statuses,
            'statuses3ds' => $statuses3ds,
        ];

        $pages = 1;
        $dataList = BankVendorTokenService::bankTokenList($filter);
        if(isset($dataList['total'])){
            if($dataList['total'] < $dataList['limit']){
                $pages = 1;
            }else{
                $pages = ceil($dataList['total'] / $dataList['limit']);
            }
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        $begin = microtime(true);
        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        $title = [
            'ID',
            'Partner Code',
            'Order Partner Id',
            'Vendor Code',
            'Bank Code',
            'Token',
            'Vendor Token',
            'Card Name',
            'Card Issuer',
            'Card Number',
            'Card Scheme',
            'Card Type',
            'Card Date',
            'Status 3ds',
            'Status',
            'Created at',
            'Updated at'
        ];

        fputcsv($handle, $title);


        if($pages >= 1){
            for ($i=1; $i <= $pages ; $i++) {
                $filter['page'] = $i;
                $dataList = BankVendorTokenService::bankTokenList($filter);

                foreach($dataList['data'] as $data){
                    fputcsv($handle, $data);
                }

            }
        }

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }
}
