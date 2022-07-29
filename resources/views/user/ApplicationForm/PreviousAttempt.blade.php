<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      @include('.include.userhead')
   </head>
   <body class="loading" data-layout="full" data-layout-config='{"leftSideBarTheme":"light", "layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
      <!-- Begin page -->
      <div class="wrapper">
         @include('include.UserTopNav')
         <div class="content-page">
            <div class="content">
               <!-- Topbar Start -->
               @include('include.UserHeader')
               <!-- end Topbar -->
               <div class="row">
                  <div class="col-12">
                     <div class="page-title-box">
                        <!--  <div class="page-title-right">
                           <ol class="breadcrumb m-0">
                               <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                               <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                               <li class="breadcrumb-item active">CRM</li>
                           </ol>
                           </div> -->
                        <h4 class="page-title">Application Form</h4>
                     </div>
                  </div>
                  <div class="col-12">
                     <div class="tab-content">
                        <form autocomplete="off">
                           <fieldset class="form-fieldset">
                              <legend>Previous Attempt of PG-CET NET PG  </legend>
                              <div class="row form-group br-bt-1 justify-content-center">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">Details of previous  PGM-CET NEET PG Attempted by the candidate  <br>उमेदवाराने प्रयत्न केलेल्या मागील पीजीएम-सीईटी एनईईटी पीजीचा तपशील :</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" id="customCheck1">
                                       <label class="custom-control-label" for="customCheck1">None</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" id="customCheck2">
                                       <label class="custom-control-label" for="customCheck2">2018</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" id="customCheck3">
                                       <label class="custom-control-label" for="customCheck3">2019</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" id="customCheck4">
                                       <label class="custom-control-label" for="customCheck4">2020</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="row form-group ">
                                 <div class="col-md-6 ">
                                    <button type="button" class="btn btn-warning mb-3">Previous</button>
                                 </div>
                                 <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-secondary mb-3">Save As Draft</button>
                                    <button type="button" class="btn btn-success mb-3">Save And Next</button>
                                 </div>
                              </div>
                           </fieldset>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            @include('include.userFooter')
         </div>
      </div>
   </body>
</html>