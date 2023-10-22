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
        Schema::create('timses_card', function (Blueprint $table) {
            $table->id();
            $table->integer('timses_id')->unsigned()->index('timses_id');
            $table->string('name')->nullable();
            $table->string('id_card')->nullable();
            $table->string('kode_province', 20)->nullable();
            $table->string('kode_kabupaten', 40)->nullable();
            $table->string('kode_kecamatan', 50)->nullable();
            $table->string('kode_desa', 80)->nullable();
            $table->string('photo')->nullable();
            $table->string('nama_organisasi')->nullable();
            $table->string('slogan_organisasi')->nullable();
            $table->string('logo_organisasi')->nullable();
            $table->text('alamat_organisasi')->nullable();
            $table->date('tanggal_berlaku')->nullable();
            $table->string('email_organisasi')->nullable();
            $table->string('telephone_organisasi')->nullable();
            $table->string('warna')->nullable();
            $table->string('image_generate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timses_card');
    }
};
