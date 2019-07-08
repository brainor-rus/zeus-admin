<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZeusAdminFileblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zeus_admin_filebles', function (Blueprint $table) {
            $table->bigInteger('zeus_admin_file_id');
            $table->bigInteger('zeus_admin_fileble_id');
            $table->string('zeus_admin_fileble_type');
            $table->integer('order')->default(0);
            $table->boolean('default')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zeus_admin_filebles');
    }
}
