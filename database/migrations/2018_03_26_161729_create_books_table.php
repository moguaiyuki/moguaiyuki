<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('author');
            $table->integer('image_id')->nullable()->index();
            $table->integer('status')->default(0)->comment('0:読みたい,1:読んでる,2:読んだ,3:積読');
            $table->integer('is_bookshelf')->default(0)->comment('0:持ってない,1:本棚');
            $table->integer('yonda')->default(0)->comment('読んだ人はクリック');
            $table->string('amazon_url')->nullable();
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
        Schema::dropIfExists('books');
    }
}
