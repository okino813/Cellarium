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
        if (! Schema::hasColumn('containings', 'firestation_id')) {
            Schema::table('containings', function (Blueprint $table) {
                $table->unsignedBigInteger('firestation_id')->nullable()->after('source_id');
            });
        }

        Schema::table('containings', function (Blueprint $table) {
            $table->foreign('firestation_id')->references('id')->on('firestations');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
