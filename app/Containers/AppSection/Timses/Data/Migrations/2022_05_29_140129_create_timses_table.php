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
        Schema::create('timses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->index('userid');
            $table->integer('group_id')->unsigned()->index('group_id');
            $table->string('id_akun')->nullable();
            $table->string('default_campaign_id')->nullable();
            $table->string('name')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('nik')->nullable();
            $table->string('id_timses_recommend')->nullable();
            $table->string('kode_province', 20)->nullable();
            $table->string('kode_kabupaten', 40)->nullable();
            $table->string('kode_kecamatan', 50)->nullable();
            $table->string('kode_desa', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timses');
    }
};
