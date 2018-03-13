<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrUkCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uk_categories', function (Blueprint $table) {
            $table->unsignedSmallInteger('cat_id')->comment('reference 2 cats');
            $table->string('uk_name')->charset('utf8')->unique();
            $table->string('title')->charset('utf8')->comment('page title');
            $table->string('desc')->charset('utf8')->nullale()->comment('page description');
            $table->string('h1')->charset('utf8')->nullable();
            $table->string('h2')->charset('utf8')->nullable();
            $table->longText('seo_text')->charset('utf8')->nullable();
            $table->longText('seo_text_2')->charset('utf8')->nullable()->comment('secondary seo text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uk_categories');
    }
}
