<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZeusAdminOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zeus_admin_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->double('discount');
            $table->double('price');
            $table->integer('category_id');
            $table->boolean('visible')->default(true);
            $table->text('description')->nullable();
            $table->string('article')->nullable();
            $table->string('producer_id')->nullable();
            // todo Поиск???
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
        Schema::table('zeus_admin_offers', function (Blueprint $table) {
            Schema::dropIfExists('offers');
        });
    }
}
