<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id')->comment('item id');
            $table->string('name')->charset('utf8')->unique()->comment('item name');
            $table->string('photo')->charset('utf8')->default('no_image.png')->comment('file name');
            $table->float('price',8,2)->default(0);
            $table->float('new_price',8,2)->default(0)->comment('marketing price');
            $table->text('tags')->charset('utf8')->nullable()->comment('tags for search');
            $table->integer('brand_id')->unsigned()->comment('manufacturer id');
            $table->boolean('enabled')->default(1)->comment('does it visible (enabled)');
            $table->string('url_slug');
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
