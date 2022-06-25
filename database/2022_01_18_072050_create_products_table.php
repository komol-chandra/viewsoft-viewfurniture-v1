<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->integer('brand_id')->nullable();

            $table->string('product_name', 200)->nullable();
            $table->string('product_size', 200)->nullable();
            $table->integer('product_qty')->nullable();
            $table->string('product_slug')->nullable();
            $table->string('product_sku', 100)->nullable();
            $table->longText('product_details')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('resubcategory_id')->nullable();
            $table->integer('child_resubcategory')->nullable();
            $table->integer('grand_childresubcategory_id')->nullable();
            $table->string('product_brand', 200)->nullable();
            $table->float('product_price', 20)->nullable();
            $table->string('product_weight', 200)->nullable();
            $table->string('style', 200)->nullable();
            $table->string('age_group', 20)->nullable();
            $table->string('product_gender', 20)->nullable();
            $table->string('product_materials', 70)->nullable();
            $table->string('product_condition', 20)->nullable();
            $table->string('product_tags')->nullable();
            $table->integer('have_a_discount')->nullable();
            $table->string('offer')->nullable();
            $table->float('discount_price')->nullable();
            $table->string('discount_price_type', 30)->nullable();

            $table->string('discount_condition', 30)->nullable();
            $table->datetime('from_date')->nullable();
            $table->datetime('to_date')->nullable();
            $table->string('offer_stock_type', 30)->nullable();
            $table->string('offer_qty', 30)->nullable();
            $table->string('image', 200)->nullable();
            $table->text('gallary_image')->nullable();

            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('products');
    }
}
