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
        Schema::create('spds', function (Blueprint $table) {
            $table->id();
            $table->string('no_spd');
            $table->date('spd_tgl');
            $table->string('spd_uraian');
            $table->integer('spd_nilai');
            $table->integer('spd_sisa');
            $table->integer('iwp1')->nullable();
            $table->integer('iwp8')->nullable();
            $table->integer('pph21')->nullable();
            $table->integer('pph22')->nullable();
            $table->integer('pph23')->nullable();
            $table->integer('ppn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spds');
    }
};
