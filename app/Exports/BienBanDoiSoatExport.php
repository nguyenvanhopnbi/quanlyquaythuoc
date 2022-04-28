<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Connection\DoubleCheckConnection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App\Services\Gate\PartnerPayGateConfigService;
use App\Transformers\PartnerPaygateConfigTransformer;
use App\Connection\PartnerConnection;

class BienBanDoiSoatExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $id;
    public function __construct($id){
        $this->id = $id;
    }

    public function getSoHopDong($partnerCode){
        $contractNumber = '';
        $params = [];
        $params['query']['partner_code'] = $partnerCode;
        $data = PartnerPayGateConfigService::getList($params);
        $data->data = PartnerPaygateConfigTransformer::transformCollection($data->data);
        if(isset($data->data)){
            foreach($data->data as $list){
                $contractNumber = $list->contract_number;
            }
        }
        return $contractNumber;
    }

    public function getPartnerCodeName($partnerCode){
        $partnerName = '';
        $params = [];
        $params['query']['partner_code'] = $partnerCode;
        $data = PartnerConnection::getList($params);
        // dd($data);
        if(isset($data->data)){
            foreach($data->data as $partner){
                $partnerName = $partner->name;
            }
        }

        return $partnerName;
    }
    public $partnerCode;
    public $startDate;
    public $endDate;
    public $NgayDoisoat;
    public $dataTableType2;

    public function view(): View
    {


        $params = [];
        if(isset($this->id)){
            $params['filter']['id'] = $this->id;
        }

        $data = DoubleCheckConnection::getList($params);
        if(isset($data->data)){
            $transactionList = $data->data;
            foreach($transactionList as $list){
                $j = json_decode($list->logs);
                // $json = Collection::make($j)->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                $list->logs = $j;
            }
        }

        $dataTableType2 = null;
        $dataTable = null;

        foreach($transactionList as $logs){


            $logs->logs->logs->dataCost->TongGiaTriGiaoDichThanhCong = $logs->sum_revenue;
            $logs->logs->logs->dataCost->TongGiaTriGiaoDichHoanTien = $logs->sum_refund;
            $logs->logs->logs->dataCost->TongGiaTriGiaoDichHold = $logs->sum_hold;
            $logs->logs->logs->dataCost->TongGiaTriGiaoDichUnHold = $logs->sum_unhold;

            $logs->logs->logs->dataCost->TongPhiBenAhuong = $logs->sum_cost;
            $logs->logs->logs->dataCost->TongBenAThanhToanBenB = $logs->sum_receive;



            $this->partnerCode = $logs->partner_code;
            $this->startDate = $logs->start_date;
            $this->endDate = $logs->end_date;
            $this->NgayDoisoat = $logs->date_perform_reconciliation;
            foreach($logs->logs as $log2){

                if(isset($log2->dataCost->ATM)){
                    $dataTableType2 = $log2->dataCost;
                }else{
                    if($log2 != 'system'){
                        $dataTable = $log2;
                    }
                }

            }
        }
        // dd($transactionList);

        return view('exports.bienbandoisoat', [
            'dataTable' => $dataTable,
            'dataTableType2' => $dataTableType2,
            'sohopdong' => $this->getSoHopDong($this->partnerCode),
            'partnerCode' => $this->partnerCode,
            'partnerName' => $this->getPartnerCodeName($this->partnerCode),
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'NgayDoisoat' => $this->NgayDoisoat
        ]);
    }


}
