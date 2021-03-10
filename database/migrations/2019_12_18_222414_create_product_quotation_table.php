<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductQuotationTable extends Migration
{
    public function up()
    {
        Schema::create('product_quotation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('quotation_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->float('price', 9, 2);
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('quotation_id')->references('id')->on('quotations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_quotation');
    }
}
