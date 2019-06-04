<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZeusAdminCustomFieldGroupConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zeus_admin_custom_field_group_conditions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->string('condition_type')->default('in');
            $table->string('condition_parameter')->default('any');
            $table->string('condition_value')->default('any');
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
        Schema::dropIfExists('zeus_admin_custom_field_group_conditions');
    }
}
