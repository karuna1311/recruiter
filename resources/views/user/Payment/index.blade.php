@extends('layouts.UserDashboard')
@section('content')
 <div class="row">
     <div class="col-12">
        <div class="page-title-box">
           <h4 class="page-title">Payment</h4>
        </div>
     </div>
     <div class="col-12">
        <div class="card card-widget card-events">
           <div class="card-body">
            @if(count($scheduleData))
              <table class="table table-bordered table-centered mb-0 tableData">
                <thead class="table-dark">
                 <tr>
                    <th >Sr No.</th>
                    <th>Session Name</th>
                    <th class="text-center">Start date</th>
                    <th class="text-center">End date</th>
                    <th class="text-center">Fees</th>
                    <th>Action</th>
                 </tr>
               </thead>
                 @foreach($scheduleData as $key=>$data)
                 <tr>
                    <td>{{++$key}}</td>
                    <td>{{$data->sessionData->session_name}}</td>
                    <td>{{date('d-m-Y h:i:s A',strtotime($data->start_date))}}</td>
                    <td>{{date('d-m-Y h:i:s A',strtotime($data->end_date))}}</td>
                    <td>&#8377; {{$data->sessionData->sessionFee}}  /-<br>{{$data->sessionData->securityDeposite}}<br>{{$data->sessionData->total}}</td>
                    <td>
                      <a href="{{route('payment.store',$data->sessionData->id)}}" type="button" class="btn btn-apply" id="sessionApply" ><i class="uil-check"></i>Make Payment</a>
                     </td> 
                 </tr>
                 @endforeach
              </table>
              @else
              <p>Payment schedule not active</p>
              @endif
           </div>
           <div class="card-footer bg-transparent">
           </div>
        </div>
     </div>
</div>
@endsection