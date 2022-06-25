<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponUserCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupon_user_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('cupon_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('cupon_discount_amount')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cupon_user_customers');
    }
}
