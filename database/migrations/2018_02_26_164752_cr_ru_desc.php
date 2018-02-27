<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrRuDesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ru_descriptions', function (Blueprint $table) {
         $table->unsignedInteger('item_id')->comment('current item ID');
         $table->longText('desc')->charset('utf8')->nullable()->comment('description in RU lang 4 item ID num');
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ru_descriptions');
    }
}
