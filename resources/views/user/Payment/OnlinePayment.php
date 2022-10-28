<html>
<head>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<title>MCGM</title>
<style>
table { border: 1px solid #BDE5F8; }
td{font-family: Arial; font-size: 10pt;}
tr:nth-child(even) {background-color: #f2f2f2;}
input[type=text] {
  width: 100%;
  padding: 05px 10px;
  margin: 5px 0;
  box-sizing: border-box;
  border: none;
  background-color: #3CBC8D;
  color: white;
}
.button {
  background-color: #555555; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

</style>
<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
</head>

<body>

<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
$subdate = date('d-m-Y H:i:s');

//API Post data Processing
$posturl=$_SERVER['HTTP_ORIGIN'];
$Response=$_POST['msg']; 
$ArrResponse=explode("|",$Response);
  
// print_r($ArrResponse);
// die();
 $billres=$ArrResponse[0]."|".$ArrResponse[1]."|".$ArrResponse[2]."|".$ArrResponse[3]."|".$ArrResponse[4]."|".$ArrResponse[5]."|".$ArrResponse[6]
 ."|".$ArrResponse[7]."|".$ArrResponse[8]."|".$ArrResponse[9];
   


$CheckSumKey='7DX2bbMKc9YU';
$CheckSumValue=hash_hmac('sha256',$billres,$CheckSumKey,false);
$CheckSumValue=strtoupper($CheckSumValue);

if (
  $ArrResponse[9]===$CheckSumValue )
// and ($posturl==='http://127.0.0.1:8000') or ($posturl==='http://13.127.59.127') or ($posturl==='http://3.108.174.42')))
{
	
	//include('db.php');
	//echo $sql="INSERT INTO Payment_Initiate(order_id, order_amount, sub_datetime) VALUES ('$ArrResponse[0]','$ArrResponse[1]','$subdate')";
	//$mysqli ->query($sql);
	//$mysqli ->close();	
}else{
	echo "Something went wrong....(Security Issue)";
	exit();
} 
  
    $order_id=$ArrResponse[0];
  	// $user_id=$ArrResponse[1];
  	// $amount=$ArrResponse[2];
    
  	// $apiBodyJson=json_encode(array('amount'=>$amount,'user_id'=>$user_id));                       
  	// $header=array(
    //   "accept: application/json",
    //   "cache-control: no-cache",
    //   "content-type: application/json",
    //   "x-api-key: 579ad4b3-91e6-45fe-87a2-ffee681184cb");
  	// $curl = curl_init();
    //   curl_setopt_array($curl, array(
    //     CURLOPT_URL => 'http://3.108.174.42/BANK_RECRUITMENT/public/api/storePaymentInfo',
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => "",
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 30,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => 'POST',
    //     CURLOPT_POSTFIELDS => $apiBodyJson,
    //     CURLOPT_HTTPHEADER => $header,
    //   ));
    // $response = curl_exec($curl);
    // $err = curl_error($curl);
    // curl_close($curl);
    // if ($err) {
    //   ?>
    //     <script>
    //       alert('<?php echo $err;?>');
    //       //window.location.href='http://doaonline.in/DOA_KalaPradarshan/public/home';
    //     </script>
    //   <?php
    // } else {
    //   $arryOfResponse=json_decode($response,true);
    //   //print_r($arryOfResponse);die();
    //   if($arryOfResponse['status']=='error')
    //   {
  	// 	?>
    //     <script>
    //       alert('<?php echo $arryOfResponse['message'];?>');
    //       window.location.href='http://doaonline.in/BANK_RECRUITMENT/public/home';
    //     </script>
    //   	<?php
    //   }
    //   if($arryOfResponse['status']=='success')
    //   {
    //     $order_id=$arryOfResponse['data'];
    //   }
    // }

?>
<form method="post" name="customerData" action="ccavRequestHandler.php">
		
			<input type="hidden" name="tid" id="tid" readonly />
			<input type="text" name="merchant_id" value="    "/>
			
			<table width="35%" height="100" border='0' align="center" cellspacing="0" cellpadding="4">
				<tr><td colspan="2" align="center" bgcolor="#BDE5F8"><font size="4px"><b>Online Payment</b></font></td></tr>
						
				<tr>
					<td>Order Id	:</td><td><input type="text" name="order_id" value="<?php echo $order_id; ?>" readonly/></td>
				</tr>
				<tr>
					<td>Amount	:</td><td><input type="text" name="amount" value="<?php echo $ArrResponse[2]; ?>" readonly/></td>
				</tr>
				 
		        <tr>
		        	<td colspan="2" align="center"><INPUT TYPE="submit" class="button" value="Go for Payment"></td></td>
		        </tr>
	      	</table>
	      	</table>
	      	<!-- <input type="hidden" name="currency" value="INR"/> -->
			  <input type="hidden" name="redirect_url" value="https://smbgroup.co.in/Payment/BANK_RECRUITMENT/ccavResponseHandler.php"/>
	      	<input type="hidden" name="cancel_url" value="https://smbgroup.co.in/Payment/BANK_RECRUITMENT/ccavResponseHandler.php"/> 
			<input type="hidden" name="language" value="EN"/>
			<input type="hidden" name="merchant_param1" value="<?php echo $ArrResponse[0];?>" />
			<input type="hidden" name="merchant_param2" value="<?php echo $ArrResponse[1];?>"/>
			<input type="hidden" name="merchant_param3" value="<?php echo $ArrResponse[2];?>"/>
      <input type="hidden" name="merchant_param4" value="<?php echo $ArrResponse[3];?>"/>
	      </form>
	</body>
</html>