<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->integer('id')->unsigned()->comment('item id from Items');
            $table->text('review')->charset('utf8')->comment('text of review');
            $table->boolean('approved')->default('0')->comment('did review aproove');
            $table->timestamp('added_on')->useCurrent()->comment('when review added');
            $table->foreign('id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
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
