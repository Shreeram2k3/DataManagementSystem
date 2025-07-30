<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('StudentActivity_2', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_student(s)');
            $table->string('Roll_No');
            $table->string('class');
            $table->string('Title_of_Event/Presentation');
            $table->string('Venue');
            $table->string('Prize/place');
            $table->date('Date');
            $table->string('Document_Link');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('StudentActivity_2');
    }
};