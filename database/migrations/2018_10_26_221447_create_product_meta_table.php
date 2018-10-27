<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('product_metas', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('product_id')->index()->unsigned()->nullable();
        $table->string('key');
        $table->longText('value');
        $table->enum('is_media', [0, 1]);
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
      Schema::dropIfExists('product_metas');
    }
}
