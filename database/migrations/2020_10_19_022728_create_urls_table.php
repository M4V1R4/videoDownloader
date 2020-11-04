<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD:database/migrations/2020_10_19_022728_create_urls_table.php
        Schema::create('urls', function (Blueprint $table) {
=======
        Schema::create('colas', function (Blueprint $table) {
>>>>>>> vlkw:database/migrations/2020_11_04_160729_create_cola_table.php
            $table->id();
            $table->string('url');
<<<<<<< HEAD
            $table->string('format');
            $table->string('path');
=======
            $table->string('user_id');
            $table->string('format');
            $table->string('state');
            
>>>>>>> 0426650cb1065321edbfe0a0957e2549b5fede1d
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD:database/migrations/2020_10_19_022728_create_urls_table.php
        Schema::dropIfExists('urls');
=======
        Schema::dropIfExists('colas');
>>>>>>> vlkw:database/migrations/2020_11_04_160729_create_cola_table.php
    }
}
