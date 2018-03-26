<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('introduction');
            $table->string('keyword1');
            $table->string('keyword2');
            $table->string('keyword3');
            $table->string('keyword4');
            $table->string('keyword5');
            $table->string('user');
            $table->string('imgfile');
            $table->text('content');
            $table->integer('watch');
            $table->integer('cid');
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
        Schema::dropIfExists('articles');
    }
}
