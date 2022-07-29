<!DOCTYPE html>
<html>
   <head>
      <style type="text/css">
         @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap');
         body { margin: 1px; }
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
         </style>
         <table style="margin-bottom: 20px;">
            <tr>
              <td><img src="{{ url('/') }}/LoginAssets/images/pdfback.jpg" class="w-100"></td>
            </tr>
         </table>
         <br>
         <!-- neet details -->
         <table class="widthBd">
            <tr>
               <th colspan="6">PREVIOUS ATTEMPT OF NEET PG</th>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.registration.NeetRollNo_eng') }}</span><br><span class="devnagari">{{ trans('cruds.registration.NeetRollNo_dev') }}:</span></td>
               <td><b>{{$userData['rollno']}}</b></td>
               <td><span>{{ trans('cruds.registration.NeetAppNo_eng') }}</span><br><span class="devnagari">{{ trans('cruds.registration.NeetAppNo_dev') }}:</span></td>
               <td><b>{{$userData['neetappno']}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.DateOfBirth_eng') }}</span><br><span class="devnagari">{{ trans('cruds.personalInformation.fields.DateOfBirth_dev') }}:</span></td>
               <td><b>{{$userData['dob']}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.registration.NeetRank_eng') }}</span><br><span class="devnagari">{{ trans('cruds.registration.NeetRank_dev') }}:</span></td>
               <td><b>{{$userData['arank']}}</b></td></td>
               <td><span>{{ trans('cruds.registration.NeetMark_eng') }}</span><br><span class="devnagari">{{ trans('cruds.registration.NeetMark_dev') }}:</span></td>
               <td><b>{{$userData['neet_marks']}}</b></td>
            </tr>
         </table>
         <br>
         <!-- Personal Information -->
         <table  class="widthBd">
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
               <td colspan="3"><b>{{$previewData->adhar_card_no??'--'}}</b></td>
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
               <td><b>{{$previewData->permanent_state??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.district_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.district_dev') }}</span></td>
               <td><b>{{$previewData->permanent_district??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.taluka_eng') }} </span><br> <span class="devnagari"> {{ trans('cruds.personalInformation.fields.taluka_dev') }}</span></td>
               <td><b>{{$previewData->permanent_taluka??'--'}}</b></td>
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
               <td><b>{{$previewData->present_state??'--'}}</b></td>
               <td><span>{{ trans('cruds.personalInformation.fields.district_eng') }}</span> <br> <span class="devnagari">{{ trans('cruds.personalInformation.fields.district_dev') }}</span></td>
               <td><b>{{$previewData->present_district??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.personalInformation.fields.taluka_eng') }} </span><br> <span class="devnagari"> {{ trans('cruds.personalInformation.fields.taluka_dev') }}</span></td>
               <td><b>{{$previewData->present_taluka??'--'}}</b></td>
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
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.nri_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.nri_dev') }}</span>:</td>
               <td><b>{{$previewData->nriq??'--'}}</b></td>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               @if($previewData->nriq=='YES')
               <td><span>{{ trans('cruds.Reservation.fields.nriSelf_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.nriSelf_dev') }}</span>:</td>
               <td><b>{{$previewData->nrim??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.NriWard_eng') }}</span>: <br><span class="devnagari">{{ trans('cruds.Reservation.fields.NriWard_dev') }}</span>:</td>
               <td><b>{{$previewData->nriw??'--'}}</b></td>
               @endif
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
               @if($previewData->nriq=='NO' && $previewData->nation=='INDIAN')
               <td><span>{{ trans('cruds.Reservation.fields.AnnualIncome_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.AnnualIncome_dev') }}</span>:</td>
               <td><b>{{$previewData->annual_family_income??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.regionOfResidence_eng') }} </span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.regionOfResidence_dev') }}:</span></td>
               <td><b>{{$previewData->region_of_residence??'--'}}</b></td>
               @endif
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               @if($previewData->ews=='YES')
               <td><span>{{ trans('cruds.Reservation.fields.certStatus_eng') }}</span><br> <span class="devnagari">{{ trans('cruds.Reservation.fields.certStatus_dev') }}</span></td>
               <td><b>tedt</b></td>
               @endif
            </tr>
         </table>
         <table class="widthBd">
            @if($previewData->ews_cert_status=='AVAILABLE')
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.EwsCertificateNo_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.EwsCertificateNo_dev') }}</span>:</td>
               <td><b>{{$previewData->ews_cert_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.EWSCertIssuingDistrict_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.EWSCertIssuingDistrict_dev') }}</span>:</td>
               <td><b>{{$previewData->ews_cert_issue_dist??'--'}}</b></td>
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
               <td><b>{{$previewData->ews_cert_appli_issue_dist??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.EwsIssuingTaluka_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.Reservation.fields.EwsIssuingTaluka_dev') }} :</span></td>
               <td><b>{{$previewData->ews_cert_appli_issue_taluka??'--'}}</b></td>
            </tr>
            @endif
         </table>
         <table class="widthBd">
            <tr>
               @if($previewData->cate=='SC' || $previewData->cate=='ST' || $previewData->cate=='DT-VJ(A)' || $previewData->cate=='NT(B)' || $previewData->cate=='NT(C)' || $previewData->cate=='NT(D)' || $previewData->cate=='OBC' || $previewData->cate=='SBC')
               <td><span>{{ trans('cruds.Reservation.fields.ScCasteCert_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.ScCasteCert_dev') }}</b>:</td>
               <td><b>{{$previewData->caste_certificate??'--'}}</b></td>
               @endif
               @if($previewData->caste_certificate=='AVAILABLE')
               <td><span>{{ trans('cruds.Reservation.fields.CasteCertNumber_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteCertNumber_dev') }}</b>:</td>
               <td><b>{{$previewData->caste_cert_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.CasteCertInssDist_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteCertInssDist_dev') }}</b>:</td>
               <td><b>{{$previewData->caste_cert_issue_district??'--'}}</b></td>
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
               <td><b>{{$previewData->caste_cert_appli_issue_dist??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.CasteCertTal_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.CasteCertTal_dev') }}:</span></td>
               <td><b>{{$previewData->caste_cert_appli_issue_taluka??'--'}}</b></td>
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
               <td><b>{{$previewData->caste_validity_issue_district??'--'}}</b></td>
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
               <td><b>{{$previewData->caste_validity_appli_issue_taluka??'--'}}</b></td>
            </tr>
            @endif
         </table>
         <table class="widthBd">
            @if($previewData->ncl_cert=='AVAILABLE')
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.NCLCertNo_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.NCLCertNo_dev') }}:</span></td>
               <td><b>{{$previewData->ncl_cert_no??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.NCLCertDist_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.NCLCertDist_dev') }}:</span></td>
               <td><b>{{$previewData->ncl_cert_issue_dist??'--'}}</b></td>
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
               <td><b>{{$previewData->ncl_cert_appli_issue_taluka??'--'}}</b></td>
            </tr>
            @endif
         </table>
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.ph_eng') }} :</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.ph_dev') }}:</span></td>
               <td><b>{{$previewData->ph??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.orphan_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.orphan_dev') }}:</span></td>
               <td><b>{{$previewData->orphan??'--'}}</b></td>
               <td><span>{{ trans('cruds.Reservation.fields.MinorityQuota_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.MinorityQuota_dev') }}:</span></td>
               <td><b>{{$previewData->minority??'--'}}</b></td>
            </tr>
         </table>
         <table class="widthBd">
            @if($previewData->minority=='YES') 
            <tr>
               <td><span>{{ trans('cruds.Reservation.fields.religion_eng') }}</span><br><span class="devnagari">{{ trans('cruds.Reservation.fields.religion_dev') }}:</span></td>
               <td><b>{{$previewData->minority_quota??'--'}}</b></td>
            </tr>
            @endif
         </table>
         <table class="widthBd">
            <tr>
               <th>Inservice Quota</th>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td colspan="4"><span>{{ trans('cruds.inserviceQuota.fields.inserviceQuota_eng') }} </span> <br><span class="devnagari">{{ trans('cruds.inserviceQuota.fields.inserviceQuota_dev') }}:</span></td>
               <td><b>{{$previewData->inservice_quota??'--'}}</b></td>
            </tr>
         </table>
         <table class="widthBd">
            @if($previewData->inservice_quota=='YES')
            <tr>
               <td><span>{{ trans('cruds.inserviceQuota.fields.inservice_establishment_eng') }}</span><br><span class="devnagari">{{ trans('cruds.inserviceQuota.fields.inservice_establishment_dev') }}</span>:</td>
               <td><b>{{$previewData->inservice_establishment??'--'}}</b></td>
               <td ><span>{{ trans('cruds.inserviceQuota.fields.DateOfJoin_eng') }} </span> <br><span class="devnagari">{{ trans('cruds.inserviceQuota.fields.DateOfJoin_dev') }}:</span></td>
               <td><b>{{$previewData->inservice_join_date??'--'}}</b></td>
            </tr>
            <tr>
               <td ><span>{{ trans('cruds.inserviceQuota.fields.PostingAdd_eng') }} </span> <br><span class="devnagari">{{ trans('cruds.inserviceQuota.fields.PostingAdd_dev') }}:</span></td>
               <td><b>{{$previewData->inservice_posting_addr??'--'}}</b></td>
               <td><span>{{ trans('cruds.inserviceQuota.fields.noc_eng') }} </span> <br><span class="devnagari">{{ trans('cruds.inserviceQuota.fields.noc_dev') }}:</span></td>
               <td><b>{{$previewData->inservice_establish_noc??'--'}}</b></td>
            </tr>
            <tr>
               @if($previewData->inservice_quota=='YES')
               <td ><span>{{ trans('cruds.inserviceQuota.fields.NocIssuingDate_eng') }} </span><br><span class="devnagari">{{ trans('cruds.inserviceQuota.fields.NocIssuingDate_dev') }}:</span></td>
               <td><b>{{$previewData->inservice_establish_noc_date??'--'}}</b></td>
               @endif
               <td ><span>{{ trans('cruds.inserviceQuota.fields.DeptInq_eng') }}</span>  <br><span class="devnagari">{{ trans('cruds.inserviceQuota.fields.DeptInq_dev') }}:</span></td>
               <td><b>{{$previewData->inservice_dept_enquiry??'--'}}</b></td>
            </tr>
            @if($previewData->inservice_dept_enquiry=='YES')
            <tr>
               <td><span>{{ trans('cruds.inserviceQuota.fields.InqDetails_eng') }}:</span><br><span class="devnagari">{{ trans('cruds.inserviceQuota.fields.InqDetails_dev') }}:</span></td>
               <td><b>{{$previewData->inservice_dept_enquiry_details??'--'}}</b></td>
            </tr>
              @endif
            @endif
         </table>
         <table class="widthBd">
            <tr>
               <th><b>{{ trans('cruds.CollegeInformation.title_eng') }} </b></th>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.DegreeExam_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.DegreeExam_dev') }}:</span></td>
               <td><b>{{$previewData->mbbs_passing_date??'--'}}</b></td>
               <td><span>{{ trans('cruds.CollegeInformation.fields.PercentageMBBS_eng') }} </span><br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.PercentageMBBS_dev') }}:</span></td>
               <td><b>{{$previewData->mbbs_agg_per??'--'}}</b></td>
               <td><span>{{ trans('cruds.CollegeInformation.fields.DateofIntern_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.DateofIntern_dev') }}</span></td>
               <td><b>{{$previewData->mbbs_internship_date??'--'}}</b></td>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.DiplomaCourse_eng') }}</span><br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.DiplomaCourse_dev') }}:</span></td>
               <td><b>{{$previewData->mci_reg_diploma??'--'}}</b></td>
               @if($previewData->mci_reg_diploma=='COMPLETED' || $previewData->mci_reg_diploma=='ADMITTED AND PURSUING')
               <td><span>{{ trans('cruds.CollegeInformation.fields.SubofDiploma_eng') }}</span><br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.SubofDiploma_dev') }}:</span></td>
               <td><b>{{$previewData->diploma_subject??'--'}}</b></td>
               @endif
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.DegreeCourse_eng') }}</span><br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.DegreeCourse_dev') }}:</span></td>
               <td><b>{{$previewData->mci_reg_degree??'--'}}</b></td>
            </tr>
            <tr>
               
               <td><span>{{ trans('cruds.CollegeInformation.fields.MBBSDegree_eng') }}</span><br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.MBBSDegree_dev') }}:</span></td>
               <td><b>{{$previewData->mbbs_dc_in_mh_or_aiims??'--'}}</b></td>
             
            </tr>
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.GovtClg_eng') }}: </span><br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.GovtClg_dev') }}</span></td>
               <td><b>{{$previewData->mbbs_college_name??'--'}}</b></td>
            </tr>
            @if($previewData->mbbs_dc_in_mh_or_aiims=='YES')
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.CollegeType_eng') }}: </span> <br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.CollegeType_dev') }}:</span></td>
               <td><b>{{$previewData->mbbs_college_type??'--'}}</b></td>
            </tr>
            @endif
            @if($previewData->mbbs_dc_in_mh_or_aiims=='NO' )
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.GovtClg_eng') }}:</span> <br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.GovtClg_dev') }}</span></td>
               <td><b>{{$previewData->mbbs_college_outoff_ind_mah??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.college_name_out_mh_eng') }}</span><span class="devnagari"> <br>{{ trans('cruds.CollegeInformation.fields.college_name_out_mh_dev') }} :</span> </td>
               <td><b>{{$previewData->mbbs_college_ind_mah??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.uni_name_out_mh_eng') }}</span><br><span class="devnagari"> {{ trans('cruds.CollegeInformation.fields.uni_name_out_mh_dev') }}:</span></td>
               <td><b>{{$previewData->mbbs_university_ind_mah??'--'}}</b></td>
            </tr>
            @endif
            @if($previewData->mci_reg_degree=='COMPLETED')
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.SubofDegree_eng') }}:</span><br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.SubofDegree_dev') }}:</span></td>
               <td><b>{{$previewData->degree_subject??'--'}}</b></td>
            </tr>
             @endif
         </table>
         @if( $previewData->mbbs_college_type=='AIIMS OR CENTRAL GOVT INSTITUTION' )
         <table>
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.college_name_out_mh_eng') }}</span> <br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.college_name_out_mh_dev') }} :</span></td>
               <td><b>{{$previewData->mbbs_college_ind_mah??'--'}}</b></td>
            </tr>
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.uni_name_out_mh_eng') }}</span><br><span class="devnagari"> {{ trans('cruds.CollegeInformation.fields.uni_name_out_mh_dev') }}:</span></td>
               <td><b>{{$previewData->mbbs_university_ind_mah??'--'}}</b></td>
            </tr>
         </table>
         @endif
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.MedicalCollege_eng') }}</span><br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.MedicalCollege_dev') }}:</span></td>
               <td><b>{{$previewData->aiee??'--'}}</b></td>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <th><b>Previous Attempt Of NEET-G</b></th>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.CollegeInformation.fields.attemptedCandidate_eng') }}</span><br><span class="devnagari">{{ trans('cruds.CollegeInformation.fields.attemptedCandidate_dev') }}:</span></td>
               <td>{{$previewData->neet_pg_attempt_year??'--'}}</td>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <th><b>DC Council Registration</b> </th>
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <td><span>{{ trans('cruds.DcCouncil.fields.MedicalCouncil_eng') }}</span><br><span class="devnagari">{{ trans('cruds.DcCouncil.fields.MedicalCouncil_dev') }}:</span></td>
               <td><b>{{$previewData->medical_council_reg??'--'}}</b></td>
               @if($previewData->medical_council_reg=='YES' || $previewData->medical_council_reg=='APPLIED')
               <td><span>{{ trans('cruds.DcCouncil.fields.MedicalCouncilReg_eng') }}</span><span class="devnagari"> <br>{{ trans('cruds.DcCouncil.fields.MedicalCouncilReg_dev') }} :</span></td>
               <td><b>{{$previewData->medical_council_reg_no??'--'}}</b></td>
               @endif
            </tr>
            <tr>
               <td><span>{{ trans('cruds.DcCouncil.fields.dci_eng') }} </span><br><span class="devnagari">{{ trans('cruds.DcCouncil.fields.dci_dev') }}:</span></td>
               <td><b>{{$previewData->medical_dci_reg??'--'}}</b></td>
               @if($previewData->medical_dci_reg=='YES')
               <td><span>{{ trans('cruds.DcCouncil.fields.dci_eng') }} </span><br><span class="devnagari">{{ trans('cruds.DcCouncil.fields.dci_dev') }}:</span></td>
               <td><b>{{$previewData->medical_dci_reg_no??'--'}}</b></td>
               @endif
            </tr>
         </table>
         <table class="widthBd">
            <tr>
               <th><b>Required Documents</b> </th>
            </tr>
         </table>
         <table class="widthBd">
            @php $i=0;@endphp
            @foreach($documentData as $document)
            <tr>
               <td>{{++$i}}</td>
               <td>{{$document->document_name}}</td>
               <td>{{$document->documentUploaded}}</td>
            </tr>
            @endforeach
         </table>
      </div>
   </body>
</html>