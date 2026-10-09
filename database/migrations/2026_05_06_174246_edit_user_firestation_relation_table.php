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
    if (! Schema::hasColumn('users', 'firestation_id')) {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('firestation_id')->nullable();
        });
    }

    Schema::table('users', function (Blueprint $table) {
        $table->foreign('firestation_id')->references('id')->on('firestations');
        $table->string('matricule')->change();
        $table->string('email')->change();
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
