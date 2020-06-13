<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmAssignSubject extends Model
{
    public function subject()
    {
        return $this->belongsTo('App\SmSubject', 'subject_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\SmStaff', 'teacher_id', 'id');
    }

    public static function getNumberOfPart($subject_id, $class_id, $section_id, $exam_term_id)
    {
        $results = SmExamSetup::where([
            ['class_id', $class_id],
            ['subject_id', $subject_id],
            ['section_id', $section_id],
            ['exam_term_id', $exam_term_id],
        ])->get();
        return $results;
    }

    public static function getMarksOfPart($student_id, $subject_id, $class_id, $section_id, $exam_term_id)
    {
        $results = SmMarkStore::where([
            ['student_id', $student_id],
            ['class_id', $class_id],
            ['subject_id', $subject_id],
            ['section_id', $section_id],
            ['exam_term_id', $exam_term_id],
        ])->get();
        return $results;
    }
    public static function getSumMark($student_id, $subject_id, $class_id, $section_id, $exam_term_id)
    {
        $results = SmMarkStore::where([
            ['student_id', $student_id],
            ['class_id', $class_id],
            ['subject_id', $subject_id],
            ['section_id', $section_id],
            ['exam_term_id', $exam_term_id],
        ])->sum('total_marks');
        return $results;
    }


    public static function get_student_result($student_id, $class_id, $section_id, $exam_term_id)
    {
        $this_student_failed = 0;
        $total_gpa_point = 0;
        $subjects = SmAssignSubject::where([['class_id', $class_id], ['section_id', $section_id]])->get();
        foreach ($subjects as $row) {
            $subject_id = $row->subject_id;
            $total_mark = SmAssignSubject::getSumMark($student_id, $subject_id, $class_id, $section_id, $exam_term_id);
            $mark_grade = SmMarksGrade::where([['percent_from', '<=', $total_mark], ['percent_upto', '>=', $total_mark]])->first();
            $total_gpa_point = $total_gpa_point + $mark_grade->gpa;
            if ($mark_grade->gpa < 1) {
                $this_student_failed = 1;
            }
        }
        if ($this_student_failed != 1) {
            $number_of_subject = count($subjects);
            if ($total_gpa_point != 0 && $number_of_subject != "") {
                $final_result =  number_format($total_gpa_point / $number_of_subject, 2, ',', ' ');
                return $final_result;
            } else {
                return '0.00';
            }
        } else {
            return '0.00';
        }
    }
}
