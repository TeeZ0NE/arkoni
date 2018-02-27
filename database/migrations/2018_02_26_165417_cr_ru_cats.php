<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrRuCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ru_categories', function (Blueprint $table) {
            $table->unsignedSmallInteger('category_id')->comment('link to main UK category ID');
            $table->string('category_name')->charset('utf8')->unique()->comment('name of category in RU');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ru_categories');
    }
}
