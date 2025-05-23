<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
{
    Schema::create('attendances', function (Blueprint $table) {
        $table->id();
        $table->foreignId('school_day_id')->nullable()->constrained('school_days')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('status'); // "presente" o "ausente"
        $table->string('justification')->nullable(); // Justificación de la ausencia
        $table->date('date')->default(now()); // Fecha de la asistencia
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
