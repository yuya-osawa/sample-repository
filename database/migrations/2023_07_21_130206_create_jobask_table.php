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
            $table->string('tel','11');
            $table->string('email')->unique();
            $table->string('title','255');
            $table->string('deadline');
            $table->integer('amount');
            $table->string('memo','255')->nullable();
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
        Schema::dropIfExists('jobask');
    }
}
