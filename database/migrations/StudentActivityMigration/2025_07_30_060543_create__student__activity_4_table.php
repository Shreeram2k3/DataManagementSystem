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
        Schema::create('StudentActivity_4', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_student(s)');
            $table->string('Roll_No');
            $table->string('Nmae_of_the_Guide');
            $table->string('Title_of_Project');
            $table->string('Submitted/Sanctioned');
            $table->string('Sponsoring_Agency_(Date of Submission/Sanctioned');
            $table->string('Amount_Sanctioned_in_(Rs)');
            $table->string('Dept');
            $table->string('Document_Link');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('StudentActivity_4');
    }
};
