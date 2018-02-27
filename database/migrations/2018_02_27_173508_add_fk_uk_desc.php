<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkUkDesc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uk_descriptions', function (Blueprint $table) {
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
        Schema::table('uk_descriptions', function (Blueprint $table) {
            //
        });
    }
}
