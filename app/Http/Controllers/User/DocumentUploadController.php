<?php

namespace App\Http\Controllers\User;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Http\Controllers\Controller;
use App\Services\DocumentUploadService;
use Illuminate\Http\Request;
use App\Http\Requests\User\DocumentUploadRequest;
use App\Models\DocumentMaster;
use Response;
use Exception;
use Gate;

class DocumentUploadController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('document_upload'), HttpResponse::HTTP_FORBIDDEN, '403 Forbidden');
    	$documentData=DocumentUploadService::getEligibleDocuments();
        return view('user.DocumentUpload.index',compact('documentData'));
    }
    public function upload(DocumentUploadRequest $request,DocumentMaster $document){        
    	try {
			$documentData=DocumentUploadService::uploadDocument($request->documentFile,$document->document_code,$document->id,$request->documentType);
			$documentData['documentId']=$document->id;
    	} catch (Exception $e) {
    		return Response::json(['status'=>'error','data'=>$e->getMessage()]);
    	}
    	return Response::json(['status'=>'success','data'=>$documentData]);
    }
}
