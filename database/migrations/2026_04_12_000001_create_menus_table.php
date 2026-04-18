<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('menu_items')) {
            Schema::create('menu_items', function (Blueprint $table) {
                $table->id();
                $table->string('label');           // Текст в менюто
                $table->string('type');            // 'page', 'category', 'post', 'custom', 'blog'
                $table->unsignedBigInteger('reference_id')->nullable(); // id на page/category/post
                $table->string('url')->nullable(); // за custom URL
                $table->unsignedBigInteger('parent_id')->nullable(); // за подменюта
                $table->integer('sort_order')->default(0);
                $table->timestamps();

                $table->foreign('parent_id')->references('id')->on('menu_items')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
