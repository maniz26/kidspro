<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateContentCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->string('alias')->index();
            $table->integer('parent_id')->default(0);
            $table->longText('description')->default(0);
            $table->string('image')->nullable();            
            $table->tinyinteger('featured')->default(0);
            $table->tinyinteger('status')->default(0);
            $table->timestamps();
        });

        DB::table('content_categories')->insert(
            array(
                'title'     => 'Uncategorised',
                'alias'     => 'uncategorised',
                'status'    => 1,
                'created_at' => Carbon::now()
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_categories');
    }
}
