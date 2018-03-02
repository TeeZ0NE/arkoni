<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrSubCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(/**
         * @param Blueprint $table
         */
            'sub_categories', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('cat_id')->comment('parent ID');
            $table->string('sub_cat_url_slug')->charset('utf8')->comment('URL slug 4 sub_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
