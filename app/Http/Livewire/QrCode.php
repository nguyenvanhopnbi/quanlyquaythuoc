<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Connection\QrCodeConnection;
use App\Connection\PartnerConnection;
use Illuminate\Http\Request;
use App\Services\UploadImageService;

class QrCode extends Component
{

    protected $listeners = [
        'search' => 'search',
        'updateImage' => 'updateImage',
        'create' => 'create',
        'updateImageEdit' => 'updateImageEdit',
        'edit' => 'edit',
        'resetUrl' => 'resetUrl'
    ];

    public function render()
    {
        return view('livewire.qr-code', [
            'dataList' => $this->getList(),
            'partnerCodeList' => $this->getPartnerCode()
        ]);
    }

    public $start;
    public $end;
    public $part = 10;
    public $currentPage;
    public $totalPage;

    public $pageCurrent;


    public $store_name;
    public $partner_code;
    public $application_id;
    public $vendor_code;
    public $vendor_bank_code;
    public $vendor_account_no;

    public function getList(){
        $params = [];

        $params['pagination']['limit'] = 10;

        if(isset($this->pageCurrent)){
            $params['pagination']['page'] = $this->pageCurrent;
        }

        if(isset($this->store_name)){
            $params['query']['store_name'] = $this->store_name;
        }

        if(isset($this->partner_code)){
            $params['query']['partner_code'] = $this->partner_code;
        }

        if(isset($this->application_id)){
            $params['query']['application_id'] = $this->application_id;
        }

        if(isset($this->vendor_code)){
            $params['query']['vendor_code'] = $this->vendor_code;
        }

        if(isset($this->vendor_bank_code)){
            $params['query']['vendor_bank_code'] = $this->vendor_bank_code;
        }

        if(isset($this->vendor_account_no)){
            $params['query']['vendor_account_no'] = $this->vendor_account_no;
        }

        $data = QrCodeConnection::getList($params);

        if(isset($data->meta->page)){
            $this->currentPage = $data->meta->page;
        }

        if(isset($data->meta->pages)){
            $this->totalPage = $data->meta->pages;
        }

        $this->start = $this->currentPage - $this->part;
        if($this->start < 1){
            $this->start = 1;
        }

        $this->end = $this->currentPage + $this->part;
        if($this->end > $this->totalPage){
            $this->end = $this->totalPage;
        }

        if(isset($data->data)){
            return $data->data;
        }
    }

    public function getPartnerCode(){
        $params = [];
        $params['pagination']['limit'] = 20000;
        $data = PartnerConnection::getList($params);
        if(isset($data->data)){
            return $data->data;
        }
    }

    public function search($store_name, $partner_code, $application_id, $vendor_code, $vendor_bank_code, $vendor_account_no){

        $this->store_name = $store_name;
        $this->partner_code = $partner_code;
        $this->application_id = $application_id;
        $this->vendor_code = $vendor_code;
        $this->vendor_bank_code = $vendor_bank_code;
        $this->vendor_account_no = $vendor_account_no;

    }

