<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_commissions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('shop_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('product_qty')->nullable();
            $table->float('product_price')->nullable();
            $table->float('total_price')->nullable();
            $table->float('shop_commission')->nullable();
            $table->float('website_payable')->nullable();
            $table->float('vendor_payable')->nullable();
            $table->integer('status')->default(1);
            $table->integer('is_deleted')->default(0);
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
        Schema::dropIfExists('order_commissions');
    }
}
