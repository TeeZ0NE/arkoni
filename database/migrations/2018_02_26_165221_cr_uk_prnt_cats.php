<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrUkPrntCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uk_parent_categories', function (Blueprint $table) {
            $table->tinyIncrements('parent_category_id')->comment('main ID of parent_categories');
            $table->string('parent_name')->charset('utf8')->unique()->comment('parent name in main language UK');
            $table->string('parent_url_slug')->charset('utf8')->comment('URL of parent category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uk_parent_categories');
    }
}
