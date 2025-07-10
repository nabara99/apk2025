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
        Schema::table('pajak_kwitansis', function (Blueprint $table) {
            $table->string('kwitu_id')->after('kwi_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pajak_kwitansis', function (Blueprint $table) {
            $table->dropColumn('kwitu_id');
        });
    }
};
