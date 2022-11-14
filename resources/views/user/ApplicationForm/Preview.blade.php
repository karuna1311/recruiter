@extends('layouts.UserDashboard')
@section('content')
<style type="text/css">
   .tableScroll{
      overflow-x: scroll;
       width: 100%;
       display: block;
   }
</style>
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
            <div class="accordion custom-accordion"id="custom-accordion-one">
               <!-- //Personal Information -->
               <div class="card mb-0">
                  <div class="card-header"id="headingFour">
                     <h5 class="m-0 w-100">
                        <a class="custom-accordion-title d-block py-1"
                           data-bs-toggle="collapse"href="#collapseFour"
                           aria-expanded="false"aria-controls="collapseFour">
                        <i class="uil-comment-alt-edit"></i> Personal Information <i
                           class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseFour"class="collapse show"
                     aria-labelledby="headingFour"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset">
                           <legend>{{ trans('cruds.personalInformation.title_eng') }} <span class="text-muted">{{ trans('cruds.personalInformation.title_dev') }}</span></legend>
                           <div class="row form-group">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.name_eng') }}  <br>{{ trans('cruds.personalInformation.fields.name_dev') }}:</label>
                              </div>
                              <div class="col-md-6">
                                 <p id="firstname"class="uppercase primary_color"><b>{{$userData['name']}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group ">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.namchange_eng') }} <br>{{ trans('cruds.personalInformation.fields.namchange_dev') }} ?:</label>
                              </div>
                              <div class="col-md-3">
                                 <p class="uppercase primary_color"><b>{{$previewData->cname_change??'--'}}</b></p>
                              </div>                                                     
                              @if($previewData->cname_change=='YES')
                              <div class="col-md-3 ">
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
                                 <p class="uppercase primary_color" ><b>{{$userData['dob']}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.Mobile_eng') }} <br> {{ trans('cruds.personalInformation.fields.Mobile_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color" ><b>{{$userData['mobile']}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.email_eng') }} <br> {{ trans('cruds.personalInformation.fields.email_dev') }}:</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="primary_color"><b>{{$userData['email']}}</b></p>
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
                                 <p class="uppercase primary_color"><b>{{ App\Traits\Convertors::getStateByID($previewData->permanent_state)??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.district_eng') }} <br> {{ trans('cruds.personalInformation.fields.district_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{  App\Traits\Convertors::getDistrictById($previewData->permanent_district)??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group ">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.taluka_eng') }} <br> {{ trans('cruds.personalInformation.fields.taluka_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{   App\Traits\Convertors::getTalukaById( $previewData->permanent_taluka )??'--'}}</b></p>
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
                        <fieldset class="form-fieldset mt-3  mb-3"id="presentAddressDiv">
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
                                 <p class="uppercase primary_color"><b>{{ App\Traits\Convertors::getStateByID($previewData->present_state ) ??'--'}}</b></p>
                              </div>
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.district_eng') }} <br> {{ trans('cruds.personalInformation.fields.district_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{ App\Traits\Convertors::getDistrictById($previewData->present_district) ??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group">
                              <div class="col-md-2 text-right">
                                 <label class="d-block">{{ trans('cruds.personalInformation.fields.taluka_eng') }} <br> {{ trans('cruds.personalInformation.fields.taluka_dev') }} :</label>
                              </div>
                              <div class="col-md-2">
                                 <p class="uppercase primary_color"><b>{{ App\Traits\Convertors::getTalukaById($previewData->present_taluka )??'--'}}</b></p>
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
                  <div class="card-header"id="headingFive">
                     <h5 class="m-0 w-100">
                        <a class="custom-accordion-title collapsed d-block py-1"data-bs-toggle="collapse"href="#collapseFive"aria-expanded="false"aria-controls="collapseFive">
                        <i class="uil-money-stack"></i> Reservation <i class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseFive"class="collapse"
                     aria-labelledby="headingFive"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset mb-3">
                           <legend>{{ trans('cruds.Reservation.title_eng') }} <span class="text-muted">{{ trans('cruds.Reservation.title_dev') }}</span></legend>
                           <div class="row">
                              <div class="col-md-6 text-right">
                                 <label class="d-block">{{ trans('cruds.Reservation.fields.Nationality_eng') }} <br>{{ trans('cruds.Reservation.fields.Nationality_dev') }}:</label>
                              </div>
                              <div class="col-md-3">
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
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->annual_family_income??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.regionOfResidence_eng') }} <br>{{ trans('cruds.Reservation.fields.regionOfResidence_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->region_of_residence??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->cate=='EWS')
                              <div class="row form-group ewsdetails">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.certStatus_eng') }}<br> {{ trans('cruds.Reservation.fields.certStatus_dev') }} </label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_status??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->ews_cert_status=='AVAILABLE')
                              <div class="row form-group   ewscertavaildetails">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.EwsCertificateNo_eng') }} <br>{{ trans('cruds.Reservation.fields.EwsCertificateNo_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.EWSCertIssuingDistrict_eng') }} <br>{{ trans('cruds.Reservation.fields.EWSCertIssuingDistrict_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_issue_dist??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->ews_cert_status=='APPLIED BUT NOT RECEIVED')
                              <div class="row form-group  certdetails">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.EwsApplicationNo_eng') }}:<br>{{ trans('cruds.Reservation.fields.EwsApplicationNo_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_appli_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.EwsApplicationDate_eng') }}<br>{{ trans('cruds.Reservation.fields.EwsApplicationDate_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
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
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ews_cert_appli_issue_taluka??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->cate=='SC' || $previewData->cate=='ST' || $previewData->cate=='DT-VJ(A)' || $previewData->cate=='NT(B)' || $previewData->cate=='NT(C)' || $previewData->cate=='NT(D)' || $previewData->cate=='OBC' || $previewData->cate=='SBC')
                              <div class="row form-group br-bt-1 scdetails ">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.ScCasteCert_eng') }}<br>{{ trans('cruds.Reservation.fields.ScCasteCert_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_certificate??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->caste_certificate=='AVAILABLE')
                              <div class="row form-group  sccertavaildetails ">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertNumber_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteCertNumber_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertInssDist_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteCertInssDist_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_issue_district??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->caste_certificate=='APPLIED BUT NOT RECEIVED')
                              <div class="row form-group sccertdetails">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertAteappnNo_eng') }}  <br>{{ trans('cruds.Reservation.fields.CasteCertAteappnNo_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_appli_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertappDate_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteCertappDate_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_appli_date??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertDist_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteCertDist_dev') }}</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_appli_issue_dist??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertTal_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteCertTal_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_cert_appli_issue_taluka??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->caste_certificate=='AVAILABLE')
                              <div class="row form-group castavail">
                                 <div class="col-md-6 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValidity_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteValidity_dev') }} :</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->caste_validity=='AVAILABLE')
                              <div class="row form-group  CasteValAvail">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValNumber_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteValNumber_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValDist_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteValDist_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_issue_district??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->caste_validity=='APPLIED BUT NOT RECEIVED')
                              <div class="row form-group  CasteValApplied">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppNo_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteValAppNo_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_appli_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppDate_eng') }}<br>{{ trans('cruds.Reservation.fields.CasteValAppDate_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_appli_date??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppDist_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteValAppDist_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->caste_validity_appli_issue_dist??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppTal_eng') }} <br>{{ trans('cruds.Reservation.fields.CasteValAppTal_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
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
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->ncl_cert=='AVAILABLE')
                              <div class="row form-group  NCLAvail ">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertNo_eng') }}<br>{{ trans('cruds.Reservation.fields.NCLCertNo_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertDist_eng') }}<br>{{ trans('cruds.Reservation.fields.NCLCertDist_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_issue_dist??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.nclCertDate_eng') }} <br>{{ trans('cruds.Reservation.fields.nclCertDate_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_date??'--'}}</b></p>
                                 </div>
                              </div>
                              @endif
                              @if($previewData->ncl_cert=='APPLIED BUT NOT RECEIVED')
                              <div class="row form-group   NCLApplied">
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLAppNo_eng') }} <br>{{ trans('cruds.Reservation.fields.NCLAppNo_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_appli_no??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLAppDate_eng') }} <br>{{ trans('cruds.Reservation.fields.NCLAppDate_dev') }} :</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_appli_date??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertIssDist_eng') }} <br>{{ trans('cruds.Reservation.fields.NCLCertIssDist_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="uppercase primary_color"><b>{{$previewData->ncl_cert_appli_issue_dist??'--'}}</b></p>
                                 </div>
                                 <div class="col-md-3 text-right">
                                    <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertIssuingTal_eng') }}<br>{{ trans('cruds.Reservation.fields.NCLCertIssuingTal_dev') }}:</label>
                                 </div>
                                 <div class="col-md-3">
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
                                 <label  class="d-block mb-0"for="orphan">{{ trans('cruds.Reservation.fields.orphan_eng') }}<br>{{ trans('cruds.Reservation.fields.orphan_dev') }}  :</label>
                              </div>
                              <div class="col-sm-3 ">
                                 <p class="uppercase primary_color"><b>{{$previewData->orphan??'--'}}</b></p>
                              </div>
                              <div class="col-md-3 text-right ">
                                 <label  class="d-block"for="orphan">{{ trans('cruds.Reservation.fields.MinorityQuota_eng') }}<br>{{ trans('cruds.Reservation.fields.MinorityQuota_dev') }}:</label>
                              </div>
                              <div class="col-sm-3 ">
                                 <p class="uppercase primary_color"><b>{{$previewData->minority??'--'}}</b></p>
                              </div>
                              @if($previewData->minority=='YES') 
                              <div class="col-md-3 text-right ">
                                 <label  class="d-block"for="orphan"> {{ trans('cruds.Reservation.fields.religion_eng') }}<br>{{ trans('cruds.Reservation.fields.religion_dev') }}:</label>
                              </div>
                              <div class="col-sm-3 ">
                                 <p class="uppercase primary_color"><b>{{$previewData->minority_quota??'--'}}</b></p>
                              </div>
                              @endif
                           </div>
                        </fieldset>
                        <br>
                        <fieldset class="form-fieldset ">
                           <legend>Persons with Benchmark Disabilities Details <span class="text-muted">बेंचमार्क अपंग तपशील असलेल्या व्यक्ती</span></legend>
                           <div class="row form-group br-bt-1">
                              <div class="col-md-6 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.Reservation.fields.ph_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.ph_dev') }}:</label>
                              </div>
                              <div class="col-md-3">
                                       <p class="uppercase primary_color"><b>{{$previewData->ph??'--'}}</b></p>
                           </div>
                           <div class="row form-group br-bt-1 mt-2 mb-2 phDetails {{ (isset($previewData->ph) && $previewData->ph==='YES') ? 'show' : 'hide' }}">
                              <div class="col-md-3 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.perdisability_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.perdisability_dev') }}</label>
                              </div>
                              <div class="col-md-3 text-right">
                                <p class="uppercase primary_color"><b>{{$previewData->per_disability??'--'}}</b></p>
                              </div>
                              <div class="col-md-3 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.phType_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.phType_dev') }}</label>
                              </div>
                              <div class="col-md-3 text-right">                                
                                    <p class="uppercase primary_color"><b>{{ ($previewData->ph_type) ? App\Traits\Convertors::phType($previewData->ph_type) :'--'  }}</b></p>                                  
                              </div>
                           </div>
                        </fieldset>
                        <fieldset class="form-fieldset mt-3">
                           <legend>Orphan Details <span class="text-muted">अनाथ तपशील</span></legend>
                           <div class="row form-group br-bt-1">
                              <div class="col-md-6 text-right ">
                                 <label  class="d-block mb-0"for="orphan">{{ trans('cruds.Reservation.fields.orphan_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.orphan_dev') }}:</label>
                              </div>
                              <div class="col-sm-3 ">
                                <p class="uppercase primary_color"><b>{{$previewData->orphan??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group br-bt-1 orphanDetails {{ (isset($previewData->orphan) && $previewData->orphan==='YES') ? 'show' : 'hide' }}">
                              <div class="col-md-6 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.orphanType_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.orphanType_dev') }}:</label>
                              </div>
                              <div class="col-md-3 text-right">
                                <p class="uppercase primary_color"><b>{{$previewData->orphan_type ??'--'}}</b></p>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset class="form-fieldset mt-3">
                           <legend>Ex-serviceman <span class="text-muted">माजी सैनिक</span></legend>
                           <div class="row form-group br-bt-1">
                              <div class="col-md-6 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.exserviceman_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.exserviceman_dev') }}:</label>
                              </div>
                              <div class="col-md-3 text-right">
                                 <p class="uppercase primary_color"><b>{{$previewData->ex_serviceman??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group br-bt-1 {{ (isset($previewData->ex_serviceman) && $previewData->ex_serviceman==='YES') ? 'show' : 'hide' }} serviceDetails">
                              <div class="col-md-6 text-right">
                                 <label class="d-block mb-0">Division of the Armed Forces <span class="asrtick">*</span> <br>सशस्त्र दलांची विभागणी:</label>
                              </div>
                              <div class="col-md-3 text-right">
                                 <p class="uppercase primary_color"><b>{{$previewData->forces_division??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group br-bt-1 mt-2  {{ (isset($previewData->ex_serviceman) && $previewData->ex_serviceman==='YES') ? 'show' : 'hide' }} serviceDetails">
                              <div class="col-md-3 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.joinDate_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.joinDate_dev') }}:</label>
                              </div>
                              <div class="col-md-3 text-right">
                                 <p class="uppercase primary_color"><b>{{$previewData->join_date??'--'}}</b></p>
                              </div>
                              <div class="col-md-3 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.retirement_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.retirement_dev') }}:</label>
                              </div>
                              <div class="col-md-3 text-right">
                                 <p class="uppercase primary_color"><b>{{$previewData->retirement_date??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group br-bt-1 mt-2  {{ (isset($previewData->ex_serviceman) && $previewData->ex_serviceman==='YES') ? 'show' : 'hide' }} serviceDetails">
                              <div class="col-md-6 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.PeriodOfService_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.PeriodOfService_dev') }}:</label>
                              </div>
                              <div class="col-md-3 text-right">
                                 <p class="uppercase primary_color"><b>{{$previewData->service_years.'  Year '.$previewData->service_months.' months '.$previewData->service_days. ' days '??'--'}}</b></p>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset class="form-fieldset mt-3">
                           <legend>{{ trans('cruds.SportDetails.title_eng') }} <span class="text-muted">{{ trans('cruds.SportDetails.title_dev') }}</span></legend>
                           <div class="row form-group br-bt-1 mt-2">
                              <div class="col-md-6 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SportDetails.fields.sportPerson_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SportDetails.fields.sportPerson_dev') }}:</label>
                              </div>
                              <div class="col-md-3 text-right">
                                <p class="uppercase primary_color"><b>{{$previewData->sports_person??'--'}}</b></p>
                              </div>
                           </div>
                           <div class="row form-group br-bt-1 mt-2 
                              {{ (isset($previewData->sports_person) && $previewData->sports_person=='YES') ? 'show' : 'hide' }} SportDetails">
                              <div class="col-md-3 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SportDetails.fields.CompetitionType_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SportDetails.fields.CompetitionType_dev') }}:</label>
                              </div>
                              <div class="col-md-3 text-left">
                                 <p class="uppercase primary_color"><b>
                                    {{ ($previewData->type_competition) ? App\Traits\Convertors::competitionType($previewData->type_competition) :'--'  }}
                                 </b>
                                 </p>
                              </div>
                              <div class="col-md-3 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SportDetails.fields.CompetitionLevel_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SportDetails.fields.CompetitionLevel_dev') }}:</label>
                              </div>
                              <div class="col-md-3 text-right">
                                 <p class="uppercase primary_color"><b>{{$previewData->level_competition??'--'}}</b></p>
                              </div>
                              <div class="col-md-3 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SportDetails.fields.CompetitionMedal_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SportDetails.fields.CompetitionMedal_dev') }}:</label>
                              </div>
                              <div class="col-md-3 text-right">
                                 <p class="uppercase primary_color"><b>                                    
                                    {{ ($previewData->position_medal) ? App\Traits\Convertors::medalname($previewData->position_medal) :'--'  }}
                                 </b></p>
                              </div>
                              <div class="col-md-3 text-right">
                                 <label class="d-block mb-0">{{ trans('cruds.SportDetails.fields.CompetitionYear_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SportDetails.fields.CompetitionYear_dev') }}:</label>
                              </div>
                              <div class="col-md-3 text-right">
                                 <p class="uppercase primary_color"><b>{{$previewData->competition_year??'--'}}</b></p>
                              </div>
                           </div>
                        </fieldset>
                     </div>
                  </div>
               </div>
               <!-- //End Reservation -->
               <!-- //Qualification -->
               <div class="card mb-0">
                  <div class="card-header"id="headingSix">
                     <h5 class="m-0 w-100">
                        <a class="custom-accordion-title collapsed d-block py-1"data-bs-toggle="collapse"href="#collapseSix"aria-expanded="false"aria-controls="collapseSix">
                        <i class="uil-wall"></i> Qualification <i class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseSix"class="collapse"aria-labelledby="headingSix"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset">
                           <legend>Qualification </legend>
                           <div class="row form-group br-bt-1 mt-2">
                              <div class="col-md-12 text-right">
                                 <table class="table table-bordered table-centered mb-0 tableScroll">
                                    <thead class="table-dark">
                                       <tr role="row">
                                          <th>Sr No</th>
                                          <th>Qualification Type</th>
                                          <th>Name of Qualification</th>
                                          <th>Subject / Stream / Branch</th>
                                          <th>Board / University</th>
                                          <th>Qualification Type</th>
                                          <th>Date of qualification completion</th>
                                          <th>Attempts</th>
                                          <th>Percentage / CGPA (For Grade add respective percentage value)</th>
                                          <th>Number of academic months</th>
                                          <th>Class / Grade</th>
                                          <th>Mode</th>
                                       </tr>
                                    </thead>
                                    <tbody style="font-size: 12px;">                                                                       
                                       <?php $i=1; ?>
                                       @foreach($qualification as $value)
                                          <tr role="row"class="odd">                                                                                   
                                             <td>{{ $i }}</td>
                                             <td>{{ !empty($value->qualification_type) ? $value->qualification_type : '-'}}</td>
                                             <td>{{ !empty($value->qualification_name) ? $value->qualification_name : '-'}}</td>
                                             <td>{{ !empty($value->subject_name) ? $value->subject_name : '-'}}</td>
                                             <td>{{ !empty($value->university_name) ? $value->university_name : '-'}}</td>                                    
                                             <td>{{ !empty($value->typeResult) ? $value->typeResult : '-'}}</td>                                    
                                             <td>{{ !empty($value->doq) ? $value->doq : '-'}}</td>                                    
                                             <td>{{ !empty($value->attempts) ? $value->attempts : '-'}}</td>                                    
                                             <td>{{ !empty($value->percentage) ? $value->percentage : '-'}}</td>                                    
                                             <td>{{ !empty($value->courseDurations) ? $value->courseDurations : '-'}}</td>                                    
                                             <td>{{ !empty($value->class) ? $value->class : '-'}}</td>                                    
                                             <td>{{ !empty($value->mode) ? $value->mode : '-'}}</td> 
                                             <?php $i++; ?>
                                          </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                              
                           </div>
                        </fieldset>
                     </div>
                  </div>
               </div>
               <!-- End Qualification -->
               <!-- //Experience Information -->
               <div class="card mb-0">
                  <div class="card-header"id="headingSeven">
                     <h5 class="m-0 w-100">
                        <a class="custom-accordion-title collapsed d-block py-1"
                           data-bs-toggle="collapse"href="#collapseSeven"
                           aria-expanded="false"aria-controls="collapseSeven">
                        <i class="uil-building"></i> Experience Information <i
                           class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseSeven"class="collapse"
                     aria-labelledby="headingSeven"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset">
                           <legend>Experience Information</legend>
                           <div class="row">
                              <div class="col-md-12">
                                  <table class="table table-bordered table-centered mb-0 tableScroll">
                                    <thead class="table-dark">
                                       <tr>
                                          <th>Sr No</th>
                                          <th>Institution / Department / Organisation / Court</th>
                                          <th>Designation (Post Held)</th>
                                          <th>Nature Of Appointment</th>
                                          <th>Nature Of Job</th>
                                          <th>Full Time / Other</th>
                                          <th>Pay Band / Pay Scale / Professional Charge</th>
                                          <th>Grade Pay</th>
                                          <th>Monthly Gross Salary / Income</th>
                                          <th>From Date</th>
                                          <th>To Date</th>                                       
                                       </tr>
                                    </thead>
                                    <tbody style="font-size: 12px;">
                                       <?php $i=1; ?>   
                                       @foreach($experience as $value)
                                       <tr>                                          
                                          <td>{{ $i }}</td>
                                          <td>{{ !empty($value->officeName) ? $value->officeName : '-'}}</td>
                                          <td>{{ !empty($value->designation) ? $value->designation : '-'}}</td>
                                          <td>{{ !empty($value->appointment) ? $value->appointment : '-'}}</td>
                                          <td>{{ !empty($value->job_nature) ? $value->job_nature : '-'}}</td>                                    
                                          <td>{{ !empty($value->time) ? $value->time : '-'}}</td>                                    
                                          <td>{{ !empty($value->payScale) ? $value->payScale : '-'}}</td>                                    
                                          <td>{{ !empty($value->gradePay) ? $value->gradePay : '-'}}</td>                                                                                                           
                                          <td>{{ !empty($value->monthlyGrossSalary) ? $value->monthlyGrossSalary : '-'}}</td>                                    
                                          <td>{{ !empty($value->fromDate) ? $value->fromDate : '-'}}</td>                                    
                                          <td>{{ !empty($value->toDate) ? $value->toDate : '-'}}</td>  
                                       <?php $i++; ?>
                                       </tr>
                                       @endforeach   
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </fieldset>
                        
      
                     </div>
                  </div>
                  <!-- //End Previous College Information -->
               </div>
               <!-- //Medical Council Registration  -->
               <div class="card mb-0">
                  <div class="card-header"id="headingFour">
                     <h5 class="m-0">
                        <a class="custom-accordion-title collapsed d-block py-1"
                           data-bs-toggle="collapse"href="#collapseEight"
                           aria-expanded="false"aria-controls="collapseEight">
                        <i class="uil-medical-square-full"></i> Job Applied <i
                           class="mdi mdi-chevron-down accordion-arrow"></i>
                        </a>
                     </h5>
                  </div>
                  <div id="collapseEight"class="collapse"
                     aria-labelledby="headingFour"
                     data-bs-parent="#custom-accordion-one">
                     <div class="card-body">
                        <fieldset class="form-fieldset">
                           <legend>Job Post </legend>
                            <table class="table table-bordered table-centered mb-0 ">
                                    <thead class="table-dark">
                                      <tr>
                                         <th>Sr. No.</th>
                                         <th>Post Name</th>
                                         <th>Year</th>
                                         <th>Post Description</th>                                         
                                      </tr>
                                   </thead>
                                   <?php $i=1; ?>   
                                   <tbody>                                                                                                            
                                       @foreach($job_applied as $value)
                                       <tr>                                          
                                          <td>{{ $i }}</td>
                                          <td>{{ !empty($value->name) ? $value->name : '-'}}</td>
                                          <td>{{ !empty($value->year) ? $value->year : '-'}}</td>                                      
                                          <td>{{ !empty($value->description) ? $value->description : '-'}}</td>                                      
                                       <?php $i++; ?>
                                       </tr>
                                       @endforeach                                                                                       
                                   </tbody>
                                </table> 
                        </fieldset>
                     </div>
                  </div>
                  <!--End Job Applied  -->
               </div>
               
            </div>
         </div>
         <!-- card-body -->
         <div class="card-footer bg-transparent">
            <form action="{{ route("preview.update", [$previewData->id]) }}"method="POST"enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
               <input type="submit"class="btn btn-success mb-3"value="Confirm and Next"></button>
            </div>
            </form>
         </div>
         <!-- card-footer -->
      </div>
   </div>
</div>
@endsection