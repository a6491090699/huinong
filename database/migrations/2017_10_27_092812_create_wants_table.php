<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('kind');
            $table->integer('gaodu');
            $table->integer('mijing');
            $table->integer('guanfu');
            $table->integer('number');
            $table->tinyinteger('cutday');
            $table->string('source');
            $table->string('imgs');
            $table->string('tip');
            $table->tinyinteger('status');
            $table->tinyinteger('status');


            $table->string('title');
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
        Schema::dropIfExists('wants');
    }
}
