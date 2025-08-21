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
        Schema::create('FacultyActivity_5',function(Blueprint $table)
        {
            $table->id('S_NO');
            $table->string('Organizer_Name_Details');
            $table->string('Nature_of_Seminar/Conference');
            $table->string('Title');
            $table->string('Total_Number_of_Participants/Papers');
            $table->date('Date');
            $table->string('Dept');
            $table->string('Outcome');
            $table->string('document_link',2083)->nullable();
            $table->string('Document');
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('FacultyActivity_5');
    }
};
