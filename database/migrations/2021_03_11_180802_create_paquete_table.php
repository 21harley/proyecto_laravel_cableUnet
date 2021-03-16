<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaqueteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paquete', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            
            $table->unsignedBigInteger('cable_id')->nullable();

            $table->unsignedBigInteger('internet_id')->nullable();

            $table->unsignedBigInteger('telephony_id')->nullable();

            $table->string('cost');            
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
        Schema::dropIfExists('package');
    }
}
