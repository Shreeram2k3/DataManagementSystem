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
        Schema::create('FacultyActivity_7',function(Blueprint $table)
        {
            $table->id('S_NO');
            $table->string('Winter/SummerSchool');
            $table->string('Sponsoring_Agency');
            $table->string('Title_of_the_Programme');
            $table->string('Coordinator');
            $table->string('Period');
            $table->string('Amount(Rs)');
            $table->string('Dept');
            $table->string('Outcome(IfSanctioned)');
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
        Schema::dropIfExists('FacultyActivity_7');
    }
};
