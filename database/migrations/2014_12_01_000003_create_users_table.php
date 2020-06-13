<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 250)->nullable();
            $table->string('username', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('usertype', 210)->nullable();
            $table->tinyInteger('access_status')->default(1)->comment('0 = off, 1 = on');
            $table->tinyInteger('active_status')->default(1);
            $table->text('random_code')->nullable();
            $table->text('notificationToken')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->integer('created_by')->nullable()->default(1);
            $table->integer('updated_by')->nullable()->default(1);

            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');

            $table->integer('role_id')->nullable()->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
        });


        $data = User::find(1);
        if (empty($data)) {
            $user            = new User();
            $user->created_by   = 1;
            $user->updated_by   = 1;
            $user->school_id   = 1;
            $user->role_id   = 1;
            $user->full_name = 'admin';
            $user->email     = 'admin@infixedu.com';
            $user->username  = 'admin@infixedu.com';
            $user->password  = Hash::make('123456');
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
