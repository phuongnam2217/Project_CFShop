<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resource_id');
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->integer('quantity');
            $table->string('note')->nullable();
            $table->integer('unit_price');
            $table->integer('total_buy');
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
        Schema::dropIfExists('import_resources');
    }
}
