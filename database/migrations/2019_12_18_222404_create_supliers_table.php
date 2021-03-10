<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupliersTable extends Migration
{
    public function up()
    {
        Schema::create('supliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name', 64)->nullable();
            $table->string('contact', 64)->nullable();
            $table->integer('person_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('people')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('supliers');
    }
}
