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
        Schema::create('FacultyActivity_6',function(Blueprint $table)
        {
            $table->id('S_NO');
            $table->string('Name_of_the_Faculty');
            $table->string('ID');
            $table->string('Name_of_Programme');
            $table->string('Organiser_Details');
            $table->date('From_Date');
            $table->date('To_Date');
            $table->string('Purpose_of_Attending(Teaching/Research');
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
        Schema::dropIfExists('FacultyActivity_6');
    }
};
