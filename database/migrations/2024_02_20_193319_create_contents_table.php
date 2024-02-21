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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('ranking');
            $table
                ->foreignId('page_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->tinyInteger('format')->default(0);
            $table->string('title');
            $table->text('content')->nullable();
            $table->integer('image_id')->nullable();
            $table->tinyInteger('button')->nullable();
            $table->string('url_link')->nullable();
            $table->string('en_title');
            $table->text('en_content')->nullable();
            $table->string('ru_title');
            $table->text('ru_content')->nullable();
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
        Schema::dropIfExists('contents');
    }
};
