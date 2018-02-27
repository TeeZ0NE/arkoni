<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkItemTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_tags', function (Blueprint $table) {
            $table
            ->foreign('tag_id')
            ->references('tag_id')
            ->on('uk_tags')
            ->onDelete('cascade')
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
        Schema::table('item_tags', function (Blueprint $table) {
            //
        });
    }
}
