<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmStudentCertificate extends Model
{
    public static function certificateBody($body, $s_id){
    	$student = SmStudent::find($s_id);
    	$certificate_body = str_replace("]","] ",$body);

        $values = explode(' ', $certificate_body);


       $body = '';

       for($i = 0; $i < count($values); $i++){
        if($values[$i]  == '[name]'){
            $body .= ' '.$student->full_name;
        }elseif($values[$i]  == '[present_address]'){
            $body .= ' '.$student->current_address;
        }elseif($values[$i]  == '[guardian]'){
           $body .= ' '.$student->parents->guardians_name;
        }elseif($values[$i]  == '[created_at]'){
            $body .= ' '.$student->created_at;
        }elseif($values[$i]  == '[admission_no]'){
            $body .= ' '.$student->admission_no;
        }elseif($values[$i]  == '[roll_no]'){
            $body .= ' '.$student->roll_no;
        }elseif($values[$i]  == '[class]'){
            $body .= ' '.$student->className->class_name;
        }elseif($values[$i]  == '[section]'){
            $body .= ' '.$student->section->section_name;
        }elseif($values[$i]  == '[gender]'){
            $body .= ' '.$student->gender->base_setup_name;
        }elseif($values[$i]  == '[admission_date]'){
            $body .= ' '.$student->admission_date;
        }elseif($values[$i]  == '[category]'){
            $body .= ' '.$student->category->category_name;
        }elseif($values[$i]  == '[cast]'){
            $body .= ' '.$student->caste;
        }elseif($values[$i]  == '[father_name]'){
            $body .= ' '.$student->parents->fathers_name;
        }elseif($values[$i]  == '[mother_name]'){
            $body .= ' '.$student->parents->mothers_name;
        }elseif($values[$i]  == '[religion]'){
            $body .= ' '.$student->religion->base_setup_name;
        }elseif($values[$i]  == '[email]'){
            $body .= ' '.$student->email;
        }elseif($values[$i]  == '[phone]'){
            $body .= ' '.$student->mobile;
        }elseif($values[$i]  == ','){
            $body .= $values[$i];
        }elseif($values[$i]  == '.'){
            $body .= $values[$i];
        }else{
           $body .= ' '.$values[$i];
        }
       }

       return $body;
    }


}
