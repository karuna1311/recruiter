<?php

namespace App\Services;

use App\Models\AppliedJobByUser;
use App\Models\UserReservation;
use App\Models\DocumentMaster;
use App\Models\DocumentUpload;
use App\Models\UserExperience;
use App\Models\UserQualification;
use Storage;

class DocumentUploadService 
{
	public static function getEligibleDocuments(){
		$candidateRes=UserReservation::first()->toArray();
		$candidateQual=UserQualification::where('user_id',$candidateRes['user_id'])->get()->toArray();
		$candidateExp=UserExperience::where('user_id',$candidateRes['user_id'])->get()->toArray();
		
		$applied_user = AppliedJobByUser::select('application_no')->first();


		$documentData=DocumentMaster::where('is_active','1')->get();
		$uploadedData=DocumentUpload::where([['user_id',$candidateRes['user_id']],['is_active','1']])->pluck('document_type','document_id')->all();
		
		foreach($documentData as $key => $document)
		{
			if (array_key_exists($document->id, $uploadedData) && Storage::disk('uploads')->exists('Documents/'.$applied_user->application_no.'/'.$applied_user->application_no.'_'.$document->document_code.'.pdf')) {
				$documentData[$key]->documentUploaded=base64_encode(Storage::disk('uploads')->get('Documents/'.$applied_user->application_no.'/'.$applied_user->application_no.'_'.$document->document_code.'.pdf'));
				$documentData[$key]->documentType=$uploadedData[$document->id];
			}
			if($document->document_config=='1') continue;
			$docConfig=json_decode($document->document_config);

			if($document->table_type=='R')
			{
				if($candidateRes[$docConfig->fieldName]!=$docConfig->value) unset($documentData[$key]);
			}elseif($document->table_type=='Q')
			{
				foreach($candidateQual as $qualification)
				{
					$paramsArr[]=$qualification[$docConfig->fieldName];
				}
				if(!in_array($docConfig->value,$paramsArr)) unset($documentData[$key]);
			}elseif($document->table_type=='E'){
				foreach($candidateExp as $experience)
				{
					$paramsArr[]=$experience[$docConfig->fieldName];
				}
				if(!in_array($docConfig->value,$paramsArr)) unset($documentData[$key]);
			}
		}
		return $documentData;
	}

	public static function uploadDocument($file,$documentCode,$documentId,$documentType)
	{
		
		$candidateData=UserReservation::select('user_id')->first();
		$applied_user = AppliedJobByUser::select('application_no')->first();
    	Storage::disk('uploads')->put('Documents/'.$applied_user->application_no.'/'.$applied_user->application_no.'_'.$documentCode.'.pdf',file_get_contents($file));
    	DocumentUpload::updateOrCreate(['user_id'=>$candidateData->user_id,'document_id'=>$documentId,'is_active'=>'1'],['document_code'=>$documentCode,'document_type'=>$documentType]);
    	if(Storage::disk('uploads')->exists('Documents/'.$applied_user->application_no.'/'.$applied_user->application_no.'_'.$documentCode.'.pdf'))
    	$docfile=base64_encode(Storage::disk('uploads')->get('Documents/'.$applied_user->application_no.'/'.$applied_user->application_no.'_'.$documentCode.'.pdf'));
    	else $docfile='0';
    	return ['documentFile'=>$docfile];
	}

	public static function getDocumentList()
	{
		$applied_user = AppliedJobByUser::select('application_no')->first();
		$candidateData=UserReservation::select('user_id')->first();
		$documentData=DocumentMaster::where('is_active','1')->select('id','document_code','document_name','document_config')->get();
		$uploadedData=DocumentUpload::where([['user_id',$candidateData['user_id']],['is_active','1']])->pluck('document_type','document_id')->all();
		foreach($documentData as $key => $document)
		{
			if (array_key_exists($document->id, $uploadedData) && Storage::disk('uploads')->exists('Documents/'.$applied_user->application_no.'/'.$applied_user->application_no.'_'.$document->document_code.'.pdf')) {
				$documentData[$key]->documentUploaded='uploaded';
			}else{
				$documentData[$key]->documentUploaded='Not uploaded';
			}
			if($document->document_config=='1') continue;
				$docConfig=json_decode($document->document_config);
			if($candidateData[$docConfig->fieldName]!=$docConfig->value) unset($documentData[$key]);
		}
		return $documentData;
	}
}
