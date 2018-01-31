<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
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
            $table->string('name')->charset('utf8')->comment('item name');
            $table->smallInteger('category_id')->unsigned()->comment('category id FK to Categories');
            $table->string('photo')->charset('utf8')->comment('file name to item image');
            $table->float('price',8,2)->default('0.00')->comment('current item price');
            $table->float('new_price',8,2)->default('0.00')->comment('marketing price');
            $table->text('tags')->charset('utf8')->comment('tags for search');
            $table->tinyInteger('brand_id')->unsigned()->comment('FK to manufacturer (brand) id');
            $table->boolean('enabled')->default('1')->comment('does it visible (enabled');
            $table->string('url_slug')->charset('utf8')->comment('URL item');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict')->onUpdate('cascade');
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
