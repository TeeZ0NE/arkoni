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
            $table->smallIncrements('category_id')->comment('category ID. Main index');
            $table->string('category_name')->charset('utf8')->unique()->comment('category name in UK');
            $table->unsignedTinyInteger('parent_category_id')->comment('link to parent category ID');
            $table->string('category_url_slug')->charset('utf8')->comment('category URL');
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
