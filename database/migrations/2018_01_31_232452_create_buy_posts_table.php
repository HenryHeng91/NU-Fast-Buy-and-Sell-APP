<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->decimal('price_from', 8, 2);
            $table->decimal('price_to', 8, 2);
            $table->integer('category_id');
            $table->longText('product_image')->nullable();
            $table->integer('user_id');
            $table->integer('status')->default(1);
            $table->enum('post_type', ['buy', 'sell'])->default('buy');
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
        Schema::dropIfExists('posts');
    }
}
