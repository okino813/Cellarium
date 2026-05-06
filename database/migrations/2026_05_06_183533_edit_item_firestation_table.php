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
        //

        Schema::table('items', function (Blueprint $table) {
            // 👇 Ajoute la colonne ET la contrainte
            $table->unsignedBigInteger('firestation_id')->nullable()->after('seuil');
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
