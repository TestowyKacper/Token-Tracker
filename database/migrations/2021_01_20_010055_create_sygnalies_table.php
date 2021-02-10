<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSygnaliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sygnalies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nick');
            $table->string('tytul');
            $table->string('para');
            $table->string('opis')->length(800);
            $table->string('img');
            $table->string('status')->default('rozpatrywany');
            $table->string('miniaturka');
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
        Schema::dropIfExists('sygnalies');
    }
}
