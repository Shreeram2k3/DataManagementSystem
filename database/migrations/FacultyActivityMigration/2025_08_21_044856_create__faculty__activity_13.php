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
        Schema::create('FacultyActivity_13', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_the_Faculty_Member');
            $table->string('Part_time/Full_Time');
            $table->string('Internal/External');
            $table->string('Name_of_the_Scholar');
            $table->string('Address_of_external')->nullable();
            $table->date('Date_of_Registration');
            $table->string('Research_Area');
            $table->string('Status');
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
        Schema::dropIfExists('FacultyActivity_13');
    }
};

    
