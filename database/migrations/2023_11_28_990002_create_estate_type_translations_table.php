<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_type_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('estate_type_id')->unsigned();
            $table->string('locale');
            $table->string('name');

            $table->unique(['estate_type_id', 'locale']);
            $table->foreign('estate_type_id')->references('id')->on('estates_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_type_translations');
    }
};
