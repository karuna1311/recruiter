<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenantModelTrait;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class UserReservation extends Model
{
    use HasFactory,SoftDeletes,MultiTenantModelTrait, Auditable;
    public $table = 'user_reservation';

    protected $fillable = ['user_id','session_master_id','cname_change','cname_change_value','fname','mname','gender','age','alternate_mobile','adhar_card_no','permanent_address_1','permanent_address_2','permanent_address_3','permanent_city','permanent_state','permanent_district','permanent_taluka','permanent_pin_code','address_not_same','present_address_1','present_address_2','present_address_3','present_city','present_state','present_district','present_taluka','present_pin_code',
    'nation','domicle_maharashtra','region_of_residence','cate','caste_certificate','caste_cert_no','caste_cert_issue_district','caste_cert_appli_no','caste_cert_appli_date','caste_cert_appli_issue_dist','caste_cert_appli_issue_taluka','caste_validity','caste_validity_no','caste_validity_issue_district','caste_validity_appli_no','caste_validity_appli_date','caste_validity_appli_issue_dist','caste_validity_appli_issue_taluka','ncl_cert','ncl_cert_no','ncl_cert_issue_dist','ncl_cert_date','ncl_cert_appli_no','ncl_cert_appli_date','ncl_cert_appli_issue_dist','ncl_cert_appli_issue_taluka','annual_family_income','ews','ews_cert_status','ews_cert_no','ews_cert_issue_dist','ews_cert_appli_no','ews_cert_appli_date','ews_cert_appli_issue_dist','ews_cert_appli_issue_taluka',
    'ph','ph_type',
    'per_disability',
    'orphan','orphan_type',
   'ex_serviceman',
   'forces_division',
   'join_date',
   'retirement_date',
   'service_months',
   'service_days',
   'service_years',
   'sports_person',
   'type_competition',
   'level_competition',
   'position_medal',
   'competition_year',
   'bankemp', 'marathispeaking',
    'declaration_status','status_lock'];


    public function qualification(){
      return $this->hasMany('App\Models\UserQualification','user_id','user_id');
      // ->select('*')->get();
         // ->join('subject', 'subject.subject_id', '=', 'user_qualification.subject')
         // ->select('user_qualification.qualificationtype', 'user_qualification.qualificationname','subject.subject_name')
         // ->where('user_qualification.user_id','1')
         // ->get();
      //   ->orderBy('date', 'asc')
    }

  

    public function experience(){
      return $this->hasMany('App\Models\UserExperience','user_id','user_id');
      // ->select('*')->get();
         // ->join('subject', 'subject.subject_id', '=', 'user_qualification.subject')
         // ->select('user_qualification.qualificationtype', 'user_qualification.qualificationname','subject.subject_name')
         // ->get();
      //   ->orderBy('date', 'asc')
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function setCnameChangeAttribute($value)
    {
        $this->attributes['cname_change'] = $value ? strtoupper($value) : null;
    }
    public function setCnameChangeValueAttribute($value)
    {
        $this->attributes['cname_change_value'] = $value ? strtoupper($value) : null;
    }
    public function setFnameAttribute($value)
    {
        $this->attributes['fname'] = $value ? strtoupper($value) : null;
    }
    public function setMnameAttribute($value)
    {
        $this->attributes['mname'] = $value ? strtoupper($value) : null;
    }
    public function setGenderAttribute($value)
    {
        $this->attributes['gender'] = $value ? strtoupper($value) : null;
    }
    public function setPermanentAddress1Attribute($value)
    {
        $this->attributes['permanent_address_1'] = $value ? strtoupper($value) : null;
    }
    public function setPermanentAddress2Attribute($value)
    {
        $this->attributes['permanent_address_2'] = $value ? strtoupper($value) : null;
    }
    public function setPermanentAddress3Attribute($value)
    {
        $this->attributes['permanent_address_3'] = $value ? strtoupper($value) : null;
    }
    public function setPermanentCityAttribute($value)
    {
        $this->attributes['permanent_city'] = $value ? strtoupper($value) : null;
    }
    public function setPermanentStateAttribute($value)
    {
        $this->attributes['permanent_state'] = $value ? strtoupper($value) : null;
    }
    public function setPermanentTalukaAttribute($value)
    {
        $this->attributes['permanent_taluka'] = $value ? strtoupper($value) : null;
    }
    public function setPermanentPinCodeAttribute($value)
    {
        $this->attributes['permanent_pin_code'] = $value ? strtoupper($value) : null;
    }
    public function setAddressNotSameAttribute($value)
    {
        $this->attributes['address_not_same'] = $value ? $value : '0';
    }
    public function setPresentAddress1Attribute($value)
	{
	   $this->attributes['present_address_1'] = $value ? strtoupper($value) : null;
	}
	public function setPresentAddress2Attribute($value)
	{
	   $this->attributes['present_address_2'] = $value ? strtoupper($value) : null;
	}
	public function setPresentAddress3Attribute($value)
	{
	   $this->attributes['present_address_3'] = $value ? strtoupper($value) : null;
	}
	public function setPresentCityAttribute($value)
	{
	   $this->attributes['present_city'] = $value ? strtoupper($value) : null;
	}
	public function setPresentStateAttribute($value)
	{
	   $this->attributes['present_state'] = $value ? strtoupper($value) : null;
	}
	public function setPresentDistrictAttribute($value)
	{
	   $this->attributes['present_district'] = $value ? strtoupper($value) : null;
	}
	public function setPresentTalukaAttribute($value)
	{
	   $this->attributes['present_taluka'] = $value ? strtoupper($value) : null;
	}
	public function setPresentPinCodeAttribute($value)
	{
	   $this->attributes['present_pin_code'] = $value ? strtoupper($value) : null;
	}
    public function setNriqAttribute($value)
    {
       $this->attributes['nriq'] = $value ? strtoupper($value) : null;
    }
    public function setNrimAttribute($value)
    {
       $this->attributes['nrim'] = $value ? strtoupper($value) : null;
    }
    public function setNriwAttribute($value)
    {
       $this->attributes['nriw'] = $value ? strtoupper($value) : null;
    }
    public function setDomicleMaharashtraAttribute($value)
    {
       $this->attributes['domicle_maharashtra'] = $value ? strtoupper($value) : null;
    }
    public function setCateAttribute($value)
    {
       $this->attributes['cate'] = $value ? strtoupper($value) : null;
    }
    public function setAnnualFamilyIncomeAttribute($value)
    {
       $this->attributes['annual_family_income'] = $value ? strtoupper($value) : null;
    }
    public function setRegionOfResidenceAttribute($value)
    {
       $this->attributes['region_of_residence'] = $value ? strtoupper($value) : null;
    }
    public function setEwsAttribute($value)
    {
       $this->attributes['ews'] = $value ? strtoupper($value) : null;
    }
    public function setEwsCertStatusAttribute($value)
    {
       $this->attributes['ews_cert_status'] = $value ? strtoupper($value) : null;
    }
    public function setEwsCertNoAttribute($value)
    {
       $this->attributes['ews_cert_no'] = $value ? strtoupper($value) : null;
    }
    public function setEwsCertIssueDistAttribute($value)
    {
       $this->attributes['ews_cert_issue_dist'] = $value ? strtoupper($value) : null;
    }
    public function setEwsCertAppliNoDistAttribute($value)
    {
       $this->attributes['ews_cert_appli_no'] = $value ? strtoupper($value) : null;
    }
    public function setEwsCertAppliDateDistAttribute($value)
    {
       $this->attributes['ews_cert_appli_date'] = $value ? date('d-m-Y',strtotime($value)): null;
    }
    public function setEwsCertAppliIssueDistAttribute($value)
    {
       $this->attributes['ews_cert_appli_issue_dist'] = $value ? strtoupper($value) : null;
    }
    public function setEwsCertAppliIssueTalukaAttribute($value)
    {
       $this->attributes['ews_cert_appli_issue_taluka'] = $value ? strtoupper($value) : null;
    }
    public function setCasteCertificateAttribute($value)
    {
       $this->attributes['caste_certificate'] = $value ? strtoupper($value) : null;
    }
    public function setCasteCertNoAttribute($value)
    {
       $this->attributes['caste_cert_no'] = $value ? strtoupper($value) : null;
    }
    public function setCasteCertIssueDistrictAttribute($value)
    {
       $this->attributes['caste_cert_issue_district'] = $value ? strtoupper($value) : null;
    }
    public function setCasteCertAppliNoAttribute($value)
    {
       $this->attributes['caste_cert_appli_no'] = $value ? strtoupper($value) : null;
    }
    public function setCasteCertAppliDateAttribute($value)
    {
       $this->attributes['caste_cert_appli_date'] = $value ? date('d-m-Y',strtotime($value)) : null;
    }
    public function setCasteCertAppliIssueDistAttribute($value)
    {
       $this->attributes['caste_cert_appli_issue_dist'] = $value ? strtoupper($value) : null;
    }
    public function setCasteCertAppliIssueTalukaAttribute($value)
    {
       $this->attributes['caste_cert_appli_issue_taluka'] = $value ? strtoupper($value) : null;
    }
    public function setCasteValidityAttribute($value)
    {
       $this->attributes['caste_validity'] = $value ? strtoupper($value) : null;
    }
    public function setCasteValidityNoAttribute($value)
    {
       $this->attributes['caste_validity_no'] = $value ? strtoupper($value) : null;
    }
    public function setCasteValidityIssueDistrictAttribute($value)
    {
       $this->attributes['caste_validity_issue_district'] = $value ? strtoupper($value) : null;
    }
    public function setCasteValidityAppliNoAttribute($value)
    {
       $this->attributes['caste_validity_appli_no'] = $value ? strtoupper($value) : null;
    }
    public function setCasteValidityAppliDateAttribute($value)
    {
       $this->attributes['caste_validity_appli_date'] = $value ? date('d-m-Y',strtotime($value)) : null;
    }
    public function setCasteValidityAppliIssueDistAttribute($value)
    {
       $this->attributes['caste_validity_appli_issue_dist'] = $value ? strtoupper($value) : null;
    }
    public function setCasteValidityAppliIssueTalukaAttribute($value)
    {
       $this->attributes['caste_validity_appli_issue_taluka'] = $value ? strtoupper($value) : null;
    }
    public function setNclCertAttribute($value)
    {
       $this->attributes['ncl_cert'] = $value ? strtoupper($value) : null;
    }
    public function setNclCertNoAttribute($value)
    {
       $this->attributes['ncl_cert_no'] = $value ? strtoupper($value) : null;
    }
    public function setNclCertIssueDistAttribute($value)
    {
       $this->attributes['ncl_cert_issue_dist'] = $value ? strtoupper($value) : null;
    }
    public function setNclCertDateAttribute($value)
    {
       $this->attributes['ncl_cert_date'] = $value ? date('d-m-Y',strtotime($value)) : null;
    }
    public function setNclCertAppliNoAttribute($value)
    {
       $this->attributes['ncl_cert_appli_no'] = $value ? strtoupper($value) : null;
    }
    public function setNclCertAppliDateAttribute($value)
    {
       $this->attributes['ncl_cert_appli_date'] = $value ? date('d-m-Y',strtotime($value)) : null;
    }
    public function setNclCertAppliIssueDistAttribute($value)
    {
       $this->attributes['ncl_cert_appli_issue_dist'] = $value ? strtoupper($value) : null;
    }
    public function setNclCertAppliIssueTalukaAttribute($value)
    {
       $this->attributes['ncl_cert_appli_issue_taluka'] = $value ? strtoupper($value) : null;
    }
    public function setPhAttribute($value)
    {
       $this->attributes['ph'] = $value ? strtoupper($value) : null;
    }
    public function setOrphanAttribute($value)
    {
       $this->attributes['orphan'] = $value ? strtoupper($value) : null;
    }
   //  public function setMinorityAttribute($value)
   //  {
   //     $this->attributes['minority'] = $value ? strtoupper($value) : null;
   //  }
   //  public function setMinorityQuotaAttribute($value)
   //  {
   //     $this->attributes['minority_quota'] = $value ? strtoupper($value) : null;
   //  }
    public function setInserviceQuotaAttribute($value)
    {
       $this->attributes['inservice_quota'] = $value ? strtoupper($value) : null;
    }
    public function setInserviceEstablishmentAttribute($value)
    {
       $this->attributes['inservice_establishment'] = $value ? strtoupper($value) : null;
    }
    public function setInserviceJoinDateAttribute($value)
    {
       $this->attributes['inservice_join_date'] = $value ? date('d-m-Y',strtotime($value)) : null;
    }
    public function setInservicePostingAddrAttribute($value)
    {
       $this->attributes['inservice_posting_addr'] = $value ? strtoupper($value) : null;
    }
    public function setInserviceEstablishNocAttribute($value)
    {
       $this->attributes['inservice_establish_noc'] = $value ? strtoupper($value) : null;
    }
    public function setInserviceEstablishNocDateAttribute($value)
    {
       $this->attributes['inservice_establish_noc_date'] = $value ? date('d-m-Y',strtotime($value)) : null;
    }
    public function setInserviceDeptEnquiryAttribute($value)
    {
       $this->attributes['inservice_dept_enquiry'] = $value ? strtoupper($value) : null;
    }
    public function setInserviceDeptEnquiryDetailsAttribute($value)
    {
       $this->attributes['inservice_dept_enquiry_details'] = $value ? strtoupper($value) : null;
    }
    public function setMbbsPassingDateAttribute($value)
    {
       $this->attributes['mbbs_passing_date'] = $value ? date('d-m-Y',strtotime($value)) : null;
    }
    public function setMbbsAggPerAttribute($value)
    {
       $this->attributes['mbbs_agg_per'] = $value ? strtoupper($value) : null;
    }
    public function setMbbsInternshipDateAttribute($value)
    {
       $this->attributes['mbbs_internship_date'] = $value ? date('d-m-Y',strtotime($value)) : null;
    }
    public function setMciRegDiplomaAttribute($value)
    {
       $this->attributes['mci_reg_diploma'] = $value ? strtoupper($value) : null;
    }
    public function setDiplomaSubjectAttribute($value)
    {
       $this->attributes['diploma_subject'] = $value ? $value : null;
    }
    public function setMciRegDegreeAttribute($value)
    {
       $this->attributes['mci_reg_degree'] = $value ? strtoupper($value) : null;
    }
    public function setDegreeSubjectAttribute($value)
    {
       $this->attributes['degree_subject'] = $value ? strtoupper($value) : null;
    }
    public function setMbbsDcInMhOrAiimsAttribute($value)
    {
       $this->attributes['mbbs_dc_in_mh_or_aiims'] = $value ? strtoupper($value) : null;
    }
    public function setMbbsCollegeTypeAttribute($value)
    {
       $this->attributes['mbbs_college_type'] = $value ? strtoupper($value) : null;
    }
    public function setMbbsCollegeNameAttribute($value)
    {
       $this->attributes['mbbs_college_name'] = $value ? strtoupper($value) : null;
    }
    public function setMbbsCollegeOutoffIndMahAttribute($value)
    {
       $this->attributes['mbbs_college_outoff_ind_mah'] = $value ? strtoupper($value) : null;
    }
    public function setMbbsCollegeIndMahAttribute($value)
    {
       $this->attributes['mbbs_college_ind_mah'] = $value ? strtoupper($value) : null;
    }
    public function setMbbsUniversityIndMahAttribute($value)
    {
       $this->attributes['mbbs_university_ind_mah'] = $value ? strtoupper($value) : null;
    }
    public function setAieeAttribute($value)
    {
       $this->attributes['aiee'] = $value ? strtoupper($value) : null;
    }
    public function setBondServiceAttribute($value)
    {
       $this->attributes['bond_service'] = $value ? strtoupper($value) : null;
    }
    public function setBondServiceUndertakingAttribute($value)
    {
       $this->attributes['bond_service_undertaking'] = $value ? strtoupper($value) : null;
    }
    public function setNeetPgAttemptYearAttribute($value)
    {
       $this->attributes['neet_pg_attempt_year'] = $value ? implode(',',$value) : null;
    }
    public function setMedicalCouncilRegAttribute($value)
    {
       $this->attributes['medical_council_reg'] = $value ? strtoupper($value) : null;
    }
    public function setMedicalCouncilRegNoAttribute($value)
    {
       $this->attributes['medical_council_reg_no'] = $value ? strtoupper($value) : null;
    }
    public function setMedicalDciRegAttribute($value)
    {
       $this->attributes['medical_dci_reg'] = $value ? strtoupper($value) : null;
    }
    public function setMedicalDciRegNoAttribute($value)
    {
       $this->attributes['medical_dci_reg_no'] = $value ? strtoupper($value) : null;
    }
    public function setSecurityDepositeSeatTypeAttribute($value)
    {
       $this->attributes['security_deposite_seat_type'] = $value ? strtoupper($value) : null;
    }
    public function setSecurityDepositeAmountAttribute($value)
    {
       $this->attributes['security_deposite_amount'] = $value ? strtoupper($value) : null;
    }

}
