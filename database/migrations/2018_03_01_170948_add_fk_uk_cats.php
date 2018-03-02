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
           $table->foreign('cat_id')
               ->references('id')
               ->on('categories')
               ->onUpdate('cascade')
               ->onDelete('cascade');
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
