@extends('layouts.UserDashboard')
@section('content')
 <div class="row">
     <div class="col-12">
        <div class="page-title-box">
           <h4 class="page-title">Applied Job Payment</h4>
        </div>
     </div>
     <?php $i=1; ?>
   
   <div class="col-12">
        <div class="card card-widget card-events">
         <div class="col-mb-6 ml-3 mt-3 mr-3">
            <form action="{{ route('payment.unlockProfile') }}" method="POST" >
             <input type="hidden" name="_method" value="POST">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="submit" class="btn btn-xs btn-success pull-right" value="Apply Jobs">
          </form>
       </div>
           <div class="card-body">
              <table class="table table-bordered table-centered mb-0 tableData">
                 <thead class="table-dark">
                 <tr>
                    <th >Sr No.</th>
                    <th>Job Name</th>
                    <th>Payment Receipt</th>
                    <th>Application Report</th>
                 </tr>
               </thead>
           
               <?php if($user->application_status >= '7' && $user->status_lock == 1){ ?>
               @foreach ($jobpayment as $item)
               <tr>
                  <td>{{$i}}</td>
                  <td>{{$item->name}}</td>
                  <td>
                     <a href="{{route('appliedJobPayment.paymentReceipt',[base64_encode($item->order_id),base64_encode($item->job_id)])}}"><img src="{{ url('/') }}/public/LoginAssets/img/downloadIcon.GIF" class="downloadIcon"> </a>
                  </td>
                  <td>
                     <a class="btn btn-apply mb-1" href="{{route('appliedJobPayment.applicationReport',[base64_encode($item->order_id),base64_encode($item->job_id)])}}"><i class="uil-file-download"></i> Download</a>
                  </td>
                  <?php $i++; ?>
                 </tr>
               @endforeach
              <?php }else{  ?>
               <tr>
                  <td colspan="4">Please lock the status and Update the application status</td>
                              
                  
                 </tr>
               
               <?php } ?>
              </table>
           </div>
           <div class="card-footer bg-transparent">
           </div>
        </div>
     </div>
</div>
@endsection