<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntryMaterialTable extends Migration
{
    public function up()
    {
        Schema::create('entry_material', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entry_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->float('price', 9, 2);
            $table->softDeletes();

            $table->foreign('entry_id')->references('id')->on('entries')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->foreign('material_id')->references('id')->on('materials')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('entry_material');
    }
}
