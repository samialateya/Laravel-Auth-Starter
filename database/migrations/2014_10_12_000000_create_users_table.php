<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
						//define default user as a regular user not and admin
						$table->boolean('is_admin')->default(0);
						//setup admin type foreign key
						$table->bigInteger('admin_type')->unsigned()->index()->nullable();
						//foreign key constraints for a user type
						$table->foreign('admin_type')->references('id')->on('admin_types')->onDelete('cascade')->onUpdate('cascade');
						//define a column to store user image link
						$table->string('avatar')->nullable();
						//user status is a boolean define a if a user is active or blocked
						$table->boolean('is_active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
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
