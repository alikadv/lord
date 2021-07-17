<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active')->default(0)->nullable();
            $table->string('name');
            $table->string('group');
            $table->string('category')->nullable();
            $table->float('feature_1', 15, 4);
            $table->float('feature_2');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }
}
