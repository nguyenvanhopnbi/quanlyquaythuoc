<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Connection\HistoryRiskManagerConnection;

class riskManagementController extends Controller
{
    public function index(){
        return view('riskManagement.list');
    }
    public function ruleSpecial(){
        return view('riskManagement.ruleSpecial');
    }
    public function PartnerruleSpecial(){
        return view('riskManagement.PartnerSpecialRule');
    }
    public function ccAccountBypass(){
        return view('riskManagement.ccAccountBypass');
    }
    public function ruleRisk(){
        return view('riskManagement.ruleRisk');
    }
    public function historyManagement(){
        return view('riskManagement.historyManagement');
    }

    public function blacklistIP(){
        return view('riskManagement.blacklistIP');
    }

    public function ccPartnerBinCardAllow(){
        return view('riskManagement.ccPartnerBinCardAllow');
    }

    public function exportCSV(Request $request){

        $params = [];
        $params['pagination']['limit'] = 10000;
        $params['sort']['id'] = 'desc';

        if(isset($request->rule_code) && !empty($request->rule_code)){
            $params['filter']['rule_code'] = $request->rule_code;
        }
        if(isset($request->actionArray) && !empty($request->actionArray)){
            $params['filter']['like']['where']['action'] = $request->actionArray;
        }
        if(isset($request->startTime) && date($request->startTime)){
            $params['filter']['start_time'] = strtotime($request->startTime);
        }
        if(isset($request->endTime) && date($request->endTime)){
            $params['filter']['end_time'] = strtotime($request->endTime);
        }


        if(isset($request->transaction_id) && !empty($request->transaction_id)){
            $params['filter']['transaction_id'] = $request->transaction_id;
        }
        if(isset($request->card_number) && !empty($request->card_number)){
            $params['filter']['card_number'] = $request->card_number;
        }

        if(isset($request->order_id) && !empty($request->order_id)){
            $params['filter']['order_id'] = $request->order_id;
        }

        if(isset($request->card_name) && !empty($request->card_name)){
            $params['filter']['card_name'] = $request->card_name;
        }

        if(isset($request->ip) && !empty($request->ip)){
            $params['filter']['ip'] = $request->ip;
        }

        if(isset($request->amount) && !empty($request->amount)){
            $params['filter']['amount'] = $request->amount;
        }

        if(isset($request->partner_code) && !empty($request->partner_code)){
            $params['filter']['partner_code'] = $request->partner_code;
        }

        if(isset($request->vendor_code) && !empty($request->vendor_code)){
            $params['filter']['vendor_code'] = $request->vendor_code;
        }

        if(isset($request->bank_code) && !empty($request->bank_code)){
            $params['filter']['bank_code'] = $request->bank_code;
        }
        if(isset($request->transaction_status) && !empty($request->transaction_status)){
            $params['filter']['transaction_status'] = $request->transaction_status;
        }


        $dataHis = HistoryRiskManagerConnection::getList($params);

        if(!isset($dataHis->data) || empty($dataHis->data)){
            return;
        }
        $pages = $dataHis->meta->total_pages;
        // dd($dataHis);
        unset($dataHis);
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $begin = microtime(true);

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

        if($pages >= 1){
            for ($i=1; $i <= $pages ; $i++) {
                $params['pagination']['page'] = $i;
                $data = HistoryRiskManagerConnection::getList($params)->data;
                // dd($data);
                foreach($data as $key=>$data){

                    if($i == 1 && $key == 0){
                        foreach($data as $tit=>$content){
                            // if($tit == 'timestamp'){
                            //     $tit = 'Transaction Time';
                            // }
                            $title[] = $tit;
                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    // dd($data);
                    $data['time_request'] = date("Y-m-d H:i:s", $data['time_request']);
                    $data['time_response'] = date("Y-m-d H:i:s", $data['time_response']);
                    fputcsv($handle, $data);
                }

                event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::RISK_MANAGEMENT_EXPORT_HISTORY_MANAGEMENT, "Export CSV History risk management", compact('params')));

            }
        }

        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }
}
