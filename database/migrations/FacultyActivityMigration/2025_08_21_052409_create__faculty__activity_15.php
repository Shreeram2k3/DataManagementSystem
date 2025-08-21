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
        Schema::create('FacultyActivity_15', function (Blueprint $table) {
            $table->id('S_NO');
            $table->date('Period_(From)');
            $table->foreignId('user_id')->constrained('users');
            $table->date('Period_(To)');
            $table->string('Name_of_the_Company');
            $table->string('Address_of_the_Company');
            $table->string('Work_Description');
            $table->string('Faculty/Faculty_Team');
            $table->string('Amount_Generated(in_Rs)');
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
        Schema::dropIfExists('FacultyActivity_15');
    }
};

    
