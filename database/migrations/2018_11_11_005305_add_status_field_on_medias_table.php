<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusFieldOnMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('media', function (Blueprint $table) {
        $table->enum('status', ['draft', 'publish', 'private'])->after('ext');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('media', function (Blueprint $table) {
        $table->dropColumn('status');
      });
    }
}
