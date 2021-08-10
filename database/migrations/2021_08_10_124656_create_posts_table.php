<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50)->nullable();
            $table->string('extract',80)->nullable();
            $table->text('body')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            //Relaciones post-categorias muchos-uno
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            //Relaciones post-usuarios muchos-uno
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

        });

        //Esquema relacionador
        //Relaciones post-etiquetas muchos-muchos
        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('post_id');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('post_id')->references('id')->on('users');
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
        Schema::dropIfExists('post_tag');
    }
}
