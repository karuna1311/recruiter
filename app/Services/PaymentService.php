<?php

namespace App\Services;
use Auth;
use App\Models\MasterPgd;
use App\Models\Transaction;
use Carbon\Carbon;

class PaymentService 
{
    public static function initiatePayment($sessionId,$amount)
    {
        $masterData=MasterPgd::select('id','user_id','security_deposite_amount')->first();
        $amount=$amount+$masterData->security_deposite_amount;
        $orderId=date('ymdhis').$masterData->user_id;
        $transactionData=Transaction::create(['master_pgd_id'=>$masterData->id,'session_master_id'=>$sessionId,'user_id'=>$masterData->user_id,'order_id'=>$orderId,'amount'=>$amount]);
        $transactionData->messageType='0100';
        $transactionData->merchantId=env('PAYMENT_MARCHANT_ID');
        $transactionData->serviceId=env('PAYMENT_SERVICE_ID');
        $transactionData->currencyCode='INR';
        $transactionData->successUrl=env('APP_URL').'/paymentUpdate/'.$transactionData->id;
        $transactionData->failUrl=env('APP_URL').'/paymentUpdate/'.$transactionData->id;
		$transactionData->requestDateTime=date('d-m-Y h:m:s',strtotime($transactionData->created_at));
		$transactionData->customerId=str_pad($transactionData->user_id,6,"0",STR_PAD_LEFT);
		$transactionData->additionalFeild4=env('PAYMENT_PNAME');
        $posted=['messageType'=>$transactionData->messageType,'merchantId'=>$transactionData->merchantId,'serviceId'=>$transactionData->serviceId,'orderId'=>$transactionData->order_id,'customerId'=>$transactionData->customerId,'transactionAmount'=>$amount,'currencyCode'=>'INR','requestDateTime'=>$transactionData->requestDateTime,'successUrl'=>$transactionData->successUrl,'failUrl'=>$transactionData->failUrl,'additionalFeild1'=>$transactionData->master_pgd_id,'additionalFeild2'=>$transactionData->session_master_id,'additionalFeild4'=>$transactionData->additionalFeild4];
        $checksum=self::getChecksum($posted);
        $transactionData->checksum=$checksum;
        return $transactionData;
    }
    public static function getChecksum($posted){

        $salt_key=env('PAYMENT_SECRET_KEY');

        $hash_sequence = "messageType|merchantId|serviceId|orderId|customerId|transactionAmount|currencyCode|requestDateTime|successUrl|failUrl|additionalFeild1|additionalFeild2|additionalFeild3|additionalFeild4|additionalFeild5";
        $hash_sequence_array = explode('|', $hash_sequence);
        $hash = null;
        foreach ($hash_sequence_array as $value) {
            $hash .= isset($posted[$value]) ? $posted[$value] : '';
            $hash .= '|';
        }
        $hash .= $salt_key;
		//echo $hash;die();
        return crc32($hash);
    }
	public static function checkPaymentResponse($posted){
		$responseArry=explode('|',$posted);
		$checksumValue=array_pop($responseArry);
		$generatedChecksum=crc32(implode('|',$responseArry).'|'.env('PAYMENT_SECRET_KEY'));
		if($checksumValue==$generatedChecksum) return '1'; return '0';
	}
}
