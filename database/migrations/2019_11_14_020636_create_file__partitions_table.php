<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilePartitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_partitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('file__resource_id')->unsigned()->index();
            $table->string('partition');
            $table->string('storage');
            $table->string('dir');
            $table->string('size');
            $table->string('hash');
            $table->timestamps();

            $table->foreign('file__resource_id')
                  ->references('id')
                  ->on('files_resource')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file__partitions');
    }
}
