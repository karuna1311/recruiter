<div style="display:block;">
<form id="paymentForm" name="paymentForm" method="POST" 
action="https://smbgroup.co.in/Payment/BANK_RECRUITMENT/OnlinePayment.php"
 autocomplete="off">
  <fieldset>
  
  <input type="hidden" name="merchantId" id="merchantId" value="{{$payment_user['merchantId']}}">
  <input type="hidden" name="orderId" id="orderId" value="{{$payment_user['order_id']}}">
   <input type="hidden" name="user_id" id="user_id" value="{{$payment_user['user_id']}}" > 
  <input type="hidden" name="transactionAmount" id="transactionAmount" value="{{$payment_user['amount']}}">
  <input type="hidden" name="currencyCode" id="currencyCode" value="{{$payment_user['currencyCode']}}">
  <input type="hidden" name="requestDateTime" id="requestDateTime"  value="{{$payment_user['created_at']}}" >
  {{-- <input type="hidden" name="successUrl" id="successUrl"  value="{{$payment_user->successUrl}}"> 
  {{-- <input type="hidden" name="failUrl" id="failUrl"  value="{{$payment_user->failUrl}}"> --}}
   <input type="hidden" name="additionalField1" id="additionalField1"  value="{{$payment_user['user_id']}}">         
  <input type="hidden" name="additionalField2" id="additionalField2"  value="{{$payment_user['mobile']}}">         
  <input type="hidden" name="additionalField3" id="additionalField3"  value="{{$payment_user['email']}}">           
  <input type="hidden" name="additionalField4" id="additionalField4"  value="{{json_encode($payment_user['job_wise'])}}">       
   <input type="hidden" name="additionalField5" id="additionalField5" value="{{json_encode($payment_user['groupjob_wise'])}}">
  <input type="hidden" name="checksum" id="checksum" value="{{$payment_user['checksum']}}"> 
	
  @php
            
  $FormattedData=$payment_user['order_id'].'|'. $payment_user['user_id'].'|'.$payment_user['amount'].'|'.$payment_user['currencyCode'].'|'.$payment_user['created_at'].'|'.$payment_user['mobile'].'|'.$payment_user['email'].'|'.json_encode($payment_user['job_wise']).'|'.json_encode($payment_user['groupjob_wise']);   // order_id,user id,amount
  $CheckSumKey=$payment_user['checksum'];
  $CheckSumValue=hash_hmac('sha256',$FormattedData,$CheckSumKey,false);
  $CheckSumValue=strtoupper($CheckSumValue);
  $FormattedDataa=$FormattedData."|".$CheckSumValue;
@endphp
    <legend>Payment</legend>
    <input type="hidden" name="msg" id="msg" value="{{$FormattedDataa}}">
    
    <table align="center">
        <tr>
          <td><h3 style="hidden-align:centre;">PLEASE CHOOSE YOUR PAYMENT MODE FOR COMPLETE PAYMENT PROCESS.</h3>
          </td>
        </tr>
      <tr class="payment_link">
        <td>
            <input type="submit" class="btn btn-success" value="Online Payment" >
          </td>
      </tr>
    </table>
  </fieldset>
</form>
</div>
<script language='javascript'>document.paymentForm.submit();</script>


