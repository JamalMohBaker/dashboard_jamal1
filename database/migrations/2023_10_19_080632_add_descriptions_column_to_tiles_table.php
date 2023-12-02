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
        Schema::table('tiles', function (Blueprint $table) {
            $table->string('descriptions')->after('name')->nullable();
            $table->string('link')->after('descriptions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tiles', function (Blueprint $table) {
            //
        });
    }
};
