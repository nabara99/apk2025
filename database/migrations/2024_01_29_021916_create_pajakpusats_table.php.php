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
        Schema::create('pajakpusats', function (Blueprint $table) {
            $table->id();
            $table->string('uraian_pajak')->nullable();
            $table->foreignId('spd_id')->nullable()->constrained('spds')->onDelete('cascade');
            $table->string('kwi_id')->nullable();
            $table->string('ntpn')->nullable();
            $table->date('tgl_setor')->nullable();
            $table->string('ntb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pajakpusats');
    }
};
