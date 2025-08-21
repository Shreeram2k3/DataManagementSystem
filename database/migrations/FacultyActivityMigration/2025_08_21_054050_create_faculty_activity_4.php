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
        Schema::create('FacultyActivity_4',function(Blueprint $table)
        {
            $table->id('S_NO');
            $table->date('Date');
            $table->string('Name_of_the_Faculty_members');
            $table->string('Participated_Presented');
            $table->string('Title_of_the_Paper');
            $table->string('Page_Numbers');
            $table->string('Programme');
            $table->string('Conference_Symposium_Training_Programme_Details');
            $table->string('Dept');
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
        Schema::dropIfExists('FacultyActivity_4');
    }
};
