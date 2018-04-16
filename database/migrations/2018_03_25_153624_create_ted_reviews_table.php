<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTedReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ted_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->integer('user_id');
            $table->integer('status')->default(0)->comment('0:下書き,1:公開')->unsigned();
            $table->integer('talk_id')->unsigned()->index();
            $table->string('slug');
            $table->timestamps();
            $table->foreign('talk_id')->references('id')->on('ted_talks')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ted_reviews');
    }
}
