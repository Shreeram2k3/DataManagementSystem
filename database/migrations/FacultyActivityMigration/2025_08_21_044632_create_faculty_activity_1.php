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
        Schema::create('FacultyActivity_1',function(Blueprint $table)
        {
            $table->id('S_NO');
            $table->string('Name_of_the_Faculty');
            $table->string('ID');
            $table->string('Title_of_the_Paper');
            $table->string('Name_of_the_Journal_Volume');
            $table->string('Page_Nos_Impact_Factor_value');
            $table->string('National/International');
            $table->string('Scopus/SCI/others');
            $table->string("Dept");
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
        Schema::dropIfExists('FacultyActivity_1');
    }
};
