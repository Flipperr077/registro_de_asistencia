<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolDayUserTable extends Migration
{
    public function up()
{
    Schema::create('school_day_user', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_day_id')->constrained('school_days')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('school_day_user');
    }
}
