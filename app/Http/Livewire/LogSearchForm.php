<?php

namespace App\Http\Livewire;

use App\Helpers\PusherHelper;
use App\Services\Gate\LogImportCardService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Http\Controllers\Gate\ExportLogTransaction;


class LogSearchForm extends Component
{
    use AuthorizesRequests;

    protected $listeners = ['exportLogImportCard' => 'exportLogImportCard'];

    public $filter = [];
    protected $fileName = '';

    public function render()
    {
        return view('livewire.log-search-form');
    }

    public function exportLogImportCard(
        $value,
        $providerName,
        $method,
        $status,
        $startTime,
        $endTime,
        $vendor
    ){

        return redirect()->route('shopcard.auto-import-card.ajax-save-config-log-export', [
            'value' => $value,
            'provider_name' => $providerName,
            'method' => $method,
            'status' => $status,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'vendor' => $vendor

        ]);


    }

    public function export()
    {
        $this->authorize('transfer-money-transaction-export');
        $logImportCard = new LogImportCardService();
        $params = $this->getData($this->filter);
        $secret = $logImportCard->exportCSV($params);
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EXPORT_LOG_IMPORT_CARD, "Export Excel Log import card", ['params' => $this->filter]));

        $this->channelName = PusherHelper::getExportChannel(auth()->id());
        $this->channelEven = PusherHelper::getExportEven($secret);
        $this->fileName = '/log-transfer-money-transaction-' . now()->format('dmYHis') . '.xlsx';
        $dataEmit = [
            'channelName' => PusherHelper::getExportChannel(auth()->id()),
            'channelEven' => PusherHelper::getExportEven($secret),
            'key' => env('PUSHER_APP_KEY'),
            'cluster' => env('PUSHER_APP_CLUSTER')
        ];
        $this->emit('eventPusherDownloadExcel', $dataEmit);
    }

    protected function getData($request)
    {
        $limit = 10000;
        $starttime = !empty($request['startTime']) ? strtotime($request['startTime'] . '00:00:00') : '';
        $endtime = !empty($request['endTime']) ? strtotime($request['endTime'] . '23:59:59') : '';
        $value = !empty($request['value']) ? $request['value'] : '';
        $provider = !empty($request['provider']) ? $request['provider'] : '';
        $method = !empty($request['method']) ? $request['method'] : '';
        $vendor = !empty($request['vendor']) ? $request['vendor'] : '';
        $status = !empty($request['status']) ? $request['endTime'] : '';

        $param = [
            'pagination' => [
                'page' => 1,
                'limit' => $limit
            ],
            'query' => [
                'method' => $method,
                'provider_name' => $provider,
                'vendor' => $vendor,
                'value' => $value,
                'status' => $status,
                'startTime' => $starttime,
                'endTime' => $endtime,
            ]

        ];

        return $param;
    }
    public function download()
    {
        $logImportCard = new LogImportCardService();
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EXPORT_LOG_IMPORT_CARD, "Download Excel Log import card", ['params' => $this->filter]));
        return \Response::download($logImportCard->getExportPath($this->fileName))->deleteFileAfterSend(true);

    }


}
