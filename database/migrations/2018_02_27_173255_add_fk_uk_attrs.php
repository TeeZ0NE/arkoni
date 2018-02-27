<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkUkAttrs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_attributes', function (Blueprint $table) {
            $table
            ->foreign('attribute_id')
            ->references('attribute_id')
            ->on('uk_attributes')
            ->onDelete('restrict')
            ->onUpdate('cascade');
            
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
        Schema::table('item_attributes', function (Blueprint $table) {
            //
        });
    }
}
