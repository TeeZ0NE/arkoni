<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrRuTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ru_tags', function (Blueprint $table) {
         $table->unsignedInteger('tag_id')->comment('main tag ID in RU');
         $table->string('tag_name')->charset('utf8')->unique()->comment('tag name in RU');
         $table->string('tag_url_slug')->charset('utf8')->comment('URL of tag in RU');
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ru_tags');
    }
}
