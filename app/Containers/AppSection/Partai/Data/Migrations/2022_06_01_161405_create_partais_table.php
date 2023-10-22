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
        Schema::create('partai', function (Blueprint $table) {
            $table->id();
            $table->string('nomer_urut', 10)->nullable();
            $table->string('name')->nullable();
            $table->string('simbol')->nullable();
            $table->string('slogan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('warna')->nullable();
            $table->boolean('is_client')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partai');
    }
};
