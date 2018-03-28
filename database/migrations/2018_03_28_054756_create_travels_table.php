<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->string('country')->comment('slugで使用するため英語表記');
            $table->integer('user_id');
            $table->integer('image_id')->nullable()->index();;
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('is_published')->default(0)->unsigned()->comment('0:下書き,1:公開');
            $table->string('slug')->comment('国名でslugを作成');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travels');
    }

}
