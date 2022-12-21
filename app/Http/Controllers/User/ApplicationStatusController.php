<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Services\ApplicationStatusService;
class ApplicationStatusController extends Controller
{
	public function index(){
		$appStatusArray=ApplicationStatusService::getApplicationStatus();
		$incompleteStatusArray=ApplicationStatusService::getIncompleteApplicationStatus();
		
		return view('user.ApplicationStatus.index',compact('appStatusArray','incompleteStatusArray'));
	}
}
