<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTedTalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ted_talks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('トークタイトル');
            $table->string('presenter')->comment('プレゼンターの名前');
            $table->integer('image_id')->nullable()->index();
            $table->integer('subtitle')->comment('0:日本語字幕なし,1:日本語字幕あり');
            $table->integer('status')->comment('0:見たい,1:見た')->default(0)->unsigned();
            $table->integer('is_favorite')->comment('0:普通,1:お気に入り')->default(0)->unsigned();
            $table->date('presented_at')->comment('プレゼン公開日')->nullable();
            $table->text('url')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('ted_talks');
    }
}
