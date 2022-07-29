@extends('layouts.UserDashboard')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title">Preview Application</h4>
      </div>
   </div>
   <div class="col-12">
      <div class="card card-widget card-events">
         <!-- card-header -->
         <div class="card-body">
            <div class="accordion custom-accordion" id="custom-accordion-one">
               <!-- // NEET INFORMATION -->
               <div class="card mb-0">
                  <div class="card-header" id="headingSeven">
                     <h5 class="m-0 w-100">
                        <a class="custom-accordion-title collapsed d-block py-1"
                           data-bs-toggle="collapse" href="#collapseOne"
                           aria-expanded="true" aria-controls="collapseOne">
                        <i class="uil-building"></i> NEET-PGD Details <i
                           class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseOne" class="collapse show"
                     aria-labelledby="headingSeven"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        
                        <fieldset class="form-fieldset mt-3">
                           <legend>PREVIOUS ATTEMPT OF NEET PG</legend>
                           <div class="row form-group br-bt-1">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.registration.NeetRollNo_eng') }}<br>{{ trans('cruds.registration.NeetRollNo_dev') }}:</label>
                              </div>
                              <div class=" col-md-2">
                                 <p class="uppercase primary_color"><b>{{$userData['rollno']}}</b></p>
                              </div>

                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.registration.NeetAppNo_eng') }}<br>{{ trans('cruds.registration.NeetAppNo_dev') }}:</label>
                              </div>
                              <div class=" col-md-2">
                                 <p class="uppercase primary_color"><b>{{$userData['neetappno']}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.DateOfBirth_eng') }}<br> {{ trans('cruds.personalInformation.fields.DateOfBirth_dev') }}:</label>
                              </div>
                              <div class=" col-md-2">
                                 <p class="uppercase primary_color"><b>{{$userData['dob']}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.registration.NeetRank_eng') }}<br> {{ trans('cruds.registration.NeetRank_dev') }}:</label>
                              </div>
                              <div class=" col-md-2">
                                 <p class="uppercase primary_color"><b>{{$userData['arank']}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.registration.NeetMark_eng') }}<br> {{ trans('cruds.registration.NeetMark_dev') }}:</label>
                              </div>
                              <div class=" col-md-2">
                                 <p class="uppercase primary_color"><b>{{$userData['neet_marks']}}</b></p>
                              </div>

                           </div>
                        </fieldset>
                     </div>
                  </div>
                  <!-- //End Previous College Information -->
               </div>
               <!-- //Personal Information -->
               <div class="card mb-0">
                  <div class="card-header" id="headingFour">
                     <h5 class="m-0 w-100">
                        <a class="custom-accordion-title d-block py-1"
                           data-bs-toggle="collapse" href="#collapseFour"
                           aria-expanded="false" aria-controls="collapseFour">
                        <i class="uil-comment-alt-edit"></i> Personal Information <i
                           class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseFour" class="collapse"
                     aria-labelledby="headingFour"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset">
                           <legend>{{ trans('cruds.personalInformation.title_eng') }} <span class="text-muted">{{ trans('cruds.personalInformation.title_dev') }}</span></legend>
                           <div class="row form-group">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.name_eng') }}  <br>{{ trans('cruds.personalInformation.fields.name_dev') }}:</label>
                              </div>
                              <div class=" col-md-6">
                                 <p id="firstname" class="uppercase primary_color"><b>{{$userData['name']}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group ">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.namchange_eng') }} <br>{{ trans('cruds.personalInformation.fields.namchange_dev') }} ?:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->cname_change??'--'}}</b></p>
                              </div>
                              @if($previewData->cname_change=='YES')
                              <div class="col-md-3 " >
                                 <p class="uppercase primary_color">Updated Name: <b>{{$previewData->cname_change_value??'--'}}</b></p>
                              </div>
                              @endif
                           </div>
                           <div class="row form-group">
                              <div class="col-md-2 text-right">
                                 <label class="d-block ">{{ trans('cruds.personalInformation.fields.fatherName_Eng') }} <br> {{ trans('cruds.personalInformation.fields.fatherName_dev') }}:</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->fname??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.motherName_Eng') }} <br>{{ trans('cruds.personalInformation.fields.motherName_dev') }}:</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->mname??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.gender_eng') }} <br>{{ trans('cruds.personalInformation.fields.Gender_dev') }}:</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->gender??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.DateOfBirth_eng') }} :<br> {{ trans('cruds.personalInformation.fields.DateOfBirth_dev') }}:</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"  ><b>{{$userData['dob']}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.Mobile_eng') }} <br> {{ trans('cruds.personalInformation.fields.Mobile_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"  ><b>{{$userData['mobile']}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.email_eng') }} <br> {{ trans('cruds.personalInformation.fields.email_dev') }}:</label>
                              </div>
                              <div class="col-md-2">
                                 <p class=" primary_color"><b>{{$userData['email']}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group ">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.alternateContact_eng') }}:<br> {{ trans('cruds.personalInformation.fields.alternateContact_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->alternate_mobile??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.aadhar_eng') }}: <br> {{ trans('cruds.personalInformation.fields.aadhar_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->adhar_card_no??'--'}}</b></p>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset class="form-fieldset mt-3">
                           <legend>{{ trans('cruds.personalInformation.fields.PermanentAdd_eng') }} <span class="text-muted">{{ trans('cruds.personalInformation.fields.PermanentAdd_dev') }}</span></legend>
                           <div class="row form-group">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine1_eng') }}:<br> {{ trans('cruds.personalInformation.fields.addressLine1_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->permanent_address_1??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine2_eng') }}:<br> {{ trans('cruds.personalInformation.fields.addressLine2_dev') }}:</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->permanent_address_2??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine3_eng') }}:<br> {{ trans('cruds.personalInformation.fields.addressLine3_dev') }}:</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->permanent_address_3??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group ">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.city_eng') }} <br> {{ trans('cruds.personalInformation.fields.city_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->permanent_city??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.state_eng') }} <br> {{ trans('cruds.personalInformation.fields.state_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->permanent_state??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.district_eng') }} <br> {{ trans('cruds.personalInformation.fields.district_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->permanent_district??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group ">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.taluka_eng') }} <br> {{ trans('cruds.personalInformation.fields.taluka_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->permanent_taluka??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.PinCode_eng') }} <br> {{ trans('cruds.personalInformation.fields.PinCode_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->permanent_pin_code??'--'}}</b></p>
                              </div>
                           </div>
                        </fieldset>
                        @if($previewData->address_not_same=='1')
                        <fieldset class="form-fieldset mt-3  mb-3" id="presentAddressDiv">
                           <legend>Present Address <span class="text-muted">वर्तमान पत्ता</span></legend>
                           <div class="row form-group">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine1_eng') }}:<br> {{ trans('cruds.personalInformation.fields.addressLine1_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->present_address_1??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine2_eng') }}:<br> {{ trans('cruds.personalInformation.fields.addressLine2_dev') }}:</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->present_address_2??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.addressLine3_eng') }}:<br> {{ trans('cruds.personalInformation.fields.addressLine3_dev') }}:</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->present_address_3??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group ">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.city_eng') }} <br> {{ trans('cruds.personalInformation.fields.city_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->present_city??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.state_eng') }} <br> {{ trans('cruds.personalInformation.fields.state_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->present_state??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.district_eng') }} <br> {{ trans('cruds.personalInformation.fields.district_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->present_district??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group ">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.taluka_eng') }} <br> {{ trans('cruds.personalInformation.fields.taluka_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->present_taluka??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.PinCode_eng') }} <br> {{ trans('cruds.personalInformation.fields.PinCode_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{$previewData->present_pin_code??'--'}}</b></p>
                              </div>
                           </div>
                        </fieldset>
                        @endif
                     </div>
                  </div>
               </div>
               <!-- //End Personal Information -->
               <!-- //Reservation -->
               <div class="card mb-0">
                  <div class="card-header" id="headingFive">
                     <h5 class="m-0 w-100">
                        <a class="custom-accordion-title collapsed d-block py-1"
                           data-bs-toggle="collapse" href="#collapseFive"
                           aria-expanded="false" aria-controls="collapseFive">
                        <i class="uil-money-stack"></i> Reservation <i
                           class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseFive" class="collapse"
                     aria-labelledby="headingFive"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset mb-3">
                           <legend>{{ trans('cruds.Reservation.title_eng') }} <span class="text-muted">{{ trans('cruds.Reservation.title_dev') }}</span></legend>
                           <div class="row  ">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.Reservation.fields.nri_eng') }} <br>{{ trans('cruds.Reservation.fields.nri_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->nriq??'--'}}</b></p>
                              </div>
                           </div>
                           @if($previewData->nriq=='YES')
                           <div class="row form-group  mt-3 " id="nridetails">
                              <div class="col-md-3 text-right">
                                 <label class="d-block">{{ trans('cruds.Reservation.fields.nriSelf_eng') }} <br>{{ trans('cruds.Reservation.fields.nriSelf_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->nrim??'--'}}</b></p>
                              </div>
                              <div class="col-md-3 text-right">
                                 <label class="d-block">{{ trans('cruds.Reservation.fields.NriWard_eng') }}: <br>{{ trans('cruds.Reservation.fields.NriWard_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->nriw??'--'}}</b></p>
                              </div>
                           </div>
                           @endif
                        </fieldset>

                        <fieldset class="form-fieldset mb-3">
                           <div class="row">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.Reservation.fields.Nationality_eng') }} <br>{{ trans('cruds.Reservation.fields.Nationality_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->nation??'--'}}</b></p>
                              </div>
                           </div>

                           <div class="row form-group natDetails ">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.Reservation.fields.domicile_eng') }} <br>{{ trans('cruds.Reservation.fields.domicile_dev') }}</label>
                              </div>
                              <div class="col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->domicle_maharashtra??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group  ForDetails CatDetail  ">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.Reservation.fields.Category_eng') }} <br>{{ trans('cruds.Reservation.fields.Category_dev') }}:</label>
                              </div>
                              <div class="col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->cate??'--'}}</b></p>
                              </div>
                           </div>

                           <div class="certificateDetails">
                              @if($previewData->nriq=='NO')
                              <div class="row form-group  ">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.AnnualIncome_eng') }} <br>{{ trans('cruds.Reservation.fields.AnnualIncome_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->annual_family_income??'--'}}</b></p>
                                 </div>
                             
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.regionOfResidence_eng') }} <br>{{ trans('cruds.Reservation.fields.regionOfResidence_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->region_of_residence??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif

                              @if($previewData->cate=='EWS')
                              <div class="row form-group ewsdetails">
                                  <div class="col-md-6 text-right">
                                      <label class="d-block">{{ trans('cruds.Reservation.fields.certStatus_eng') }}<br> {{ trans('cruds.Reservation.fields.certStatus_dev') }} </label>
                                  </div>
                                  <div class=" col-md-3">
                                      <p class="uppercase primary_color"><b>{{$previewData->ews_cert_status??'--'}}</b></p>
                                  </div>
                              </div>
                               @endif
                               
                              @if($previewData->ews_cert_status=='AVAILABLE')
                              <div class="row form-group   ewscertavaildetails">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.EwsCertificateNo_eng') }} <br>{{ trans('cruds.Reservation.fields.EwsCertificateNo_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.EWSCertIssuingDistrict_eng') }} <br>{{ trans('cruds.Reservation.fields.EWSCertIssuingDistrict_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_issue_dist??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif

                              @if($previewData->ews_cert_status=='APPLIED BUT NOT RECEIVED')
                              <div class="row form-group  certdetails">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.EwsApplicationNo_eng') }}:<br>{{ trans('cruds.Reservation.fields.EwsApplicationNo_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_appli_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.EwsApplicationDate_eng') }}<br>{{ trans('cruds.Reservation.fields.EwsApplicationDate_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_appli_date??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.EwsEwsAppDistrict_eng') }} <br>{{ trans('cruds.Reservation.fields.EwsEwsAppDistrict_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_appli_issue_dist??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.EwsIssuingTaluka_eng') }} <br>{{ trans('cruds.Reservation.fields.EwsIssuingTaluka_dev') }} :</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_appli_issue_taluka??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->cate=='SC' || $previewData->cate=='ST' || $previewData->cate=='DT-VJ(A)' || $previewData->cate=='NT(B)' || $previewData->cate=='NT(C)' || $previewData->cate=='NT(D)' || $previewData->cate=='OBC' || $previewData->cate=='SBC')
                              <div class="row form-group br-bt-1 scdetails ">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.ScCasteCert_eng') }}<br>{{ trans('cruds.Reservation.fields.ScCasteCert_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_certificate??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif

                              @if($previewData->caste_certificate=='AVAILABLE')
                              <div class="row form-group  sccertavaildetails ">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertNumber_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteCertNumber_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertInssDist_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteCertInssDist_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_issue_district??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->caste_certificate=='APPLIED BUT NOT RECEIVED')
                              <div class="row form-group sccertdetails">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertAteappnNo_eng') }}  <br>{{ trans('cruds.Reservation.fields.CasteCertAteappnNo_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_appli_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertappDate_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteCertappDate_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_appli_date??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertDist_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteCertDist_dev') }}</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_appli_issue_dist??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertTal_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteCertTal_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_appli_issue_taluka??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->caste_certificate=='AVAILABLE')
                              <div class="row form-group castavail">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValidity_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteValidity_dev') }} :</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->caste_validity=='AVAILABLE')
                              <div class="row form-group  CasteValAvail">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValNumber_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteValNumber_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValDist_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteValDist_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_issue_district??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->caste_validity=='APPLIED BUT NOT RECEIVED')
                              <div class="row form-group  CasteValApplied">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppNo_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteValAppNo_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_appli_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppDate_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteValAppDate_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_appli_date??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppDist_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteValAppDist_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_appli_issue_dist??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppTal_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteValAppTal_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_appli_issue_taluka??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              <!-- //noncreamy -->
                              @if($previewData->cate=='DT-VJ(A)' || $previewData->cate=='NT(B)' || $previewData->cate=='NT(C)' || $previewData->cate=='NT(D)' || $previewData->cate=='OBC' || $previewData->cate=='SBC')
                              <div class="row form-group  Ncldetails ">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCL_eng') }}<br>{{ trans('cruds.Reservation.fields.NCL_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->ncl_cert=='AVAILABLE')
                              <div class="row form-group  NCLAvail ">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertNo_eng') }}<br>{{ trans('cruds.Reservation.fields.NCLCertNo_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertDist_eng') }}<br>{{ trans('cruds.Reservation.fields.NCLCertDist_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_issue_dist??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.nclCertDate_eng') }} <br>{{ trans('cruds.Reservation.fields.nclCertDate_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_date??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->ncl_cert=='APPLIED BUT NOT RECEIVED')
                              <div class="row form-group   NCLApplied">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLAppNo_eng') }} <br>{{ trans('cruds.Reservation.fields.NCLAppNo_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_appli_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLAppDate_eng') }} <br>{{ trans('cruds.Reservation.fields.NCLAppDate_dev') }} :</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_appli_date??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertIssDist_eng') }} <br>{{ trans('cruds.Reservation.fields.NCLCertIssDist_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_appli_issue_dist??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertIssuingTal_eng') }}<br>{{ trans('cruds.Reservation.fields.NCLCertIssuingTal_dev') }}:</label>
                                 </div>
                                 <div class=" col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_appli_issue_taluka??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                           </div>
                        </fieldset>
                        <fieldset class="form-fieldset ">
                           <div class="row form-group br-bt-1">
                              <div class="col-md-3 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.Reservation.fields.ph_eng') }} :<br>{{ trans('cruds.Reservation.fields.ph_dev') }}:</label>
                               
                              </div>
                              <div class="col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->ph??'--'}}</b></p>
                              </div>
                              <div class="col-md-3 text-right ">
                                 <label  class="d-block mb-0" for="orphan">{{ trans('cruds.Reservation.fields.orphan_eng') }}<br>{{ trans('cruds.Reservation.fields.orphan_dev') }}  :</label>
                                
                              </div>
                              <div class="col-sm-3 ">
                                 <p class="uppercase primary_color"><b>{{$previewData->orphan??'--'}}</b></p>
                              </div>
                              <div class="col-md-3 text-right ">
                                 <label  class="d-block" for="orphan">{{ trans('cruds.Reservation.fields.MinorityQuota_eng') }}<br>{{ trans('cruds.Reservation.fields.MinorityQuota_dev') }}:</label>
                              </div>
                              <div class="col-sm-3 ">
                                 <p class="uppercase primary_color"><b>{{$previewData->minority??'--'}}</b></p>
                              </div>
                              @if($previewData->minority=='YES') 
                              <div class="col-md-3 text-right ">
                                 <label  class="d-block" for="orphan"> {{ trans('cruds.Reservation.fields.religion_eng') }}<br>{{ trans('cruds.Reservation.fields.religion_dev') }}:</label>
                              </div>
                              <div class="col-sm-3 ">
                                 <p class="uppercase primary_color"><b>{{$previewData->minority_quota??'--'}}</b></p>
                              </div>
                              @endif
                           </div>
                        </fieldset>
                     </div>
                  </div>
               </div>
               <!-- //End Reservation -->
               <!-- //Inservice Quota -->
               <div class="card mb-0">
                  <div class="card-header" id="headingSix">
                     <h5 class="m-0 w-100">
                        <a class="custom-accordion-title collapsed d-block py-1"
                           data-bs-toggle="collapse" href="#collapseSix"
                           aria-expanded="false" aria-controls="collapseSix">
                        <i class="uil-wall"></i> Inservice Quota <i
                           class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset">
                           <legend>Inservice Quota </legend>
                           <div class="row form-group br-bt-1">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.inserviceQuota.fields.inserviceQuota_eng') }}  <br>{{ trans('cruds.inserviceQuota.fields.inserviceQuota_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->inservice_quota??'--'}}</b></p>
                              </div>
                           </div>
                           @if($previewData->inservice_quota=='YES')
                           <div class="row  quotaDetails">
                              <div class="col-md-3 text-right">
                                 <label class="d-block">{{ trans('cruds.inserviceQuota.fields.inservice_establishment_eng') }}<br>{{ trans('cruds.inserviceQuota.fields.inservice_establishment_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->inservice_establishment??'--'}}</b></p>
                              </div>
                              <div class="col-md-3 text-right">
                                 <label class="d-block">{{ trans('cruds.inserviceQuota.fields.DateOfJoin_eng') }}  <br>{{ trans('cruds.inserviceQuota.fields.DateOfJoin_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->inservice_join_date??'--'}}</b></p>
                              </div>
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.inserviceQuota.fields.PostingAdd_eng') }}  <br>{{ trans('cruds.inserviceQuota.fields.PostingAdd_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->inservice_posting_addr??'--'}}</b></p>
                              </div>
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.inserviceQuota.fields.noc_eng') }}  <br>{{ trans('cruds.inserviceQuota.fields.noc_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->inservice_establish_noc??'--'}}</b></p>
                              </div>
                              @if($previewData->inservice_quota=='YES')
                              <div class="col-md-6 text-right NocDate ">
                                 <label class="d-block">{{ trans('cruds.inserviceQuota.fields.NocIssuingDate_eng') }} <br>{{ trans('cruds.inserviceQuota.fields.NocIssuingDate_dev') }}:</label>
                              </div>
                              <div class=" col-md-3 NocDate ">
                                 <p class="uppercase primary_color"><b>{{$previewData->inservice_establish_noc_date??'--'}}</b></p>
                              </div>
                              @endif
                              <div class="col-md-6 text-right" >
                                 <label class="d-block">{{ trans('cruds.inserviceQuota.fields.DeptInq_eng') }}  <br>{{ trans('cruds.inserviceQuota.fields.DeptInq_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->inservice_dept_enquiry??'--'}}</b></p>
                              </div>
                              @if($previewData->inservice_dept_enquiry=='YES')
                              <div class="col-md-6 text-right" >
                                 <label class="d-block">{{ trans('cruds.inserviceQuota.fields.InqDetails_eng') }}:<br>{{ trans('cruds.inserviceQuota.fields.InqDetails_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->inservice_dept_enquiry_details??'--'}}</b></p>
                              </div>
                              @endif
                           </div>
                           @endif
                        </fieldset>
                     </div>
                  </div>
               </div>
               <!-- End Inservice Quota -->
               <!-- //Previous College Information -->
               <div class="card mb-0">
                  <div class="card-header" id="headingSeven">
                     <h5 class="m-0 w-100">
                        <a class="custom-accordion-title collapsed d-block py-1"
                           data-bs-toggle="collapse" href="#collapseSeven"
                           aria-expanded="false" aria-controls="collapseSeven">
                        <i class="uil-building"></i> {{ trans('cruds.CollegeInformation.title_eng') }} <i
                           class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseSeven" class="collapse"
                     aria-labelledby="headingSeven"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset">
                           <legend>{{ trans('cruds.CollegeInformation.title_eng') }} <span class="text-muted"> {{ trans('cruds.CollegeInformation.title_dev') }}</span></legend>
                           <div class="row form-group br-bt-1 mb-2">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.DegreeExam_eng') }}  <br>{{ trans('cruds.CollegeInformation.fields.DegreeExam_dev') }}:</label>
                              </div>
                              <div class="col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->mbbs_passing_date??'--'}}</b></p>
                              </div>
                           </div>
                            <div class="row form-group br-bt-1 mb-2">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.PercentageMBBS_eng') }}  <br>{{ trans('cruds.CollegeInformation.fields.PercentageMBBS_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->mbbs_agg_per??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group br-bt-1 mb-3">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.DateofIntern_eng') }}  <br>{{ trans('cruds.CollegeInformation.fields.DateofIntern_dev') }}</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->mbbs_internship_date??'--'}}</b></p>
                              </div>
                           </div>
                            <div class="row form-group br-bt-1 mb-2">
                          
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.DiplomaCourse_eng') }}<br>{{ trans('cruds.CollegeInformation.fields.DiplomaCourse_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->mci_reg_diploma??'--'}}</b></p>
                              </div>
                           </div>
                           @if($previewData->mci_reg_diploma=='COMPLETED' || $previewData->mci_reg_diploma=='ADMITTED AND PURSUING')
                           <div class="row form-group br-bt-1  DiplomaCourseDetails">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.SubofDiploma_eng') }}<br>{{ trans('cruds.CollegeInformation.fields.SubofDiploma_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->diploma_subject??'--'}}</b></p>
                              </div>
                           </div>
                           @endif
                           <div class="row form-group br-bt-1">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.DegreeCourse_eng') }}<br>{{ trans('cruds.CollegeInformation.fields.DegreeCourse_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->mci_reg_degree??'--'}}</b></p>
                              </div>
                           </div>
                           @if($previewData->mci_reg_degree=='COMPLETED')
                           <div class="row form-group br-bt-1">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.SubofDegree_eng') }}:<br>{{ trans('cruds.CollegeInformation.fields.SubofDegree_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->degree_subject??'--'}}</b></p>
                              </div>
                        
                           </div>
                           @endif
                            <div class="row form-group br-bt-1 mb-2">
                          
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.MBBSDegree_eng') }}<br>{{ trans('cruds.CollegeInformation.fields.MBBSDegree_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->mbbs_dc_in_mh_or_aiims??'--'}}</b></p>
                              </div>
                           </div>
                           

                           @if($previewData->mbbs_dc_in_mh_or_aiims=='YES')
                           <div class="row form-group br-bt-1  CollegeTypeDetails">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.CollegeType_eng') }}:  <br>{{ trans('cruds.CollegeInformation.fields.CollegeType_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->mbbs_college_type??'--'}}</b></p>
                              </div>
                           </div>
                           @endif
                           @if($previewData->mbbs_dc_in_mh_or_aiims=='NO' )
                           <div class="row form-group br-bt-1">
                             <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.GovtClg_eng') }}: <br>{{ trans('cruds.CollegeInformation.fields.GovtClg_dev') }}</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->mbbs_college_outoff_ind_mah??'--'}}</b></p>
                              </div>
                           </div>
                            <div class="row form-group br-bt-1 mb-2">
                              
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.college_name_out_mh_eng') }} <br>{{ trans('cruds.CollegeInformation.fields.college_name_out_mh_dev') }} :  </label>
                              </div>
                              <div class="col-md-3  ">
                                <p class="uppercase primary_color"><b>{{$previewData->mbbs_college_ind_mah??'--'}}</b></p>
                              </div>
                           </div>
                            <div class="row form-group br-bt-1 mb-2">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.uni_name_out_mh_eng') }}<br> {{ trans('cruds.CollegeInformation.fields.uni_name_out_mh_dev') }}: </label>
                              </div>
                              <div class="col-md-3  ">
                                 <p class="uppercase primary_color"><b>{{$previewData->mbbs_university_ind_mah??'--'}}</b></p>
                              </div>
                             
                           </div>
                            @endif
                            @if( $previewData->mbbs_college_type=='AIIMS OR CENTRAL GOVT INSTITUTION' )
                            <div class="row form-group br-bt-1">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.college_name_out_mh_eng') }} <br>{{ trans('cruds.CollegeInformation.fields.college_name_out_mh_dev') }} :  </label>
                              </div>
                              <div class="col-md-3  ">
                                <p class="uppercase primary_color"><b>{{$previewData->mbbs_college_ind_mah??'--'}}</b></p>
                              </div>
                           </div>
                            <div class="row form-group br-bt-1 mb-2">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.uni_name_out_mh_eng') }}<br> {{ trans('cruds.CollegeInformation.fields.uni_name_out_mh_dev') }}: </label>
                              </div>
                              <div class="col-md-3  ">
                                 <p class="uppercase primary_color"><b>{{$previewData->mbbs_university_ind_mah??'--'}}</b></p>
                              </div>
                             
                           </div>
                            @endif
                           <div class="row form-group br-bt-1">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.MedicalCollege_eng') }} <br>{{ trans('cruds.CollegeInformation.fields.MedicalCollege_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->aiee??'--'}}</b></p>
                              </div>
                           </div>
                         
                        </fieldset>
                        <!-- <fieldset class="form-fieldset mt-3">
                           <legend>Details Of Bond Service </legend>
                           <div class="row form-group br-bt-1 ">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.BondService_eng') }} <br>{{ trans('cruds.CollegeInformation.fields.BondService_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->bond_service??'--'}}</b></p>
                              </div>
                           </div>
                           @if($previewData->bond_service=='Undertaking')
                           <div class="row form-group br-bt-1  UndertakingDetails">
                              <div class="custom-control custom-checkbox mb-2 d-flex" >
                                 <input name="undertake_to_submit" id="undertake_to_submit_bond" type="checkbox" checked value="1">
                                 <label class="custom-control-label" for="1"> {{ trans('cruds.CollegeInformation.fields.undertake_to_submit_eng') }}<br> <span class="text-muted">{{ trans('cruds.CollegeInformation.fields.undertake_to_submit_dev') }}</span>
                                 </label>
                              </div>
                           </div>
                           @endif
                        </fieldset> -->
                        <fieldset class="form-fieldset mt-3">
                           <legend>PREVIOUS ATTEMPT OF NEET PG</legend>
                           <div class="row form-group br-bt-1 justify-content-center">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.CollegeInformation.fields.attemptedCandidate_eng') }}<br>{{ trans('cruds.CollegeInformation.fields.attemptedCandidate_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->neet_pg_attempt_year??'--'}}</b></p>
                              </div>
                           </div>
                        </fieldset>
                     </div>
                  </div>
                  <!-- //End Previous College Information -->
               </div>
               <!-- //Medical Council Registration  -->
               <div class="card mb-0">
                  <div class="card-header" id="headingFour">
                     <h5 class="m-0">
                        <a class="custom-accordion-title collapsed d-block py-1"
                           data-bs-toggle="collapse" href="#collapseEight"
                           aria-expanded="false" aria-controls="collapseEight">
                        <i class="uil-medical-square-full"></i> DC Council Registration <i
                           class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseEight" class="collapse"
                     aria-labelledby="headingFour"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset">
                           <legend>DC Council Registration  </legend>
                           <div class="row form-group  ">
                              <div class="col-md-7 text-right">
                                 <label class="d-DcCouncil">{{ trans('cruds.DcCouncil.fields.MedicalCouncil_eng') }}<br>{{ trans('cruds.DcCouncil.fields.MedicalCouncil_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->medical_council_reg??'--'}}</b></p>
                              </div>
                           </div>
                           @if($previewData->medical_council_reg=='YES' || $previewData->medical_council_reg=='APPLIED')
                           <div class="row form-group  MedicalCouncilDetails">
                              <div class="col-md-7 text-right">
                                 <label class="d-block">{{ trans('cruds.DcCouncil.fields.MedicalCouncilReg_eng') }} <br>{{ trans('cruds.DcCouncil.fields.MedicalCouncilReg_dev') }} :</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->medical_council_reg_no??'--'}}</b></p>
                              </div>
                           </div>
                           @endif
                           <div class="row form-group  ">
                              <div class="col-md-7 text-right">
                                 <label class="d-block">{{ trans('cruds.DcCouncil.fields.dci_eng') }} <br>{{ trans('cruds.DcCouncil.fields.dci_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->medical_dci_reg??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group  ">
                              @if($previewData->medical_dci_reg=='YES')
                              <div class="col-md-7 text-right">
                                 <label class="d-block">{{ trans('cruds.DcCouncil.fields.dci_eng') }} <br>{{ trans('cruds.DcCouncil.fields.dci_dev') }}:</label>
                              </div>
                              <div class=" col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->medical_dci_reg_no??'--'}}</b></p>
                              </div>
                           @endif
                           </div>

                        </fieldset>
                     </div>
                  </div>
                  <!--End Medical Council Registration  -->
               </div>

               <div class="card mb-0">
                  <div class="card-header" id="headingFour">
                     <h5 class="m-0">
                        <a class="custom-accordion-title collapsed d-block py-1"
                           data-bs-toggle="collapse" href="#collapseNine"
                           aria-expanded="false" aria-controls="collapseNine">
                        <i class="uil-keyhole-square-full"></i> Security Deposite <i
                           class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseNine" class="collapse"
                     aria-labelledby="headingFour"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset">
                           <legend>Security Deposite </legend>
                            <div class="row form-group">
                  <div class="col-md-7 text-right">
                     <label class="d-block">{{ trans('cruds.SecurityDeposite.fields.seat_eng') }}<font class="astr">*</font><br>{{ trans('cruds.SecurityDeposite.fields.seat_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     {{$previewData->security_deposite_seat_type??'--'}}
                     
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-7 text-right">
                     <label class="d-block">{{ trans('cruds.SecurityDeposite.fields.depositeAmount_eng') }}<font class="astr">*</font><br>{{ trans('cruds.SecurityDeposite.fields.depositeAmount_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <p class="uppercase primary_color"><b id="depositeAmount">{{$previewData->security_deposite_amount??'--'}}</b><b>/-</b></p>
                  </div>
               </div>

                        </fieldset>
                     </div>
                  </div>
                  <!--End Medical Council Registration  -->
               </div>
            </div>
         </div>
         <!-- card-body -->
         <div class="card-footer bg-transparent">
            <form action="{{ route("preview.update", [$previewData->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
               <input type="submit" class="btn btn-success mb-3" value="Confirm and Next"></button>
            </div>
            </form>
         </div>
         <!-- card-footer -->
      </div>
   </div>
</div>
@endsection