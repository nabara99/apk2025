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
        Schema::create('kwitansis', function (Blueprint $table) {
            $table->string('kw_id');
            $table->date('tgl');
            $table->string('hal');
            $table->integer('nilai');
            $table->integer('ppn');
            $table->integer('pph21');
            $table->integer('pph22');
            $table->integer('pph23');
            $table->integer('pdaerah');
            $table->integer('sisa');
            $table->string('penerima_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kwitansis');
    }
};
