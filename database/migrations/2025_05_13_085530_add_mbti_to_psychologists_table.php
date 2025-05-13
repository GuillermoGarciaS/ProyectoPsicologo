<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMbtiToPsychologistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('psychologists', function (Blueprint $table) {
        $table->string('mbti_type')->nullable()->after('user_id');
    });
}

public function down()
{
    Schema::table('psychologists', function (Blueprint $table) {
        $table->dropColumn('mbti_type');
    });
}

}
