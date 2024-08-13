<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePfPostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('pf_posts', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->string('project_title');
            $table->string('client');
            $table->string('completed_at');
            $table->string('skills');
            $table->string('client_url');
            $table->integer('pfcategory_id');
            $table->string('featured');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pf_posts');
    }
}
