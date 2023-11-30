<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjectiveTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjective_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('adjective_id')->unsigned();
            $table->string('locale');
            $table->string('name');

            $table->unique(['adjective_id', 'locale']);
            $table->foreign('adjective_id')->references('id')->on('adjectives')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjective_translations');
    }
}
