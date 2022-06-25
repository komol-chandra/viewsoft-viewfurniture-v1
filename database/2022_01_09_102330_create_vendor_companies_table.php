<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_companies', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->longtext('company_google_map')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('sale_area')->nullable();
            $table->string('delevery_possible_area')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();

            $table->string('name_of_bank')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('i_ban')->nullable();
            $table->string('swift_code')->nullable();

            $table->string('image')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('is_deleted')->default(0);
            $table->integer('is_approve')->default(0);
            $table->string('approve_by')->nullable();
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
        Schema::dropIfExists('vendor_companies');
    }
}
