<?php

use App\SmStudent;
use App\SmStudentAttendance;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class sm_student_attendancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        SmStudentAttendance::query()->truncate();
        $studentList = SmStudent::all();
        foreach ($studentList as $student) {
            // $m = date('m');
            for ($m = 1; $m <= 1; $m++) {
                for ($d = 1; $d <= 5; $d++) {
                    if ($d <= 9) {
                        $d = '0' . $d;
                    }
                    $str = date('Y') . '-' . $m . '-' . $d;
                    if ($d % 3 == 0) {
                        $status = 'A';
                    } elseif ($d % 3 == 1) {
                        $status = 'L';
                    } else {
                        $status = 'P';
                    }
                    if ($m == 2 && $d == 28) {
                        break;
                    }

                    $sa                  = new SmStudentAttendance();
                    $sa->student_id      = $student->id;
                    $sa->attendance_type = $status;
                    $sa->notes           = 'Sample Attendance for ' . $str;
                    $sa->attendance_date = $str;
                    $sa->save();
                }
            }
        }
    }
}
