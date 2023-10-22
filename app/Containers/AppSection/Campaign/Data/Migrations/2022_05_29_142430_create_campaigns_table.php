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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('id_akun', 100)->index()->nullable();
            $table->integer('group_campaign_id')->index()->nullable();
            $table->integer('subgroup_campaign_id')->index()->nullable();
            $table->string('kode_subgroup_campaign')->index()->nullable();
            $table->string('kode_provinsi')->nullable();
            $table->string('kode_kabupaten')->nullable();
            $table->string('kode_dapil')->nullable();
            $table->string('kode_partai')->nullable();
            $table->string('singkatan')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('slogan')->nullable();
            $table->string('warna')->nullable();
            $table->date('date_campaign')->nullable();
            $table->tinyInteger('campaign')->default(0);
            $table->tinyInteger('survey')->default(0);
            $table->tinyInteger('count')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
