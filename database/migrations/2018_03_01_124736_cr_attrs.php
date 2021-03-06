<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrAttrs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->mediumIncrements('id')->comment('attribute ID');
            $table->string('ru_name')->charset('utf8')->unique()->comment('color, weight, etc.');
            $table->string('uk_name')->charset('utf8')->unique()->comment('color, weight, etc.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ru_attributes');
    }
}
