<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsychologistsTable extends Migration
{
    public function up()
    {
        Schema::create('psychologists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('photo_url')->nullable();
            $table->string('specialty');
            $table->text('approach');
            $table->integer('experience');
            $table->string('languages');
            $table->integer('age');
            $table->text('studies');
            $table->text('bio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('psychologists');
    }
};