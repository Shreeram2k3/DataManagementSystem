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
        Schema::create('FacultyActivity_19', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_the_Staff');
            $table->foreignId('user_id')->constrained('users');
            $table->string('Faculty');
            $table->string('University');
            $table->date('Date_of_Recognition');
            $table->string('Reference_No');
            $table->string('Document_Link',2083)->nullable();
            $table->string('Document');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('FacultyActivity_19');
    }
};

    
