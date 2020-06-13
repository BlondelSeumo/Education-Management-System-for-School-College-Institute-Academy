<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmEmailSmsLog extends Model
{
    public  static function saveEmailSmsLogData($request){

    	$selectTabb = '';
        if(empty($request->selectTab)){
            $selectTabb = 'G';
        }
        else{
            $selectTabb = $request->selectTab;
        }

        $emailSmsData = new SmEmailSmsLog();
        $emailSmsData->title = $request->email_sms_title;
        $emailSmsData->description = $request->description;
        $emailSmsData->send_through = $request->send_through;
        $emailSmsData->send_date = date('Y-m-d');
        $emailSmsData->send_to = $selectTabb;
        $success = $emailSmsData->save();
    }
}
