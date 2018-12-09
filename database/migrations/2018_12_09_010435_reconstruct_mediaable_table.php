<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReconstructMediaableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::dropIfExists('mediaables');
      Schema::create('mediaables', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('media_id')->index()->unsigned()->nullable();
        $table->integer('mediaable_id')->index()->unsigned()->nullable();
        $table->string('mediaable_type');
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
      Schema::dropIfExists('mediaables');
    }
}
