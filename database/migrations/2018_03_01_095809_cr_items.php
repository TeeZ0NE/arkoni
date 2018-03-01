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
            $table->increments('id');
            $table->string('item_photo')->charset('utf8')->default('no_image.png')->comment('item image file');
            $table->float('price',8,2)->default(0)->comment('item current price');
            $table->float('new_price',8,2)->default(0)->comment('new price if promotion');
            $table->unsignedInteger('brand_id')->comment('brand ID');
            $table->boolean('enabled')->default(1)->commet('does it showing on site');
            $table->string('item_url_slug')->charset('utf8');
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
