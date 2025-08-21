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
        Schema::create('FacultyActivity_2',function(Blueprint $table)
        {
            $table->id('S_NO');
            $table->string('Name_of_the_Faculty');
            $table->string('ID');
            $table->string('Title');
            $table->string('Details_of_publication');
            $table->date('Date');
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
        Schema::dropIfExists('FacultyActivity_2');
    }
};
