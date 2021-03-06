<?php

namespace App\Services;

use Validator;

class ValidationService
{
    /*
     * function make validation
     */

    public function make($params, $type)
    {
        $validator = Validator::make(
                        $params, $this->getRules($type), $this->getCustomMessages(), $this->attributes()
        );
        return $validator;
    }

    /*
     * function get rule config
     */

    public function getRules($type)
    {
        $rules = [
            'add_bill_provider_fields' => [
                'providerName' => self::getRule('require_field'),
                'providerCode' => self::getRule('require_field'),
                'secretKey' => self::getRule('require_field'),
                'rsaPublicKey' => self::getRule('require_field'),
                'rsaPrivateKey' => self::getRule('require_field')
            ],
            'edit_bill_provider_fields' => [
                'providerName' => self::getRule('require_field'),
                'providerCode' => self::getRule('require_field'),
                'secretKey' => self::getRule('require_field'),
                'rsaPublicKey' => self::getRule('require_field'),
                'rsaPrivateKey' => self::getRule('require_field')
            ],
            'add_gate_application_fields' => [
                'partner_code' => self::getRule('require_field'),
                'api_key' => self::getRule('require_field'),
                'secret_key' => self::getRule('require_field'),
                'status' => self::getRule('require_field'),
                'name' => self::getRule('require_field'),
            ],
            'edit_gate_application_fields' => [
                'partner_code' => self::getRule('require_field'),
                'api_key' => self::getRule('require_field'),
                'secret_key' => self::getRule('require_field'),
                'name' => self::getRule('require_field'),
            ],
            'add_bill_service_fields' => [
                'serviceCode' => self::getRule('require_field'),
                'serviceName' => self::getRule('require_field'),
                'categoryCode' => self::getRule('require_field'),
                'description' => self::getRule('require_field'),
                'icon' => self::getRule('require_field'),
                'public' => self::getRule('require_field')
            ],
            'edit_bill_service_fields' => [
                'serviceCode' => self::getRule('require_field'),
                'serviceName' => self::getRule('require_field'),
                'categoryCode' => self::getRule('require_field'),
                'description' => self::getRule('require_field'),
                'public' => self::getRule('require_field')
            ],
            'add_bill_provider_config_fields' => [
                'providerCode' => self::getRule('require_field'),
                'secretKey' => self::getRule('require_field'),
                'rsaPublicKey' => self::getRule('require_field'),
                'rsaPrivateKey' => self::getRule('require_field')
            ],
            'edit_bill_provider_config_fields' => [
                'secretKey' => self::getRule('require_field'),
                'rsaPublicKey' => self::getRule('require_field'),
                'rsaPrivateKey' => self::getRule('require_field')
            ],
            'add_bill_service_category_fields' => [
                'categoryCode' => self::getRule('require_field'),
                'categoryName' => self::getRule('require_field'),
                'description' => self::getRule('require_field'),
                'public' => self::getRule('require_field')
            ],
            'edit_bill_service_category_fields' => [
                'categoryCode' => self::getRule('require_field'),
                'categoryName' => self::getRule('require_field'),
                'description' => self::getRule('require_field'),
                'public' => self::getRule('require_field')
            ],
            'add_bill_provider_service_match_fields' => [
                'serviceCode' => self::getRule('require_field'),
                'providerServiceCode' => self::getRule('require_field'),
                'providerPublisherCode' => self::getRule('require_field'),
                'partnerCode' => self::getRule('require_field'),
                // 'providerCode' => self::getRule('require_field'),
            ],
            'edit_bill_provider_service_match_fields' => [
                'serviceCode' => self::getRule('require_field'),
                'providerServiceCode' => self::getRule('require_field'),
                'providerPublisherCode' => self::getRule('require_field'),
            ],
            'add_gate_application_service_config_fields' => [
                'partner_code' => self::getRule('require_field'),
                'service_name' => self::getRule('require_field'),
                'service_code' => self::getRule('require_field'),
                'application_id' => self::getRule('require_field'),
                'description' => self::getRule('require_field'),
            ],
            'edit_gate_application_service_config_fields' => [
                'partner_code' => self::getRule('require_field'),
                'service_name' => self::getRule('require_field'),
                'service_code' => self::getRule('require_field'),
                'application_id' => self::getRule('require_field'),
                'description' => self::getRule('require_field'),
            ],
            'add_bank_fields' => [
                'bank_code' => self::getRule('require_field'),
                'bank_name' => self::getRule('require_field'),
                'type' => self::getRule('require_field'),
                'public' => self::getRule('require_field')
            ],
            'edit_bank_fields' => [
                'bank_code' => self::getRule('require_field'),
                'bank_name' => self::getRule('require_field'),
                'type' => self::getRule('require_field'),
                'public' => self::getRule('require_field')
            ],
            'edit_gate_application_service_config_fields' => [
                'partner_code' => self::getRule('require_field'),
                'service_name' => self::getRule('require_field'),
                'service_code' => self::getRule('require_field'),
                'application_id' => self::getRule('require_field'),
                'description' => self::getRule('require_field')
            ],
            'add_bank_vendor_fields' => [
                'vendor_code' => self::getRule('require_field'),
                'vendor_name' => self::getRule('require_field'),
                'public' => self::getRule('require_field')
            ],
            'edit_bank_vendor_fields' => [
                'vendor_code' => self::getRule('require_field'),
                'vendor_name' => self::getRule('require_field'),
                'public' => self::getRule('require_field')
            ],
            'add_partner_bank_vendor_fields' => [
                'partner_code' => self::getRule('require_field'),
                'bank_code' => self::getRule('require_field'),
                'vendor_code' => self::getRule('require_field'),
            ],
            'edit_partner_bank_vendor_fields' => [
                'partner_code' => self::getRule('require_field'),
                'bank_code' => self::getRule('require_field'),
                'vendor_code' => self::getRule('require_field'),
            ],
            'add_topup_discount_config' => [
                'partnerCode' => self::getRule('require_field'),
            ],
            'edit_topup_discount_config_fields' => [
                'partnerCode' => self::getRule('require_field'),
            ],
            'add_topup_provider_config' => [
                'providerCode' => self::getRule('require_field'),
                'secretKey' => self::getRule('require_field'),
                'rsaPublicKey' => self::getRule('require_field'),
                'rsaPrivateKey' => self::getRule('require_field')
            ],
            'edit_topup_provider_config_fields' => [
                'providerCode' => self::getRule('require_field'),
                'secretKey' => self::getRule('require_field'),
                'rsaPublicKey' => self::getRule('require_field'),
                'rsaPrivateKey' => self::getRule('require_field')
            ],
            'add_topup_telco_provider_config' => [
                'telco' => self::getRule('require_field'),
                'providerCode' => self::getRule('require_field'),
                'telcoServiceType' => self::getRule('require_field')
            ],
            'edit_topup_telco_provider_fields' => [
                'telco' => self::getRule('require_field'),
                'telcoServiceType' => self::getRule('require_field'),
                'providerCode' => self::getRule('require_field'),
            ],
            'edit_shopcard_card_fields' => [
                'name' => self::getRule('require_field'),
                'productCode' => self::getRule('require_field'),
                'vendor' => self::getRule('require_field'),
                'value' => self::getRule('require_field'),
                'price' => self::getRule('require_field'),
                'public' => self::getRule('require_field')
            ],
            'add_shopcard_card_fields' => [
                'name' => self::getRule('require_field'),
                'productCode' => self::getRule('require_field'),
                'vendor' => self::getRule('require_field'),
                'value' => self::getRule('require_field'),
                'price' => self::getRule('require_field'),
                'public' => self::getRule('require_field')
            ],
            'add_shop_card_item_fields' => [
                'data' => self::getRule('require_field'),
                'vendor' => self::getRule('require_field'),
            ],
            'import_card_data_file' => [
                'file' => self::getRule('require_file_excel'),
            ],
            'add_shop_card_discount_config_fields' => [
                'partner_code' => self::getRule('require_field'),
            ],
            'add_balance_partner_fields' => [
                'partnerCode' => self::getRule('require_field'),
                'amount' => self::getRule('amount'),
                'reason' => self::getRule('require_field'),
                'otp' => self::getRule('require_field'),
            ],
            'sub_balance_partner_fields' => [
                'partnerCode' => self::getRule('require_field'),
                'amount' => self::getRule('amount'),
                'reason' => self::getRule('require_field'),
            ],
            'add_collect_money_partner_fields' => [
                'providerCode' => self::getRule('require_field'),
                'apiKey' => self::getRule('require_field'),
                'secretKey' => self::getRule('require_field'),
                'rsaPublicKey' => self::getRule('require_field'),
                'systemRsaPrivateKey' => self::getRule('require_field'),
                'status' => self::getRule('require_field'),
            ],
            'edit_collect_money_partner_fields' => [
                'apiKey' => self::getRule('require_field'),
                'secretKey' => self::getRule('require_field'),
                'rsaPublicKey' => self::getRule('require_field'),
                'systemRsaPrivateKey' => self::getRule('require_field'),
                'status' => self::getRule('require_field'),
            ],
            'add_topup_denomination_config' => [
                'telco' => self::getRule('require_field'),
                'value' => self::getRule('amount'),
            ],
            'update_topup_denomination_config' => [
                'telco' => self::getRule('require_field'),
                'value' => self::getRule('amount'),
            ],
            'edit_partner_fields' => [
                'partnerCode' => $this->getRule('partner_code'),
                'email' => $this->getRule('email'),
                'phoneNumber' => $this->getRule('require_field'),
                'status' => $this->getRule('require_field'),
                'accountType' => $this->getRule('require_field'),
                'emailReconciliation' => $this->getRule('require_field'),
            ],
            'add_partner_fields' => [
                'partnerCode' => $this->getRule('partner_code'),
                'email' => $this->getRule('email'),
                'phoneNumber' => $this->getRule('phone_number'),
                'status' => $this->getRule('require_field'),
                'accountType' => $this->getRule('require_field'),
                'password' => $this->getRule('require_field'),
                'emailReconciliation' => $this->getRule('require_field'),
            ],
            'add_transfer_money_provider_fields' => [
                'providerCode' => self::getRule('require_field'),
                'providerCode' => self::getRule('require_field'),
                'secretKey' => self::getRule('require_field'),
                'rsaPublicKey' => self::getRule('require_field'),
                'rsaPrivateKey' => self::getRule('require_field')
            ],
            'edit_transfer_money_provider_fields' => [
                'secretKey' => self::getRule('require_field'),
                'rsaPublicKey' => self::getRule('require_field'),
                'rsaPrivateKey' => self::getRule('require_field')
            ],
            'add_partner_pay_gate_config_fields' => [
               'partner_code'=> self::getRule('require_field'),
               'contract_number'=> self::getRule('require_field'),
               'cc_payment_fee'=> self::getRule('number_required'),
               'cc_transaction_fee'=> self::getRule('number_required'),
               'atm_payment_fee'=> self::getRule('number_required'),
               'atm_transaction_fee'=> self::getRule('number_required'),

               'ewallet_appota_fee'=> self::getRule('number_required'),
               'ewallet_transaction_appota_fee'=> self::getRule('number_required'),
               'cc_payment_jcb_fee'=> self::getRule('number_required'),
               'cc_transaction_jcb_fee'=> self::getRule('number_required'),
            ],
            'update_partner_pay_gate_config_fields' => [
                'contract_number'=> self::getRule('require_field'),
                'atm_payment_fee'=> self::getRule('number_required'),
                'atm_transaction_fee'=> self::getRule('number_required'),
                'cc_payment_fee'=> self::getRule('number_required'),
                'cc_transaction_fee'=> self::getRule('number_required'),

                'ewallet_appota_fee'=> self::getRule('number_required'),
               'ewallet_transaction_appota_fee'=> self::getRule('number_required'),
               'cc_payment_jcb_fee'=> self::getRule('number_required'),
               'cc_transaction_jcb_fee'=> self::getRule('number_required'),
            ],
            'refund_bank_transaction_fields'=> [
                'amount'=>self::getRule('number_required'),
                'reason'=>self::getRule('require_field'),
                'transaction_id'=> self::getRule('require_field')
            ],
            'add_partner_vendor_fields'=> [
                'vendor_code'=> self::getRule('require_field'),
                'partner_code'=> self::getRule('require_field'),
            ],
            'edit_partner_vendor_fields'=> [
                'vendor_code'=> self::getRule('require_field'),
                'partner_code'=> self::getRule('require_field'),
            ]
        ];

        return isset($rules[$type]) ? $rules[$type] : array();
    }

