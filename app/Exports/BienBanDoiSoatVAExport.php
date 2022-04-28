<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Connection\EbillConnection;
use App\Connection\PartnerConnection;

class BienBanDoiSoatVAExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $id;
    public function __construct($id){
        $this->id = $id;
    }

    public $soluonggiaodich;
    public $tongtien;
    public $dongiaphiGD;
    public $tongphi;
    public $sotiencongvaobalance;
    public $sotienchuyenkhoantructiepbenB;


    public function view(): View
    {
        return view('exports.bienbandoisoatVA', [
            'datalist' => $this->getList(),
            'soluonggiaodich' => $this->soluonggiaodich,
            'tongtien' => $this->tongtien,
            'dongiaphiGD' => $this->dongiaphiGD,
            'tongphi' => $this->tongphi,
            'sotiencongvaobalance' => $this->sotiencongvaobalance,
            'sotienchuyenkhoantructiepbenB' => $this->sotienchuyenkhoantructiepbenB
        ]);
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

    public function getList(){
        $params = [];
        if(!isset($this->id)){
            return;
        }
        else{
            $params['filter']['id'] = $this->id;
        }
        $datalist = EbillConnection::getListBienBanDoiSoat($this->id);
        // dd($datalist);
        if(isset($datalist)){
            $datalist->log = json_decode($datalist->logs);
        }

        if(isset($datalist->log->logs->data->revenue->countTrans)){
                $this->soluonggiaodich = $datalist->log->logs->data->revenue->countTrans;
            }

            if(isset($datalist->sum_revenue)){
                $this->tongtien = $datalist->sum_revenue;
            }
            // if(isset($datalist->log->logs->data->fee->transFee)){
            //     $this->dongiaphiGD = $datalist->log->logs->data->fee->transFee;
            // }

            // if(isset($datalist->sum_cost)){
            //     $this->tongphi = $datalist->sum_cost;
            // }

            if(isset($datalist->log->logs->fee->raw->fee)){
                $dongiaphiGD = json_decode($datalist->log->logs->fee->raw->fee);
                $this->dongiaphiGD = $dongiaphiGD->feeTrans;
            }

            if(isset($datalist->log->logs->data->cost->transFee)){
                $this->tongphi = $datalist->log->logs->data->cost->transFee;
            }

            if(isset($datalist->sum_receive)){
                $this->sotiencongvaobalance = $datalist->sum_receive;
            }

            if(isset($datalist->log->logs->data->transfer_direct->totalAmount)){
                $this->sotienchuyenkhoantructiepbenB = $datalist->log->logs->data->transfer_direct->totalAmount;
            }

            $datalist->partnerName = $this->getPartnerCodeName($datalist->partner_code);

            return $datalist;
    }
}
