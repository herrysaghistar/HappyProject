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
            $table->string('permission_id');
            $table->string('work_location_id');
            $table->string('level');
            $table->string('berlaku_dari');
            $table->string('berlaku_sampai');
            $table->string('manpower_qty');
            $table->string('remark');
            $table->string('status');
            $table->string('approved_by');
            $table->string('rejected_by');
            $table->string('created_by');
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
