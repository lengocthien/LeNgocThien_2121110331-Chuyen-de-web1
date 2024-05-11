<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_orderdetail', function (Blueprint $table) {
            $table->id(); //id
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->float('price');
            $table->unsignedInteger('qty');
            $table->timestamps(); //created_at, updated_at
            $table->float('amount');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('db_orderdetail');
    }
};
