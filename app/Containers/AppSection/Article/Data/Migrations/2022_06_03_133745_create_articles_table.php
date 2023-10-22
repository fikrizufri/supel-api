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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id')->index('campaignindex')->nullable();
            $table->integer('user_id')->unsigned()->index('userindex');
            $table->text('title');
            $table->longText('article_text');
            $table->string('img')->nullable();
            $table->enum('type', array('public', 'campaign'))->default('public');
            $table->string('category', 100)->default('politik');
            $table->string('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
