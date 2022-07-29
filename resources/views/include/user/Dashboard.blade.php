<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      @include('include.userhead')
   </head>
   <body class="loading" data-layout-config='{"leftSideBarTheme":"light","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false}'>
      <!-- Begin page -->
      <div class="wrapper">
         @include('include.UserTopNav')
         <div class="content-page">
            <div class="content">
               <!-- Topbar Start -->
               @include('include.UserHeader')
               <!-- end Topbar -->
               <!-- Start Content-->
               <div class="container-fluid">
                  <!-- start page title -->
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
                              <a href="OnlineForm" class="link-03 tx-16">Go and complete your profile <span class="examlink"><b>Click Here</b></span></a>
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
                                 <li class="media">
                                    <div class="media-left">
                                       <label>Step</label>
                                       <p>01</p>
                                    </div>
                                    <div class="media-body event-panel-green">
                                       <h6 class="event-title">Registration</h6>
                                    </div>
                                    <div class="media-right">
                                       <button class="btn-complete btn"><i class="fa fa-check"></i> Complete</button>
                                    </div>
                                 </li>
                                 <!-- media item -->
                                 <li class="media">
                                    <div class="media-left">
                                       <label>Step</label>
                                       <p>02</p>
                                    </div>
                                    <div class="media-body event-panel-orange">
                                       <h6 class="event-title">Personal Information</h6>
                                    </div>
                                    <div class="media-right">
                                       <button class="btn-incomplete btn">Incomplete</button>
                                    </div>
                                 </li>
                                 <!-- media item -->
                                 <li class="media">
                                    <div class="media-left">
                                       <label>Step</label>
                                       <p>03</p>
                                    </div>
                                    <div class="media-body event-panel-pink">
                                       <h6 class="event-title">Reservation</h6>
                                    </div>
                                    <div class="media-right">
                                       <button class="btn-incomplete btn">Incomplete</button>
                                    </div>
                                 </li>
                                 <!-- media item -->
                                 <li class="media">
                                    <div class="media-left">
                                       <label>Step</label>
                                       <p>04</p>
                                    </div>
                                    <div class="media-body event-panel-primary">
                                       <h6 class="event-title">Details Of Inservice Quota</h6>
                                    </div>
                                    <div class="media-right">
                                       <button class="btn-incomplete btn">Incomplete</button>
                                    </div>
                                 </li>
                                 <!-- media item -->
                                 <li class="media">
                                    <div class="media-left">
                                       <label>Step</label>
                                       <p>05</p>
                                    </div>
                                    <div class="media-body event-panel-orange">
                                       <h6 class="event-title">Previous College Information</h6>
                                    </div>
                                    <div class="media-right">
                                       <button class="btn-incomplete btn">Incomplete</button>
                                    </div>
                                 </li>
                                 <!-- media item -->
                                 <li class="media">
                                    <div class="media-left">
                                       <label>Step</label>
                                       <p>06</p>
                                    </div>
                                    <div class="media-body event-panel-green">
                                       <h6 class="event-title">Previous Attempt of PG-CET NET PG</h6>
                                    </div>
                                    <div class="media-right">
                                       <button class="btn-incomplete btn">Incomplete</button>
                                    </div>
                                 </li>
                                 <!-- media item -->
                                 <li class="media">
                                    <div class="media-left">
                                       <label>Step</label>
                                       <p>07</p>
                                    </div>
                                    <div class="media-body event-panel-pink">
                                       <h6 class="event-title">Medical Council Registration</h6>
                                    </div>
                                    <div class="media-right">
                                       <button class="btn-incomplete btn">Incomplete</button>
                                    </div>
                                 </li>
                                 <!-- media item -->
                                 <li class="media">
                                    <div class="media-left">
                                       <label>Step</label>
                                       <p>08</p>
                                    </div>
                                    <div class="media-body event-panel-primary">
                                       <h6 class="event-title">Declaration Of Candidates</h6>
                                    </div>
                                    <div class="media-right">
                                       <button class="btn-incomplete btn">Incomplete</button>
                                    </div>
                                 </li>
                                 <!-- media item -->
                                 <li class="media">
                                    <div class="media-left">
                                       <label>Step</label>
                                       <p>09</p>
                                    </div>
                                    <div class="media-body event-panel-orange">
                                       <h6 class="event-title">Payment</h6>
                                    </div>
                                    <div class="media-right">
                                       <button class="btn-incomplete btn">Incomplete</button>
                                    </div>
                                 </li>
                                 <!-- media item -->
                                 <li class="media">
                                    <div class="media-left">
                                       <label>Step</label>
                                       <p>10</p>
                                    </div>
                                    <div class="media-body event-panel-green">
                                       <h6 class="event-title">Documents Upload</h6>
                                    </div>
                                    <div class="media-right">
                                       <button class="btn-incomplete btn">Incomplete</button>
                                    </div>
                                 </li>
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
               <!-- container -->
            </div>
            <!-- content -->
            @include('include.userFooter')
         </div>
      </div>
      <!-- container -->
      
   </body>
</html>