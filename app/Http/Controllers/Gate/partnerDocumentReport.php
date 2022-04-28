<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Connection\partnerPaygateFeeConfigConnection;
use App\Connection\PartnerConnection;

class partnerDocumentReport extends Controller
{

    public function index(){
        return view('gate.partnerDocumentReport.partnerDocumentReport');
    }

    public function document(){
        return view('gate.partnerDocumentReport.partnerDocumentTimeResponse');
    }

    public function paymentMethodConfig(){
        return view('gate.partnerDocumentReport.paymentMethodConfig');
    }

    public function partnerPaygateFeeConfig(){
        return view('gate.partnerDocumentReport.partnerGateFeeConfig');
    }



    public function checkPartnerCode($partnerCode){
        $params = [];
        $params['pagination']['limit'] = '10000';
        $data = PartnerConnection::getList($params);
        $list = [];

            if(isset($data->data)){
                foreach($data->data as $data){
                    $list[] = $data->partner_code;
                }
                if(in_array($partnerCode, $list)){
                    return true;
                }
            }

        return false;
    }

    public function partnerPaygateFeeConfigUpdates(Request $request){
        $params = $request->all();
        // dump($params);
        if(!isset($params['partner_code']) and empty($params['partner_code'])){

            $request->session()->flash('status', '<strong style="color:red">Update thất bại, không tồn tại . </strong> #Partner Code: ' .$params['partner_code']);

           return response()->json(['success' => $request->session()->get('status')]);
        }

        $checkPartnerCode = $this->checkPartnerCode($params['partner_code']);
        if(!$checkPartnerCode){
            $request->session()->flash('status', '<strong style="color:red">Update thất bại, partner Code không tồn tại . </strong> #Partner Code: ' .$params['partner_code']);
                return response()->json(['success' => $request->session()->get('status')]);
        }

        $result = partnerPaygateFeeConfigConnection::update($request->all());

        // dd($result);

        if(!$result){
            $request->session()->flash('status', '<strong style="color:red">Update thất bại . Đã tồn tại </strong>#Partner Code: ' .$params['partner_code']);
            return response()->json(['success' => $request->session()->get('status')]);
        }
        if($result->success){
            $request->session()->flash('status', 'Update thành công .#Partner Code: ' .$params['partner_code']);

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYGATE_FEE_CONFIG, "Update cấu hình phí Paygate Partner thành công #PARAMS: ". json_encode($request->all())));

            return response()->json(['success' => $request->session()->get('status')]);
        }else{
            $request->session()->flash('status', '<strong style="color:red">Update thất bại , trùng. </strong>#Partner Code: ' .$params['partner_code']);
            return response()->json(['success' => false]);
        }


    }

    public function partnerPaygateFeeConfigAddPostMethod(Request $request){
        $params = $request->all();
        // dd($params);
        if(!isset($params['partner_code']) and empty($params['partner_code'])){
            $request->session()->flash('status', '<strong style="color:red">Thêm mới thất bại, partner Code chưa đúng . </strong> #Partner Code: ' .$params['partner_code']);
            return response()->json(['success' => $request->session()->get('status')]);
        }

        $checkPartnerCode = $this->checkPartnerCode($params['partner_code']);
            if(!$checkPartnerCode){

                $request->session()->flash('status', '<strong style="color:red">Thêm mới thất bại, partner Code không tồn tại . </strong> #Partner Code: ' .$params['partner_code']);

                return response()->json(['success' => $request->session()->get('status')]);
            }



        $result = partnerPaygateFeeConfigConnection::addnew($request->all());

        if(!$result){
            $request->session()->flash('status', '<strong style="color:red"> Thêm mới thất bại . Đã tồn tại </strong> #Partner Code: ' .$params['partner_code']);
            return response()->json(['success' => $request->session()->get('status')]);
        }
        if($result->success){
            $request->session()->flash('status', 'Thêm mới thành công .#Partner Code: ' .$params['partner_code']);

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::PARTNER_PAYGATE_FEE_CONFIG, "Thêm mới cấu hình phí Paygate Partner thành công #PARAMS: ". json_encode($request->all())));

            return response()->json(['success' => $request->session()->get('status')]);
        }else{
            $request->session()->flash('status', '<strong style="color:red">Thêm mới thất bại . </strong>#Params: ' .json_encode($request->all()));
            return response()->json(['success' => false]);
        }
    }




}
