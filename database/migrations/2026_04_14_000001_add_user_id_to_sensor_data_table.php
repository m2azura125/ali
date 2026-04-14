<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sensor_data', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
        });

        $defaultResidentId = DB::table('users')
            ->where('role', 'warga')
            ->orderBy('id')
            ->value('id');

        if ($defaultResidentId) {
            DB::table('sensor_data')
                ->whereNull('user_id')
                ->update(['user_id' => $defaultResidentId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sensor_data', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
