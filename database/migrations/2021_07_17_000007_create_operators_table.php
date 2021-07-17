<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatorsTable extends Migration
{
    public function up()
    {
        Schema::create('operators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active')->default(0)->nullable();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }
}
