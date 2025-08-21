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
        Schema::create('FacultyActivity_8',function(Blueprint $table)
        {
            $table->id('S_NO');
            $table->string('Name_of_winter/SummerSchool/FDPTitle_of_the_programme');
            $table->string('Name_of_the_coordinator(s)');
            $table->string('Total_No_of_Participants(TN)');
            $table->string('Total_No_of_Participants(Others)');
            $table->string('Total_No_of_Participants(BIT)');
            $table->date('From_date');
            $table->date('To_date');
            $table->string('Dept');
            $table->string('Document_Link',2083)->nullable();
            $table->string('Document');
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('FacultyActivity_8');
    }
};
