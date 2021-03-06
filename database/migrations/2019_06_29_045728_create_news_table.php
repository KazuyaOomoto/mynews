<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     // title と body と image_path を追記
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');    // ニュースのタイトルを保存するカラム
            $table->string('body');     // ニュースの本文を保存するカラム
            $table->string('image_path')->nullable();  // 画像のパスを保存するカラム nullable:画像のパスは空でも保存できる
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     // マイグレーションの取り消しを行う為のコード
    public function down()
    {
        //もしnewsというテーブルが存在すれば削除する
        Schema::dropIfExists('news');
    }
}
