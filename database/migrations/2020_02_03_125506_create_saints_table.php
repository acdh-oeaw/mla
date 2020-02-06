<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saints', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name');
            $table->string('date')->nullable();
            $table->text('heading')->nullable();
            $table->text('incipit')->nullable();
            $table->text('explicit')->nullable();
            $table->text('comments')->nullable();
            $table->text('bhl')->nullable();
            $table->text('printed_editions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saints');
    }
}
