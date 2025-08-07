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
        Schema::create('StudentActivity_1',function(Blueprint $table)
        {
            $table->id();
            $table->date('date');
            $table->string('name_of_programme');
            $table->string('speaker_details');
            $table->string('topic');
            $table->string('outcome');
            $table->integer('students_participated');
            $table->string('document_link',2083);
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('StudentActivity_1');
    }
};
