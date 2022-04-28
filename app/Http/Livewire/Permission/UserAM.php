<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;

use App\Models\UserAMmodel;
use App\Models\User;
use Livewire\WithPagination;
use App\Services\Gate\PartnerService;
use Illuminate\Support\Facades\Gate;
use App\Connection\PartnerConnection;

class UserAM extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'addNewUserAM' => 'addNewUserAM',
        'addPartnerCode' => 'addPartnerCode',
        'resetMessage' => 'resetMessage',
        'deleteUserAM' => 'deleteUserAM',
        'getDateTableupdateUserAMModal' => 'getDateTableupdateUserAMModal',
        'updateUserAM' => 'updateUserAM',
        'search' => 'search',
        'ViewUserAM' => 'ViewUserAM',
        'changeStatus' => 'changeStatus'
    ];


    public $email;
    public $partnerCode = [];
    public $partnerCodeListView = '';
    public $emailSearch;
    public $statusUser;
    public $statusUserMessage;
    public $statusUserWarning = false;

    protected $rules = [
        'email' => 'required|email',
        'partnerCode' => 'required'
    ];

    public function render()
    {

        $params['pagination']['limit'] = 10000;
        $partnerList = PartnerConnection::getList($params);
        if($partnerList == false){
            $partnerList = [];
        }

        return view('livewire.permission.user-a-m', [
            'listUser' => $this->getList(),
            'partnerList' => $partnerList
        ])->extends('index');
    }

    public function getListPartner(){
        $partnerService = new PartnerService();
        return $partnerService->getAll();
    }

    public function ViewUserAM($email){

        unset($this->statusUserWarning);
        unset($this->statusUserMessage);

        $users = User::where('email', $email)->get();
        if($users->count() == 1){
            foreach($users as $user){
                $this->statusUser = $user->is_am;
            }

        }else{
            $this->statusUserMessage = "User không tồn tại trong bảng User.";
            $this->statusUserWarning = true;
        }
    }

    public function changeStatus($email, $status){
        if (!Gate::allows('am-user-manage-active')) {
            $this->message = 'Bạn không được phân quyền active user AM.';
            return;
        }

        $users = User::where('email', $email)->get();
        if($users->count() == 1){
            User::where('email', $email)->update([
                'is_am' => $status
            ]);

            $this->statusUserMessage = "Update successfully!";
        }
    }

    public function getList(){
        return UserAMmodel::orderBy('id', 'DESC')->where('email', 'like', '%'. $this->emailSearch .'%')->paginate(10);
    }

    public function search($email){
        $this->emailSearch = $email;
    }



    public function addPartnerCode($partner_code){

        if($partner_code == ""){

            $this->statusUserWarning = false;
            $this->message = 'Hãy chọn PartnerCode trong danh sách.';
            return;

        }

        $this->partnerCode[] = $partner_code;
        $this->partnerCode = array_unique($this->partnerCode);

        $this->partnerCodeListView = $this->partnerCodeListView . '<li> <a>' .$partner_code. '</a> <a><i wire:click.prevent="removePartnerCodeView('.$partner_code.')" style="font-size: 10px; color: red; margin-left: 15px;" class="flaticon2-delete"></i></a> </li>';

    }

    public function resetMessage(){
        unset($this->message);
    }

    public function removePartnerCodeView($partnerCode){

        $key = array_search($partnerCode, $this->partnerCode);
        unset($this->partnerCode[$key]);

    }

    public $message;
    public $warning;

    public function updateUserAM($email, $partnerCode){

        if (!Gate::allows('am-user-manage-edit')) {
            $this->message = 'Bạn không được phân quyền sửa user AM.';
            return;
        }

        if($partnerCode != ''){
            $this->partnerCode[] = $partnerCode;
        }
        $this->partnerCode = array_unique($this->partnerCode);

        $this->email = $email;
        $this->validate();
        $checkEmail = UserAMmodel::where('email', $this->email)->get();

        foreach($checkEmail  as $check){
            $current_partner_code = $check->partner_code;
        }


        UserAMmodel::where('email', $this->email)->update([
            'partner_code' => implode(',', $this->partnerCode)
        ]);
        $this->statusUserWarning = false;
        $this->message = 'Update thành công.';


    }

    public function getDateTableupdateUserAMModal($id){
        $userAM = UserAMmodel::where('id', $id)->get();
        if($userAM->count() == 1){
            foreach($userAM as $user){
                $this->email = $user->email;
                $this->partnerCode = explode(',', $user->partner_code);
            }
        }

    }

    public function deleteUserAM($id){
        if (!Gate::allows('am-user-manage-delete')) {
            $this->message = 'Bạn không được phân quyền xóa user AM.';
            return;
        }

        $userAM = UserAMmodel::where('id', $id)->delete();
    }

    public function addNewUserAM($email, $partnerCode){

        if (!Gate::allows('am-user-manage-add')) {
            $this->message = 'Bạn không được phân quyền thêm mới user AM.';
            return;
        }

        if(empty($this->partnerCode)){
            if($partnerCode != ''){
                $this->partnerCode[] = $partnerCode;
            }
        }

        $this->email = $email;
        $this->validate();
        $checkEmail = UserAMmodel::where('email', $this->email)->get();

        if($checkEmail->count() == 0){
            UserAMmodel::create([
                'email' => $this->email,
                'partner_code' => implode(',', $this->partnerCode)
            ]);
        }else{

            foreach($checkEmail  as $check){
                $current_partner_code = $check->partner_code;
            }


            UserAMmodel::where('email', $this->email)->update([
                'partner_code' => implode(',', array_unique(explode(',', implode(',', $this->partnerCode) . ',' .$current_partner_code)))
            ]);

        }

        $this->changeStatus($email, 'yes');

        $this->message = 'Thêm mới thành công.';

    }
}
