<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('material_capacity', 15, 4);
            $table->integer('product');
            $table->float('quantity', 15, 4);
            $table->float('feature_1', 15, 4);
            $table->float('feature_2', 15, 2);
            $table->longText('description')->nullable();
            $table->float('linetotal', 15, 2)->nullable();
            $table->integer('order');
            $table->integer('number');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
