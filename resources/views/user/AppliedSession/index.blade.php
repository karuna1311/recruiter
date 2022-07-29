@extends('layouts.UserDashboard')
@section('content')
 <div class="row">
     <div class="col-12">
        <div class="page-title-box">
           <h4 class="page-title">Applied Session</h4>
        </div>
     </div>
     <div class="col-12">
        <div class="card card-widget card-events">
           <div class="card-body">
        
              <table class="table table-bordered table-centered mb-0 tableData">
                <thead class="table-dark">
                 <tr>
                    <th >Sr No.</th>
                    <th>Session Name</th>
                    <th>Payment Receipt</th>
                    <th>Application Report</th>
                 </tr>
               </thead>
                 <tr>
                  <td>1</td>
                  <td>{{$sessionData->session_name}}</td>
                  <td>
                     <a href="{{route('appliedSessions.paymentReceipt',[$sessionData->id])}}"><img src="{{ url('/') }}/LoginAssets/img/downloadIcon.GIF" class="downloadIcon"> </a>
                  </td>
                  <td>
                     <a class="btn btn-apply mb-1" href="{{route('appliedSessions.applicationReport',[$sessionData->id])}}"><i class="uil-file-download"></i> Download</a>
                  </td>
                 </tr>
              </table>
           </div>
           <div class="card-footer bg-transparent">
           </div>
        </div>
     </div>
</div>
@endsection