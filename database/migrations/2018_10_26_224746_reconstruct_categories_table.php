<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReconstructCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::dropIfExists('categories');

      Schema::create('categories', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('media_id')->index()->unsigned()->nullable();
        $table->integer('parent')->index()->unsigned()->nullable();
        $table->string('title');
        $table->string('slug');
        $table->string('type');
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
      Schema::table('categories', function (Blueprint $table) {
        Schema::dropIfExists('categories');
      });
    }
}
