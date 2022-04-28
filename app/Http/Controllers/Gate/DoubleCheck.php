<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Connection\DoubleCheckConnection;

class DoubleCheck extends Controller
{

    public function getListEbillTransaction(){
        return view('gate.doublecheck.getListEbillTransaction');
    }
    public function index(){
        return view('gate.doublecheck.index');
    }

    public function ImportVAProvider(){
        return view('gate.doublecheck.ImportVAProvider');
    }

    public function ResendTransaction(){
        return view('gate.doublecheck.ResendTransaction');
    }

    public function RequestBankMoney(){
        return view('gate.doublecheck.RequestBankMoney');
    }

    public function ConfigEBillPartnerProvider(){
        return view('gate.doublecheck.ConfigEBillPartnerProvider');
    }

    public function ConfigEBillPartnerBankProvider(){
        return view('gate.doublecheck.ConfigEBillPartnerBankProvider');
    }

    // ConfigEBillPartnerBankProvider

    public function DoiSoatThuHovoiPartner(){
        return view('gate.doublecheck.DoiSoatThuHovoiPartner');
    }

    public function doisoatvoiPartner(){
        return view('gate.doublecheck.partner');
    }

    public function doisoatvoiprovider(){
        return view('gate.doublecheck.filedoisoatprovider');
    }

    public function confirmSchedule(){
        return view('gate.doublecheck.confirm-schedule-double-check');
    }

    public function doisoat(){
        return view('gate.doublecheck.doisoat');
    }

    public function bienbandoisoat(){
        return view('gate.doublecheck.bienbandoisoat');
    }

    public function exportcsv(Request $request){
        // dd($request->id);
        $data = $request->data;
        $begin = microtime(true);
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        header('Content-Type: application/json');
        header('Accept: application/json');
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));


            foreach($data['data'] as $key => $data){
                if(isset($data['application_name'])){
                    unset($data['application_name']);
                }
                if(isset($data['vendor_ref_id'])){
                    unset($data['vendor_ref_id']);
                }
                if($key == 0){
                    foreach($data as $title=>$content){
                        $this->tit[] = $title;
                    }
                    fputcsv($handle, $this->tit);
                }

                if(isset($data['request_time'])){
                    $data['request_time'] = date('d-m-Y', $data['request_time']);
                }
                if(isset($data['response_time'])){
                    $data['response_time'] = date('d-m-Y', $data['response_time']);
                }

                fputcsv($handle, $data);
            }


        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }
}
