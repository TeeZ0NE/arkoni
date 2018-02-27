<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrUkDesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uk_descriptions', function (Blueprint $table) {
            $table->unsignedInteger('item_id')->comment('current item ID');
            $table->longText('desc')->charset('utf8')->nullable()->comment('description in UK lang 4 item ID num');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uk_descriptions');
    }
}
