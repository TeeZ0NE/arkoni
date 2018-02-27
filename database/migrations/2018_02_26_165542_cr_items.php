<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_id')->comment('item ID');
            $table->string('item_name')->charset('utf8')->unique()->comment('items name');
            $table->string('item_photo')->charset('utf8')->default('no_image.png')->comment('item image, if it hasnt def no_image. Must be in storage folder img');
            $table->float('price',8,2)->default(0)->comment('current item price');
            $table->float('new_price',8,2)->default(0)->comment('if promotion it return into view');
            $table->unsignedInteger('brand_id')->comment('brand ID');
            $table->boolean('enabled')->default(1)->comment('does it showing on the site');
            $table->string('item_url_slug')->comment('item URL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
