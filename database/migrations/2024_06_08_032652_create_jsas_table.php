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
        Schema::create('jsas', function (Blueprint $table) {
            $table->id();
            $table->string('ptw_id');
            $table->string('supervisi_name');
            $table->string('project_code');
            $table->string('judul_pekerjaan');
            $table->string('tempat_bekerja');
            $table->string('uraian_tugas');
            $table->string('plant_loc');
            $table->string('review');
            $table->string('reviewed_by');
            $table->string('reviewed_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jsas');
    }
};
