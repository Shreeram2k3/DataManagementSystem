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
        Schema::create('DepartmentActivity_10', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('AY-SEM');
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
        Schema::dropIfExists('DepartmentActivity_10');
    }
};
