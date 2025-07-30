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
        Schema::create('StudentActivity_3', function (Blueprint $table) {
            $table->id("S_NO");
            $table->date('Date');
            $table->string('Name_of_programme');
            $table->string('Speaker_details/Convener&details');
            $table->string('Coordinator');
            $table->string('Duration');
            $table->string('Dept');
            $table->string('Outcome');
            $table->string('CAMPUS_Document_ID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('StudentActivity_3');
    }
};
