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
        Schema::create('DepartmentActivity_2', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_the_Faculty');
            $table->string('Name_of_the_Equipment_failed/_ Serviced');
            $table->string('Name_of_the_Lab');
            $table->string('Servicing_details');
            $table->string('Amount_Rs');
            $table->string('status');
            $table->date('Date');
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
        Schema::dropIfExists('DepartmentActivity_2');
    }
};
