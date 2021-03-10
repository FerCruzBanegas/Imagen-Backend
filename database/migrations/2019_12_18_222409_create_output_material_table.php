<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutputMaterialTable extends Migration
{
    public function up()
    {
        Schema::create('output_material', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('output_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->float('price', 9, 2);
            $table->softDeletes();

            $table->foreign('output_id')->references('id')->on('outputs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('material_id')->references('id')->on('materials')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('output_material');
    }
}
