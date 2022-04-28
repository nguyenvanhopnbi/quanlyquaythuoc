<?php

namespace App\Http\Livewire\Gate\Ebill;

use Livewire\Component;
use App\Connection\EbillConnection;
use Illuminate\Http\Request;

use App\Exports\BienBanDoiSoatVAExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Connection\PartnerConnection;

class BienBanDoiSoat extends Component
{

    protected $listeners = [
        'ExportBienBanDoiSoatVA' => 'ExportBienBanDoiSoatVA'
    ];

    public $idBienBan;

    public $soluonggiaodich;
    public $tongtien;
    public $dongiaphiGD;
    public $tongphi;
    public $sotiencongvaobalance;
    public $sotienchuyenkhoantructiepbenB;

    protected $startTime;
    protected $endTime;

    public function mount(Request $request){
        $this->idBienBan = $request->id;
    }

    public function render()
    {
        return view('livewire.gate.ebill.bien-ban-doi-soat', [
            'datalist' => $this->getList()
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
        if(!isset($this->idBienBan)){
            return;
        }
        else{
            $params['filter']['id'] = $this->idBienBan;
        }
        $params['pagination']['limit'] = 1;
        $datalist = EbillConnection::getListBienBanDoiSoatDetails($this->idBienBan);
        if(isset($datalist)){
            $datalist->log = json_decode($datalist->logs);
        }
        if(isset($datalist->log->logs->data->revenue->countTrans)){
                $this->soluonggiaodich = $datalist->log->logs->data->revenue->countTrans;
            }

            if(isset($datalist->sum_revenue)){
                $this->tongtien = $datalist->sum_revenue;
            }
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
            // dump($datalist);

            return $datalist;
    }


    public function ExportBienBanDoiSoatVA($id){
        return Excel::download(new BienBanDoiSoatVAExport($id), 'bienbandoisoat.xlsx');
    }
}
