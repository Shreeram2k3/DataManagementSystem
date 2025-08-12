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
        Schema::create('StudentActivity_8', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_Student(s)');
            $table->string('Roll_No');
            $table->string('Name_of_the_Organization');
            $table->string('Location');
            $table->string('Salary(Rs/Annum)');
            $table->date('Date_of_Interview');
            $table->string('Remarks')->nullable();
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
        Schema::dropIfExists('StudentActivity_8');
    }
};
