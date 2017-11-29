<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
			$table->increments('id');
            $table->string('name');
			$table->integer('user_id')->unsigned();
            $table->string('path');
			$table->bigInteger('size');
			$table->string('mime_type');
			$table->boolean('public_share')->default(true);
            $table->timestamps();
            //acabo de agregar esto nuevo es el hashname de seguridad
            $table->string('hashName');
            //palabras para poder guardar mas facilmente los contextos
            $table->string('hashTags');
			$table->foreign('user_id')->references('id')->on('users');	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
