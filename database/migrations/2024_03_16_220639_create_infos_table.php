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
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('location', 50)->nullable();
            $table->string('address', 80)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('mail', 40)->nullable();
            $table->string('web', 80)->nullable();
            $table->string('logo_path', 80)->nullable();
            $table->string('logo_ext', 5)->nullable();
            $table->string('maps')->nullable();
            $table->text('iframe')->nullable();
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
        Schema::dropIfExists('infos');
    }
};
