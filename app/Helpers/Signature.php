<?php

namespace App\Helpers;

class Signature
{

	/*
	* function generate api signature
	*/
	public static function generateAPISignature($params = array(), $algo = 'SHA256', $secretKey = '')
	{
		if (!$params)
			return false;

		ksort($params);
		$string = implode('', $params);
		$secretKey = ($secretKey) ? $secretKey : env('SIGNATURE_SECRET_KEY');
		return hash($algo, $string . $secretKey);
	}

	/*
	* function verify api signature
	*/
	public static function verifyAPISignature($params, $signature, $algo = 'SHA256', $secretKey = '')
	{
        // $secretKey = ($secretKey) ? $secretKey : env('JWT_SECRET_KEY');
		$checkSignature = self::generateAPISignature($params, $algo, $secretKey);
		return $checkSignature === $signature;
	}

    /**
     * @param $data
     * @param $secret_key
     * @return false|string
     */
    public static function generatePartnerSignature($data, $secret_key): string
    {
        ksort($data);
        array_walk($data, function (&$item, $key) {
            $item = $key . '=' . $item;
        });
        $signData = implode('&', $data);
        return hash_hmac('SHA256', $signData, $secret_key);
    }

    /**
     * @param null|string $clientSignature
     * @param array $params
     * @param string $secretKey
     * @return bool
     */
    public static function verifyPartnerSignature(?string $clientSignature, array $params, string $secretKey): bool
    {
        if (!$clientSignature) {
            return false;
        }

        $signature = self::generatePartnerSignature($params, $secretKey);
        return $signature === $clientSignature;
    }
}
