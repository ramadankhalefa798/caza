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
        Schema::create('deal_type_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('deal_type_id')->unsigned();
            $table->string('locale');
            $table->string('name');

            $table->unique(['deal_type_id', 'locale']);
            $table->foreign('deal_type_id')->references('id')->on('deals_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_type_translations');
    }
};
