<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrItemShortcuts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_shortcuts', function (Blueprint $table) {
           $table->unsignedInteger('item_id');
           $table->unsignedTinyInteger('shortcut_id');
           $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
           $table->foreign('shortcut_id')->references('id')->on('shortcuts')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_shortcuts');
    }
}
