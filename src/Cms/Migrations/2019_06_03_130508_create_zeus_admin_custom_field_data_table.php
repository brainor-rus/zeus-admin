<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZeusAdminCustomFieldDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zeus_admin_custom_field_data', function (Blueprint $table) {
            $table->increments('id');
            $table->text('value');
            $table->integer('field_id');
            $table->text('description')->nullable();
            $table->integer('customable_id');
            $table->string('customable_type');
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
        Schema::dropIfExists('zeus_admin_custom_field_data');
    }
}
