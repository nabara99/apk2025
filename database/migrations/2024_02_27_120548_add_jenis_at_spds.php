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
        Schema::table('spds', function (Blueprint $table) {
            $table->enum('jenis', array('LS', 'UP','GU', 'TU'))->nullable()->after('spd_tgl');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spds', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
};
