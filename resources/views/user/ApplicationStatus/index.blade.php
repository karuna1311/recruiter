@extends('layouts.UserDashboard')
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="page-title-box">
            <h4 class="page-title">Application Status</h4>
         </div>
      </div>
      <div class="col-12">
         <div class="card card-widget card-events">
            <div class="card-header">
               <h6 class="card-title mg-b-0">Registration Form Status <span class="examname"> (NEET PGD) </span></h6>
               @if(count($incompleteStatusArray))
               <a href="{{route($incompleteStatusArray['route'])}}" class="link-03 tx-16" href="">Go and complete your profile <span class="examlink"><b>Click Here</b></span></a>
               @endif
            </div>
            <!-- card-header -->
            <div class="card-body">
               <ul class="list-unstyled media-list mg-b-0">
                  <li class="media">
                     <div class="media-left">
                        <h6 class="eventtitle">Step ID</h6>
                     </div>
                     <div class="mediabody">
                        <h6 class="eventtitle">Step Details</h6>
                     </div>
                     <div class="media-right">
                        <h6 class="eventtitle" >Status</h6>
                     </div>
                  </li>
                  <!-- media item -->
                  @foreach($appStatusArray as $key=>$data)
                  <li class="media">
                     <div class="media-left">
                        <label>Step</label>
                        <p>{{$key}}</p>
                     </div>
                     <div class="media-body event-panel-green">
                        <h6 class="event-title">{{$data['name']}}</h6>
                     </div>
                     <div class="media-right">
                        <button class="btn-{{($data['status']=='Complete')?'complete':'incomplete'}} btn"><i class="fa fa-check"></i> {{$data['status']}}</button>
                     </div>
                  </li>
                  @endforeach
               </ul>
            </div>
            <!-- card-body -->
            <div class="card-footer bg-transparent">
            </div>
            <!-- card-footer -->
         </div>
      </div>
   </div>
   <!-- end page title --> 
</div>
@endsection        
            