    /*
     * function get Attrbutes
     */

    public function attributes()
    {
        return [
            'post_title' => 'Ti??u ?????',
            'post_description' => 'M?? t???',
            'post_content' => 'N???i dung',
            'host_name' => 'T??n kh??ch s???n, resort',
            'host_descrition' => 'M?? t??? kh??ch s???n, resort',
        ];
    }

    /*
     * function get rule
     */

    public function getRule($rule)
    {
        $rules = [
            'limit' => 'numeric',
            'offset' => 'numeric',
            'user_id' => 'numeric|required',
            'username' => 'required',
            'full_name' => 'required',
            'phone_number' => 'digits_between:10,15|required',
            'password' => 'nullable|min:5|required',
            'require_field' => 'required',
            'require_field_topup_config' => 'required|numeric',
            'email' => 'required|email',
            'payment_method' => 'required',
            'ip' => 'ip',
            'amount' => 'numeric|required',
            'number' => 'numeric',
            'post_unique' => 'required|unique:posts',
            'page_unique' => 'required|unique:pages',
            'host_name' => 'required|unique:hosts',
            'require_file_excel' => 'required|',
            'partner_code'=> 'required|regex:/(^[a-zA-Z0-9]+$)+/',
            'number_required' => 'numeric|required',

        ];

        return $rules[$rule];
    }

    /**
     * function get custom messages
     */
    public function getCustomMessages()
    {
        $messages = [
            'required' => 'Kh??ng b??? tr???ng tr?????ng :attribute',
            'unique' => ':attribute ???? t???n t???i, vui l??ng thay ?????i n???i dung',
            'email' => ':attribute kh??ng ????ng ?????nh d???ng',
            'digits_between' => ':attribute kh??ng ????ng ?????nh d???ng',
            'partner_code'=> 'Kh??ng b??? tr???ng tr?????ng partner code',
            'regex'=> 'Vui l??ng kh??ng nh???p k?? t??? ?????c bi???t ho???c d???u c??ch cho partner code'
        ];

        return $messages;
    }

}
