<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobask', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('posts_id');
            $table->string('tel', '11');
            $table->string('email');
            $table->string('title', '255');
            $table->string('deadline');

            $table->string('memo', '255')->nullable();
            $table->timestamps();
        });

        Schema::table('jobasks', function (Blueprint $table) {
            $table->integer('status')->default(0); // 0: 掲載中, 1: 進行中, 2: 完了
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobask');
    }
}
