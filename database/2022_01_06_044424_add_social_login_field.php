<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialLoginField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('social_id')->nullable();
            $table->string('social_type')->nullable();
            $table->integer('is_shop')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->integer('is_active')->default(0);
            $table->integer('is_verified')->default(0);
            $table->longtext('main_address')->nullable();
            
            $table->longtext('google_map')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();

            $table->string('phone')->nullable();
            $table->string('verification_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
