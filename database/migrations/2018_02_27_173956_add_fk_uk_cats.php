<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkUkCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uk_categories', function (Blueprint $table) {
           $table
           ->foreign('parent_category_id')
           ->references('parent_category_id')
           ->on('uk_parent_categories')
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
        Schema::table('uk_categories', function (Blueprint $table) {
            //
        });
    }
}
