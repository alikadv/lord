<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active')->default(0)->nullable();
            $table->string('name')->unique();
            $table->float('productivity', 15, 4);
            $table->string('group')->nullable();
            $table->longText('comment')->nullable();
            $table->timestamps();
        });
    }
}
