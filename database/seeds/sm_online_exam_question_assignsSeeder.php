<?php

use App\SmOnlineExam;
use App\SmOnlineExamQuestionAssign;
use App\SmQuestionBank;
use Illuminate\Database\Seeder;

class sm_online_exam_question_assignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $online_exams = SmOnlineExam::all();
        foreach ($online_exams as $online_exam){
            $question_banks = SmQuestionBank::take(10)->get();
            foreach ($question_banks as $question_bank) {
                $store = new SmOnlineExamQuestionAssign();
                $store->online_exam_id = $online_exam->id;
                $store->question_bank_id = $question_bank->id;
                $store->save();
            }

        }
    }
}
