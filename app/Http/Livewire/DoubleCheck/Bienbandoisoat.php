<?php

namespace App\Http\Livewire\DoubleCheck;

use Livewire\Component;
use App\Connection\DoubleCheckConnection;
use App\Connection\PartnerConnection;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Services\Gate\PartnerPayGateConfigService;
use App\Transformers\PartnerPaygateConfigTransformer;

use App\Exports\BienBanDoiSoatExport;
use Maatwebsite\Excel\Facades\Excel;

class Bienbandoisoat extends Component
{

    protected $listeners = [
        'ExportTransaction' => 'ExportTransaction',
        'ExportBienBanDoiSoat' => 'ExportBienBanDoiSoat'
    ];

    protected $transactionList;

    protected $dataTable;
    protected $dataTableType2;

    public function render()
    {
        $this->getList();
        $this->getPartnerCodeName($this->partnerCodeRequest);
        $this->getSoHopDong($this->partnerCodeRequest);
        return view('livewire.double-check.bienbandoisoat', [
            'transactionList' => $this->transactionList,
            'dataTable' => $this->dataTable,
            'dataTableType2' => $this->dataTableType2,
            'contractNumber' => $this->contractNumber
        ]);
    }

    public function ExportBienBanDoiSoat($id){
        return Excel::download(new BienBanDoiSoatExport($id), 'bienbandoisoat.xlsx');
    }


    protected $contractNumber = '';
    public function getSoHopDong($partnerCode){
        $params = [];
        $params['query']['partner_code'] = $partnerCode;
        $data = PartnerPayGateConfigService::getList($params);
        $data->data = PartnerPaygateConfigTransformer::transformCollection($data->data);
        if(isset($data->data)){
            foreach($data->data as $list){
                $this->contractNumber = $list->contract_number;
            }
        }
        // dd($this->contractNumber);
    }

    public $partnerName;
    public function getPartnerCodeName($partnerCode){
        $params = [];
        $params['query']['partner_code'] = $partnerCode;
        $data = PartnerConnection::getList($params);
        // dd($data);
        if(isset($data->data)){
            foreach($data->data as $partner){
                $this->partnerName = $partner->name;
            }
        }

        // dump($this->partnerName);
    }

    public $madoisoat;

    public $idString;

    public $limit = 10;

    public $partnerCodeRequest;

    public function mount(Request $request){
        $this->madoisoat = $request->id;
        $this->partnerCodeRequest = $request->partnerCode;
    }

    public function getList(){
        $params = [];
        $params['pagination']['limit'] = $this->limit;
        $params['pagination']['page'] = 1;

        if(isset($this->madoisoat)){
            $params['filter']['id'] = $this->madoisoat;
        }

        if(isset($this->partnerCode)){
            $params['filter']['partner_code'] = $this->partnerCode;
        }
        if(isset($this->status)){
            $params['filter']['status'] = $this->status;
        }
        if(isset($this->startTime)){
            $params['filter']['startTime'] = $this->startTime;
        }
        if(isset($this->endTime)){
            $params['filter']['endTime'] = $this->endTime;
        }


        $data = DoubleCheckConnection::getList($params);
        // dd($data);
        if(isset($data->data)){
            $this->transactionList = $data->data;
            foreach($this->transactionList as $list){
                $j = json_decode($list->logs);
                // $json = Collection::make($j)->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                $list->logs = $j;
            }
        }

        foreach($this->transactionList as $logs){


            if(isset($logs->logs->logs->total_count_trans)){
                $logs->logs->logs->dataCost->TongGiaoDichThanhCong = $logs->logs->logs->total_count_trans->revenue;
                $logs->logs->logs->dataCost->TongGiaoDichHoanTien = $logs->logs->logs->total_count_trans->refund;
                $logs->logs->logs->dataCost->TongGiaoDichHold = $logs->logs->logs->total_count_trans->hold;
                $logs->logs->logs->dataCost->TongGiaoDichUnHold = $logs->logs->logs->total_count_trans->un_hold;
                $logs->logs->logs->dataCost->TongGiaTriGiaoDichThanhCong = $logs->sum_revenue;
                $logs->logs->logs->dataCost->TongGiaTriGiaoDichHoanTien = $logs->sum_refund;
                $logs->logs->logs->dataCost->TongGiaTriGiaoDichHold = $logs->sum_hold;
                $logs->logs->logs->dataCost->TongGiaTriGiaoDichUnHold = $logs->sum_unhold;
                $logs->logs->logs->dataCost->TongPhiBenAhuong = $logs->sum_cost;
                $logs->logs->logs->dataCost->TongBenAThanhToanBenB = $logs->sum_receive;
            }

            foreach($logs->logs as $log2){
                if(isset($log2->dataCost->ATM)){
                    $this->dataTableType2 = $log2->dataCost;
                    return;
                }

                if($log2 != 'system'){
                    $this->dataTable = $log2;
                    return;
                }

            }
        }


    }

    public $tit;

    public function ExportTransaction($transactionID){
        $params = [];
        $params['ids'] = $transactionID;
        $params['ids'] = $params['ids'];
        $params['status'] = 'success';

        $data = DoubleCheckConnection::getListDataTransaction($params);

        $begin = microtime(true);
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        // header('Content-Type: application/json');
        // header('Accept: application/json');
        // header('Content-Type: application/vnd.ms-execl');
        // header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        // $handle = fopen("php://output", 'a');
        $path = storage_path('app/') . $fileName .'.csv';
        $handle = fopen($path, 'w');

        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

            foreach($data->data as $key => $data){
                unset($data->application_name);
                unset($data->vendor_ref_id);
                unset($data->vendor_callback_data);
                unset($data->extra_info);
                unset($data->application_id);
                unset($data->vendor_code);
                unset($data->error_code);
                unset($data->error_message);
                unset($data->extra_data);
                unset($data->client_ip);
                unset($data->order_version);
                unset($data->token);
                unset($data->action);

                // dd($data);
                if($key == 0){
                    foreach($data as $title=>$content){
                        $this->tit[] = $title;
                    }
                    fputcsv($handle, $this->tit);
                }

                if(isset($data->request_time)){
                    $data->request_time = date('d-m-Y H:i:s', $data->request_time);
                }
                if(isset($data->response_time)){
                    $data->response_time = date('d-m-Y H:i:s', $data->response_time);
                }

                if(isset($data->time_hold)){
                    $data->time_hold = date('d-m-Y H:i:s', $data->time_hold);
                }

                if(isset($data->time_un_hold)){
                    $data->time_un_hold = date('d-m-Y H:i:s', $data->time_un_hold);
                }

                if(isset($data->time_refund)){
                    $data->time_refund = date('d-m-Y H:i:s', $data->time_refund);
                }

                $data = (array)$data;

                fputcsv($handle, $data);
            }


        fclose($handle);
        ob_flush();
        flush();
        return response()->download($path)->deleteFileAfterSend(true);
        $end = microtime(true);

    }

}
