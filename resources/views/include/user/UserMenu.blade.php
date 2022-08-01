<span id="loader" class="lds-dual-ring hidden overlay"></span>

<div class="leftside-menu">
   <!-- LOGO -->
   <a href="#" class="logo text-center logo-light">
   <span class="logo-lg">
   <img src="assets/img/cet-cell-logo.png" alt="" class="w-100">
   </span>
   <span class="logo-sm">
   <img src="assets/img/logo_heder.png" alt="" class="w-80">
   </span>
   </a>
   <!-- LOGO -->
   <a href="index.html" class="logo text-center logo-dark">
   <span class="logo-lg">
   <img src="assets/img/cet-cell-logo.png" alt="" class="w-100">
   </span>
   <span class="logo-sm">
   <img src="assets/img/logo_heder.png" alt="" class="w-80">
   </span>
   </a>
   <div class="h-100" id="leftside-menu-container" data-simplebar>
      <!--- Sidemenu -->
      <ul class="side-nav">
         <li class="side-nav-title side-nav-item">Navigation</li>
         <li class="side-nav-item"><a href="{{route('applicationstatus.index')}}" class="side-nav-link"> <i class="uil-file-check-alt"></i> <span>Application Status</span></a></li>
         @can('personal_info')
         <li class="side-nav-item">
            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
            <i class="uil-clipboard-alt"></i>
            
            <span>Application form </span><span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarDashboards">
               <ul class="side-nav-second-level">
                  @can('personal_info')
                  <li>

                     <a href="{{route('personalInfo.index')}}"> <i class="uil-comment-alt-edit"></i> <span>{{ trans('cruds.personalInformation.title_eng') }}</span>  </a>
                  </li>
                  @endcan
                  @can('reservation')
                  <li>
                     <a href="{{route('reservation.index')}}"> <i class="uil-money-stack"></i> <span>Reservation</span> </a>
                  </li>
                  @endcan
                  <!-- @can('') -->
                  <li>
                     <a href="{{route('qualification.index')}}"> <i class="uil-money-stack"></i> <span>Qualification</span> </a>
                  </li>
                  <!-- @endcan -->
                  @can('pre_college_info')
                  <li>
                     <a href="{{route('collegeInfo.index')}}"> <i class="uil-building"></i> <span>Previous College Information</span></a>
                  </li>
                  @endcan
                  @can('medical_council')
                  <li>
                     <a href="{{route('medicalCouncil.index')}}"> <i class="uil-medical-square-full"></i> <span>Medical Council Registration</span></a>
                  </li>
                  @endcan
                  @can('security_deposite')
                  <li>
                     <a href="{{route('securityDeposite.index')}}"> <i class="uil-keyhole-square-full"></i> <span>Security Deposite</span></a>
                  </li>
                  @endcan
                  @can('preview')
                  <li>
                     <a href="{{route('preview.index')}}"> <i class="uil-presentation-check"></i> <span>Preview</span></a>
                  </li>
                  @endcan
                  @can('declaration')
                  <li>
                     <a href="{{route('declaration.index')}}"> <i class="uil-check-circle"></i> <span>Declaration of Candidates</span></a>
                  </li>
                  @endcan
               </ul>
            </div>
         </li.
         >
         @endcan
         @can('session_application')
         <li class="side-nav-item">
            <a href="{{route('session.index')}}" class="side-nav-link"> <i class="uil-file-check-alt"></i><span>Session Application</span>  </a>
         </li>     
         @endcan
         @can('payment')
         <li class="side-nav-item"><a href="{{route('payment.index')}}" class="side-nav-link"> <i class="uil-file-check-alt"></i> <span>Payment</span></a></li>
         @endcan
         @can('document_upload')
         <li class="side-nav-item"><a href="{{route('document.index')}}" class="side-nav-link"> <i class="uil-file-check-alt"></i> <span>Document Upload</span></a></li>
         @endcan
         @can('applied_session')
         <li class="side-nav-item"><a href="{{route('appliedSessions.index')}}" class="side-nav-link"> <i class="uil-file-check-alt"></i> <span>Applied Session</span></a></li>
         @endcan
      </ul>
      <div class="clearfix"></div>
   </div>
   <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->