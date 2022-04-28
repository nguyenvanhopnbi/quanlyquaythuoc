<?php

namespace App\Http\Livewire\DoubleCheck;

use Livewire\Component;
use App\Connection\DoubleCheckConnection;
use Illuminate\Http\Request;

class Provider extends Component
{
    protected $listeners = [

        'ExportCSVDoiSoatProvider' => 'ExportCSVDoiSoatProvider',
        'SearchDoiSoatProvider' => 'SearchDoiSoatProvider'
    ];
    public function render()
    {
        // $this->getList();
        return view('livewire.double-check.provider');
    }

    protected $listDoisoatProvider;
    public $date;
    public $message;


    public function SearchDoiSoatProvider($dateTime){
        $this->date = strtotime($dateTime);
    }

    public function ExportCSVDoiSoatProvider(Request $request){
        $params = [];
        $this->date = strtotime($request->dateTime);
        $params['date'] = $this->date;
        $params['providerCode'] = $request->providerCode;
        if($request->isFrequency){
            $params['isFrequency'] = 1;
        }else{
            $params['isFrequency'] = 0;
        }


        $data = DoubleCheckConnection::getListDoiSoatProviderCode($params, $request->providerCode);
        if($data == false){
            $data = new \stdClass();
            $data->data = [];
        }

        if(!isset($data->data)){
            $data = new \stdClass();
            $data->data = [];
        }

        $begin = microtime(true);
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $fileName = date('YmdHis', time());
        header('Content-Type: application/json');
        header('Accept: application/json');
        header('Content-Type: application/vnd.ms-execl');
        header('Content-Disposition: attachment;filename="' . $fileName . '.csv"');

        $handle = fopen("php://output", 'a');
        // $path = storage_path('app/') . $fileName .'.csv';
        // $handle = fopen($path, 'w');
        fputs($handle, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

            $count = 1;
            $titleCollum = [];
            $dataCSV = [];
            foreach($data->data as $key => $data){
                if($key == 0 and $count == 1){
                    foreach($data as $title=>$content){
                        $titleCollum[] = $title;
                    }
                    fputcsv($handle, $titleCollum);
                    $count++;
                }

                if(isset($data->date)){
                    $data->date = date('d-m-Y', strtotime($data->date));
                }
                if(isset($data->time)){
                    $data->time = date('H:i:s', strtotime($data->time));
                }
                $data = (array)$data;
                fputcsv($handle, $data);
            }


        fclose($handle);
        ob_flush();
        flush();
        // return response()->download($path)->deleteFileAfterSend(true);
        $end = microtime(true);
    }
}
