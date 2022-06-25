<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->nullable();
            $table->string('order_id')->nullable();
            $table->integer("customer_id")->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('country_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('shipping_zip')->nullable();
            $table->string('shipping_address')->nullable();
            $table->longText('products')->nullable();
            $table->longText('company_id')->nullable();
            $table->integer('total_qty')->nullable();
            $table->integer('total_item')->nullable();
            $table->double('total_tax')->nullable();
            $table->float('copon_price')->nullable();
            $table->integer('copon_used')->default(0);
            $table->double('cart_total')->nullable();
            $table->double('delivery_charge')->nullable();
            $table->double('total_amount')->nullable();
            $table->integer('order_status')->default(0);
            $table->integer('payment_status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('is_deleted')->default(0);
            $table->string('deleted_by')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
