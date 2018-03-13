<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrRuItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ru_items', function (Blueprint $table) {
            $table->unsignedInteger('item_id');
            $table->string('ru_name')->charset('utf8')->unique();
            $table->longText('desc')->charset('utf8');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ru_items');
    }
}
