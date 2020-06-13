<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\GlobalVariable;
use App\User;
use Faker\Factory as Faker;

class sm_staffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); 
        $obj = new GlobalVariable();
        $Names = $obj->Names; 
        $basic_salary=30000;



 
    for($role_id=4; $role_id<=10; $role_id++){
        for($i=1; $i<2; $i++){
            $gender_id= 1;
 
            
           

            $name_index = array_rand($Names,8);
            $First_Name = $UserName = $faker->firstName($gender =  'male');
            $Last_Name  =              $faker->lastName($gender =  'male');
            $Full_name  = $First_Name.' '.$Last_Name;

            //parents name genarator
            $Father_First_Name  =   $faker->firstName($gender =  'male');
            $Father_Last_Name   =   $faker->firstName($gender =  'male');
            $Father_full_name   =   $Father_First_Name.' '.$Father_Last_Name;



            $Mother_First_Name  =   $faker->firstName($gender =  'female');
            $Mother_Last_Name   =   $faker->firstName($gender =  'female'); 
            $Mother_full_name=$Mother_First_Name.' '.$Mother_Last_Name;
            


            //insert staff user & pass
            $newUser            = new User();
            $newUser->role_id   =$role_id;
            $newUser->full_name =$Full_name;
            $newUser->email     =$First_Name.$i.'@infixedu.com';
            $newUser->username  =$First_Name.$i.'@infixedu.com';
            $newUser->password  = Hash::make(123456);
            $newUser->save();
            $newUser->toArray();
            $staff_id_number=$newUser->id;  
            
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('sm_staffs')->insert([

             [
                 'user_id'          =>$staff_id_number,
                 'role_id'          =>$role_id,
                 'staff_no'         =>count(\App\SmStaff::all())+1, 
                 'designation_id'   =>1, 
                 'department_id'    =>1, 
                 'first_name'       =>$First_Name, 
                 'last_name'        =>$Last_Name, 
                 'full_name'        =>$Full_name, 
                 'fathers_name'     =>$Father_full_name, 
                 'mothers_name'     =>$Mother_full_name, 

                 'date_of_birth'    =>$faker->date($format = 'Y-m-d', $max = 'now'), 
                 'date_of_joining'  =>$faker->date($format = 'Y-m-d', $max = 'now'),  

                 'gender_id'        =>$gender_id, 
                 'email'            =>$First_Name.$i.'@infixedu.com', 
                 'mobile'           =>'123456789', 
                 'emergency_mobile' =>'1234567890', 
                 'marital_status'   =>'Married', 
                 'staff_photo'      =>'public/uploads/staff/staff.jpg',
                 'current_address'  => $faker->address, 
                 'permanent_address'=> $faker->streetAddress, 
                 'qualification'    =>'B.Sc in Computer Science', 
                 'experience'       =>'4 Years', 
                 'basic_salary'     =>$basic_salary + $i,
                 'casual_leave'     =>'12',
                 'medical_leave'    =>'15', 
                 'metarnity_leave'  =>'45', 

                 'driving_license'  =>'56776987453', 
                 'driving_license_ex_date'=>'2019-02-23', 
             ] 


            ]);
        }
    }
    }
}
