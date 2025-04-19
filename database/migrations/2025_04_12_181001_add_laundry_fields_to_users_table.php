<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('faculty')->nullable(); // Facultatea studentului
            $table->string('room')->nullable();    // Camera studentului
            $table->integer('floor')->nullable();   // Palierul studentului
            $table->boolean('is_active')->default(false); // Statusul activării contului
            $table->string('role')->default('student'); // Rolul utilizatorului (admin/student)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'faculty',
                'room',
                'floor',
                'is_active',
                'role'
            ]);
        });
    }
};
