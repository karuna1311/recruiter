<?php

namespace App\Services;

class MobileSms 
{
    public static function sendSms($msg,$mobile,$tmpId)
    {
        $msg=urlencode($msg);
        $msgApi="https://webpostservice.com/sendsms_v2.0/sendsms.php?apikey=".config('sms.apikey')."&type=TEXT&sender=".config('sms.sender')."&mobile=".$mobile."&message=".$msg."&peId=".config('sms.peId')."&tempId=".$tmpId;
        $i=2;
        while($i){
          $response=self::curl_get_contents($msgApi);
          $i--;
        }
        return $response;
    }
    public static function curl_get_contents($url){
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      return $response;
    }
}
