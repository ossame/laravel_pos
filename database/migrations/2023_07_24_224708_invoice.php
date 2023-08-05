<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Invoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table){
            
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('name');
            $table->date('date')->default(date('Y-m-d'));
            $table->string('client_name');
            $table->string('adresse');
            $table->unsignedInteger('user_id')->nullable();
            
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

