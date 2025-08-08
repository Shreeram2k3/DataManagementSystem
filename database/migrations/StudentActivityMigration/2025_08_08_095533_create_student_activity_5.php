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
        Schema::create('StudentActivity_5', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_Student(s)');
            $table->string('Roll_No');
            $table->string('Title_of_the_Model/Product_Developed');
            $table->string('Organizer_Details(Venue)');
            $table->date('Date');
            $table->string('Status(Further_enchancement/Final_stage)');
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
        Schema::dropIfExists('StudentActivity_5');
    }
};
