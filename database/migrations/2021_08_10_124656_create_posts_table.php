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
            $table->string('slug')->unique();
            $table->text('extract')->nullable();
            $table->longText('body')->nullable();
            $table->enum('status',['App\Post'::BORRADOR,'App\Post'::PUBLICADO])->default('App\Post'::BORRADOR);
            // $table->boolean('status')->default(true);
            $table->timestamps();
            //Relaciones post-categorias muchos-uno
            /* $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias'); */
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            //Relaciones post-usuarios muchos-uno
            /* $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users'); */
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

        });

        //Esquema relacionador
        //Relaciones post-tags muchos-muchos
        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('post_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            //Lo de cascade es oopcional!
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
