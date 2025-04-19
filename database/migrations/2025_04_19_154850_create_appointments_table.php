<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // cine a făcut programarea
            $table->unsignedTinyInteger('floor'); // etajul
            $table->date('date'); // ziua programării
            $table->enum('slot', ['08-12', '12-16', '16-20', '20-24', '00-04']); // intervalul orar
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
