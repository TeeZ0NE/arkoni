<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkItemAttrs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_attributes', function (Blueprint $table) {
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('attr_id')
                ->references('id')
                ->on('attributes')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_attributes', function (Blueprint $table) {
            //
        });
    }
}
