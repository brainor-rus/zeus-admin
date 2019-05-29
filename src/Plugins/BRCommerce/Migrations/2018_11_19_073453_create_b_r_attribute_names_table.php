<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBRAttributeNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_r_attribute_names', function (Blueprint $table) {
            $table->increments('id');
            $table->text('slug');
            $table->text('name');
            $table->string('category_id');
            $table->integer('order')->default(0);
            $table->boolean('filter')->default(true);
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
        Schema::dropIfExists('b_r_attribute_names');
    }
}
