<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('operator_id');
            $table->foreign('operator_id', 'operator_fk_4394675')->references('id')->on('operators');
            $table->unsignedBigInteger('machines_id');
            $table->foreign('machines_id', 'machines_fk_4394676')->references('id')->on('machines');
        });
    }
}
