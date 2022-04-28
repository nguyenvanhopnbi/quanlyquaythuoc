<?php

namespace App\Http\Livewire\DoubleCheck;

use Livewire\Component;
use App\Connection\DoubleCheckConnection;
use Illuminate\Http\Request;

class DoiSoatThuHoVoiPartner extends Component
{
    protected $listeners = [
        'ExportDoiSoatThuHoVoiPartner' => 'ExportDoiSoatThuHoVoiPartner',
        'SearchDoiSoatThuHoVoiPartner' => 'SearchDoiSoatThuHoVoiPartner'
    ];
    public function render()
    {
        // $this->getList();
        return view('livewire.double-check.doi-soat-thu-ho-voi-partner');
    }

    protected $listThuHoVoiPartner;
    public $message;
    public $warning = false;
    public $date;

    public function SearchDoiSoatThuHoVoiPartner($date){
        if(isset($date) and !empty($date)){
            $this->date = strtotime($date);
        }else{
            unset($this->date);
        }

    }

    // public function getList(){
    //     $params = [];
    //     if(isset($this->date)){
    //         $params['date'] = $this->date;
    //     }
    //     $data = DoubleCheckConnection::DoiSoatThuHoVoiPartner($params, 'WOORIBANK');
    //     if(isset($data->data)){
    //         $this->listThuHoVoiPartner = $data->data;
    //     }
    // }

    public function ExportDoiSoatThuHoVoiPartner(Request $request){

        $params = [];
        if(isset($request->date) and !empty($request->date)){
            $params['date'] = strtotime($request->date);
        }else{
            unset($params['date']);
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $fileName = date('YmdHis', time());
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');
        $begin = microtime(true);
        $handle = fopen("php://output", 'a');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

                $title = [];

                $data = DoubleCheckConnection::DoiSoatThuHoVoiPartner($params, $request->providerCode);
                if(!isset($data->data) or empty($data->data)){
                    $this->message = "Không có dữ liệu";
                    $this->warning = true;
                    return $this->message;
                }else{
                    $data
                    = DoubleCheckConnection::DoiSoatThuHoVoiPartner($params, $request->providerCode)->data;
                }

                foreach($data as $key=>$data){

                    if($key == 0){
                        foreach($data as $tit=>$content){
                            $title[] = $tit;

                        }
                        fputcsv($handle, $title);
                    }
                    $data = (array)$data;
                    if(isset($data['date'])){
                        $data['date'] = date('d-m-Y', strtotime($data['date']));
                    }

                    if(isset($data['time'])){
                        $data['time'] = date('H:i:s', strtotime($data['time']));
                    }


                    fputcsv($handle, $data);
                }


        fclose($handle);
        ob_flush();
        flush();
        $end = microtime(true);
    }
}
