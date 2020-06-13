<?php

use App\SmStaff;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // $data = User::find(1);
        // if (empty($data)) {
        //     //user credentials
        //     $user            = new User();
        //     $user->role_id   = 1;
        //     $user->full_name = 'Super Admin';
        //     $user->email     = 'superadmin@infixedu.com';
        //     $user->username  = 'superadmin@infixedu.com';
        //     $user->password  = Hash::make('123456');
        //     $user->save();
        //     $user->toArray();

        //     //user details
        //     $staff                  = new SmStaff();
        //     $staff->user_id         = $user->id;
        //     $staff->role_id         = 1;
        //     $staff->staff_no        = 1;
        //     $staff->designation_id  = 1;
        //     $staff->department_id   = 1;
        //     $staff->first_name      = 'Super';
        //     $staff->last_name       = 'Admin';
        //     $staff->full_name       = 'Super Admin';
        //     $staff->date_of_birth   = '1980-12-26';
        //     $staff->date_of_joining = '2019-05-26';
        //     $staff->gender_id       = 1;
        //     $staff->email           = 'superadmin@infixedu.com';
        //     $staff->staff_photo     = 'public/uploads/staff/1_infix_edu.jpg';
        //     $staff->casual_leave    = '12';
        //     $staff->medical_leave   = '15';
        //     $staff->metarnity_leave = '15';
        //     $staff->save();

        // }
    }
}
