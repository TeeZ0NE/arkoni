<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrRuPrntCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ru_parent_categories', function (Blueprint $table) {
            $table->unsignedTinyInteger('parent_category_id')->comment('belongs to UK parent categories IDs');
            $table->string('parent_name')->charset('utf8')->unique()->comment('name of parent category in RU');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ru_parent_categories');
    }
}
