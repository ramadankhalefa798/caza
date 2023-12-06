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
        Schema::create('estate_category_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('estate_category_id')->unsigned();
            $table->string('locale');
            $table->string('name');

            $table->unique(['estate_category_id', 'locale']);
            $table->foreign('estate_category_id')->references('id')->on('estates_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estate_category_translations');
    }
};
