<?php

namespace App\Http\Controllers\Instructions;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Storage;
use Response;

class InstructionsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public  function downloadFile($filename)
    {
        try
        {
          abort_if(!Storage::disk('uploads')->exists('Instructions/files/'.$filename), HttpResponse::HTTP_NOT_FOUND, '404 NOT FOUND');
          $response = Response::make(Storage::disk('uploads')->get('Instructions/files/'.$filename), 200);
          $response->header("Content-Type", 'application/pdf');
          return $response;

        }catch(\Exception $e){
          return Response::json(['status'=>'error','data'=>$e->getMessage()]);
        }

    }
}
