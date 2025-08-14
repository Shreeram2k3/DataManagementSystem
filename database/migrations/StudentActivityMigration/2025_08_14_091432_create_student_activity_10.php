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
        Schema::create('StudentActivity_10', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Semester');
            $table->string('Name_of_the_student');
            $table->string('Roll_No');
            $table->date('From_Date');
            $table->date('To_Date');
            $table->string('Industry_Details');
            $table->string('Stipend(Rs/Month)');
            $table->string('Nature_of_Training');
            $table->string('Duration');
            $table->string('Assessment');
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
        Schema::dropIfExists('StudentActivity_10');
    }
};
