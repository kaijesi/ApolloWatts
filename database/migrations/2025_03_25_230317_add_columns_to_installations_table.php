<?php

use App\Models\Household;
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
        Schema::table('installations', function (Blueprint $table) {
            $table->float('latitude');
            $table->float('longitude');
            $table->float('peak_power');
            $table->string('pv_tech');
            $table->float('system_loss');
            $table->float('slope_angle');
            $table->float('azimuth');
            $table->float('system_cost');
            $table->string('installer_name');
            $table->foreignIdFor(Household::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('installations', function (Blueprint $table) {
            $table->dropColumn([
                'latitude', 
                'longitude',
                'peak_power',
                'pv_tech',
                'system_loss',
                'slope_angle',
                'azimuth',
                'system_cost',
                'installer_name'
            ]);
            $table->dropForeignIdFor(Household::class);
        });
    }
};
