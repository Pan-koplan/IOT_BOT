<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftsTagsTable extends Migration
{
    public function up()
    {
        Schema::create('gifts_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('gift_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            // Внешние ключи
            $table->foreign('gift_id')->references('id')->on('gifts')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            // Составной первичный ключ
            $table->primary(['gift_id', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('gifts_tags');
    }
}
