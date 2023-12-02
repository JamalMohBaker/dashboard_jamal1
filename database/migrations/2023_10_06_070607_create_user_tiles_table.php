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
        Schema::create('user_tiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users','id')
            ->cascadeOnDelete(); 
            $table->foreignId('tile_id')
            ->constrained('tiles','id')
            ->cascadeOnDelete(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tiles');
    }
};
