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
        Schema::create('timses_campaign', function (Blueprint $table) {
            $table->id();
            $table->integer('timses_id')->unsigned()->index('timses_id');
            $table->string('campaign_id')->nullable()->index('campaign_id');
            $table->string('nomer_tps')->nullable()->index('nomer_tps');
            $table->enum('status',['unapproved','approved'])->nullable();
            $table->enum('saksi',['Tidak','Saksi TPS','Saksi Kecamatan','Saksi TPS & Kecamatan'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timses_campaign');
    }
};
