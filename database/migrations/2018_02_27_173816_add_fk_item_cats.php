<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkItemCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_categories', function (Blueprint $table) {
            $table
            ->foreign('category_id')
            ->references('category_id')
            ->on('uk_categories')
            ->onUpdate('cascade')
            ->onDelete('restrict');

            $table
            ->foreign('item_id')
            ->references('item_id')
            ->on('items')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_categories', function (Blueprint $table) {
            //
        });
    }
}
