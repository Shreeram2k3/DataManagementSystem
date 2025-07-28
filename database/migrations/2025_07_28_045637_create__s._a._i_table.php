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
        Schema::create('SAI',function(Blueprint $table)
        {
            $table->id('S NO');
            $table->date('Date');
            $table->string('Name of the Programme');
            $table->string('Name of the Speaker  & Details');
            $table->string('Topic');
            $table->string('Outcome');
            $table->integer('Number of Students Participated');
            $table->string('Document Link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SAI');
    }
};
