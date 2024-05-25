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
        Schema::create('ptws', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('level');
            $table->string('status');
            $table->string('work_location_id');
            $table->string('berlaku_dari');
            $table->string('berlaku_sampai');
            $table->string('manpower_qty');
            $table->string('remark');
            $table->string('instruksi_tambahan');
            $table->string('created_by');
            $table->string('approved_by');
            $table->string('rejected_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ptws');
    }
};
