<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("category_id")->nullable()->constrained("blog_categories")->onDelete("set null");
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('short_des')->nullable();
            $table->text('des')->nullable();
            $table->text('tag')->nullable();
            $table->integer('viewer')->default(0);
            $table->integer("status")->default(1)->comment("1=Active,0=Inactive");
            $table->integer("is_deleted")->default(1)->comment("1=deleted,0=not delete yet");
            $table->foreignId("created_by")->nullable()->constrained("admins")->onDelete("set null");
            $table->foreignId("updated_by")->nullable()->constrained("admins")->onDelete("set null");
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
        Schema::dropIfExists('blogs');
    }
}
