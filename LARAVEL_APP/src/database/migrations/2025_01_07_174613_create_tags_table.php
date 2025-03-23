<?php

use App\Models\gifts;
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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            // $table->unsignedBigInteger('gift_id');
            // $table->foreign('gift_id')->references('id')->on('gifts')->onDelete('cascade');
            $table->foreignId('gift_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
