<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
        });

        DB::statement("ALTER TABLE `teams` ADD `image` MEDIUMBLOB NOT NULL");
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
