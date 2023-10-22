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
        Schema::create('dapil_wilayah', function (Blueprint $table) {
            $table->id();
            $table->integer('dapil_id')->index();
            $table->string('kode_kabupaten')->nullable();
            $table->string('kode_kecamatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dapil_wilayah');
    }
};
