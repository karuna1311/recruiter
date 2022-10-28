<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePayment(Request $request)
    {
        dd('api.payment');
        $arryOfpaymentResponse=$request->all();
        // dd($arryOfpaymentResponse);
        // print_r($arryOfpaymentResponse);die();
        $dataSize=sizeof($arryOfpaymentResponse);
        for($i = 0; $i < $dataSize; $i++) 
        {
            $information=explode('=',$arryOfpaymentResponse[$i]);
            if($i==0)   $order_id=$information[1];
            if($i==1)   $tracking_id=$information[1];
            if($i==2)   $bank_ref_no=$information[1];
            if($i==8)   $status_message=$information[1];
            if($i==10)  $amount=$information[1];
            if($i==3)   $order_status=$information[1];
            if($i==26)  $merchant_param1=$information[1];
            if($i==27)  $merchant_param2=$information[1];
            if($i==28)  $merchant_param3=$information[1];
            if($i==29)  $merchant_param4=$information[1];
            if($i==40)  $trans_date=$information[1];
        }
        try{
      

            if($order_status==='Success'){

                $paymentInfoUpdate=transaction::where('order_id',$order_id)
                ->update([
                    'tracking_id'=>$tracking_id,
                    'bank_ref_no'=>$bank_ref_no,
                    'order_status'=>$order_status,
                    'payment_response_json'=>json_encode($arryOfpaymentResponse),
                    'updated_at'=>Carbon::now()
                ]);


                $transactionInfoId= transaction::where('order_id',$order_id)->select('id','created_at')->get();

                Payment::create(
                    [
                        'user_id' => '1',
                        'job_id'    => '1',
                        'amount' => $amount,
                        'order_id' => $order_id,
                        'tracking_id'=>$tracking_id,
                        'bank_ref_no'=>$bank_ref_no,
                        'order_status'=>$order_status,
                        'transaction_info_id'=>$transactionInfoId[0]['id'],                        
                        'payment_response_json'=>json_encode($arryOfpaymentResponse),
                        'created_at'=>$transactionInfoId[0]['updated_at'],
                        'updated_at'=>$transactionInfoId[0]['updated_at']
                    ]);
             }
        }catch(QueryException $exception){
            return Response::json(['status' => 'error','message'=>$exception->getMessage()]);
        }
       
        return Response::json(['status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
