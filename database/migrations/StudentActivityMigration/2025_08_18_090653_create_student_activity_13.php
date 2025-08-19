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
        Schema::create('StudentActivity_13', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Semester');
            $table->date('From_Date');
            $table->date('To_Date');
            $table->string('Factory_Visited');
            $table->string('Name_of_the_staff/Students');
            $table->string('Department');
            $table->string('Assessment_Details');
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
        Schema::dropIfExists('StudentActivity_13');
    }
};
