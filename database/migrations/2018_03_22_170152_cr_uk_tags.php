<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrUkTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uk_tags', function (Blueprint $table) {
            $table->unsignedInteger('tag_id');
            $table->string('uk_name')->charset('utf8')->comment('tag\'s name');
            $table->string('title', 70)->charset('utf8')->comment('page title');
            $table->string('description')->charset('utf8')->nullable()->comment('page description');
            $table->foreign('tag_id')->references('id')->on('tags')->
                onDelete('cascade')->onUpdate('cascade');
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
