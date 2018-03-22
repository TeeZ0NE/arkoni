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
            $table->unsignedInteger('tag_id');
            $table->string('ru_name', 210)->charset('utf8')->comment('tag\'s name');
            $table->string('title', 70)->charset('utf8')->comment('page title');
            $table->string('description')->charset('utf8')->nullable()->comment('page description');
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
