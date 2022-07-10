<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsedCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('used_cars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('year')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->decimal('mileage',5,2)->nullable();
            $table->string('image')->nullable();
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
        //
        Schema::dropIfExists('used_cars');
    }
}
