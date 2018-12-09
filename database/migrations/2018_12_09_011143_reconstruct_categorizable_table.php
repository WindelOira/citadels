<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReconstructCategorizableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::dropIfExists('categorizables');
      Schema::create('categorizables', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('category_id')->index()->unsigned()->nullable();
        $table->integer('categorizable_id')->index()->unsigned()->nullable();
        $table->string('categorizable_type');
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
      Schema::dropIfExists('categorizables');
    }
}
