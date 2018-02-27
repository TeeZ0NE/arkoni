<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrUkAttrs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uk_attributes', function (Blueprint $table) {
            $table->mediumIncrements('attribute_id')->comment('main attribute id. Parent table');
            $table->string('attribute')->charset('utf8')->unique()->comment('attribute name in UK');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uk_attributes');
    }
}
