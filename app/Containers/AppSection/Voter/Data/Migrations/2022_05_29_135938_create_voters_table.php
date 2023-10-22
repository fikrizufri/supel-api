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
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->string('data_id', 20);
            $table->string('nkk', 20);
            $table->string('nik', 20);
            $table->string('name');
            $table->string('tempat_lahir', 100);
            $table->string('tanggal_lahir', 15);
            $table->string('kawin', 4);
            $table->string('jenis_kelamin', 4);
            $table->string('alamat')->nullable();
            $table->string('rt', 4)->nullable();
            $table->string('rw', 4)->nullable();
            $table->string('difabel', 4);
            $table->integer('tps')->nullable();
            $table->integer('group_id')->unsigned()->index('group_id');
            $table->string('kode_provinsi', 10)->nullable();
            $table->string('kode_kabupaten', 10)->nullable();
            $table->string('kode_kecamatan', 20)->nullable();
            $table->string('kode_desa', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};
