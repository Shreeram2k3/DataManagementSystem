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
        Schema::create('FacultyActivity_11', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_Staff');
            $table->foreignId('user_id')->constrained('users');
            $table->string('Name_of_the_Programme');
            $table->string('BIT/Outside');
            $table->string('Duration');
            $table->string('Outcome');
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
        Schema::dropIfExists('FacultyActivity_11');
    }
};

    
