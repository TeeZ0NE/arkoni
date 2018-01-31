<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->smallIncrements('id')->comment('category id');
            $table->string('name',40)->charset('utf8')->comment('category caption, title, name etc.');
            $table->smallInteger('parrent_id')->unsigned()->nullable()->comment('is this sub-category');
            $table->string('url_slug')->charset('utf8')->comment('URL slug for category or sub category');
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
