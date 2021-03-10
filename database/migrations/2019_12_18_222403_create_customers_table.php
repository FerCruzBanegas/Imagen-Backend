<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name', 64);
            $table->string('contact', 64);
            $table->string('address', 128)->nullable();
            $table->string('nit', 32);
            $table->string('phone', 32);
            $table->string('email', 128)->nullable();
            $table->integer('city_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
