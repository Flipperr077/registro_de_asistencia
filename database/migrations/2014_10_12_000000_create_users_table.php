<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('dni')->unique(); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('nombres');
                $table->string('apellidos');
                $table->string('dni')->unique();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at');
                $table->string('password')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nombres', 'apellidos', 'dni']);
        });
    }
};