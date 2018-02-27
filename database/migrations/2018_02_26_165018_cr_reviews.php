<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->unsignedInteger('item_id')->comment('review 4 item ID num');
            $table->longText('review')->charset('utf8')->comment('text of review');
            $table->boolean('approved')->default(0)->comment('does a review approve');
            $table->timestamp('created_at')->useCurrent()->comment('when created review');
            $table->unsignedTinyInteger('raiting')->default(5)->comment('current raiting 4 item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
