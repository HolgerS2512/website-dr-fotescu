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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('ranking');
            $table->tinyInteger('subpage')->default(0);
            $table->tinyInteger('page_id')->nullable();
            $table->string('link')->unique();
            $table->string('weblink');
            $table->string('name');
            $table->string('en_name')->nullable();
            $table->string('ru_name')->nullable();
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
        Schema::dropIfExists('pages');
    }
};
