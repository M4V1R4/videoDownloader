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
        Schema::create('urls', function (Blueprint $table) {
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
        Schema::dropIfExists('urls');
    }
}
