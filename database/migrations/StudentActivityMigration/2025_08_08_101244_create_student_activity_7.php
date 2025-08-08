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
        Schema::create('StudentActivity_7', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Month');
            $table->string('Name_of_Student(s)');
            $table->string('Roll_No');
            $table->string('Staff(if_guided)');
            $table->string('Title_of_the_Paper');
            $table->string('Name_of_the_Journal');
            $table->string('Volume_No');
            $table->string('Page Nos');
            $table->string('Conference Details');
            $table->string('National/International');
            $table->string('Dept');
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
        Schema::dropIfExists('StudentActivity_7');
    }
};
