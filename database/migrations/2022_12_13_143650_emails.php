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
        Schema::create('emails', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('sub_id');
            $table->foreign('sub_id')->references('id')->on('weather_subscribers')->cascadeOnDelete();
            $table->string('type')->nullable();
            $table->string('email')->unique();
            $table->string('emailSend');
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
        //
    }
};
