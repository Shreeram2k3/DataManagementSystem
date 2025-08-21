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
        Schema::create('FacultyActivity_21', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Faculty_name');
            $table->foreignId('user_id')->constrained('users');
            $table->string('Qualification');
            $table->string('Designation');
            $table->string('Recruited/Relieved');
            $table->date('Date_of_Joining/Relieving');
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
        Schema::dropIfExists('FacultyActivity_21');
    }
};

    
