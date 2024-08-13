<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->string('site_name')->nullable(); // Site name, nullable if not always required
            $table->string('contact_number')->nullable(); // Contact number, nullable
            $table->string('contact_email')->nullable(); // Contact email, nullable
            $table->string('address')->nullable(); // Address, nullable
            $table->text('site_info')->nullable(); // Site information, nullable
            $table->string('facebook')->nullable(); // Facebook URL, nullable
            $table->string('instagram')->nullable(); // Instagram URL, nullable
            $table->string('twitter')->nullable(); // Twitter URL, nullable
            $table->string('tiktok')->nullable(); // TikTok URL, nullable
            $table->string('linkedin')->nullable(); // LinkedIn URL, nullable
            $table->string('vkontakte')->nullable(); // VKontakte URL, nullable
            $table->string('youtube')->nullable(); // YouTube URL, nullable
            $table->string('skype')->nullable(); // Skype ID, nullable
            $table->string('footer_text1')->nullable(); // Footer text 1, nullable
            $table->string('footer_text2')->nullable(); // Footer text 2, nullable
            $table->string('footer_text3')->nullable(); // Footer text 3, nullable
            $table->timestamps(); // Timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
