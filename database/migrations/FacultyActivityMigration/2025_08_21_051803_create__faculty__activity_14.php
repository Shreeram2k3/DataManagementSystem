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
        Schema::create('FacultyActivity_14', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_the_Faculty_Member');
            $table->foreignId('user_id')->constrained('users');
            $table->string('Title_of_the_Project');
            $table->string('Funding_Agency');
            $table->string('Duration');
            $table->string('Amount_(Rs_In_Lakhs)');
            $table->date('Date_of_submission_or_sanction');
            $table->string('Sanctioned/Submitted');
            $table->string('Dept');
            $table->string('Document_Link',2083)->nullable();
            $table->string('Document');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('FacultyActivity_14');
    }
};

    
