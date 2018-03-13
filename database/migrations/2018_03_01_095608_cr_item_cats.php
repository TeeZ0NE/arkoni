<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrItemCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_categories', function (Blueprint $table) {
           $table->unsignedSmallInteger('sub_cat_id')->comment('sub category ID');
           $table->unsignedInteger('item_id')->comment('item ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_categories');
    }
}
