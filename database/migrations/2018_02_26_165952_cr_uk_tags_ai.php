<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrUkTagsAi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uk_tags', function (Blueprint $table) {
            $table->increments('tag_id')->comment('main tag ID in UK');
            $table->string('tag_name')->charset('utf8')->unique()->comment('tag name in UK');
            $table->string('tag_url_slug')->charset('utf8')->comment('URL of tag in UK');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uk_tags');
    }
}
