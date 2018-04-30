<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id');
            $table->string('position');
            $table->string('method');
            $table->string('page');
            $table->integer('ordering')->default(0);
            $table->string('status')->default(0);                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_positions');
    }
}
