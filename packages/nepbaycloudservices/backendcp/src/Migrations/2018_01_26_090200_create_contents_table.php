<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->string('alias')->index();
            $table->text('introtext')->nullable();
            $table->longText('fulltext')->nullable();            
            $table->string('image')->nullable();            
            $table->integer('hits')->nullable();
            $table->tinyInteger('featured')->default(0);
            $table->integer('category_id');
            $table->tinyInteger('status')->default(0);
            $table->longText('seo')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
