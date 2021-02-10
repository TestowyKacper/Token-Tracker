<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransakcjesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('transakcjes', function (Blueprint $table) {
            
            $table->id();
            $table->integer('user_id');
            $table->string('sprzedana');
            $table->string('kupiona');
            $table->string('para');
            $table->string('cena');
            $table->double('ilosc');
            $table->string('status');
            $table->double('wartosc_transakcji');
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
        Schema::dropIfExists('transakcjes');
    }
}
