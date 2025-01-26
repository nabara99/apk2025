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
        Schema::create('pajakdaerahs', function (Blueprint $table) {
            $table->id();
            $table->string('uraian_daerah')->nullable();
            $table->foreignId('spd_id')->nullable()->constrained('spds')->onDelete('cascade');
            $table->string('no_sptpd')->nullable();
            $table->string('ntpn_daerah')->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->string('kwitan_id')->nullable();
            $table->string('ntb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pajakdaerahs');
    }
};
