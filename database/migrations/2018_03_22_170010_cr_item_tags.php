<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrItemTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_tags', function (Blueprint $table) {
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('tag_id');
            $table->foreign('item_id')->
            references('id')->on('items')->
            onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->
            references('id')->on('tags')->
            onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_tags');
    }
}
