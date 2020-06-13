<?php  
namespace App; 
use Brian2694\Toastr\Facades\Toastr; 
use App\SmDateFormat;  
use Illuminate\Database\Eloquent\Model;
use App\SmLanguage;
class SmGeneralSettings extends Model
{
    public function sessions()
    {
        return $this->belongsTo('App\SmSession', 'session_id', 'id');
    }

    public function languages()
    {
        return $this->belongsTo('App\SmLanguage', 'language_id', 'id');
    }

    public function dateFormats()
    {
        return $this->belongsTo('App\SmDateFormat', 'date_format_id', 'id');
    }
    public static function getLanguageList()
    {
        $languages = SmLanguage::all();
        return $languages;
    }

    public static function value()
    {
        $value = SmGeneralSettings::first();
        return $value->system_purchase_code;
    }

    public static function SUCCESS($redirect_specific_message = null)
    {
        if ($redirect_specific_message) {
            Toastr::success($redirect_specific_message, 'Success');
        } else {
            Toastr::success('Operation successful', 'Success');
        }
        return;
    }
    public static function ERROR($redirect_specific_message = null)
    {
        if ($redirect_specific_message) {
            Toastr::error($redirect_specific_message, 'Failed');
        } else {
            Toastr::error('Operation Failed', 'Failed');
        }
        return;
    }


    public function timeZone()
    {
        return $this->belongsTo('App\SmTimeZone', 'time_zone_id', 'id');
    }



    ///DateConvater
    public static function DateConvater($input_date)
    {
        $generalSetting = SmGeneralSettings::find(1);


        $system_date_foramt = SmDateFormat::find($generalSetting->date_format_id);
        $DATE_FORMAT =  $system_date_foramt->format;
        echo date_format(date_create($input_date), $DATE_FORMAT);
    }
}
