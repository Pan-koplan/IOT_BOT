<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Автоинкрементный первичный ключ
            $table->string('name'); // Имя пользователя
            $table->string('email')->unique(); // Уникальный email
            $table->string('password'); // Пароль
            $table->rememberToken(); // Токен для "запомнить меня"
            $table->timestamps(); // created_at и updated_at
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
};
