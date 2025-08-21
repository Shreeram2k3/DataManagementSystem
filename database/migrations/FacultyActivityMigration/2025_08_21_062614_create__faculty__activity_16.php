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
        Schema::create('FacultyActivity_16', function (Blueprint $table) {
            $table->id('S_NO');
            $table->string('Name_of_the_Company');
            $table->foreignId('user_id')->constrained('users');
            $table->string('Address');
            $table->string('Benefits/Opportunities_Utilized');
            $table->string('MoU_Duration');
            $table->string('Dept');
            $table->string('Document_Link',2083)->nullable();
            $table->string('Document');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('FacultyActivity_16');
    }
};

    
