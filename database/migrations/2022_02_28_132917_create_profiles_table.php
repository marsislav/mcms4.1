<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key
            $table->string('avatar')->nullable(); // Avatar URL or path
            $table->unsignedBigInteger('user_id'); // Foreign key for users
            $table->text('about')->nullable(); // About section, nullable
            $table->string('facebook')->nullable(); // Facebook profile URL, nullable
            $table->string('youtube')->nullable(); // YouTube channel URL, nullable
            $table->string('linkedin')->nullable(); // LinkedIn profile URL, nullable
            $table->string('instagram')->nullable(); // Instagram profile URL, nullable
            $table->string('twitter')->nullable(); // Twitter handle or URL, nullable
            $table->string('email')->nullable(); // Email address, nullable
            $table->string('phone')->nullable(); // Phone number, nullable
            $table->text('address')->nullable(); // Address, nullable
            $table->timestamps(); // Created at and updated at timestamps

            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
