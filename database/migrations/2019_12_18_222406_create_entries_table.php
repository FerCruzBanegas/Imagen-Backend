<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('voucher', 32);
            $table->string('num_voucher', 64);
            $table->tinyInteger('state')->default('1');
            $table->integer('user_id')->unsigned();
            $table->integer('suplier_id')->unsigned();
            $table->integer('warehouse_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('suplier_id')->references('id')->on('supliers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('warehouse_id')->references('id')->on('warehouses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
