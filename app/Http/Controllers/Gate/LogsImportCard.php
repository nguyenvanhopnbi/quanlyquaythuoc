<?php

namespace App\Http\Controllers\Gate;

use App\Helpers\PusherHelper;
use App\Http\Controllers\Controller;
use App\Services\Gate\LogImportCardService;
use Illuminate\Http\Request;

class LogsImportCard extends Controller
{
    public $currentPage = 1;
    public $page = 1;
    public $pageMax = 1;
    public $startTime;
    public $endTime;
    public $vendor = '';
    public $status;
    public $values;
    public $provider;
    public $method;
    public $parameters;
    public $link;
    public $pageSize;
    public $total;
    public $limit = 20;
    public $part = 10;
    public $startPage;
    public $endPage;
    public $logImportCardService;

    function __construct(LogImportCardService $logImportCardService)
    {
        $this->logImportCardService = $logImportCardService;
    }
    public function ajaxGetListSource(Request $request)
    {
        $params = $request->all();
        $data = $this->getListSource($params);

        return response()->json($data);
    }
    public function getListSource($query)
    {
        $result = [
            'total'=> 0,
            'items'=> [],
        ];
        $params['pagination']['limit'] = 20;
        if (isset($query['q'])) {
            $params['query']['bank_name'] = $query['q'];
            $params['query']['bank_code'] = $query['q'];
            $params['query']['or'] = 'true';
        }
        $params['query']['public'] = 'yes';
        $data = $this->getList($params);
        if (isset($data->data)) {
            foreach ($data->data as $bankvendor) {
                $bankvendor->id = $bankvendor->bank_code;
                $bankvendor->text = $bankvendor->bank_code;
            }
            $result['total'] = count($data->data);
            $result['items'] = $data->data;
        }
        return $result;
    }

    public function nextPage(){
        $this->page++;
    }
    public function prevPage(){
        $this->page--;
    }

    public function index(Request $request){
        if(isset($request->page)){
            $this->currentPage = $request->page;
        }

        if(isset($request->limit)){
            $this->limit = $request->limit;
        }

        $param = [
            'pagination' => [
                'page' => $this->currentPage,
                'limit' => $this->limit,
            ],
        ];

        $data = $this->logImportCardService->getList($param);
        if(empty($data->data)){
            $param['pagination']['page'] = 1;
            $data = $this->logImportCardService->getList($param);
        }

        $this->page = $data->meta->page;
        $this->pageMax = $data->meta->pages;
        $this->pageSize = $data->meta->limit;
        $this->total = $data->meta->total;
        $this->parameters = $param;
        $this->startPage = $this->page - $this->part;
        if($this->startPage < 1) {$this->startPage = 1;}
        $this->endPage = $this->page + $this->part;
        if($this->endPage > $this->pageMax){$this->endPage = $this->pageMax;}
        if(isset($this->parameters['pagination']['page'])){
            unset($this->parameters['pagination']['page']);
        }
        foreach ($this->parameters['pagination'] as $key => $value) {
            $this->link = $this->link . '&' . $key .'=' . $value;

        }

        return view('gate.logs-import-card.list', [
            'data' => $data,
            'page' => $this->page,
            'pageMax' => $this->pageMax,
            'pageSize' => $this->pageSize,
            'total' => $this->total,
            'part' => $this->part,
            'startPage' => $this->startPage,
            'endPage' => $this->endPage,
            'link' => $this->link,
        ]);
    }

    public function searchLogs(Request $request){

        $starttime = $request->input('startTime');
        if(isset($starttime)){
            $this->startTime = strtotime($request->input('startTime') . '00:00:00');
        }
        if(isset($request->page) && isset($request->startTime)){
            $this->startTime = $request->startTime;
        }

        $endtime = $request->input('endTime');
        if(isset($endtime)){
            $this->endTime = strtotime($request->input('endTime') . '23:59:59');
        }
        if(isset($request->page) && isset($request->endTime)){
            $this->endTime = $request->endTime;
        }

        $value = $request->input('value');
        if(isset($value)){
            $this->values = $value;
        }
        $provider = $request->input('provider');
        if(isset($provider)){
            $this->provider = $provider;
        }
        $method = $request->input('method');
        if(isset($method)){
            $this->method = $method;
        }

        $vendor = $request->input('vendor');
        if(isset($vendor)){
            $this->vendor = $request->input('vendor');
        }

        $status = $request->input('status');
        if(isset($status)){
            $this->status = $status;
        }

        if(isset($request->page)){
            $this->currentPage = $request->page;
        }

        if(isset($request->limit)){
            $this->limit = $request->limit;
            // dd($this->limit);
        }
        $param = [
            'pagination' => [
                'page' => $this->currentPage,
                'limit' => $this->limit
            ],
            'query' => [
                'method' => $this->method,
                'provider_name' => $this->provider,
                'vendor' => $this->vendor,
                'value' => $this->values,
                'status' => $this->status,
                'startTime' => $this->startTime,
                'endTime' => $this->endTime,
            ]

        ];
        if($param['query']['method'] == ''){
            unset($param['query']['method']);
        }
        if($param['query']['provider_name'] == ''){
            unset($param['query']['provider_name']);
        }
        if (isset($param['query']['status']) && $param['query']['status'] === 'all' || $param['query']['status'] == null ) {
             unset($param['query']['status']);
        }

        if($param['query']['startTime'] == null){
            unset($param['query']['startTime']);
        }
        if($param['query']['endTime'] == null){
            unset($param['query']['endTime']);
        }
        if($param['query']['vendor'] == ''){
            unset($param['query']['vendor']);
        }
        if($param['query']['value'] == ''){
            unset($param['query']['value']);
        }
        $data = $this->logImportCardService->getList($param);
        if(empty($data->data)){
            $param['pagination']['page'] = 1;
            $data = $this->logImportCardService->getList($param);
        }
        $this->page = $data->meta->page;
        $this->pageMax = $data->meta->pages;
        $this->parameters = $param;
        $this->pageSize = $data->meta->limit;
        $this->total = $data->meta->total;
        $this->startPage = $this->page - $this->part;
        if($this->startPage < 1) {$this->startPage = 1;}
        $this->endPage = $this->page + $this->part;
        if($this->endPage > $this->pageMax){$this->endPage = $this->pageMax;}
        // dd($this->parameters);
        foreach ($this->parameters['query'] as $key => $value) {
            $this->link = $this->link . '&' . $key .'=' . $value;

        }

        if(isset($this->parameters['pagination']['page'])){
            unset($this->parameters['pagination']['page']);
        }
        foreach ($this->parameters['pagination'] as $key => $value) {
            $this->link = $this->link . '&' . $key .'=' . $value;

        }
        // dd($this->parameters);
        return view('gate.logs-import-card.list-search', [
            'data' => $data,
            'page' => $this->page,
            'pageMax' => $this->pageMax,
            'parameter' => $this->parameters,
            'link' => $this->link,
            'pageSize' => $this->pageSize,
            'total' => $this->total,
            'part' => $this->part,
            'startPage' => $this->startPage,
            'endPage' => $this->endPage,
        ]);
    }

    public function download(Request $request)
    {
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::EXPORT_LOG_IMPORT_CARD, "Download Excel Log import card", ['params' => $request->all()]));
        return \Response::download($this->logImportCardService->getExportPath($request->file))->deleteFileAfterSend(true);
    }
}
