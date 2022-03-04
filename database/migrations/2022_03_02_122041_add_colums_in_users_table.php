<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('role_id')->unsigned()->after('name');
            $table->integer('otp')->nullable()->after('email');
            $table->dateTime('otp_expire')->nullable()->after('otp');
            $table->integer('status')->default(1)->comment("0=inactive , 1=active")->after('otp_expire');
            $table->bigInteger('added_by')->nullable()->unsigned()->after('status');
            $table->bigInteger('updated_by')->nullable()->unsigned()->after('added_by');

            $table->foreign('role_id')
            ->references('id')
            ->on('roles');
            $table->foreign('added_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['role_id','otp','otp_expire','status','added_by','updated_by']);
        });
    }
}
