<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100)->charset('utf8')->comment('title of article');
            $table->longText('body')->charset('utf8')->comment('body of article');
            $table->string('photo')->charset('utf8')->comment('photo af article');
            $table->string('url_slug')->charset('utf8')->comment('article URL');
            $table->unsignedSmallInteger('views')->nullable()->comment('count of views the article');
            $table->boolean('published')->default(1)->comment('did it publish');
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
        Schema::dropIfExists('blogs');
    }
}
