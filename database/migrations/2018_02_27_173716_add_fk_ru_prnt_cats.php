<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkRuPrntCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ru_parent_categories', function (Blueprint $table) {
            $table
            ->foreign('parent_category_id')
            ->references('parent_category_id')
            ->on('uk_parent_categories')
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
        Schema::table('ru_parent_categories', function (Blueprint $table) {
            //
        });
    }
}
