@extends('layouts.UserDashboard')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title">Application Form</h4>
      </div>
   </div>
   <div class="col-12">
      <div class="tab-content">
         <form id="reservationform" autocomplete="off">
            @csrf
            <fieldset class="form-fieldset mb-3">
               <legend>{{ trans('cruds.Reservation.title_eng') }} <span class="text-muted">{{ trans('cruds.Reservation.title_dev') }}</span></legend>
               <div class="row">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.Reservation.fields.Nationality_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.Nationality_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control inpField " name="nation" id="Nationality">
                        <option value="">[SELECT]</option>
                        <option value="INDIAN" {{ (isset($reservationData->nation) && $reservationData->nation==='INDIAN') ? 'selected' : '' }}>Indian</option>                
                     </select>
                  </div>
               </div>
               <div class="row  natDetails">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.Reservation.fields.domicile_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.domicile_dev') }}</label>
                  </div>
                  <div class="col-md-3">
                     <select class="form-control inpField" name="domicle_maharashtra"  id="domicile">
                        <option value="">[SELECT]</option>
                        <option value="YES" {{ (isset($reservationData->domicle_maharashtra) && $reservationData->domicle_maharashtra==='YES') ? 'selected' : '' }}>YES</option>
                        <option value="NO" {{ (isset($reservationData->domicle_maharashtra) && $reservationData->domicle_maharashtra==='NO') ? 'selected' : '' }}>NO</option>
                     </select>
                  </div>
               </div>
               <div class="row form-group  ForDetails CatDetail">
                  <div class="col-md-6 text-right">
                     <label class="d-block">{{ trans('cruds.Reservation.fields.Category_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.Category_dev') }}:</label>
                  </div>
                  <div class="col-md-3">
                     <select class="form-control inpField" name="cate"  id="Category">
                     @if(!empty($reservationData->cate) &&  $reservationData->cate ==='UNRESERVED' && ($reservationData->domicle_maharashtra==='NO'))                                             
                     <option value="UNRESERVED" {{ $reservationData->cate==='UNRESERVED' ? 'selected' : '' }}>UNRESERVED</option> 
                     @elseif(!empty($reservationData->cate) &&  $reservationData->cate ==='UNRESERVED' && $reservationData->domicle_maharashtra==='YES')
                     @foreach($caste as $key=>$value)    
                     <option value="{{$value}}" {{ $reservationData->cate==$value ? 'selected' : '' }}>{{$value}}</option>                                  
                     @endforeach 
                     @else
                     @foreach($caste as $key=>$value)                                        
                     <option value="{{$value}}" {{ $reservationData->cate==$value ? 'selected' : '' }}>{{$value}}</option>                                  
                     @endforeach
                     @endif      
                     </select>
                  </div>
               </div>
               <div class="row form-group  incomeAnnual">
                  <div class="col-md-3 text-right">
                     <label class="d-block">{{ trans('cruds.Reservation.fields.AnnualIncome_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.AnnualIncome_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control inpField " name="annual_family_income"  id="AnnualIncome">
                        <option value="">[SELECT]</option>
                        <option value="50,000 TO 1,00,000" {{ (isset($reservationData->annual_family_income) && $reservationData->annual_family_income==='50,000 TO 1,00,000') ? 'selected' : '' }}>50,000 TO 1,00,000</option>
                        <option value="1,00,000 TO 2,00,000" {{ (isset($reservationData->annual_family_income) && $reservationData->annual_family_income==='1,00,000 TO 2,00,000') ? 'selected' : '' }}>1,00,000 TO 2,00,000</option>
                        <option value="2,00,000 TO 3,00,000" {{ (isset($reservationData->annual_family_income) && $reservationData->annual_family_income==='2,00,000 TO 3,00,000') ? 'selected' : '' }}>2,00,000 TO 3,00,000</option>
                        <option value="3,00,000 TO 4,00,000" {{ (isset($reservationData->annual_family_income) && $reservationData->annual_family_income==='3,00,000 TO 4,00,000') ? 'selected' : '' }}>3,00,000 TO 4,00,000</option>
                        <option value="4,00,000 TO 5,00,000" {{ (isset($reservationData->annual_family_income) && $reservationData->annual_family_income==='4,00,000 TO 5,00,000') ? 'selected' : '' }}>4,00,000 TO 5,00,000</option>
                        <option value="5,00,000 TO 6,00,000" {{ (isset($reservationData->annual_family_income) && $reservationData->annual_family_income==='5,00,000 TO 6,00,000') ? 'selected' : '' }}>5,00,000 TO 6,00,000</option>
                        <option value="6,00,000 TO 7,00,000" {{ (isset($reservationData->annual_family_income) && $reservationData->annual_family_income==='6,00,000 TO 7,00,000') ? 'selected' : '' }}>6,00,000 TO 7,00,000</option>
                        <option value="7,00,000 TO 8,00,000" {{ (isset($reservationData->annual_family_income) && $reservationData->annual_family_income==='7,00,000 TO 8,00,000') ? 'selected' : '' }}>7,00,000 TO 8,00,000</option>
                        @if($reservationData->cate ==='UNRESERVED' || $reservationData->cate ==='SC'|| $reservationData->cate ==='ST' || $reservationData->cate ==='DT-VJ(A)' ||
                            $reservationData->cate ==='NT-B' || $reservationData->cate ==='NT-C' || $reservationData->cate ==='NT-D' || $reservationData->cate ==='SBC' || 
                            $reservationData->cate ==='SEBC' || $reservationData->cate ==='OBC')
                            <option id="income_800000" value="8,00,000 & More" {{ (isset($reservationData->annual_family_income) && $reservationData->annual_family_income==='8,00,000 & MORE') ? 'selected' : '' }}>8,00,000 & MORE</option>
                        @else
                            <option style="display:none;" id="income_800000" value="8,00,000 & More" {{ (isset($reservationData->annual_family_income) && $reservationData->annual_family_income==='8,00,000 & MORE') ? 'selected' : '' }}>8,00,000 & MORE</option>
                        @endif
                     </select>
                  </div>
                  <div class="col-md-3 text-right ">
                     <label class="d-block">{{ trans('cruds.Reservation.fields.regionOfResidence_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.regionOfResidence_dev') }}:</label>
                  </div>
                  <div class=" col-md-3">
                     <select class="form-control inpField " name="region_of_residence"  id="region_of_residence">
                        <option value="">[SELECT]</option>
                        <option value="1-NAGARPALIKA" {{ (isset($reservationData->region_of_residence) && $reservationData->region_of_residence==='1-NAGARPALIKA') ? 'selected' : '' }}>1-NAGARPALIKA</option>
                        <option value="2-MAHANAGARPALIKA" {{ (isset($reservationData->region_of_residence) && $reservationData->region_of_residence==='2-MAHANAGARPALIKA') ? 'selected' : '' }}>2-MAHANAGARPALIKA</option>
                        <option value="3-PANCHAYAT SAMITI" {{ (isset($reservationData->region_of_residence) && $reservationData->region_of_residence==='3-PANCHAYAT SAMITI') ? 'selected' : '' }}>3-PANCHAYAT SAMITI</option>
                        <option value="4-GRAM PACHAYAT" {{ (isset($reservationData->region_of_residence) && $reservationData->region_of_residence==='4-GRAM PACHAYAT') ? 'selected' : '' }}>4-GRAM PACHAYAT</option>
                     </select>
                  </div>
               </div>
               <div class="certificateDetails">
                  <div class="row form-group ewsdetails {{ (isset($reservationData->cate) && $reservationData->cate==='EWS') ? 'show' : 'hide' }}">
                     <div class="col-md-6 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.certStatus_eng') }}:<font class="astr">*</font><br> {{ trans('cruds.Reservation.fields.certStatus_dev') }} </label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="ews_cert_status"  id="certStatus">
                           <option value="">[SELECT]</option>
                           <option value="AVAILABLE" {{ (isset($reservationData->ews_cert_status) && $reservationData->ews_cert_status==='AVAILABLE') ? 'selected' : '' }}>AVAILABLE</option>
                           <option value="APPLIED BUT NOT RECEIVED" {{ (isset($reservationData->ews_cert_status) && $reservationData->ews_cert_status==='APPLIED BUT NOT RECEIVED') ? 'selected' : '' }}>APPLIED BUT NOT RECEIVED</option>
                        </select>
                     </div>
                  </div>
                  <div class="row form-group ewscertavaildetails {{ (isset($reservationData->ews_cert_status) && $reservationData->ews_cert_status==='AVAILABLE') ? 'show' : 'hide' }}">
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.EwsCertificateNo_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.EwsCertificateNo_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="text" class="form-control" name="ews_cert_no" id="EwsCertificateNO" value="{{ old('ews_cert_no', isset($reservationData->ews_cert_no) ? $reservationData->ews_cert_no : '') }}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.EWSCertIssuingDistrict_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.EWSCertIssuingDistrict_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="ews_cert_issue_dist"  id="EWSCertIssuingDistrict">
                        @foreach($districtData as $key=>$value)
                        <option value="{{ $key }}" {{ (isset($reservationData->ews_cert_issue_dist) && $reservationData->ews_cert_issue_dist==$key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class=" col-md-12 text-center">
                        <p class="noteForm">Certificate & Documents Are Mandatory</p>
                     </div>
                  </div>
                  <div class="row form-group certdetails {{ (isset($reservationData->ews_cert_status) && $reservationData->ews_cert_status==='APPLIED BUT NOT RECEIVED') ? 'show' : 'hide' }}">
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.EwsApplicationNo_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.EwsApplicationNo_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="text" class="form-control" name="ews_cert_appli_no" id="EwsApplicationNO" value="{{ old('ews_cert_appli_no', isset($reservationData->ews_cert_appli_no) ? $reservationData->ews_cert_appli_no : '') }}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.EwsApplicationDate_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.EwsApplicationDate_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="date" class="form-control" name="ews_cert_appli_date" id="EwsApplicationDate" value="{{ old('ews_cert_appli_date', isset($reservationData->ews_cert_appli_date) ? date(config('panel.date_format'),strtotime($reservationData->ews_cert_appli_date)) : '') }}" min="{{config('datevalidation.min_date')}}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.EwsEwsAppDistrict_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.EwsEwsAppDistrict_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="ews_cert_appli_issue_dist" id="EwsEwsAppDistrict" onchange="getLocation('EwsIssuingTaluka','subDistrict','MAHARASHTRA',$(this).val())">
                        @foreach($districtData as $key=>$value)
                        <option value="{{ $key }}" {{ (isset($reservationData->ews_cert_appli_issue_dist) && $reservationData->ews_cert_appli_issue_dist==$key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.EwsIssuingTaluka_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.EwsIssuingTaluka_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="ews_cert_appli_issue_taluka" id="EwsIssuingTaluka">
                           <option value="">[SELECT]</option>
                           @if(isset($reservationData->ews_cert_appli_issue_taluka))
                           <option value="{{$reservationData->ews_cert_appli_issue_taluka}}" selected
                              >{{ App\Traits\Convertors::getTalukaById($reservationData->ews_cert_appli_issue_taluka) }}</option>
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="row form-group br-bt-1 scdetails {{ (isset($reservationData->cate) && !in_array($reservationData->cate,['UNRESERVED','EWS'])) ? 'show' : 'hide' }}">
                     <div class="col-md-6 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.ScCasteCert_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.ScCasteCert_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control inpField" name="caste_certificate"  id="ScCasteCert">
                           <option value="">[SELECT]</option>
                           <option value="AVAILABLE" {{ (isset($reservationData->caste_certificate) && $reservationData->caste_certificate==='AVAILABLE') ? 'selected' : '' }}>AVAILABLE</option>
                           <option value="APPLIED BUT NOT RECEIVED" {{ (isset($reservationData->caste_certificate) && $reservationData->caste_certificate==='APPLIED BUT NOT RECEIVED') ? 'selected' : '' }}>APPLIED BUT NOT RECEIVED</option>
                        </select>
                     </div>
                  </div>
                  <div class="row form-group  sccertavaildetails {{ (isset($reservationData->caste_certificate) && $reservationData->caste_certificate==='AVAILABLE') ? 'show' : 'hide' }}">
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertNumber_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.CasteCertNumber_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="text" class="form-control" name="caste_cert_no" id="CasteCertNumber" value="{{ old('caste_cert_no', isset($reservationData->caste_cert_no) ? $reservationData->caste_cert_no : '') }}" >
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertInssDist_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.CasteCertInssDist_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="caste_cert_issue_district"  id="CasteCertInssDist">
                        @foreach($districtData as $key=>$value)                            
                        <option value="{{ $key }}" {{ (isset($reservationData->caste_cert_issue_district) && $reservationData->caste_cert_issue_district==$key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class=" col-md-12 text-center">
                        <p class="noteForm">Certificate & Documents Are Mandatory</p>
                     </div>
                  </div>
                  <div class="row form-group  sccertdetails {{ (isset($reservationData->caste_certificate) && $reservationData->caste_certificate==='APPLIED BUT NOT RECEIVED') ? 'show' : 'hide' }}">
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertAteappnNo_eng') }}:<font class="astr">*</font>  <br>{{ trans('cruds.Reservation.fields.CasteCertAteappnNo_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="text" class="form-control" name="caste_cert_appli_no" id="CasteCertAteappnNO" value="{{ old('caste_cert_appli_no', isset($reservationData->caste_cert_appli_no) ? $reservationData->caste_cert_appli_no : '') }}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertappDate_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.CasteCertappDate_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="date" class="form-control" name="caste_cert_appli_date" id="CasteCertappDate" value="{{ old('caste_cert_appli_date', isset($reservationData->caste_cert_appli_date) ? date(config('panel.date_format'),strtotime($reservationData->caste_cert_appli_date)) : '') }}" min="{{config('datevalidation.min_date')}}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertDist_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.CasteCertDist_dev') }}</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="caste_cert_appli_issue_dist" id="CasteCertDist" onchange="getLocation('CasteCertTal','subDistrict','MAHARASHTRA',$(this).val())">
                        @foreach($districtData as $key=>$value)
                        <option value="{{ $key }}" {{ (isset($reservationData->caste_cert_appli_issue_dist) && $reservationData->caste_cert_appli_issue_dist==$key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteCertTal_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.CasteCertTal_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="caste_cert_appli_issue_taluka" id="CasteCertTal">
                           <option value="">[SELECT]</option>
                           @if(isset($reservationData->caste_cert_appli_issue_taluka))
                           <option value="{{$reservationData->caste_cert_appli_issue_taluka}}" selected>{{ App\Traits\Convertors::getTalukaById($reservationData->caste_cert_appli_issue_taluka) }}</option>
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="row form-group castavail {{ (isset($reservationData->caste_certificate) && $reservationData->caste_certificate==='AVAILABLE') ? 'show' : 'hide' }}">
                     <div class="col-md-6 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValidity_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.CasteValidity_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control inpField" name="caste_validity"  id="CasteValidity">
                           <option value="">[SELECT]</option>
                           <option value="AVAILABLE" {{ (isset($reservationData->caste_validity) && $reservationData->caste_validity==='AVAILABLE') ? 'selected' : '' }}>AVAILABLE</option>
                           <option value="APPLIED BUT NOT RECEIVED" {{ (isset($reservationData->caste_validity) && $reservationData->caste_validity==='APPLIED BUT NOT RECEIVED') ? 'selected' : '' }}>APPLIED BUT NOT RECEIVED</option>
                        </select>
                     </div>
                  </div>
                  <div class="row form-group  CasteValAvail {{ (isset($reservationData->caste_validity) && $reservationData->caste_validity==='AVAILABLE') ? 'show' : 'hide' }}">
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValNumber_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.CasteValNumber_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="text" class="form-control" name="caste_validity_no" id="CasteValNumber" value="{{ old('caste_validity_no', isset($reservationData->caste_validity_no) ? $reservationData->caste_validity_no : '') }}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValDist_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.CasteValDist_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="caste_validity_issue_district" id="CasteValDist">
                        @foreach($districtData as $key=>$value)
                        <option value="{{ $key }}" {{ (isset($reservationData->caste_validity_issue_district) && $reservationData->caste_validity_issue_district==$key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class=" col-md-12 text-center">
                        <p class="noteForm">Certificate & Documents Are Mandatory</p>
                     </div>
                  </div>
                  <div class="row form-group CasteValApplied {{ (isset($reservationData->caste_validity) && $reservationData->caste_validity== 'APPLIED BUT NOT RECEIVED') ? 'show' : 'hide' }}">
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppNo_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.CasteValAppNo_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="text" class="form-control" name="caste_validity_appli_no" id="CasteValAppNO" value="{{ old('caste_validity_appli_no', isset($reservationData->caste_validity_appli_no) ? $reservationData->caste_validity_appli_no : '') }}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppDate_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.CasteValAppDate_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="date" class="form-control" name="caste_validity_appli_date" id="CasteValAppDate" value="{{ old('caste_validity_appli_date', isset($reservationData->caste_validity_appli_date) ? date(config('panel.date_format'),strtotime($reservationData->caste_validity_appli_date)) : '') }}" min="{{config('datevalidation.min_date')}}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppDist_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.CasteValAppDist_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="caste_validity_appli_issue_dist" id="CasteValAppDist" onchange="getLocation('CasteValAppTal','subDistrict','MAHARASHTRA',$(this).val())" >
                        @foreach($districtData as $key=>$value)
                        <option value="{{ $key }}" {{ (isset($reservationData->caste_validity_appli_issue_dist) && $reservationData->caste_validity_appli_issue_dist== $key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.CasteValAppTal_eng') }}:<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.CasteValAppTal_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" id="CasteValAppTal" name="caste_validity_appli_issue_taluka">
                           <option value="">[SELECT]</option>
                           @if(isset($reservationData->caste_validity_appli_issue_taluka))
                           <option value="{{$reservationData->caste_validity_appli_issue_taluka}}" selected>{{ App\Traits\Convertors::getTalukaById($reservationData->caste_validity_appli_issue_taluka)}}</option>
                           @endif
                        </select>
                     </div>
                  </div>
                  <!-- //NOncreamy -->
                  <div class="row form-group  Ncldetails {{ (isset($reservationData->cate) && !in_array($reservationData->cate,['UNRESERVED','EWS','SC','ST'])) ? 'show' : 'hide' }}">
                     <div class="col-md-6 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.NCL_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.NCL_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control inpField" name="ncl_cert"  id="NCL">
                           <option value="">[SELECT]</option>
                           <option value="AVAILABLE" {{ (isset($reservationData->ncl_cert) && $reservationData->ncl_cert==='AVAILABLE') ? 'selected' : '' }}>AVAILABLE</option>
                           <option value="APPLIED BUT NOT RECEIVED" {{ (isset($reservationData->ncl_cert) && $reservationData->ncl_cert==='APPLIED BUT NOT RECEIVED') ? 'selected' : '' }}>APPLIED BUT NOT RECEIVED</option>
                        </select>
                     </div>
                  </div>
                  <div class="row form-group  NCLAvail {{ (isset($reservationData->ncl_cert) && $reservationData->ncl_cert==='AVAILABLE') ? 'show' : 'hide' }}">
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertNo_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.NCLCertNo_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="text" class="form-control" name="ncl_cert_no" id="NCLCertNO"  value="{{ old('ncl_cert_no', isset($reservationData->ncl_cert_no) ? $reservationData->ncl_cert_no : '') }}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertDist_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.NCLCertDist_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="ncl_cert_issue_dist"  id="NCLCertDist" >
                        @foreach($districtData as $key=>$value)
                        <option value="{{ $key }}" {{ (isset($reservationData->ncl_cert_issue_dist) && $reservationData->ncl_cert_issue_dist==$key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.nclCertDate_eng') }}*<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.nclCertDate_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="date" class="form-control" name="ncl_cert_date" id="nclCertDate" value="{{ old('ncl_cert_date', isset($reservationData->ncl_cert_date) ? date(config('panel.date_format'),strtotime($reservationData->ncl_cert_date)) : '') }}" max="{{config('datevalidation.reservation.ncl')}}" min="{{config('datevalidation.reservation.min_ncl')}}">
                     </div>
                     <div class=" col-md-12 text-center">
                        <p class="noteForm">Certificate & Documents Are Mandatory</p>
                     </div>
                  </div>
                  <div class="row form-group NCLApplied {{ (isset($reservationData->ncl_cert) && $reservationData->ncl_cert==='APPLIED BUT NOT RECEIVED') ? 'show' : 'hide' }}">
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.NCLAppNo_eng') }}*<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.NCLAppNo_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="text" class="form-control" name="ncl_cert_appli_no" id="NCLAppNO" value="{{ old('ncl_cert_appli_no', isset($reservationData->ncl_cert_appli_no) ? $reservationData->ncl_cert_appli_no : '') }}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.NCLAppDate_eng') }}*<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.NCLAppDate_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <input type="date" class="form-control" name="ncl_cert_appli_date" id="NCLAppDate" value="{{ old('ncl_cert_appli_date', isset($reservationData->ncl_cert_appli_date) ? date(config('panel.date_format'),strtotime($reservationData->ncl_cert_appli_date)) : '') }}" min="{{config('datevalidation.min_date')}}">
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertIssDist_eng') }}*<font class="astr">*</font> <br>{{ trans('cruds.Reservation.fields.NCLCertIssDist_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="ncl_cert_appli_issue_dist" id="NCLCertIssDist" onchange="getLocation('NCLCertIssuingTal','subDistrict','MAHARASHTRA',$(this).val())">
                        @foreach($districtData as $key=>$value)
                        <option value="{{ $key }}" {{ (isset($reservationData->ncl_cert_appli_issue_dist) && $reservationData->ncl_cert_appli_issue_dist== $key) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="col-md-3 text-right">
                        <label class="d-block">{{ trans('cruds.Reservation.fields.NCLCertIssuingTal_eng') }}*<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.NCLCertIssuingTal_dev') }}:</label>
                     </div>
                     <div class=" col-md-3">
                        <select class="form-control" name="ncl_cert_appli_issue_taluka" id="NCLCertIssuingTal">
                           <option value="">[SELECT]</option>
                           @if(isset($reservationData->ncl_cert_appli_issue_taluka))
                           <option value="{{$reservationData->ncl_cert_appli_issue_taluka}}" selected>{{   App\Traits\Convertors::getTalukaById($reservationData->ncl_cert_appli_issue_taluka)  }}</option>
                           @endif
                        </select>
                     </div>
                  </div>
               </div>
            </fieldset>
            <fieldset class="form-fieldset ">
               <legend>Persons with Benchmark Disabilities Details <span class="text-muted">बेंचमार्क अपंग तपशील असलेल्या व्यक्ती</span></legend>
               <div class="row form-group br-bt-1">
                  <div class="col-md-6 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.Reservation.fields.ph_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.ph_dev') }}:</label>
                  </div>
                  <div class="col-md-3">
                     <select class="form-control inpField"  id="ph" name="ph"  >
                        <option value="" selected>[SELECT]</option>
                        <option value="YES" {{ (isset($reservationData->ph) && $reservationData->ph==='YES') ? 'selected' : '' }}>YES</option>
                        <option value="NO" {{ (isset($reservationData->ph) && $reservationData->ph==='NO') ? 'selected' : '' }}>NO</option>
                     </select>
                     <p class="noteForm hide text-danger phNote" id="phNote">Certificate mandatory as per competent authority  <br>सक्षम प्राधिकरणानुसार प्रमाणपत्र बंधनकारक</p>
                  </div>
               </div>
               <div class="row form-group br-bt-1 mt-2 mb-2 phDetails {{ (isset($reservationData->ph) && $reservationData->ph==='YES') ? 'show' : 'hide' }}">
                  <div class="col-md-3 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.perdisability_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.perdisability_dev') }}</label>
                  </div>
                  <div class="col-md-3 text-right">
                     <input type="number" class="form-control" name="per_disability" id="perDisability" value="{{ old('per_disability',isset($reservationData->per_disability) ? $reservationData->per_disability : '' ) }}">
                     <p class="text-left noteForm hide text-danger phNote" id="phNote">If Percentage of disability Is Less then 40% then you are Not Eligible for PWD</p>
                  </div>
                  <div class="col-md-3 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.phType_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.phType_dev') }}</label>
                  </div>
                  <div class="col-md-3 text-right">
                     <select class="form-control inpField"  id="phType" name="ph_type">                    
                     @foreach($disability as $key=>$value)
                     <option value="{{ $key }}"
                     {{ (isset($reservationData->ph_type) && $reservationData->ph_type==$key) ? 'selected' : '' }}
                     >{{ $value }}</option>
                     @endforeach
                     </select>
                  </div>
               </div>
            </fieldset>
            <fieldset class="form-fieldset mt-3">
               <legend>Orphan Details <span class="text-muted">अनाथ तपशील</span></legend>
               <div class="row form-group br-bt-1">
                  <div class="col-md-6 text-right ">
                     <label  class="d-block mb-0" for="orphan">{{ trans('cruds.Reservation.fields.orphan_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.Reservation.fields.orphan_dev') }}:</label>
                  </div>
                  <div class="col-sm-3 ">
                     <select class="form-control inpField"  id="orphan" name="orphan">
                        <option value="" selected>[SELECT]</option>
                        <option value="YES" {{ (isset($reservationData->orphan) && $reservationData->orphan==='YES') ? 'selected' : '' }}>YES</option>
                        <option value="NO" {{ (isset($reservationData->orphan) && $reservationData->orphan==='NO') ? 'selected' : '' }}>NO</option>
                     </select>
                     <p class="noteForm hide text-danger" id="orphanNote">Certificate mandatory as per Ministry of WOMEN AND CHILD DEVELOPMENT DEPARTMENT<br>महिला व बाल विकास मंत्रालयानुसार प्रमाणपत्र बंधनकारक </p>
                  </div>
               </div>
               <div class="row form-group br-bt-1 orphanDetails {{ (isset($reservationData->orphan) && $reservationData->orphan==='YES') ? 'show' : 'hide' }}">
                  <div class="col-md-6 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.orphanType_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.orphanType_dev') }}:</label>
                  </div>
                  <div class="col-md-3 text-right">
                     <select class="form-control" name="orphan_type" id="orphanType">
                        <option value="" selected>Select</option>
                        @if($reservationData->cate==='UNRESERVED')
                        <option {{ (isset($reservationData->orphan_type) && $reservationData->orphan_type==='ORPHAN TYPE-A') ? 'selected' : '' }} value="ORPHAN TYPE-A">ORPHAN TYPE-A</option>
                        <option {{ (isset($reservationData->orphan_type) && $reservationData->orphan_type==='ORPHAN TYPE-B') ? 'selected' : '' }} value="ORPHAN TYPE-B">ORPHAN TYPE-B</option>
                        <option {{ (isset($reservationData->orphan_type) && $reservationData->orphan_type==='ORPHAN TYPE-C') ? 'selected' : '' }} value="ORPHAN TYPE-C">ORPHAN TYPE-C</option>
                        @else                        
                        <option {{ (isset($reservationData->orphan_type) && $reservationData->orphan_type==='ORPHAN TYPE-B') ? 'selected' : '' }} value="ORPHAN TYPE-B">ORPHAN TYPE-B</option>
                        <option {{ (isset($reservationData->orphan_type) && $reservationData->orphan_type==='ORPHAN TYPE-C') ? 'selected' : '' }} value="ORPHAN TYPE-C">ORPHAN TYPE-C</option>
                        @endif
                     </select>
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
                     <select class="form-control" name="ex_serviceman" id="exServiceman">
                        <option value="" selected>Select</option>
                        <option {{ (isset($reservationData->ex_serviceman) && $reservationData->ex_serviceman==='YES') ? 'selected' : '' }} value="YES">YES</option>
                        <option {{ (isset($reservationData->ex_serviceman) && $reservationData->ex_serviceman==='NO') ? 'selected' : '' }} value="NO">NO</option>
                     </select>
                  </div>
               </div>
               <div class="row form-group br-bt-1 {{ (isset($reservationData->ex_serviceman) && $reservationData->ex_serviceman==='YES') ? 'show' : 'hide' }} serviceDetails">
                  <div class="col-md-6 text-right">
                     <label class="d-block mb-0">Division of the Armed Forces <span class="asrtick">*</span> <br>सशस्त्र दलांची विभागणी:</label>
                  </div>
                  <div class=" col-md-3 text-right">
                     <select class="form-control inpField" name="forces_division"  id="DivisionOfArm">
                        <option value="" selected>[SELECT]</option>
                        <option {{ (isset($reservationData->forces_division) && $reservationData->forces_division==='ARMY') ? 'selected' : '' }} value="ARMY">ARMY</option>
                        <option {{ (isset($reservationData->forces_division) && $reservationData->forces_division==='NAVY') ? 'selected' : '' }} value="NAVY">NAVY</option>
                        <option {{ (isset($reservationData->forces_division) && $reservationData->forces_division==='AIR FORCE') ? 'selected' : '' }} value="AIR FORCE">AIR FORCE</option>
                     </select>
                  </div>
               </div>
               <div class="row form-group br-bt-1 mt-2  {{ (isset($reservationData->ex_serviceman) && $reservationData->ex_serviceman==='YES') ? 'show' : 'hide' }} serviceDetails">
                  <div class="col-md-3 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.joinDate_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.joinDate_dev') }}:</label>
                  </div>
                  <div class="col-md-3 text-right">
                     <input type="date" class="form-control" name="join_date" id="joinDate"  
                        value="{{ old('join_date',isset($reservationData->join_date) ? $reservationData->join_date : '' ) }}">
                  </div>
                  <div class="col-md-3 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.retirement_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.retirement_dev') }}:</label>
                  </div>
                  <div class="col-md-3 text-right">
                     <input type="date" class="form-control" name="retirement_date" id="retirementDate" 
                        value="{{ old('retirement_date',isset($reservationData->retirement_date) ? $reservationData->retirement_date : '' ) }}">
                  </div>
               </div>
               <div class="row form-group br-bt-1 mt-2  {{ (isset($reservationData->ex_serviceman) && $reservationData->ex_serviceman==='YES') ? 'show' : 'hide' }} serviceDetails">
                  <div class="col-md-6 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.SpecialReservation.fields.PeriodOfService_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SpecialReservation.fields.PeriodOfService_dev') }}:</label>
                  </div>
                  <div class="col-md-1 mb-3">
                     <label> Years</label>
                     <input type="numeric" class="form-control" readonly  value="{{ old('service_years',isset($reservationData->service_years) ? $reservationData->service_years : '' ) }}" name="service_years" id="periodYears">
                  </div>
                  <div class="col-md-1 mb-3">
                     <label> Months</label>
                     <input type="numeric" class="form-control" readonly value="{{ old('service_months',isset($reservationData->service_months) ? $reservationData->service_months : '' ) }}" name="service_months" id="periodMonths">
                  </div>
                  <div class="col-md-1 mb-3">
                     <label> Days</label>
                     <input type="numeric" class="form-control" readonly value="{{ old('service_days',isset($reservationData->service_days) ? $reservationData->service_days : '' ) }}" name="service_days" id="periodDays">
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
                     <select class="form-control" name="sports_person" id="Meritorious_Sports_Person">
                        <option value="" selected>Select</option>
                        <option {{ (isset($reservationData->sports_person) && $reservationData->sports_person==='YES') ? 'selected' : '' }} value="YES">YES</option>
                        <option {{ (isset($reservationData->sports_person) && $reservationData->sports_person==='NO') ? 'selected' : '' }} value="NO">NO</option>
                     </select>
                  </div>
               </div>
               <div class="row form-group br-bt-1 mt-2 
                  {{ (isset($reservationData->sports_person) && $reservationData->sports_person=='YES') ? 'show' : 'hide' }} SportDetails">
                  <div class="col-md-3 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.SportDetails.fields.CompetitionType_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SportDetails.fields.CompetitionType_dev') }}:</label>
                  </div>
                  <div class="col-md-3 text-left">
                     <select class="form-control " name="type_competition" id="typeOfCompetition">                        
                     @foreach($competition_type as $key=>$value)
                     <option value="{{ $key }}" {{ (isset($reservationData->type_competition) && $reservationData->type_competition==$key) ? 'selected' : '' }} 
                     >{{ $value }}</option>
                     @endforeach
                     </select>
                  </div>
                  <div class="col-md-3 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.SportDetails.fields.CompetitionLevel_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SportDetails.fields.CompetitionLevel_dev') }}:</label>
                  </div>
                  <div class="col-md-3 text-right">
                     <select class="form-control" name="level_competition" id="LevelOfCompetition">
                        <OPTION VALUE="">SELECT</OPTION>
                        <OPTION {{ (!empty($reservationData->level_competition) && $reservationData->level_competition==='STATE LEVEL') ? 'selected' : '' }} 
                            VALUE="NATIONAL LEVEL">STATE LEVEL</OPTION>
                        <OPTION {{ (!empty($reservationData->level_competition) && $reservationData->level_competition==='NATIONAL LEVEL') ? 'selected' : '' }} 
                        VALUE="NATIONAL LEVEL">NATIONAL LEVEL</OPTION>
                        <OPTION {{ (!empty($reservationData->level_competition) && $reservationData->level_competition==='INTERNATIONAL LEVEL') ? 'selected' : '' }}
                        VALUE="INTERNATIONAL LEVEL">INTERNATIONAL LEVEL</OPTION>
                     </select>
                  </div>

                  <div class="col-md-3 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.SportDetails.fields.CompetitionMedal_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SportDetails.fields.CompetitionMedal_dev') }}:</label>
                  </div>
                  <div class="col-md-3 text-right">
                     <select class="form-control" name="position_medal" id="positionMedal">  
                     @foreach($position_medal as $key=>$value)
                     <option value="{{ $key }}"
                     {{ (isset($reservationData->position_medal) && $reservationData->position_medal== $key) ? 'selected' : '' }}>{{ $value }}</option>
                     @endforeach                     
                     </select>
                  </div>
                  <div class="col-md-3 text-right">
                     <label class="d-block mb-0">{{ trans('cruds.SportDetails.fields.CompetitionYear_eng') }}:<font class="astr">*</font><br>{{ trans('cruds.SportDetails.fields.CompetitionYear_dev') }}:</label>
                  </div>
                  <div class="col-md-3 text-right">
                     <input type="text" class="form-control" name="competition_year" id="CompetitionYear" 
                        value="{{ old('competition_year',isset($reservationData->competition_year) ? $reservationData->competition_year : '' ) }}">
                  </div>
               </div>
            </fieldset>
            <div class="row form-group ">
               <div class="col-md-12 text-right">
                  <button type="submit" class="btn btn-success mb-3" id="submitReservation">Save And Next</button>
               </div>
            </div>
            </fieldset>
         </form>
      </div>
   </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
   $(document).on('change', '#Nationality', function() {
       document.getElementById('Category').value = "";
       document.getElementById('domicile').value = "";
       $('.certificateDetails').hide();
      
       var nation = $(this).val();
   
       if (nation == "INDIAN"){
           $('.CatDetail').show();
           $('.natDetails').css('display', 'flex');
           //categories
           $("#Category").empty();
           $('#Category').append('<option value="" selected>[SELECT]</option><option value="UNRESERVED">UNRESERVED</option><option value="SC">SC</option><option value="ST">ST</option><option value="DT-VJ(A)">DT-VJ(A)</option><option value="NT-B">NT-B</option> <option value="NT-C">NT-C</option> <option value="NT-D">NT-D</option><option value="SBC">SBC</option> <option value="OBC">OBC</option><option value="EWS">EWS</option>');
       }    
       else{
            $('.natDetails').hide();
       }
   });
   
   $(document).on('change', '#domicile', function() {
      document.getElementById('Category').value = "";
      $('.certificateDetails').show();
      var domicile = $(this).val();
   
       var nation = $('#Nationality').val();
       if (nation == "INDIAN" && domicile=="YES"){
          $('.CatDetail').css('display', 'flex'); 
          $("#Category").empty();
          $('#Category').append('<option value="" selected>[SELECT]</option><option value="UNRESERVED">UNRESERVED</option><option value="SC">SC</option><option value="ST">ST</option><option value="DT-VJ(A)">DT-VJ(A)</option><option value="NT-B">NT-B</option> <option value="NT-C">NT-C</option> <option value="NT-D">NT-D</option><option value="SBC">SBC</option> <option value="OBC">OBC</option><option value="EWS">EWS</option>');
       }
       else if(nation == "INDIAN" && domicile=="NO")
       {   
           $('.CatDetail').css('display', 'flex');
           $("#Category").empty();
           $('#Category').append('<option value="" selected>[SELECT]</option><option value="UNRESERVED">UNRESERVED</option>');
       }
       else
       {
        //    $('.CatDetail').hide(); 
       }
   });
   
   $(document).on('change', '#Category', function() {
       $('.sccertdetails').hide();
       $('.NCLApplied').hide();
       $('.ewscertavaildetails').hide();
       $('.Ncldetails').hide();
       $('.CasteValApplied').hide();
       $('.castavail').hide();
       $('.sccertavaildetails').hide();
       $('.CasteValAvail').hide();
       $('.NCLAvail').hide();
       $('.ewsdetails').hide(); 
      
       valueFlush(['ScCasteCert','CasteCertNumber','CasteCertAteappnNO',
       'CasteCertappDate','CasteValidity','CasteValNumber','CasteValAppNO',
       'CasteValAppDate','NCL','NCLCertNO','nclCertDate','NCLAppNO',
       'NCLAppDate','certStatus','EwsCertificateNO',
       'EwsApplicationNO','EwsApplicationDate']);
   
       var cat = $(this).val();
       var nation = $('#Nationality').val();
       var domicile = $('#domicile').val();
   
   
       if (cat == "UNRESERVED" && nation == "INDIAN" && (domicile == "YES"||domicile == "NO") ) {
           $('.certificateDetails').hide();
           $('.opendetails').css('display', 'flex');
           $('.scdetails').hide();
           $('.Ncldetails').hide();
           $('.sccertavaildetails').hide();
           $('.ewsdetails').hide();
           $('#AnnualIncome #income_800000').show();
           $('#orphanType').append('<option value="ORPHAN TYPE-A">ORPHAN TYPE-A</option>');
       } 
       else if (cat == "SC" || cat == "ST" && nation == "INDIAN" && domicile == "YES") {
           $('.certificateDetails').show();
           $('.scdetails').css('display', 'flex');
           $('.opendetails').hide();
           $('.ewsdetails').hide();
           $('.certdetails').hide();
           $('.ewscertavaildetails').hide();
           $('.Ncldetails').hide();
           $('#AnnualIncome #income_800000').show();
           $("#orphanType option[value='ORPHAN TYPE-A']").remove();
    
       }
       else if (cat == "DT-VJ(A)" || cat == "NT-B" || cat == "NT-C" || cat == "NT-D"  || cat == "SBC" || cat == "OBC"  && nation == "INDIAN" && domicile == "YES") {
           $('.certificateDetails').show();
           $('.scdetails').css('display', 'flex');
           $('.Ncldetails').css('display', 'flex');
           $('.opendetails').hide();
           $('.castavail').hide();
           $('.CasteValApplied').hide();
           $('.ewsdetails').hide();
           $('.certdetails').hide();
           $('.sccertavaildetails').hide();
           $('#AnnualIncome #income_800000').show();
           $("#orphanType option[value='ORPHAN TYPE-A']").remove();
       }
        else if (cat == "EWS" && nation == "INDIAN" && domicile == "YES") {
            $('.certificateDetails').show();
           $('.ewsdetails').css('display', 'flex');
           $('.scdetails').hide();
           $('.Ncldetails').hide();
           $('.opendetails').hide();
           $('.castavail').hide();
           $('.CasteValApplied').hide();
           $('.certdetails').hide();
           $('.sccertavaildetails').hide();
           $('#AnnualIncome #income_800000').hide();
           $("#orphanType option[value='ORPHAN TYPE-A']").remove();           

        }
       else {
           $('.opendetails').hide();
           $('.scdetails').hide();
       }
   });
   
   $(document).on('change', '#certStatus', function() {
       valueFlush(['EwsCertificateNO','EWSCertIssuingDistrict','EwsApplicationNO','EwsApplicationDate','EwsEwsAppDistrict','EwsIssuingTaluka']);
       var cer = $(this).val();
       if (cer == "APPLIED BUT NOT RECEIVED") {
           $('.certdetails').css('display', 'flex');
           $('.ewscertavaildetails').hide();
       } else if (cer == "AVAILABLE") {
           $('.ewscertavaildetails').css('display', 'flex');
           $('.certdetails').hide();
   
       } else {
           $('.certdetails').hide();
           $('.ewscertavaildetails').hide();
       }
   });
   $(document).on('change', '#CasteValidity', function() {
       valueFlush(['CasteValNumber','CasteValDist','CasteValAppNO','CasteValAppDate','CasteValAppDist','CasteValAppTal']);
       var cer = $(this).val();
       if (cer == "APPLIED BUT NOT RECEIVED") {
           $('.CasteValApplied').css('display', 'flex');
           $('.CasteValAvail').hide();
           $('.ewscertavaildetails').hide();
       } else if (cer == "AVAILABLE") {
           $('.CasteValAvail').css('display', 'flex');
           $('.CasteValApplied').hide();
   
       } else {
           $('.certdetails').hide();
           $('.CasteValApplied').hide();
           $('.CasteValAvail').hide();
           $('.ewsdetails').hide();
           $('.ewscertavaildetails').hide();
       }
   });
   
   $(document).on('change', '#NCL', function() {
       valueFlush(['NCLCertNO','NCLCertDist','nclCertDate','NCLAppNO','NCLAppDate','NCLCertIssDist','NCLCertIssuingTal']);   
       var cer = $(this).val();
       if (cer == "APPLIED BUT NOT RECEIVED") {
           $('.NCLApplied').css('display', 'flex');
           $('.NCLAvail').hide();
           $('.ewscertavaildetails').hide();
       } else if (cer == "AVAILABLE") {
           $('.NCLAvail').css('display', 'flex');
           $('.NCLApplied').hide();
   
       } else {
           $('.NCLApplied').hide();
           $('.CasteValApplied').hide();
           $('.NCLAvail').hide();
           $('.ewsdetails').hide();
           $('.ewscertavaildetails').hide();
       }
   });
   
   $(document).on('change', '#ScCasteCert', function() {
       valueFlush(['CasteCertNumber','CasteCertInssDist','CasteCertAteappnNO','CasteCertappDate','CasteValidity','CasteValNumber','CasteValDist','CasteValAppNO','CasteValAppDate','CasteValAppDist','CasteValAppTal']);
       $('CasteValNumber').val('');
       $('CasteValDist').val('');
       var sc = $(this).val();
       if (sc == "APPLIED BUT NOT RECEIVED") {
   
           $('.sccertdetails').css('display', 'flex');
           $('.castavail').hide();
           $('.CasteValApplied').hide();
           $('.CasteValAvail').hide();
           $('.sccertavaildetails').hide();
           $('.certdetails').hide();
           $('.opendetails').hide();
           $('.ewsdetails').hide();
           $('.ewscertavaildetails').hide();
       } else if (sc == "AVAILABLE") {
           $('.castavail').css('display', 'flex');
           $('.sccertavaildetails').css('display', 'flex');
           $('.sccertdetails').hide();
           $('.certdetails').hide();
           $('.opendetails').hide();
           $('.ewsdetails').hide();
           $('.ewscertavaildetails').hide();
   
       } else {
           $('.CasteValAvail').hide();
           $('.castavail').hide();
           $('.sccertdetails').hide();
           $('.sccertavaildetails').hide();
           $('.certdetails').hide();
           $('.opendetails').hide();
           $('.ewsdetails').hide();
           $('.ewscertavaildetails').hide();
       }
   });
   
   $(document).on('change', '#MiNOrityQuota', function() {
       document.getElementById('religion').value = "";
       var MinorityQuota = $(this).val();
      if (MinorityQuota == "YES") {
           $('.religionDetails').removeClass('hide');
           $('.religionDetails').css('display', 'flex');
       }
       else {
           $('.religionDetails').hide();
       }
   });
   //ph
   $(document).on('change', '#ph', function() {
      valueFlush(['per_disability','ph_type']);   
       var ph = $(this).val();
      if (ph == "YES") {
           $('.phNote').show();
           $('.phDetails').css('display', 'flex');
       }
       else {
           $('.phNote').hide();
           $('.phDetails').hide();
       }
   });
   $(document).on('change', '#orphan', function() {
      valueFlush(['orphan_type']);   
       var orphan = $(this).val();
      if (orphan == "YES") {
           $('#orphanNote').show();
           $('.orphanDetails').css('display', 'flex');
       }
       else {
           $('#orphanNote').hide();
           $('.orphanDetails').hide();
       }
   });
   //
    //exserviceman
   $(document).on('change', '#exServiceman', function() {
       valueFlush(['joinDate','retirementDate', 'PeriodOfService','periodYears','periodMonths','periodDays']); 
       var exServiceman = $(this).val();
      if (exServiceman == "YES") {
           $('.serviceDetails').css('display', 'flex');
       }
       else {
           $('.serviceDetails').hide();
       }
   });
   //Meritorious_Sports_Person
   $(document).on('change','#joinDate',function(){
        valueFlush(['retirementDate']);
   });
   $(document).on('change','#retirementDate',function(){
        var retirement_date = $(this).val();        
        var join_date = $('#joinDate').val();
   
        var admission = moment(join_date, 'YYYY-MM-DD').add('days','1'); 
        var discharge = moment(retirement_date, 'YYYY-MM-DD').add('days','1');
        
        // console.log(admission);
        // console.log(discharge);
        var years = discharge.diff(admission, 'year');
        admission.add(years, 'years');
        var months = discharge.diff(admission, 'months');
        admission.add(months, 'months');
        var days = discharge.diff(admission, 'days');
        if(isNaN(years)){years=0;}
        if(isNaN(months)){months=0;}
        if(isNaN(days)){days=0;}
        // console.log(days);
      $('#reservationform #periodYears').val(years);
      $('#reservationform #periodMonths').val(months);
      $('#reservationform #periodDays').val(days);
   
   });
   
   $(document).on('change', '#Meritorious_Sports_Person', function() 
   {
       valueFlush(['typeOfCompetition','positionMedal','LevelOfCompetition', 'CompetitionYear']); 
       var Meritorious_Sports_Person = $(this).val();
      if (Meritorious_Sports_Person == "YES") {
           $('.SportDetails').css('display', 'flex');
       }
       else {
           $('.SportDetails').hide();
       }
   });
   
   
    $(document).ready(function() {
        $('#reservationform').validate({
            rules: {            
                nation:"required",
                domicle_maharashtra:{
                    required: function () { return $('#Nationality').val()==='INDIAN';},
                },
                cate:"required",
                annual_family_income : {
                    required: function () { 
                          if($('#Nationality').val()==='INDIAN' && $('#Category').val()=== 'UNRESERVED'||'SC'||'ST'||'DT-VJ(A)'||'NT-B'||'NT-C'||'NT-D'||'SBC'||'OBC'||'EWS'){
                             return true;
                          };
                   },
                },   
                region_of_residence : {
                 required : function () {
                    if($('#Nationality').val()==='INDIAN' && $('#Category').val()=== 'UNRESERVED'||'SC'||'ST'||'DT-VJ(A)'||'NT-B'||'NT-C'||'NT-D'||'SBC'||'OBC'||'EWS'){
                       return true;
                    };
                 }
                },
                ews : {
                    required: function () { return $('#Category').val()==='EWS';},
                },
                ews_cert_status:{
                    required: function () { return $('#ewsSeat').val()==='YES';},
                },
                ews_cert_no:{
                    required: function () { return $('#certStatus').val()==='AVAILABLE';},
                },
                ews_cert_issue_dist:{
                    required: function () { return $('#certStatus').val()==='AVAILABLE';},
                },
                ews_cert_appli_no:{
                    required: function () { return $('#certStatus').val()==='APPLIED BUT NOT RECEIVED';},
                },
                ews_cert_appli_date:{
                    required: function () { return $('#certStatus').val()==='APPLIED BUT NOT RECEIVED';},
                },
                ews_cert_appli_issue_dist:{
                    required: function () { return $('#certStatus').val()==='APPLIED BUT NOT RECEIVED';},
                },
                ews_cert_appli_issue_taluka:{
                    required: function () { return $('#certStatus').val()==='APPLIED BUT NOT RECEIVED';},
                },
                caste_certificate:{
                    required: function () {
                        if ($('#Category').val()==='SC'||'ST'||'DT-VJ(A)'||'NT-B'|| 'NT-C' ||'NT-D'||'SBC'||'OBC'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_cert_no:{
                    required: function () {
                        if ($('#ScCasteCert').val()==='AVAILABLE'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_cert_issue_district:{
                    required: function () {
                        if ($('#ScCasteCert').val()==='AVAILABLE'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_validity:{
                    required: function () {
                        if ($('#ScCasteCert').val()==='AVAILABLE'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_validity_no:{
                    required: function () {
                        if ($('#CasteValidity').val()==='AVAILABLE'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_cert_appli_no:{
                    required: function () {
                        if ($('#ScCasteCert').val()==='APPLIED BUT NOT RECEIVED'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_cert_appli_date:{
                    required: function () {
                        if ($('#ScCasteCert').val()==='APPLIED BUT NOT RECEIVED'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_cert_appli_issue_dist:{
                    required: function () {
                        if ($('#ScCasteCert').val()==='APPLIED BUT NOT RECEIVED'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_cert_appli_issue_taluka:{
                    required: function () {
                        if ($('#ScCasteCert').val()==='APPLIED BUT NOT RECEIVED'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_validity_issue_district:{
                                required: function () {
                                    if ($('#CasteValidity').val()==='AVAILABLE'){
                                        return true;
                                    }else{
                                        return false;
                                    }
                  },
                },
                caste_validity_appli_no:{
                    required: function () {
                        if ($('#CasteValidity').val()==='APPLIED BUT NOT RECEIVED'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_validity_appli_date:{
                    required: function () {
                        if ($('#CasteValidity').val()==='APPLIED BUT NOT RECEIVED'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                caste_validity_appli_issue_dist:{
                                required: function () {
                                    if ($('#CasteValidity').val()==='APPLIED BUT NOT RECEIVED'){
                                        return true;
                                    }else{
                                        return false;
                                    }
                  },
                },
                caste_validity_appli_issue_taluka:{
                                required: function () {
                                    if ($('#CasteValidity').val()==='APPLIED BUT NOT RECEIVED'){
                                        return true;
                                    }else{
                                        return false;
                                    }
                  },
                },
                ncl_cert:{
                    required: function () {
                        if ($('#Category').val()==='DT-VJ(A)'||'NT-B'||'NT-C'||'NT-D'||'SBC'||'OBC'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                ncl_cert_no :{
                    required: function () {
                        if ($('#NCL').val()==='AVAILABLE'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                ncl_cert_issue_dist:{
                    required: function () {
                        if ($('#NCL').val()==='AVAILABLE'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                ncl_cert_date:{
                    required: function () {
                        if ($('#NCL').val()==='AVAILABLE'){
                            return true;
                        }else{
                            return false;
                        }
                    }
                },
                ncl_cert_appli_no:{
                    required: function () {
                        if ($('#NCL').val()==='APPLIED BUT NOT RECEIVED'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                ncl_cert_appli_date:{
                    required: function () {
                        if ($('#NCL').val()==='APPLIED BUT NOT RECEIVED'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                ncl_cert_appli_issue_dist:{
                    required: function () {
                        if ($('#NCL').val()==='APPLIED BUT NOT RECEIVED'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                ncl_cert_appli_issue_taluka:{
                    required: function () {
                        if ($('#NCL').val()==='APPLIED BUT NOT RECEIVED'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
            //    ph or miNOrity or orphan
                ph:"required",
                per_disability : {
                    required: function () {
                        if ($('#ph').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },                
                },    
                ph_type : {
                    required: function () {
                        if ($('#ph').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
   
                
                ex_serviceman: "required",
                forces_division : {
                    required: function () {
                        if ($('#exServiceman').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                }, 
                join_date : {
                    required: function () {
                        if ($('#exServiceman').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },   
                  retirement_date : {
                    required: function () {
                        if ($('#exServiceman').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                }, 
                service_period : {
                    required: function () {
                        if ($('#exServiceman').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
   
                sports_person: "required",
                type_competition : {
                    required: function () {
                        if ($('#Meritorious_Sports_Person').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                level_competition : {
                    required: function () {
                        if ($('#Meritorious_Sports_Person').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                position_medal : {
                    required: function () {
                        if ($('#Meritorious_Sports_Person').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                competition_year : {
                    required: function () {
                        if ($('#Meritorious_Sports_Person').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                
                orphan:"required",
                orphan_type : {
                    required: function () {
                        if ($('#orphan').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
                minority:"required",
                minority_quota:{
                    required: function () {
                        if ($('#MiNOrityQuota').val()==='YES'){
                            return true;
                        }else{
                            return false;
                        }
                    },
                },
            },
            messages: {
                nation : {
                    required: 'Please select nationality of the candidate'
                },
                cate : {
                    required: 'Please select the category of the candidate'
                },
                domicle_maharashtra : {
                    required: 'Please select the domicile of maharashtra'
                },
   
                //category of the candidate
                annual_family_income : {
                      required : "Please select the annual family income"
                },
   
                region_of_residence: {
                      required : "Please select the region of residence"
                },
   
                //message for ews start
                ews : {
                    required:"Please select EWS"
                },
                ews_cert_status : {
                    required:" Please Select EWS Certificate Status"
                },
                ews_cert_no : {
                    required:"Please Select EWS Certificate NO"
                },
                ews_cert_issue_dist : {
                    required:"Please Select EWS Certificate Issuing District"
                },
                ews_cert_appli_no : {
                    required:"Please Select EWS Certificate Application NO"
                },
                ews_cert_appli_date : {
                    required:"Please Select EWS Certificate Application Date"
                },
                ews_cert_appli_issue_dist : {
                    required:"Please Select EWS Certificate Application District"
                },
                ews_cert_appli_issue_taluka : {
                    required:"Please Select EWS Certificate Application Taluka"
                },
                //message for ews stop
   
            //    meassage for caste certificar
                caste_certificate:{
                    required: "Please select Caste Certificate"
                },
                caste_cert_no:{
                    required: "Please provide Caste Certificate Number"
                },
                caste_cert_issue_district:{
                    required: "Please provide Caste Certificate Inssuing District"
                },
   
            //   caste validity
                caste_validity : {
                    required: "Please select Caste Validity"
                },
                caste_validity_NO : {
                    required: "Please select Validity NO"
                },
                caste_validity_issue_district : {
                    required: "Please select Validity Inssuing District"
                },
   
            //    application validity start
                caste_validity_appli_no: {
                    required: "Please enter Caste Validity Application NO"
                },
   
                caste_validity_appli_date: {
                    required: "Please select Caste Validity Application Date"
                },
                caste_validity_appli_issue_dist: {
                    required: "Please select Caste Validity Application District"
                },
                caste_validity_appli_issue_taluka: {
                    required: "Please select Caste Validity Application Taluka"
                },
                //    application validity stop
            //    caste certificate  apply applied but NOt recieved
                caste_cert_appli_no: {
                    required: "Please provide Caste Certificate Application NO"
                },
                caste_cert_appli_date: {
                    required: "Please select Caste Certificate Application Date"
                },
                caste_cert_appli_issue_dist: {
                    required: "Please select Caste Certificate Application District"
                },
                caste_cert_appli_issue_taluka: {
                    required: "Please select Caste Certificate Application Taluka"
                },
            //    stop
            //    ncl certificate AVAILABLE
                ncl_cert: {
                    required: "Please select NCL "
                },
                ncl_cert_no: {
                    required: "Please select NCL Certificate Number"
                },
                ncl_cert_issue_dist:{
                    required: "Please select NCL Certificate Inssuing District"
                },
                ncl_cert_date:{
                    required: "Please select NCL Certificate Date"
                },
            //    ncl certificate applied but NOt AVAILABLE
                ncl_cert_appli_no:{
                    required: "Please select NCL Certificate Application NO"
                },
                ncl_cert_appli_date:{
                    required: "Please select NCL Certificate Application Date"
                },
                ncl_cert_appli_issue_dist:{
                    required: "Please select NCL Certificate Application District"
                },
                ncl_cert_appli_issue_taluka:{
                    required: "Please select NCL Certificate Application Taluka"
                },
   
            //    ph or orphaNOr miNOrity
                ph:{
                    required: "Are you a Person With Disability (PWD) ?"
                },
                per_disability:{
                  required:"Please Enter Percentage of Disability."
                },
                ph_type:{
                  required:"Please select disability type"
                },
                orphan:{
                    required: "Are you want to Claim Orphan Reservation Quota"
                },
                  minority:{
                      required: 'Are you want to claim Minority Quota ?',
                  },
                minority_quota:{
                    required: 'Please Select Religion(For Minority Quota).',
                },
   
            },
   
            submitHandler: function (form) {
                $.ajax({
                    url: "{{ route('reservation.update', [$reservationData->id])}}",
                    data: $(form).serialize(),
                    type: 'PUT',
                beforeSend: function() {
                         
   
                   },
                    success : function(data){
                     if (data.ValidatorErrors) {
                          $.each(data.ValidatorErrors, function(index, jsoNObject) {
                            $.each(jsoNObject, function(key, val) {
                                toastr.error(val);
                            });
                            return false;
                          });
                        }
                        if (data.status) {
                          if(data.status==='error') toastr.error(data.data);
                          else if(data.status==='success'){
                             toastr.success(data.data);                            
                            window.location.replace("{{route('qualification.index')}}");
                           }
                        }
                   },
                   error:function (response) {
                       let data = response.responseJSON;
                       toastr.error(data);
                   }
                });
            }
        });
    });
</script>
@include('include.user.UserCustomJs')
@endsection