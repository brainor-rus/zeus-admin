<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZeusAdminCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zeus_admin_custom_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('type');
            $table->integer('group_id');
            $table->text('description')->nullable();
            $table->string('value')->nullable();
            $table->string('placeholder')->nullable();
            $table->text('html')->nullable();
            $table->text('options')->nullable();
            $table->boolean('required')->default(false);
            $table->string('order')->default('99.99');
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
        Schema::dropIfExists('zeus_admin_custom_fields');
    }
}