    public function gotoCurrentPage($page){
        if($page < 1){
            $page = 1;
        }
        if($page > $this->totalPage){
            $page = $this->totalPage;
        }

        $this->pageCurrent = $page;
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|max:2048',
        ]);

        return UploadImageService::UpdateImage($request->file('icon'));
    }

    public $urlLogoIcon;
    public $urlLogoIconEdit;

    public function resetUrl(){
        // if(isset($this->urlLogoIconEdit)){
        //     unset($this->urlLogoIconEdit);
        // }
    }

    public function updateImage($data)
    {
        if (isset($data['success']) && $data['success'] === true) {
            $this->urlLogoIcon = $data['preview_image'];
            if(isset($this->urlLogoIcon)){
                $this->emit('endUploadCreateScript', [
                    'url' => $this->urlLogoIcon
                ]);
            }

        }
    }


    public function updateImageEdit($data){
        if (isset($data['success']) && $data['success'] === true) {
            $this->urlLogoIconEdit = $data['preview_image'];
            if(isset($this->urlLogoIconEdit)){
                $this->emit('endUploadCreateScript', [
                    'url' => $this->urlLogoIconEdit
                ]);
            }

        }
    }


    public $nameAdd;
    public $partner_codeAdd;
    public $addressAdd;
    public $descriptionAdd;

    public $message;
    public $warning = false;
    public $resultCreate;

    public function create($name, $partner_code, $address, $description){
        $this->nameAdd = $name;
        $this->partner_codeAdd = $partner_code;
        $this->addressAdd = $address;
        $this->descriptionAdd = $description;

        $this->validate(
            [
                'nameAdd' => 'required|max:20|regex:/^[a-zA-Z\d\_-]+$/',
                'partner_codeAdd' => 'required',
                'addressAdd' => 'required|max:150',
                'descriptionAdd' => 'required',
                'urlLogoIcon' => 'required',
            ],
            [
                'nameAdd.required' => 'Bạn cần nhập tên store, tối đa 20 ký tự, viết liền (a-A)(-_)',
                'nameAdd.max' => 'Tên tối đa là 20 ký tự',
                'nameAdd.regex' => 'Tên chưa đúng định dạng tối đa 20 ký tự, viết liền (a-A)(-_)',
                'partner_codeAdd.required' => 'Bạn cần nhập partner code',
                'addressAdd.required' => 'Bạn cần nhập địa chỉ',
                'addressAdd.max' => 'Bạn cần nhập địa chỉ tối đa là 150 ký tự',
                'descriptionAdd.required' => 'Bạn cần nhập mô tả',
                'urlLogoIcon.required' => 'Bạn cần chọn hình ảnh icon logo upload.'
            ]
        );

        $params = [];
        $params['name'] = $this->nameAdd;
        $params['partner_code'] = $this->partner_codeAdd;
        $params['address'] = $this->addressAdd;
        $params['description'] = $this->descriptionAdd;
        $params['icon'] = $this->urlLogoIcon;

        $result = QrCodeConnection::add($params);

        if(isset($result->errorCode) and $result->errorCode == 0){
            $this->message = $result->message;
            $this->warning = false;
            $this->resultCreate = $result->errorCode;

            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning,
            ]);
        }else{
            $this->message = $result->message;
            $this->warning = true;
            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning,
            ]);
        }
    }

    public $accountIDEdit;
    public $statusEdit;
    public $addressEdit;
    public $descriptionEdit;

    public function edit($accountID, $status, $address, $description){
        $this->accountIDEdit = $accountID;
        $this->statusEdit = $status;
        $this->addressEdit = $address;
        $this->descriptionEdit = $description;

        $params = [];
        if($this->statusEdit == 'inactive'){
            $this->validate(
                [
                    'statusEdit' => 'required',
                    'addressEdit' => 'required|max:150',
                    'descriptionEdit' => 'required',
                    'accountIDEdit' => 'required'
                ],
                [
                    'statusEdit.required' => 'Bạn cần nhập status',
                    'addressEdit.required' => 'Cần nhập địa chỉ, tối đa 150 ký tự',
                    'addressEdit.max' => 'Bạn cần nhập địa chỉ tối đa là 150 ký tự',
                    'descriptionEdit.required' => 'Bạn cần nhập mô tả',
                ]
            );

            $params['address'] = $this->addressEdit;

        }else{
            $this->validate(
                [
                    'statusEdit' => 'required',
                    'descriptionEdit' => 'required',
                ],
                [
                    'statusEdit.required' => 'Bạn cần nhập status',
                    'descriptionEdit.required' => 'Bạn cần nhập mô tả',
                ]
            );
        }

        $params['status'] = $this->statusEdit;
        $params['description'] = $this->descriptionEdit;
        if(isset($this->urlLogoIconEdit)){
            $params['icon'] = $this->urlLogoIconEdit;
        }

        $result = QrCodeConnection::edit($this->accountIDEdit, $params);

        if(isset($result->errorCode) and $result->errorCode == 0){
            $this->message = $result->message;
            $this->warning = false;
            $this->resultEdit = $result->errorCode;

            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning,
            ]);
        }else{
            $this->message = $result->message;
            $this->warning = true;
            $this->emit('messageScript', [
                'message' => $this->message,
                'warning' => $this->warning,
            ]);
        }

    }

    public function loading(){
        if(isset($this->resultCreate)){
            return true;
        }
        if(isset($this->resultEdit)){
            return true;
        }
        return false;
    }

}
