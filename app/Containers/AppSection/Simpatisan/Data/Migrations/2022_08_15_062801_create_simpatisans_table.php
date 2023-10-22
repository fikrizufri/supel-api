<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('simpatisan', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id');
            $table->string('nik')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('kode_province', 20)->nullable();
            $table->string('kode_kabupaten', 40)->nullable();
            $table->string('kode_kecamatan', 50)->nullable();
            $table->string('kode_desa', 100)->nullable();
            $table->string('religion', 100)->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpatisan');
    }
};
