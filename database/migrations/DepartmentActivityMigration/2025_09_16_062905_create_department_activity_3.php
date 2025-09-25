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
        Schema::create('DepartmentActivity_3', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Total_Number_of_Titles');
            $table->string('Total_Number_of_Books');
            $table->string('Total_Number_of_Reference_Books');
            $table->string('Total_Number_of_Journals_Subscribed_National');
            $table->string('Total_Number_of_Journals_Subscribed_International');
            $table->string('Total_Value_of_Books/Journals_Investment(National)');
            $table->string('Total_Value_of_Books/Journals_Investment(international)');
            $table->string('Document_Link',2083)->nullable();
            $table->string('Document');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DepartmentActivity_3');
    }
};
