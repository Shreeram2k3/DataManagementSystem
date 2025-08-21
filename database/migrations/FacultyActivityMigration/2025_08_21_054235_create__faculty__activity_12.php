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
        Schema::create('FacultyActivity_12', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_Staff');
            $table->string('Programme_of_study');
            $table->string('Name_of_Institute_&_University');
            $table->string('Date_of_Admission_Completed');
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
        Schema::dropIfExists('FacultyActivity_12');
    }
};

    
