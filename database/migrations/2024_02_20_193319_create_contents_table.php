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
            $table->string('title')->nullable();
            $table->text('content');
            $table->integer('image_id');
            $table->tinyInteger('button');
            $table->string('url_link');
            $table->string('en_title');
            $table->text('en_content');
            $table->string('ru_title');
            $table->text('ru_content');
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
