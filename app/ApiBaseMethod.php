<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SmGeneralSettings;

class ApiBaseMethod extends Model
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public static function sendResponse($result, $message)
    {

        $settings = SmGeneralSettings::find(1);
        $api_status = $settings->api_url;
        $response = [];
        if ($api_status != 0) {
            $response = [
                'success' => true,
                'data'    => $result,
                'message' => $message,
            ];
        } else {
            $response = [

                'success' => false,
                'message' => 'Api Disabled',
            ];
        }



        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public static function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    // Return url
    public static function checkUrl($url)
    {
        $data = explode('/', $url);
        if (in_array('api', $data)) {
            return true;
        } else {
            return false;
        }
    }
}
