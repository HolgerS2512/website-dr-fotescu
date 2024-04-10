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
        Schema::create('en_lists', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('content_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->tinyInteger('ranking')->default(1);
            $table->string('title')->nullable();
            $table->integer('image_id')->nullable();
            $table->string('item_1')->nullable();
            $table->string('item_2')->nullable();
            $table->string('item_3')->nullable();
            $table->string('item_4')->nullable();
            $table->string('item_5')->nullable();
            $table->string('item_6')->nullable();
            $table->string('item_7')->nullable();
            $table->string('item_8')->nullable();
            $table->string('item_9')->nullable();
            $table->string('item_10')->nullable();
            $table->string('item_11')->nullable();
            $table->string('item_12')->nullable();
            $table->string('item_13')->nullable();
            $table->string('item_14')->nullable();
            $table->string('item_15')->nullable();
            $table->string('item_16')->nullable();
            $table->string('item_17')->nullable();
            $table->string('item_18')->nullable();
            $table->string('item_19')->nullable();
            $table->string('item_20')->nullable();
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
        Schema::dropIfExists('en_lists');
    }
};
