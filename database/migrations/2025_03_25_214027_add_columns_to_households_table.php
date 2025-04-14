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
        Schema::table('households', function (Blueprint $table) {
            $table->string('name');
            $table->string('street');
            $table->string('number');
            $table->string('postcode');
            $table->string('city');
            $table->string('country');
            $table->string('solis_api_id')->nullable();
            $table->string('solis_api_key')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('households', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('street');
            $table->dropColumn('number');
            $table->dropColumn('postcode');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('solis_api_id');
            $table->dropColumn('solis_api_key');
        });
    }
};
