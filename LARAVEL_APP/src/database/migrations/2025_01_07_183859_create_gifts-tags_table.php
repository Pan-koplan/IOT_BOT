<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gifts-tags', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('gift_id');
            $table->unsignedBigInteger('tag_id');

            $table->index('gift_id', 'gift_tag_gift_idx');
            $table->index('tag_id', 'gift_tag_tag_idx');

            $table->foreign('gift_id', 'gift_tag_gift_fk')->on('gifts')->references('id');
            $table->foreign('tag_id', 'gift_tag_tag_fk')->on('tags')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gifts-tags');
    }
};
