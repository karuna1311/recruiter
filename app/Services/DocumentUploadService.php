<?php

namespace App\Services;
use App\Models\UserReservation;
use App\Models\DocumentMaster;
use App\Models\DocumentUpload;
use Storage;

class DocumentUploadService 
{
	public static function getEligibleDocuments(){
		$candidateData=UserReservation::first()->toArray();
		$documentData=DocumentMaster::where('is_active','1')->get();
		$uploadedData=DocumentUpload::where([['user_id',$candidateData['user_id']],['session_master_id',$candidateData['session_master_id']],['is_active','1']])->pluck('document_type','document_id')->all();
		
		foreach($documentData as $key => $document){
			if (array_key_exists($document->id, $uploadedData) && Storage::disk('uploads')->exists('Documents/'.$candidateData['user_id'].'/'.$document->document_code.'.pdf')) {
				$documentData[$key]->documentUploaded=base64_encode(Storage::disk('uploads')->get('Documents/'.$candidateData['user_id'].'/'.$document->document_code.'.pdf'));
				$documentData[$key]->documentType=$uploadedData[$document->id];
			}
			if($document->document_config=='1') continue;
			$docConfig=json_decode($document->document_config);
			if($candidateData[$docConfig->fieldName]!=$docConfig->value) unset($documentData[$key]);
		}
		return $documentData;
	}

	public static function uploadDocument($file,$documentCode,$documentId,$documentType)
	{
		$candidateData=UserReservation::select('user_id','session_master_id')->first();
    	Storage::disk('uploads')->put('Documents/'.$candidateData->user_id.'/'.$documentCode.'.pdf',file_get_contents($file));
    	DocumentUpload::updateOrCreate(['user_id'=>$candidateData->user_id,'session_master_id'=>$candidateData->session_master_id,'document_id'=>$documentId,'is_active'=>'1'],['document_code'=>$documentCode,'document_type'=>$documentType]);
    	if(Storage::disk('uploads')->exists('Documents/'.$candidateData->user_id.'/'.$documentCode.'.pdf'))
    	$docfile=base64_encode(Storage::disk('uploads')->get('Documents/'.$candidateData->user_id.'/'.$documentCode.'.pdf'));
    	else $docfile='0';
    	return ['documentFile'=>$docfile];
	}

	public static function getDocumentList($masterData){
		$candidateData=$masterData->toArray();
		$documentData=DocumentMaster::where('is_active','1')->select('id','document_code','document_name','document_config')->get();
		$uploadedData=DocumentUpload::where([['user_id',$candidateData['user_id']],['session_master_id',$candidateData['session_master_id']],['is_active','1']])->pluck('document_type','document_id')->all();
		foreach($documentData as $key => $document){
			if (array_key_exists($document->id, $uploadedData) && Storage::disk('uploads')->exists('Documents/'.$candidateData['user_id'].'/'.$document->document_code.'.pdf')) {
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
