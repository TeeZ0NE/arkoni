<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrRuSubCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ru_sub_categories', function (Blueprint $table) {
            $table->unsignedSmallInteger('sub_cat_id')->comment('reference to sub_categories main sub_cat_id');
            $table->string('ru_name')->charset('utf8')->unique()->comment('native name of sub_category');
            $table->string('title')->charset('utf8')->comment('page title');
            $table->string('desc')->charset('utf8')->nullable()->comment('page description');
            $table->string('h1')->charset('utf8')->nullable()->comment('h tag');
            $table->string('h2')->charset('utf8')->nullable()->comment('h2 tag');
            $table->longText('seo_text')->charset('utf8')->nullable()->comment('seo text');
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
        Schema::dropIfExists('ru_sub_categories');
    }
}
