<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMbtiResultToUsersTable extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('mbti_result')->nullable();  
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('mbti_result');
    });
}


}
