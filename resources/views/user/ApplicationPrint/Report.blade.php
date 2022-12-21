<!DOCTYPE html>
<html>
   <head>
      <style type="text/css">
         @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap');
         body { margin: 1px; font-family: freeserif;}
         .devnagari{font-family: freeserif;}
      </style>
   </head>
   <body>
      <div class="bg-white" id="printPdf">
         <style type="text/css">
            table{width: 100%;border-collapse: collapse;}
            body{border: 1px solid #000;padding: 16px;}
            table th{background: #ddd;padding: 4px;font-size: 14px;color: #000;text-transform: uppercase;text-align: left;font-family: 'Open Sans', sans-serif;}
            table td{border: 0px solid #ddd;padding: 4px;font-size: 12px;color: #000;text-align: left;font-family: 'Open Sans', sans-serif;font-weight: 400!important;}
            .widthBd td{width: 16.66%;}
            table tr{border: 1px solid #ddd;}
            .tablebd tr td{border: 1px solid #ddd;}
            .tablebd tr th{background: #fff!important;border: 1px solid #ddd;}
         </style>
         <table style="margin-bottom: 20px;">
            <tr>
               <td><img src="{{ url('/') }}/LoginAssets/images/pdfback.jpg" class="w-100"></td>
            </tr>
         </table>
         <br>
         <!-- Personal Information -->
         <table  class="widthBd">
          
            <tr>
               <td colspan="4">
                  <span>Application No<br>
                  {{-- <span class="devnagari">{{ trans('cruds.personalInformation.fields.name_dev') }}</span>: --}}
               </td>
               <td colspan="2"><b>{{$appliedjob->application_no}}</b></td>
            </tr>
            <tr>
               <td colspan="4">
                  <span>Job Name</span><br>
                  {{-- <span class="devnagari">{{ trans('cruds.personalInformation.fields.name_dev') }}</span>: --}}
               </td>
               <td colspan="2"><b><span class="devnagari">{{ App\Traits\Convertors::postName($appliedjob['job_id'])}}</span></b></td>
            </tr>
            
            
            <tr>
               <th colspan="6">Personal Information</th>
            </tr>


            <tr>
               <td colspan="4">
                  <span>{{ trans('cruds.personalInformation.fields.name_eng') }}</span><br>
                  <span class="devnagari">{{ trans('cruds.personalInformation.fields.name_dev') }}</span>:
               </td>
               <td colspan="2"><b>{{$userData['name']}}</b></td>
            </tr>
            <tr>
               <td colspan="3"><span>{{ trans('cruds.personalInformation.fields.namchange_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.personalInformation.fields.namchange_dev') }}</span> :</td>
               <td><b>{{$previewData->cname_change??'--'}}</b></td>
               @if($previewData->cname_change=='YES')
               <td><span>Updated Name:</span></td>
               <td><b>{{$previewData->cname_change_value??'--'}}</b></td>
               @endif
            </tr>
         </table>
         <table  class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.fatherName_Eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.fatherName_dev') }}</span>:</td>
               <td><b>{{$previewData->fname??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.motherName_Eng') }}</span> <br><span class="devnagari">{{ trans('cruds.personalInformation.fields.motherName_dev') }}</span>:</td>
               <td><b>{{$previewData->mname??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.gender_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.personalInformation.fields.Gender_dev') }}</span>:</td>
               <td><b>{{$previewData->gender??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.DateOfBirth_eng') }}</span> :<br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.DateOfBirth_dev') }}</span>:</td>
               <td><b>{{$userData['dob']}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.Mobile_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.Mobile_dev') }}</span> :</td>
               <td><b>{{$userData['mobile']}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.email_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.email_dev') }}</span>:</td>
               <td><b>{{$userData['email']}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.alternateContact_eng') }}</span>:<br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.alternateContact_dev') }}</span>:</td>
               <td><b>{{$previewData->alternate_mobile??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.aadhar_eng') }}</span>: <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.aadhar_dev') }}</span>:</td>
               <td><b>{{$previewData->adhar_card_no??'--'}}</b></td>
                           <td><span>{{ trans('cruds.personalInformation.fields.age_eng') }} </span>
                  <span class="devnagari">{{ trans('cruds.personalInformation.fields.age_dev') }}</span>
               </td>
               <td><b>{{$previewData->age??'--'}}</b></td>
               </tr>
            <tr>

               <td><span>{{ trans('cruds.personalInformation.fields.municipal_bank_eng') }}</span>
                  <span class="devnagari"> {{ trans('cruds.personalInformation.fields.municipal_bank_dev') }} </span>
               </td>
               <td><b>{{$previewData->bankemp??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.marathi_eng') }}</span>
                  <span class="devnagari"> {{ trans('cruds.personalInformation.fields.marathi_dev') }} </span>
               </td>
               <td><b>{{$previewData->marathispeaking??'--'}}</b></td>
            </tr>
         </table>
         <!-- Permanent Addresss -->
         <br>
         <table class="widthBd">
            <tr>
               <th colspan="6"><b>{{ trans('cruds.personalInformation.fields.PermanentAdd_eng') }}</b> (<b class="devnagari">{{ trans('cruds.personalInformation.fields.PermanentAdd_dev') }}</b>)</th>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.addressLine1_eng') }}</span>:<br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.addressLine1_dev') }}</span>:</td>
               <td><b>{{$previewData->permanent_address_1??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.addressLine2_eng') }}</span>:<br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.addressLine2_dev') }}</span>:</td>
               <td><b>{{$previewData->permanent_address_2??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.addressLine3_eng') }}</span>:<br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.addressLine3_dev') }}</span></td>
               <td><b>{{$previewData->permanent_address_3??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.city_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.city_dev') }}</span>:</td>
               <td><b>{{$previewData->permanent_city??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.state_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.state_dev') }}</span>:</td>
               <td><b>{{ App\Traits\Convertors::getStateByID($previewData->permanent_state)??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.district_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.district_dev') }}</span></td>
               <td><b>{{  App\Traits\Convertors::getDistrictById($previewData->permanent_district)??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.taluka_eng') }} </span><br> <span class="devnagari"> {{ trans('cruds.personalInformation.fields.taluka_dev') }}</span></td>
               <td><b>{{   App\Traits\Convertors::getTalukaById( $previewData->permanent_taluka )??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.PinCode_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.PinCode_dev') }} </span></td>
               <td><b>{{$previewData->permanent_pin_code??'--'}}</b></td>
            </tr>
         </table>
         <br>
         <!-- Present Address (वर्तमान पत्ता) -->
         @if($previewData->address_not_same=='1')
         <table class="widthBd">
            <tr>
               <th colspan="6">Present Address <span class="devnagari"> (वर्तमान पत्ता)</span></th>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.addressLine1_eng') }}</span>:<br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.addressLine1_dev') }}</span>:</td>
               <td><b>{{$previewData->present_address_1??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.addressLine2_eng') }}</span>:<br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.addressLine2_dev') }}</span>:</td>
               <td><b>{{$previewData->present_address_2??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.addressLine3_eng') }}</span>:<br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.addressLine3_dev') }}</span></td>
               <td><b>{{$previewData->present_address_3??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.city_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.city_dev') }}</span>:</td>
               <td><b>{{$previewData->present_city??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.state_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.state_dev') }}</span>:</td>
               <td><b>{{ App\Traits\Convertors::getStateByID($previewData->present_state ) ??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.district_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.district_dev') }}</span></td>
               <td><b>{{ App\Traits\Convertors::getDistrictById($previewData->present_district) ??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.taluka_eng') }} </span><br> <span class="devnagari"> {{ trans('cruds.personalInformation.fields.taluka_dev') }}</span></td>
               <td><b>{{ App\Traits\Convertors::getTalukaById($previewData->present_taluka )??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.PinCode_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.PinCode_dev') }} </span></td>
               <td><b>{{$previewData->present_pin_code??'--'}}</b></td>
            </tr>
         </table>
         @endif
         <!-- Reservation -->
         <br>
         <table class="widthBd">
            <tr>
               <th colspan="2">Reservation</th>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.Nationality_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.Nationality_dev') }}</span>:</td>
               <td><b>{{$previewData->nation??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.domicile_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.domicile_dev') }}</span></td>
               <td><b>{{$previewData->domicle_maharashtra??'--'}}</b></td>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.Category_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.Category_dev') }}</span>:</td>
               <td><b>{{$previewData->cate??'--'}}</b></td>
              
               <td><span>{{ trans('cruds.Reservation.fields.AnnualIncome_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.AnnualIncome_dev') }}</span>:</td>
               <td><b>{{$previewData->annual_family_income??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.regionOfResidence_eng') }} </span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.regionOfResidence_dev') }}:</span></td>
               <td><b>{{$previewData->region_of_residence??'--'}}</b></td>
              
            </tr>
         </table>
         <table class="widthBd">
            @if($previewData->ews_cert_status=='AVAILABLE')
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.EwsCertificateNo_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.EwsCertificateNo_dev') }}</span>:</td>
               <td><b>{{$previewData->ews_cert_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.EWSCertIssuingDistrict_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.EWSCertIssuingDistrict_dev') }}</span>:</td>
               <td><b>{{   App\Traits\Convertors::getDistrictById($previewData->ews_cert_issue_dist)??'--'}}</b></td>
            </tr>
            @endif
         </table>
         <table class="widthBd">
            @if($previewData->ews_cert_status=='APPLIED BUT NOT RECEIVED')
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.EwsApplicationNo_eng') }}</span>:<br><span class="devnagari">{{ trans('cruds.Reservation.fields.EwsApplicationNo_dev') }}</span>:</td>
               <td><b>{{$previewData->ews_cert_appli_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.EwsApplicationDate_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.EwsApplicationDate_dev') }}</span>:</td>
               <td><b>{{$previewData->ews_cert_appli_date??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.EwsEwsAppDistrict_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.EwsEwsAppDistrict_dev') }}</span>:</td>
               <td><b>{{App\Traits\Convertors::getDistrictById($previewData->ews_cert_appli_issue_dist)??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.EwsIssuingTaluka_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.EwsIssuingTaluka_dev') }} :</span></td>
               <td><b>{{ App\Traits\Convertors::getTalukaById( $previewData->ews_cert_appli_issue_taluka )??'--'}} </b></td>
            </tr>
            @endif
         </table>
         <table class="widthBd">
            <tr>
               @if($previewData->cate=='SC' || $previewData->cate=='ST' || $previewData->cate=='DT-A' || $previewData->cate=='NT-B' || $previewData->cate=='NT-C' || $previewData->cate=='NT-D' || $previewData->cate=='OBC' || $previewData->cate=='SBC')
               <td><span>{{ trans('cruds.Reservation.fields.ScCasteCert_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.ScCasteCert_dev') }}</b>:</td>
               <td><b>{{$previewData->caste_certificate??'--'}}</b></td>
               @endif
               @if($previewData->caste_certificate=='AVAILABLE')
               <td><span>{{ trans('cruds.Reservation.fields.CasteCertNumber_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteCertNumber_dev') }}</b>:</td>
               <td><b>{{$previewData->caste_cert_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.CasteCertInssDist_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteCertInssDist_dev') }}</b>:</td>
               <td><b>{{  App\Traits\Convertors::getDistrictById($previewData->caste_cert_issue_district)??'--'}}</b></td>
               @endif
            </tr>
         </table>
         <table class="widthBd">
            @if($previewData->caste_certificate=='APPLIED BUT NOT RECEIVED')
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.CasteCertAteappnNo_eng') }}</span>  <br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteCertAteappnNo_dev') }}</span></td>
               <td><b>{{$previewData->caste_cert_appli_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.CasteCertappDate_eng') }} </span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteCertappDate_dev') }}:</span></td>
               <td><b>{{$previewData->caste_cert_appli_date??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.CasteCertDist_eng') }} </span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteCertDist_dev') }}</span></td>
               <td><b>{{ App\Traits\Convertors::getDistrictById($previewData->caste_cert_appli_issue_dist)??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.CasteCertTal_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteCertTal_dev') }}:</span></td>
               <td><b>{{ App\Traits\Convertors::getTalukaById( $previewData->caste_cert_appli_issue_taluka )??'--'}} </b></td>
            </tr>
            @endif
         </table>
         <table class="widthBd">
            <tr>
               @if($previewData->caste_certificate=='AVAILABLE')
               <td><span>{{ trans('cruds.Reservation.fields.CasteValidity_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteValidity_dev') }} :</span></td>
               <td><b>{{$previewData->caste_validity??'--'}}</b></td>
               @endif
               @if($previewData->caste_validity=='AVAILABLE')
               <td><span>{{ trans('cruds.Reservation.fields.CasteValNumber_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteValNumber_dev') }}:</span></td>
               <td><b>{{$previewData->caste_validity_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.CasteValDist_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteValDist_dev') }}:</span></td>
               <td><b>{{  App\Traits\Convertors::getDistrictById($previewData->caste_validity_issue_district)??'--'}}</b></td>
               @endif
            </tr>
         </table>
         <table class="widthBd">
            @if($previewData->caste_validity=='APPLIED BUT NOT RECEIVED')
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.CasteValAppNo_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteValAppNo_dev') }}:</span></td>
               <td><b>{{$previewData->caste_validity_appli_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.CasteValAppDate_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteValAppDate_dev') }}:</span></td>
               <td><b>{{$previewData->caste_validity_appli_date??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.CasteValAppDist_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteValAppDist_dev') }}:</span></td>
               <td><b>{{$previewData->caste_validity_appli_issue_dist??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.CasteValAppTal_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteValAppTal_dev') }}:</span></td>
               <td><b>{{ App\Traits\Convertors::getTalukaById( $previewData->caste_validity_appli_issue_taluka )??'--'}}  </b></td>
            </tr>
            @endif
         </table>
         <table class="widthBd">
            @if($previewData->ncl_cert=='AVAILABLE')
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.NCLCertNo_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.NCLCertNo_dev') }}:</span></td>
               <td><b>{{$previewData->ncl_cert_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.NCLCertDist_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.NCLCertDist_dev') }}:</span></td>
               <td><b>{{ App\Traits\Convertors::getDistrictById($previewData->ncl_cert_issue_dist)??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.nclCertDate_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.nclCertDate_dev') }}:</span></td>
               <td><b>{{$previewData->ncl_cert_date??'--'}}</b></td>
            </tr>
            @endif
         </table>
         <table class="widthBd">
            @if($previewData->ncl_cert=='APPLIED BUT NOT RECEIVED')
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.NCLAppNo_eng') }} </span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.NCLAppNo_dev') }}:</span></td>
               <td><b>{{$previewData->ncl_cert_appli_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.NCLAppDate_eng') }} </span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.NCLAppDate_dev') }}: </span></td>
               <td><b>{{$previewData->ncl_cert_appli_date??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.NCLCertIssDist_eng') }} </span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.NCLCertIssDist_dev') }}:</span></td>
               <td><b>{{$previewData->ncl_cert_appli_issue_dist??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.NCLCertIssuingTal_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.NCLCertIssuingTal_dev') }}:</span></td>
               <td><b>{{ App\Traits\Convertors::getTalukaById( $previewData->ncl_cert_appli_issue_taluka )??'--'}} </b></td>
            </tr>
            @endif
         </table>
         <br>
          <table class="widthBd">
            <tr>
               <th >Persons with Benchmark Disabilities Details</th>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.ph_eng') }} :</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.ph_dev') }}:</span></td>
               <td><b>{{$previewData->ph??'--'}}</b></td>
              @if($previewData->ph=='YES') 
               <td><span>{{ trans('cruds.SpecialReservation.fields.perdisability_eng') }}</span><br><span class="devnagari">{{ trans('cruds.SpecialReservation.fields.perdisability_dev') }}:</span></td>
               <td><b>{{$previewData->per_disability??'--'}}</b></td>
                <td>
                  <span>{{ trans('cruds.SpecialReservation.fields.phType_eng') }}</span><span class="devnagari">{{ trans('cruds.SpecialReservation.fields.phType_dev') }}</span>
               </td>
               <td><b>{{ ($previewData->ph_type) ? App\Traits\Convertors::phType($previewData->ph_type) :'--'  }}</b></td>
                @endif
            </tr>
         </table>
         <br>
          <table class="widthBd">
            <tr>
               <th >Orphan Details</th>
            </tr>
         </table>
         <table class="widthBd">
           
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.orphan_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.orphan_dev') }}:</span></td>
               <td><b>{{$previewData->orphan??'--'}}</b></td>
            </tr>
             @if($previewData->orphan=='YES') 
             <tr>
                <td><span>{{ trans('cruds.SpecialReservation.fields.orphanType_eng') }}</span> <span class="devnagari">{{ trans('cruds.SpecialReservation.fields.orphanType_dev') }}</span></td>
                <td><b>{{$previewData->orphan_type ??'--'}}</b></td>
             </tr>
            @endif
         </table>
         <br>
         <table class="widthBd">
            <tr>
               <th>Ex-serviceman</th>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td colspan="4"><span>{{ trans('cruds.SpecialReservation.fields.exserviceman_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.SpecialReservation.fields.exserviceman_dev') }}:</span></td>
               <td><b>{{$previewData->ex_serviceman??'--'}}</b></td>
            </tr>
         </table>
         <table class="widthBd">
            @if($previewData->ex_serviceman=='YES')
            <tr>
               <td><span>Division of the Armed Forces</span><br><span class="devnagari">सशस्त्र दलांची विभागणी</span>:</td>
               <td><b>{{$previewData->forces_division??'--'}}</b></td>

               <td ><span>{{ trans('cruds.SpecialReservation.fields.joinDate_eng') }}</span><br><span class="devnagari">{{ trans('cruds.SpecialReservation.fields.joinDate_dev') }}:</span></td>
               <td><b>{{$previewData->join_date??'--'}}</b></td>
            </tr>
            <tr>
               <td ><span>{{ trans('cruds.SpecialReservation.fields.retirement_eng') }}</span><br><span class="devnagari">{{ trans('cruds.SpecialReservation.fields.retirement_dev') }}</span></td>
               <td><b>{{$previewData->retirement_date??'--'}}</b></td>

               <td><span>{{ trans('cruds.SpecialReservation.fields.PeriodOfService_eng') }}</span><br><span class="devnagari">{{ trans('cruds.SpecialReservation.fields.PeriodOfService_dev') }}:</span></td>
               <td><b>{{$previewData->service_years.'  Year '.$previewData->service_months.' months '.$previewData->service_days. ' days '??'--'}}</b></td>
            </tr>
              @endif
            
         </table>
         <br>
         <table class="widthBd">
            <tr>
               <th><b>{{ trans('cruds.SportDetails.title_eng') }} </b></th>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.SportDetails.fields.sportPerson_eng') }}</span><br>
                  <span class="devnagari">{{ trans('cruds.SportDetails.fields.sportPerson_dev') }}:</span></td>
               <td><b>{{$previewData->sports_person??'--'}}</b></td>
            </tr>
         </table>
            @if($previewData->sports_person=='YES') 
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.SportDetails.fields.CompetitionType_eng') }}</span><br>
                  <span class="devnagari">{{ trans('cruds.SportDetails.fields.CompetitionType_dev') }}:</span></td>
               <td><b>{{ ($previewData->type_competition) ? App\Traits\Convertors::competitionType($previewData->type_competition) :'--'  }}</b></td>

               <td><span>{{ trans('cruds.SportDetails.fields.CompetitionLevel_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.SportDetails.fields.CompetitionLevel_dev') }}</span></td>
               <td><b>{{$previewData->level_competition??'--'}}</b></td> 
            </tr>
         </table>

         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.SportDetails.fields.CompetitionMedal_eng') }}</span><br><span class="devnagari">{{ trans('cruds.SportDetails.fields.CompetitionMedal_dev') }}:</span></td>
               <td><b> {{ ($previewData->position_medal) ? App\Traits\Convertors::medalname($previewData->position_medal) :'--'  }}</b></td>

              
               <td><span>{{ trans('cruds.SportDetails.fields.CompetitionYear_eng') }}</span><br><span class="devnagari">{{ trans('cruds.SportDetails.fields.CompetitionYear_dev') }}:</span></td>
               <td><b>{{$previewData->competition_year??'--'}}</b></td>

            </tr>
         </table>
          @endif
          <br>
          <table class="widthBd">
            <tr>
               <th>Qualification</th>
            </tr>
         </table>
         <table class="tablebd">
            <thead style="background: #fff!important;">
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
                  <th>Class / Grade</th>
                  <th>Mode</th>
               </tr>
            </thead>
            <tbody style="font-size: 12px;">
               <?php $i=1; ?>
               @foreach($qualification as $value)
               <tr role="row"class="odd">
                  <td>{{ $i }}</td>
                  <td>{{ !empty($value->qualificationtype) ? $value->qualificationtype : '-'}}</td>
                  <td>{{ !empty($value->qualificationname) ? $value->qualificationname : '-'}}</td>
                  <td>{{ !empty($value->subject) ? App\Traits\Convertors::subject($value->subject)  : '-'}}</td>
                  <td>{{ !empty($value->university) ? App\Traits\Convertors::university($value->university) : '-'}}</td>
                  <td>{{ !empty($value->typeResult) ? $value->typeResult : '-'}}</td>
                  <td>{{ !empty($value->doq) ? $value->doq : '-'}}</td>
                  <td>{{ !empty($value->attempts) ? $value->attempts : '-'}}</td>
                  <td>{{ !empty($value->percentage) ? $value->percentage : '-'}}</td>                  
                  <td>{{ !empty($value->classGrade) ? App\Traits\Convertors::class($value->classGrade)  : '-'}}</td>
                  <td>{{ !empty($value->mode) ? App\Traits\Convertors::mode($value->mode) : '-'}}</td>
                  <?php $i++; ?>
               </tr>
               @endforeach
            </tbody>
         </table>
         <br>
         <table class="widthBd">
            <tr>
               <th>Experience Information</th>
            </tr>
         </table>
         <table class="tablebd">
            <thead >
               <tr>
                  <th>Sr No</th>
                  <th>Institution / Department / Organisation / Court</th>
                  <th>Designation </th>
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
                  <td>{{ !empty($value->postNameLookupId) ? App\Traits\Convertors::designation($value->postNameLookupId) : '-'}}</td>
                  <td>{{ !empty($value->apointmentNatureLookupId) ? App\Traits\Convertors::appointment($value->apointmentNatureLookupId) : '-'}}</td>
                  <td>{{ !empty($value->jobNatureLookupId) ? App\Traits\Convertors::jobnature($value->jobNatureLookupId) : '-'}}</td>
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
         <table>
            <tr>
                @if(!empty($photo))
               <td>
                  <img id="uploadPreview" width="80" height="90" src="data:image/jpg;base64,{{$photo}}">
               </td>
               @endif
                @if(!empty($sign))
               <td style="text-align:right;"><img id="SuploadPreview" width="100" height="50" src="data:image/jpg;base64,{{$sign}}" ></td>
                @endif
            </tr>

         </table>
         <br>
         <table class="widthBd">
            <tr>
               <th><b>Required Documents</b> </th>
            </tr>
         </table>
         <table class="documentUpload" >
            <tr>
               <th style="width:10%;text-align: right;">Sr. No.</th>
               <th>Document Name</th>
               <th>Status</th>
            </tr>
            @php $i=0;@endphp
            @foreach($documentData as $document)
            <tr>
               <td style="text-align: right;">{{++$i}}</td>
               <td>{{$document->document_name}}</td>
               <td class="status" style="text-align: center;">{{$document->documentUploaded}}</td>
            </tr>
            @endforeach
         </table>


      </div>
   </body>
</html>