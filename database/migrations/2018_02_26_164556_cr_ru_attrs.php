<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrRuAttrs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ru_attributes', function (Blueprint $table) {
            $table->unsignedMediumInteger('attribute_id')->comment('depends from ua_attributes id');
            $table->string('attribute')->charset('utf8')->unique()->comment('like a weight, width, etc.');
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
