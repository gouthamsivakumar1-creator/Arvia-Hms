<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Arvia: patients identify by ABHA number, not Pakistan's CNIC. Aadhaar is deliberately
 * not stored, because keeping raw Aadhaar numbers carries legal restrictions in India.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient', function (Blueprint $table) {
            $table->renameColumn('cnic', 'abha_number');
        });
    }

    public function down(): void
    {
        Schema::table('patient', function (Blueprint $table) {
            $table->renameColumn('abha_number', 'cnic');
        });
    }
};
