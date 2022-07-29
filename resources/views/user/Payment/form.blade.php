<div style="display:none;">
<form id="paymentForm" name="paymentForm" method="POST" action="https://pilot.surepay.ndml.in/SurePayPayment/sp/processRequest" autocomplete="off">
  <fieldset>
  <input type="hidden" name="messageType" id="messageType" value="{{$paymentData->messageType}}" >
  <input type="hidden" name="merchantId" id="merchantId" value="{{$paymentData->merchantId}}">
  <input type="hidden" name="serviceId" id="serviceId" value="{{$paymentData->serviceId}}" >
  <input type="hidden" name="orderId" id="orderId" value="{{$paymentData->order_id}}">
  <input type="hidden" name="customerId" id="customerId" value="{{$paymentData->customerId}}" >
  <input type="hidden" name="transactionAmount" id="transactionAmount" value="{{$paymentData->amount}}">
  <input type="hidden" name="currencyCode" id="currencyCode" value="{{$paymentData->currencyCode}}">
  <input type="hidden" name="requestDateTime" id="requestDateTime"  value="{{$paymentData->requestDateTime}}" >
  <input type="hidden" name="successUrl" id="successUrl"  value="{{$paymentData->successUrl}}">
  <input type="hidden" name="failUrl" id="failUrl"  value="{{$paymentData->failUrl}}">
  <input type="hidden" name="additionalField1" id="additionalField1"  value="{{$paymentData->master_pgd_id}}">
  <input type="hidden" name="additionalField2" id="additionalField2"  value="{{$paymentData->session_master_id}}">
  <input type="hidden" name="additionalField3" id="additionalField3"  value="">
  <input type="hidden" name="additionalField4" id="additionalField4"  value="{{$paymentData->additionalFeild4}}">
  <input type="hidden" name="additionalField5" id="additionalField5" value="">
  <input type="hidden" name="checksum" id="checksum" value="{{$paymentData->checksum}}">
	
    <legend>Payment</legend>
    <table align="center">
        <tr>
          <td><h3 style="hidden-align:centre;">PLEASE CHOOSE YOUR PAYMENT MODE FOR COMPLETE PAYMENT PROCESS.</h3>
          </td>
        </tr>
      <tr class="payment_link">
        <td>
            <input type="submit" class="btn btn-success" value=" Online Payment" >
          </td>
      </tr>
    </table>
  </fieldset>
</form>
</div>
<script language='javascript'>document.paymentForm.submit();</script>
