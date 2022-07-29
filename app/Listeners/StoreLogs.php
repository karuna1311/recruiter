<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\LoggingEvent;
use Illuminate\Support\Facades\Log;
use Storage;
use Carbon\Carbon;
use RequestIp;
class StoreLogs
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LoggingEvent $event)
    {
        $logData = $event->logData;
        $jsonString=$logData['logType'].'|'.Carbon::now().'|'.json_encode($logData['logData']).'|'.RequestIp::ip();
        $logFile=Storage::disk('uploads')->append('/logs/'.$logData['userId'].'.txt',$jsonString);  
    }
}
