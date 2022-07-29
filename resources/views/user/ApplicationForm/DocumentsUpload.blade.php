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
                        <h4 class="page-title">Application Form</h4>
                     </div>
                  </div>
                  <div class="col-12">
                     <div class="tab-content">
                        <form autocomplete="off">
                           <fieldset class="form-fieldset">
                              <legend>Upload Documents  </legend>
                              <div class="row form-group br-bt-1 justify-content-center mb-2">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">Nationality Certificate/Valid Indian Passport or H.S.C (or Equivalent) School Leaving Certificate <br>राष्ट्रीयत्व प्रमाणपत्र/वैध भारतीय पासपोर्ट किंवा H.S.C (किंवा समतुल्य) शाळा सोडल्याचे प्रमाणपत्र</label>
                                 </div>
                                 <div class=" col-md-5">
                                   <input type="file" class="form-control" name="" id="">
                                 </div>                               
                              </div>
                              <div class="row form-group br-bt-1 justify-content-center mb-2">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">Domicile Certificate <br>अधिवास प्रमाणपत्र</label>
                                 </div>
                                 <div class=" col-md-5">
                                   <input type="file" class="form-control" name="" id="">
                                 </div>                               
                              </div>
                              <div class="row form-group br-bt-1 justify-content-center mb-2">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">MBBS Degree/Passing Certificate<br>एमबीबीएस पदवी / उत्तीर्ण प्रमाणपत्र</label>
                                 </div>
                                 <div class=" col-md-5">
                                   <input type="file" class="form-control" name="" id="">
                                 </div>                               
                              </div>
                              <div class="row form-group br-bt-1 justify-content-center mb-2">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">Admit Card of NEET-PG-2021<br>NEET-PG-2021 चे प्रवेशपत्र</label>
                                 </div>
                                 <div class=" col-md-5">
                                   <input type="file" class="form-control" name="" id="">
                                 </div>                               
                              </div>
                              <div class="row form-group br-bt-1 justify-content-center mb-2">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">Admit Card of NEET-PG-2021<br>NEET-PG-2021 चे प्रवेशपत्र</label>
                                 </div>
                                 <div class=" col-md-5">
                                   <input type="file" class="form-control" name="" id="">
                                 </div>                               
                              </div>
                              <div class="row form-group br-bt-1 justify-content-center mb-2">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">Admit Card of NEET-PG-2021<br>NEET-PG-2021 चे प्रवेशपत्र</label>
                                 </div>
                                 <div class=" col-md-5">
                                   <input type="file" class="form-control" name="" id="">
                                 </div>                               
                              </div>
                              <div class="row form-group br-bt-1 justify-content-center mb-2">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">Admit Card of NEET-PG-2021<br>NEET-PG-2021 चे प्रवेशपत्र</label>
                                 </div>
                                 <div class=" col-md-5">
                                   <input type="file" class="form-control" name="" id="">
                                 </div>                               
                              </div>
                              <div class="row form-group br-bt-1 ">
                                 <div class="col-md-12 text-right">
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