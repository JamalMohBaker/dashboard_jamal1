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
        Schema::create('links_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')
                  ->constrained('links','id')
                  ->cascadeOnDelete(); // حتنحذف الصورةالتابعة للمنتج اذا انحذف
            $table->string('user_permissions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links_permissions');
    }
};
