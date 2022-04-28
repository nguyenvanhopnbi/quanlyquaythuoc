<?php

namespace App\Services\Partner;

use App\Connection\PartnerBankAccountConnection;
use App\Connection\PartnerConnection;
use App\Helpers\AuthenticationHelper;
use App\Helpers\Connection;
use App\Helpers\MailHelper;
use App\Helpers\Signature;
use App\Models\AuthOtp;
use App\Models\PartnerBankTransfer;
use App\Repositories\PartnerBankTransferRepository;
use App\Services\System\AuthOtpService;
use Illuminate\Support\Facades\Log;

class PartnerBankAccountService
{

    public function listBankAccount(array $filter = []): array
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/partner/bank-account';
        $result = Connection::sendRequest($url, $filter, 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody['data'] ?? [];
    }

    public function bankAccountCreate(array $data = []): array
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/partner/bank-account/create';
        $result = Connection::sendRequest($url, $data, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        if ($resultBody['errorCode'] !== 0) {
            return ['success' => false, 'data' => $resultBody['errors'],'message' => 'Thất bại',];
        }
        return ['success' => true, 'message' => 'Thành công', 'data' => []];
    }

    public function bankAccountDelete(string $id, array $data = []): array
    {
        $url = env('API_URL_PARTNER_SERVICE') . "/api/cms/partner/bank-account/$id/delete";
        $result = Connection::sendRequest($url, $data, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        if ($resultBody['errorCode'] !== 0) {
            return ['success' => false, 'data' => $resultBody['errors'],'message' => 'Thất bại',];
        }
        return ['success' => true, 'message' => 'Thành công', 'data' => []];
    }

    public function bankAccountMake(array $data = []): array
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/partner/bank-account/make';
        $result = Connection::sendRequest($url, $data, 'POST', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody['data'] ?? [];
    }

    public function detailBankAccount(string $id): array
    {
        $url = env('API_URL_PARTNER_SERVICE') . '/api/cms/partner/bank-account/' . $id;
        $result = Connection::sendRequest($url, [], 'GET', AuthenticationHelper::getHeader(), true);
        $resultBody = json_decode($result['body'], true);
        return $resultBody['data'] ?? [];
    }

    public function requestMakeTransferMoney(int $partnerBankTransferId, array $data): array
    {
        $return = [
            'status' => null,
            'message' => null
        ];
        $partnerRefId = 'PBA_' . time();
        $req = [
            'bankCode' => $data['bank_code'],
            'accountNo' => $data['bank_account_no'],
            'accountType' => $data['bank_account_type'],
            'accountName' => $data['bank_account_name'],
            'amount' => (int)$data['amount'],
            'feeType' => 'payer',
            'partnerRefId' => $partnerRefId,
            'message' => $data['content'],
            'contractNumber' => $data['bbds_id'],
            'customerPhoneNumber' => '',
        ];
        $res = PartnerBankAccountConnection::transferMake($req);

        ## update result from response api
        if (isset($res['errorCode'])) {
            $codeMustRecheck = PartnerBankTransfer::getCodeApiMustReVerify();
            $update = [
                'status_code' => $res['errorCode'],
                'status_message' => $res['message'],
                'partner_ref_id' => $partnerRefId,
                'approved_at' => now(),
            ];
            if ($res['errorCode'] == 0) {
                $status = PartnerBankTransfer::STATUS_SUCCESS;
                $update['status_message'] = 'Thanh toán thành công';
            } elseif (in_array($res['errorCode'], $codeMustRecheck)) {
                $status = PartnerBankTransfer::STATUS_PENDING;
            } else {
                $status = PartnerBankTransfer::STATUS_ERROR;
            }
            $update['status'] = $status;
        } else {
            $update = [
                'status_message' => $res['message'] ?? 'Lỗi hệ thống, không thể gửi yêu cầu tạo lệnh',
                'status' => PartnerBankTransfer::STATUS_ERROR,
                'partner_ref_id' => $partnerRefId,
                'approved_at' => now(),
            ];
        }
        $update['approver_id'] = \Auth::user()->id;
        $update['approver_name'] = \Auth::user()->name;
        $update['approver_email'] = \Auth::user()->email;
        (new PartnerBankTransferRepository())->updateById($partnerBankTransferId, $update);

        $return['status'] = $update['status'];
        $return['message'] = $update['status_message'];

        return $return;
    }

    public function sendOtpEmail($params)
    {
        $authOtpService = new AuthOtpService();
        $params = (object)$params;
        $genCode = AuthOtp::generateOtpCode();
        $code = $genCode['code'];
        $data = [
            'email' => MailHelper::getDefaultEmailForOtpCodePartnerBankAccountTransfer(),
            'phone' => null,
            'secure_code' => $genCode['secure_code'],
            'expired_at' => now()->addMinutes(15),
            'max_retry' => 5,
            'times_retry' => 0,
        ];
        $channel = 'email';
        $otpCountTime = $authOtpService->getOtpCountTime($channel);
        if ($otpCountTime) {
            return (['success' => false, 'message' => 'Vui lòng gửi lại sau ' . $otpCountTime . ' giây']);
        }

        if ($data['email']) {
            $params = [
                'partner_name' => $params->partner_name,
                'partner_code' => $params->partner_code,
                'bbds_id' => $params->bbds_id,
                'content' => $params->content,
                'amount' => $params->amount,
                'file_url' => $params->file_url,
                'code' => $code,
                'link' => route('partner.bank-account.make.list', ['id' => $params->id]),
            ];
            $success = $authOtpService->sendMailOtpWithParams($data['email'], 'partner.email.mail_otp', $params);
        } elseif ($data['phone']) {
            $success = $authOtpService->sendSmsOtp($data['phone'], $code);
        } else {
            $success = false;
        }
        if (!$success) {
            return ['success' => false ,'message' => 'Lỗi không thể gửi OTP'];
        }
        $authOtpService->setExpireTime(60, $channel);
        $authOtpService->createOtp($data);
        $otpCountTime = $authOtpService->getOtpCountTime($channel);
        $expiredAt = now()->addSeconds($otpCountTime)->getTimestamp();
        return ['success' => true, 'expiredAt' => $expiredAt, 'message' => 'Đã gửi yêu cầu OTP mới'];
    }


}
